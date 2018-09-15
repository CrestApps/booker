<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationToDriver extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservation_to_drivers';

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
                  'reservation_id',
                  'driver_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the reservation for this model.
     *
     * @return App\Models\Reservation
     */
    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation','reservation_id');
    }

    /**
     * Get the driver for this model.
     *
     * @return App\Models\Driver
     */
    public function driver()
    {
        return $this->belongsTo('App\Models\Driver','driver_id');
    }



}
