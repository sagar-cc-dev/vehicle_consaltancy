<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Vehical extends Model
{
    use HasFactory,Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static $fules = [
        "petrol" => "Petrol",
        "diesal" => "Diesal",
        "electric" => "Electric"
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function vehical_model(){
        return $this->belongsTo('App\Models\VehicalModel','model_id','id');
    }

    public function gallery(){
        return $this->hasMany('App\Models\VehicalGallery');
    }

    public function feature_image(){
        return $this->hasOne('App\Models\VehicalGallery')->where('is_featured',true);
    }

}
