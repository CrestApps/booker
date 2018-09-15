<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'related_date',
        'amount',
        'category_id',
        'notes',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the category for this model.
     *
     * @return App\Models\ExpenseCategory
     */
    public function category()
    {
        return $this->belongsTo('App\Models\ExpenseCategory', 'category_id');
    }

    /**
     * Set the related_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setRelatedDateAttribute($value)
    {
        $this->attributes['related_date'] = !empty($value) ? \DateTime::createFromFormat(config('app.date_out_format'), $value) : null;
    }

    /**
     * Get related_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getRelatedDateAttribute($value)
    {
        return \DateTime::createFromFormat(config('app.date_out_format'), $value);
    }

    /**
     * Get deleted_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDeletedAtAttribute($value)
    {
        return \DateTime::createFromFormat(config('app.datetime_out_format'), $value);
    }

}
