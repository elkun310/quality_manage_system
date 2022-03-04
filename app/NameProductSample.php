<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NameProductSample extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'name_product_sample';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];
}
