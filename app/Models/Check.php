<?php

namespace App\Models;

use App\Models\Customer;
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
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
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
    public static function whipOut($reservationId, $customerId, $total, $dueDate, $status = 'received')
    {
        $check = new Check();

        $check->reservation_id = $reservationId;
        $check->customer_id = $customerId;
        $check->total = $total;
        $check->due_date = carbonFromDate($dueDate);
        $check->status = $status;

        return $check;
    }
}
