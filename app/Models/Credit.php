<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'credits';

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
        'amount',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'due_date',
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
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get the reservation-to-credit relation models for this model.
     *
     * @return App\Models\ReservationToCredit
     */
    public function reservationRelations()
    {
        return $this->hasMany(ReservationToCredit::class);
    }

    /**
     * Makes a new instance of the model
     *
     * @param int $customerId
     * @param float $amount
     *
     * @return App\Models\Credit
     */
    public static function make($customerId, $amount)
    {
        $credit = new Credit();

        $credit->customer_id = $customerId;
        $credit->amount = $amount;

        return $credit;
    }
}
