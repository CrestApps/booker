<?php

namespace App\Models;

use App\Models\MaintenanceCategory;
use App\Models\PayableCheck;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRecord extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maintenance_records';

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
        'vehicle_id',
        'category_id',
        'payment_method',
        'cost',
        'paid_at',
        'related_date',
        'notes',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'paid_at',
        'related_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

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
     * Get the category for this model.
     *
     * @return App\Models\MaintenanceCategory
     */
    public function category()
    {
        return $this->belongsTo(MaintenanceCategory::class, 'category_id');
    }

    /**
     * Get the category for this model.
     *
     * @return App\Models\MaintenanceCategory
     */
    public function payableChecks()
    {
        return $this->hasMany(PayableCheck::class, 'expense_id');
    }

    /**
     * Set the paid_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setPaidAtAttribute($value)
    {
        $this->attributes['paid_at'] = !empty($value) ? \DateTime::createFromFormat(config('app.date_out_format'), $value) : null;
    }

    /**
     * Set the related_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setRelatedDateAttribute($value)
    {
        $this->attributes['related_date'] = !empty($value) ? \DateTime::createFromFormat(config('app.date_out_format'), $value) : null;
    }

    /**
     * Create a new instance of MaintenanceRecord model
     *
     * @param  int  $vehicleId
     * @param  int  $categoryId
     * @param  string  $paymentMethod
     * @param  double  $cost
     * @param  Carbon\Carbon  $paidAt
     * @param  string  $notes
     *
     * @return App\Model\MaintenanceRecord
     */
    public static function whipOut($vehicleId, $categoryId, $paymentMethod, $cost, $paidAt, $relatedDate, $notes)
    {
        $record = new MaintenanceRecord();

        $record->vehicle_id = $vehicleId;
        $record->category_id = $categoryId;
        $record->payment_method = $paymentMethod;
        $record->cost = $cost;
        $record->paid_at = $paidAt;
        $record->related_date = $relatedDate;
        $record->notes = $notes;

        return $record;
    }
}
