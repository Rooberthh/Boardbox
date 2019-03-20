<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'color'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->slug}";
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str_slug($name);
    }
}
