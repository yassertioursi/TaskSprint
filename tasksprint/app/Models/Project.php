<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
protected $fillable = [
        'title',
        'description',
        'start_timestamp',
        'end_timestamp',
        'user_id',
        'end_date',

    ];

    public function tasks()
    {
       return $this->hasManyThrough( Task::class, Project::class) ;
    }






    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
