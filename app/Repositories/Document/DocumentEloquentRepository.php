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

    public function createDocument($request) {
        DB::beginTransaction();
        try {
            $params = $request->all();
            $params['import_date'] = Carbon::parse(date('Y-m-d', strtotime($params['import_date'])));
            $params['dead_line'] = Carbon::parse(now())->addWeekdays(15)->format('y-m-d');
            $document = Document::create($params);

            //update url and digital code
            if ($request->hasFile('attach_file')) {
                $file = $request->file('attach_file');
                $document->url = $document->id.'_'.$file->getClientOriginalName() ?? null;
            }
            $document->digital_code = $document->id . DIGITAL_NAMESPACE;
            $document->save();

            //create references
            foreach (json_decode($request->reference) as $value) {
                $reference = new Reference();
                $reference->name = $value->name;
                $reference->publish_date = Carbon::parse(date('Y-m-d', strtotime($value->publish_date)));
                $reference->code = $value->code;
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
            Storage::disk('public')->putFileAs('attach_files', $file, $document->id.'_'.$file->getClientOriginalName());
            return $document;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }
}
