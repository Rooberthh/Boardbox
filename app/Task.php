<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'body', 'completed'
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];

    function project()
    {
        return $this->belongsTo(Project::class);
    }

    function completed()
    {
        $this->update(['completed' => true]);
    }

    function incomplete()
    {
        $this->update(['completed' => false]);
    }
}
