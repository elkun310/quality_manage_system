<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductExemption extends Model
{
    protected $table = 'product_exemptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'specification',
        'symbol',
        'amount',
        'exemption_id',
    ];

    public function exemption()
    {
        $this->belongsTo(Exemption::class);
    }
}
