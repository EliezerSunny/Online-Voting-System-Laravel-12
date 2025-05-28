<?php

namespace App\Models;

use App\Models\Vote;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    

    protected $fillable = [
        'unique_id',
        'position_id',
        'first_name',
        'last_name',
        'other_name',
        'username',
        'gender',
        'slug',
        'email',
        'image',
        'phone_number',
        'created_by',
 ];


 public function position(): BelongsTo 
 {
    return $this->belongsTo(Position::class);
 }

 public function votes(): HasMany 
 {
    return $this->hasMany(Vote::class);
 }
 


}
