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

    protected $with = [
        'project'
    ];

    protected $appends = [
        'creator'
    ];

    function getCreatorAttribute(){
        return $this->project->user_id;
    }

    function project()
    {
        return $this->belongsTo(Project::class);
    }

    function complete()
    {
        $this->update(['completed' => true]);
    }

    function incomplete()
    {
        $this->update(['completed' => false]);
    }

    public function path()
    {
        return "/projects/{$this->project->category->name}/{$this->project->id}/tasks/{$this->id}";
    }
}
