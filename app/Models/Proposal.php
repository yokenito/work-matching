<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    public function proposer(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function work(){
        return $this->belongsTo(Work::class);
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }
}
