<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRecord extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maintenance_records';

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
        'vehicle_id',
        'catgeory_id',
        'cost',
        'paid_at',
        'related_date',
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
     * Get the vehicle for this model.
     *
     * @return App\Models\Vehicle
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id');
    }

    /**
     * Get the catgeory for this model.
     *
     * @return App\Models\MaintenanceCatgeory
     */
    public function catgeory()
    {
        return $this->belongsTo('App\Models\MaintenanceCatgeory', 'catgeory_id');
    }

    /**
     * Set the paid_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setPaidAtAttribute($value)
    {
        $this->attributes['paid_at'] = !empty($value) ? \DateTime::createFromFormat(config('app.datetime_out_format'), $value) : null;
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
     * Get paid_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getPaidAtAttribute($value)
    {
        return \DateTime::createFromFormat(config('app.datetime_out_format'), $value);
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
