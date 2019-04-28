<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];

    protected $appends = [
        'gravatar'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class)->latest('updated_at');
    }

    public function isAdmin()
    {
        return in_array(
            strtolower($this->email),
            array_map('strtolower', config('boardbox.administrators'))
        );
    }

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    public function getGravatarAttribute()
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email));
    }

    public function accessibleProjects()
    {
        return Project::where('user_id', $this->id)
            ->orWhereHas('members', function ($query){
                $query->where('user_id', $this->id);
            })
            ->get();
    }
}
