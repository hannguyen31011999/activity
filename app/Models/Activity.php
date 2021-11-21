<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activity";
    protected $fillable = [
        'id','user_created','activity_name','date_start','address','total_user','cost','costs_incurred','total_revenue','total_expenditure','activity_url','status_activity','created_at','updated_at','deleted_at'
    ];

    public function Users()
    {
        return $this->belongsTo('App\Models\User','user_created', 'id');
    }

    public function ActivityDetails()
    {
        return $this->hasMany('App\Models\ActivityDetail','activity_id','id');
    }
}
