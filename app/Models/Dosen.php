<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dosen extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'dosens';

    protected $guarded = ['id'];

    public function proposal() {
        return $this->belongsToMany(Proposal::class, 'reviewer_proposals')->withTimestamps();
    }


}
