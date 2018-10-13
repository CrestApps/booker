<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assets';

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
        'name',
        'category_id',
        'cost',
        'purchased_at',
        'notes',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'purchased_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the category for this model.
     *
     * @return App\Models\AssetCategory
     */
    public function category()
    {
        return $this->belongsTo('App\Models\AssetCategory', 'category_id');
    }

    /**
     * Set the purchased_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setPurchasedAtAttribute($value)
    {
        $this->attributes['purchased_at'] = !empty($value) ? \DateTime::createFromFormat('j/n/Y g:i A', $value) : null;
    }
}
