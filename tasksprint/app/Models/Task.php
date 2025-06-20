<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_timestamp',
        'end_timestamp',
        'project_id',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
