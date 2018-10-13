<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

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
        'name',
        'size_id',
        'brand_id',
        'model',
        'year',
        'color',
        'last_oil_change',
        'miles_to_oil_change',
        'current_miles',
        'registration_experation_on',
        'insurance_experation_on',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'is_active',
        'vin_number',
        'licence_plate',
        'purchase_cost',
        'purchased_date',
        'sold_date',
        'sold_amount',
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
     * Get the size for this model.
     *
     * @return App\Models\VehicleSize
     */
    public function size()
    {
        return $this->belongsTo('App\Models\VehicleSize', 'size_id');
    }

    /**
     * Get the brand for this model.
     *
     * @return App\Models\Brand
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    /**
     * Get the reservations for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    /**
     * Set the last_oil_change.
     *
     * @param  string  $value
     * @return void
     */
    public function setLastOilChangeAttribute($value)
    {
        $this->attributes['last_oil_change'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the registration_experation_on.
     *
     * @param  string  $value
     * @return void
     */
    public function setRegistrationExperationOnAttribute($value)
    {
        $this->attributes['registration_experation_on'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the insurance_experation_on.
     *
     * @param  string  $value
     * @return void
     */
    public function setInsuranceExperationOnAttribute($value)
    {
        $this->attributes['insurance_experation_on'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the purchased_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setPurchasedDateAttribute($value)
    {
        $this->attributes['purchased_date'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the sold_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setSoldDateAttribute($value)
    {
        $this->attributes['sold_date'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Get last_oil_change in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getLastOilChangeAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get registration_experation_on in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getRegistrationExperationOnAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get insurance_experation_on in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getInsuranceExperationOnAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get purchased_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getPurchasedDateAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y');
    }

    /**
     * Get sold_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getSoldDateAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y');
    }

    /**
     * Get the best rate available for the given days
     *
     * @param int $days
     *
     * @return float
     */
    public function getRate($days)
    {
        if ($days >= 30) {
            return $this->monthly_rate;
        }
        if ($days >= 7) {
            return $this->weekly_rate;
        }

        return $this->daily_rate;
    }
}
