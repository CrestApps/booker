<?php

namespace App\Models;

use App\Models\Check;
use App\Models\Credit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditPayment extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'credit_payments';

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
        'credit_id',
        'amount',
        'payment_method',
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
     * Get the credit for this model.
     *
     * @return App\Models\Credit
     */
    public function credit()
    {
        return $this->belongsTo(Credit::class, 'credit_id');
    }

    /**
     * Get the credit for this model.
     *
     * @return App\Models\Check
     */
    public function check()
    {
        return $this->belongsTo(Check::class, 'check_id');
    }
    /**
     * Create a new instance of the model
     *
     * @param int $creditId
     * @param float $amount
     * @param string $method
     * @param int $checkId
     *
     * @return App\Models\CreditPayment
     */
    public static function whipOut($creditId, $amount, $method, $checkId = null)
    {
        $payment = new CreditPayment();
        $payment->credit_id = $creditId;
        $payment->amount = $amount;
        $payment->payment_method = $method;
        $payment->check_id = $checkId;

        return $payment;
    }

}
