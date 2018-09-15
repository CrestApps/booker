<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayableCheck extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payable_checks';

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
        'number',
        'value',
        'due_date',
        'issue_date',
        'expense_id',
        'is_cashed',
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
     * Get the expense for this model.
     *
     * @return App\Models\Expense
     */
    public function expense()
    {
        return $this->belongsTo('App\Models\Expense', 'expense_id');
    }

    /**
     * Set the due_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = !empty($value) ? \DateTime::createFromFormat($this->getDateFormat(), $value) : null;
    }

    /**
     * Set the issue_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setIssueDateAttribute($value)
    {
        $this->attributes['issue_date'] = !empty($value) ? \DateTime::createFromFormat(config('app.date_out_format'), $value) : null;
    }

    /**
     * Get due_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDueDateAttribute($value)
    {
        return \DateTime::createFromFormat(config('app.date_out_format'), $value);
    }

    /**
     * Get issue_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getIssueDateAttribute($value)
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
