<?php

namespace App\Models;

use App\Model\Credit;
use App\Model\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationToCredit extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservation_to_credits';

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
        'reservation_id',
        'amount',
        'due_date',
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
     * Get the credit for this model.
     *
     * @return App\Models\Credit
     */
    public function credit()
    {
        return $this->belongsTo(Credit::class, 'credit_id');
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
     * Get the reservation for this model.
     *
     * @return App\Models\Reservation
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    /**
     * Make a new relation
     *
     * @param int $reservationId
     * @param float $amount
     * @param datetime $dueDate
     * @param int $creditId
     *
     * @return App\Models\ReservationToCredit
     */
    public static function make($reservationId, $amount, $dueDate, $creditId)
    {
        $relation = new ReservationToCredit();
        $relation->reservation_id = $reservationId;
        $relation->amount = $amount;
        $relation->due_date = $dueDate;
        $relation->credit_id = $creditId;

        return $relation;
    }
}
