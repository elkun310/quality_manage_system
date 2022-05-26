<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemption extends Model
{
    protected $table = 'exemptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name_company',
        'expired',
        'dispatch_number',
        'dispatch_date',
        'dispatch_file',
    ];

    public function productExemptions()
    {
        $this->hasMany(ProductExemption::class, 'exemption_id', 'id');
    }
}
