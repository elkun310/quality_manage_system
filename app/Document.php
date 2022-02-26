<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name_company',
        'address',
        'phone',
        'email',
        'digital_code',
        'import_gate',
        'import_date',
        'url',
        'dead_line',
        'status',
    ];

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
