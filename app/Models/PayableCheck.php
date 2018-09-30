<?php

namespace App\Models;

use Carbon\Carbon;
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
        'due_date',
        'issue_date',
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
     * Get a new instance of the PayableCheck model
     *
     * @param int $number
     * @param double $amount
     * @param Date $dueDate
     * @param DateTime $paidAt
     * @param int $expenseId
     * @param bit $isCashed
     *
     * @return App\Models\PayableCheck
     */
    public static function whipOut($number, $amount, $dueDate, $paidAt, $expenseId, $isCashed = 0)
    {
        $check = new PayableCheck();

        $check->number = $number;
        $check->value = $amount;
        $check->due_date = is_string($dueDate) ? Carbon::createFromFormat(config('app.date_out_format'), $dueDate) : $dueDate;
        $check->issue_date = is_string($paidAt) ? Carbon::createFromFormat(config('app.date_out_format'), $paidAt) : $paidAt;
        $check->expense_id = $expenseId;
        $check->is_cashed = $isCashed;

        return $check;
    }
}
