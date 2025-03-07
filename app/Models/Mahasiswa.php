<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'mahasiswas';

    protected $guarded = ['id'];

    public function proposal()
    {
        return $this->belongsToMany(Proposal::class, 'mahasiswa_proposals')->withTimestamps();
    }
}
