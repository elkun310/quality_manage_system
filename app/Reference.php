<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'references';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'publish_date',
        'code',
        'document_id',
    ];

    public function document()
    {
        $this->belongsTo(Document::class);
    }

    public function getPublishDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
