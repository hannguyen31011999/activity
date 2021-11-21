<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityDetail extends Model
{
    protected $table = "activity";
    protected $fillable = [
        'id','user_id','activity_id','desc','isChecked','created_at','updated_at','deleted_at'
    ];

    public function Users()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }

    public function Activitys()
    {
        return $this->belongsTo('App\Models\User','activity_id', 'id');
    }
}
