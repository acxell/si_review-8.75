<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proposal extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'proposals';

    protected $guarded = ['id'];

    public function dosen (){
        return $this->belongsToMany(Dosen::class, 'reviewer_proposals')->withTimestamps();
    }

    public function mahasiswa (){
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_proposals')->withTimestamps();
    }
}
