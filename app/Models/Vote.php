<?php

namespace App\Models;

use App\Models\User;
use App\Models\Position;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    

    protected $fillable = [
        'user_id',
        'position_id',
        'candidate_id',
        'vote',
 ];


 public function user(): BelongsTo 
 {
    return $this->belongsTo(User::class);
 }

 public function position(): BelongsTo 
 {
    return $this->belongsTo(Position::class);
 }

 public function candidate(): BelongsTo 
 {
    return $this->belongsTo(Candidate::class);
 }


}
