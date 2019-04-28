<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'category_id'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($project){
            $project->tasks->each->delete();
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function path()
    {
        return "/projects/{$this->category->slug}/{$this->id}";
    }

    public function invite(User $user)
    {
        $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }
}
