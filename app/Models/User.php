<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function works(){
        return $this->hasMany(Work::class);
    }
    public function proposals(){
        return $this->hasMany(Proposal::class);
    }
    public function chats(){
        return $this->hasMany(Chat::class);
    }

    // お気に入り用
    public function nices(){
        return $this->belongsToMany(Work::class,'nices')->withTimestamps();
    }
    public function isNice($work_id){
        return $this->nices()->where('work_id',$work_id)->exists();
    }
    public function nice($work_id){
        $this->nices()->attach($work_id);
    }
    public function deletenice($work_id){
        $this->nices()->detach($work_id);
    }

}
