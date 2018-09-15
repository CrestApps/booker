<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Check extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'checks';

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
        'customer_id',
        'total',
        'due_date',
        'status',
        'reservation_id',
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
     * Get the customer for this model.
     *
     * @return App\Models\Customer
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    /**
     * Get the reservation for this model.
     *
     * @return App\Models\Reservation
     */
    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation', 'reservation_id');
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
     * Get deleted_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDeletedAtAttribute($value)
    {
        return \DateTime::createFromFormat(config('app.datetime_out_format'), $value);
    }

    /**
     * Makes a new instance of the model
     *
     * @param int $reservationId
     * @param int $customerId
     * @param float $total
     * @param date $dueDate
     * @param string $status
     *
     * @return App\Models\Check
     */
    public static function make($reservationId, $customerId, $total, $dueDate, $status = 'received')
    {
        $check = new Check();

        $check->reservation_id = $reservationId;
        $check->customer_id = $customerId;
        $check->total = $total;
        $check->due_date = $dueDate;
        $check->status = $status;

        return $check;
    }
}
