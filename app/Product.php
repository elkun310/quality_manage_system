<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'specification',
        'symbol',
        'origin',
        'amount',
        'document_id',
    ];

    public function document()
    {
        $this->belongsTo(Document::class);
    }
}
