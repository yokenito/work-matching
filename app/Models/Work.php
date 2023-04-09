<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    public function client(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function proposals(){
        return $this->hasMany(Proposal::class);
    }

    public function nices(){
        return $this->belongsToMany(User::class,'nices')
            ->withTimestamps()->withPivot('work_id');
    }

}
