<?php

namespace App\Models;

use App\Models\Credit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

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
        'fullname',
        'home_address',
        'personal_identification_number',
        'driver_license_number',
        'birth_date',
        'driver_license_issue_date',
        'driver_license_experation_date',
        'phone',
        'is_black_listed',
        'black_list_notes',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'birth_date',
        'driver_license_issue_date',
        'driver_license_experation_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Gets the credit account for this customer
     *
     * @return App\Models\Credit
     */
    public function credit()
    {
        return $this->hasOne(Credit::class);
    }

    /**
     * Set the birth_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = !empty($value) ? \DateTime::createFromFormat(config('app.date_out_format'), $value) : null;
    }

    /**
     * Set the driver_license_issue_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setDriverLicenseIssueDateAttribute($value)
    {
        $this->attributes['driver_license_issue_date'] = !empty($value) ? \DateTime::createFromFormat(config('app.date_out_format'), $value) : null;
    }

    /**
     * Set the driver_license_experation_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setDriverLicenseExperationDateAttribute($value)
    {
        $this->attributes['driver_license_experation_date'] = !empty($value) ? \DateTime::createFromFormat(config('app.date_out_format'), $value) : null;
    }
}
