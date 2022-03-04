<?php

namespace App;

use Carbon\Carbon;
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
        'register_date',
        'standard',
        'number_receive',
        'date_receive',
        'is_publish',
    ];

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImportDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getDateReceiveAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getRegisterDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
