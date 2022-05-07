<?php

namespace App\Repositories\Exemption;

use App\Exemption;
use App\Repositories\BaseRepository;

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
        
    }

    /**
     * Get list exemptions
     */
    public function getList($param)
    {
        
    }

}
