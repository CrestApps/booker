<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\ReservationToDriver;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservations';

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
        'primary_driver_id',
        'vehicle_id',
        'reserved_from',
        'reserved_to',
        'total_override',
        'total_rent',
        'total_tax',
        'total_owe',
        'total_days',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'reserved_from',
        'reserved_to',
        'picked_up_at',
        'dropped_off_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the primaryDriver for this model.
     *
     * @return App\Models\Customer
     */
    public function primaryDriver()
    {
        return $this->belongsTo(Customer::class, 'primary_driver_id');
    }

    /**
     * Get the vehicle for this model.
     *
     * @return App\Models\Vehicle
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    /**
     * Get the addition drivers for this model.
     *
     * @return App\Models\Customer
     */
    public function additionalDrivers()
    {
        return $this->hasManyThrough(Customer::class, ReservationToDriver::class, 'reservation_id', 'id');
    }

    /**
     * Get the relation to the credit
     *
     * @return App\Models\Customer
     */
    public function creditRelation()
    {
        return $this->hasOne(ReservationToCredit::class);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrder($query)
    {
        return $query->orderByRaw("CASE status WHEN 'completed' THEN 3 WHEN 'in-progress' THEN 2 ELSE 1 END ASC")
            ->orderBy('reserved_from', 'desc')
            ->orderBy('reserved_to', 'desc');
    }

    /**
     * Create a new instance of the reservation model
     *
     * @param Carbon\Carbon $from
     * @param Carbon\Carbon $to
     * @param int $primaryDriveId;
     * @param int $vehicleId;
     * @param float $totalOverride;
     * @param int $totalDays
     * @param float $totalRent
     * @param string $status
     *
     * @return App\Model\Reservation
     */
    public static function whipOut(Carbon $from, Carbon $to, $primaryDriveId, $vehicleId, $totalOverride, $totalDays, $totalRent, $status = 'Scheduled')
    {
        $reservation = new Reservation();
        $reservation->reserved_from = $from;
        $reservation->reserved_to = $to;
        $reservation->primary_driver_id = $primaryDriveId;
        $reservation->total_override = $totalOverride;
        $reservation->vehicle_id = $vehicleId;
        $reservation->total_days = $totalDays;
        $reservation->total_rent = $totalRent;
        $reservation->total_tax = $totalRent * config('booker.tax_rate', 0);
        $reservation->status = $status;

        return $reservation;
    }
}
