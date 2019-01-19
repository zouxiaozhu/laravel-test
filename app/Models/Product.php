<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{


    public static function boot()
    {
        parent::boot();
    }
    public function searchableAs()
    {
        return 'product';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

    public function ssss()
    {
    }
    /**
     * @var array
     */
    protected $fillable = ['name', 'url', 'android_url', 'ios_url', 'status', 'sort'];
}
