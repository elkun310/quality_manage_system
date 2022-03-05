<?php

namespace App\Repositories\Document;

use App\Document;
use App\Product;
use App\Reference;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentEloquentRepository extends BaseRepository implements DocumentRepositoryInterface
{

    /**
     * Overwrite of parent class
     *
     * 親クラスの上書き
     * @return mixed|string
     */
    public function model()
    {
        return Document::class;
    }

    /**
     * @param $request
     * @return bool
     * Create document
     */
    public function createDocument($request)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();
            $params['import_date'] = \DateTime::createFromFormat("d/m/Y", $params['import_date'])->format("Y-m-d");
            $params['register_date'] = \DateTime::createFromFormat("d/m/Y", $params['register_date'])->format("Y-m-d");
            $params['date_receive'] = \DateTime::createFromFormat("d/m/Y", $params['date_receive'])->format("Y-m-d");
            $params['dead_line'] = Carbon::parse(now())->addWeekdays(15)->format('Y-m-d');
            $document = Document::create($params);

            //update url and digital code
            if ($request->hasFile('attach_file')) {
                $file = $request->file('attach_file');
                $document->url = $document->id . '_' . $file->getClientOriginalName() ?? null;
            }
            $document->digital_code = $document->id . DIGITAL_NAMESPACE;
            $document->save();

            //create references
            foreach (json_decode($request->reference) as $value) {
                $reference = new Reference();
                $reference->name = $value->name;
                $reference->publish_date = $value->publish_date ? \DateTime::createFromFormat("d/m/Y", $value->publish_date)->format("Y-m-d") : null;
                $reference->code = $value->code ?: null;
                $reference->document_id = $document->id;
                $reference->save();
            }

            //create products
            foreach (json_decode($request->product) as $value) {
                $product = new Product();
                $product->name = $value->name;
                $product->specification = $value->specification;
                $product->symbol = $value->symbol;
                $product->origin = $value->origin;
                $product->amount = $value->amount;
                $product->document_id = $document->id;
                $product->save();
            }

            DB::commit();
            if ($request->hasFile('attach_file')) {
                Storage::disk('public')->putFileAs('attach_files', $file, $document->id . '_' . $file->getClientOriginalName());
            }
            return $document;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * @param $request
     * @param $id
     * @return false
     * Update document
     */
    public function updateDocument($request, $id)
    {
        DB::beginTransaction();
        try {
            $document = $this->model->findOrFail($id);
            $params = $request->all();
            $params['import_date'] = \DateTime::createFromFormat("d/m/Y", $params['import_date'])->format("Y-m-d");
            $params['register_date'] = \DateTime::createFromFormat("d/m/Y", $params['register_date'])->format("Y-m-d");
            $params['date_receive'] = \DateTime::createFromFormat("d/m/Y", $params['date_receive'])->format("Y-m-d");

            if ($params['date_extend']) {
                $params['dead_line'] = Carbon::parse($document['dead_line'])->addWeekdays(15)->format('Y-m-d');
            }
            $this->update($id, $params);
            $oldUrl = $document->url;
            //update url and digital code
            if ($request->hasFile('attach_file')) {
                $file = $request->file('attach_file');
                $document->url = $document->id . '_' . $file->getClientOriginalName() ?? null;
            }
            $document->digital_code = $document->id . DIGITAL_NAMESPACE;
            $document->save();

            //delete all references of document
            $document->references()->delete();


            //create references
            foreach (json_decode($request->reference) as $value) {
                $reference = new Reference();
                $reference->name = $value->name;
                $reference->publish_date = $value->publish_date ? \DateTime::createFromFormat("d/m/Y", $value->publish_date)->format("Y-m-d") : null;
                $reference->code = $value->code ?: null;
                $reference->document_id = $document->id;
                $reference->save();
            }

            //delete all references of document
            $document->products()->delete();

            //create products
            foreach (json_decode($request->product) as $value) {
                $product = new Product();
                $product->name = $value->name;
                $product->specification = $value->specification;
                $product->symbol = $value->symbol;
                $product->origin = $value->origin;
                $product->amount = $value->amount;
                $product->document_id = $document->id;
                $product->save();
            }

            DB::commit();
            if ($request->hasFile('attach_file')) {
                if (Storage::disk('public')->exists("attach_files/" . $oldUrl)) {
                    unlink(storage_path('app/public/attach_files/' . $oldUrl));
                }
                Storage::disk('public')->putFileAs('attach_files', $file, $document->id . '_' . $file->getClientOriginalName());
            }
            return $document;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * Get list documents
     */
    public function getList($param)
    {
        return $this->model
            ->when(isset($param['search']), function ($query) use ($param) {
                return $query->where('name_company', 'like', '%' . escapeSpecialCharacter($param['search']) . '%')
                    ->orWhere('digital_code', 'like', '%' . escapeSpecialCharacter($param['search']) . '%')
                    ->orWhere('standard', 'like', '%' . escapeSpecialCharacter($param['search']) . '%')
                    ->orWhereHas('products', function ($query) use ($param) {
                        $query->where('products.symbol', 'like', '%' . escapeSpecialCharacter($param['search']) . '%');
                    })
                    ->orWhereHas('products', function ($query) use ($param) {
                        $query->where('products.origin', 'like', '%' . escapeSpecialCharacter($param['search']) . '%');
                    });
            })
            ->when(isset($param['dead_line']), function ($query) use ($param) {
                switch ($param['dead_line']) {
                    case DEAD_LINE_STATUS:
                        return $query->where('dead_line', '<', now()->format('Y-m-d'));
                    case ACTIVE:
                        return $query->where('dead_line', '>=', now()->format('Y-m-d'));
                    case ALL:
                        break;
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(PAGINATE_DEFAULT);
    }
}
