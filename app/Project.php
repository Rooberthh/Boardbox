<?php

namespace App;

use App\Notifications\ProjectMemberWasAdded;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'category_id', 'completed'];

    protected $casts = [
        'completed' => 'boolean'
    ];

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
        $this->NotifyProjectMembers($user);

        $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }

    public function hasMember(User $user)
    {
        return $this->members()->get()->contains($user);
    }

    function complete()
    {
        $this->update(['completed' => true]);
    }

    function incomplete()
    {
        $this->update(['completed' => false]);
    }

    protected function NotifyProjectMembers(User $member)
    {
        $this->members()
            ->where('user_id', '!=', auth()->id())
            ->get()
            ->each
            ->notify(new ProjectMemberWasAdded($this, $member));
    }
}
