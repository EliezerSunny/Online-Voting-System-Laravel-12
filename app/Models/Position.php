<?php

namespace App\Models;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    

    protected $fillable = [
        'code',
        'name',
        'party',
        'created_by',
 ];


 public function candidates(): HasMany 
 {
    return $this->hasMany(Candidate::class);
 }

 public function votes(): HasMany 
 {
    return $this->hasMany(Vote::class);
 }


}
