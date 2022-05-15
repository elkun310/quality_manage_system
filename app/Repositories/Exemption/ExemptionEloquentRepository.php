<?php

namespace App\Repositories\Exemption;

use App\Exemption;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\ProductExemption;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ExemptionEloquentRepository extends BaseRepository implements ExemptionRepositoryInterface
{

    public function model()
    {
        return Exemption::class;
    }

    /**
     * @param $request
     * @return bool
     * Create Exemption
     */
    public function createExemption($request)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();
            $params['expired'] = \DateTime::createFromFormat("d/m/Y", $params['expired'])->format("Y-m-d");
            $params['dispatch_date'] = \DateTime::createFromFormat("d/m/Y", $params['dispatch_date'])->format("Y-m-d");
            $exemption = Exemption::create($params);
            if ($request->hasFile('dispatch_file')) {
                $file = $request->file('dispatch_file');
                $exemption->dispatch_file = $exemption->id . '_' . $file->getClientOriginalName() ?? null;
            }
            $exemption->save();
            //create products
            foreach (json_decode($params['product']) as $value) {
                $product = new ProductExemption();
                $product->name = $value->name;
                $product->specification = $value->specification;
                $product->symbol = $value->symbol;
                $product->amount = $value->amount;
                $product->exemption_id = $exemption->id;
                $product->save();
            }

            DB::commit();
            if ($request->hasFile('dispatch_file')) {
                Storage::disk('public')->putFileAs('dispatch_file', $file, $exemption->id . '_' . $file->getClientOriginalName());
            }
            return $exemption;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * Get list exemptions
     */
    public function getList($param)
    {
        
    }

}
