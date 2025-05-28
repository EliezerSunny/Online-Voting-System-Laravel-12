<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteSession extends Model
{
    
    protected $fillable = [
        'vote_ends_at',
        'created_by',
        'active',
 ];


}
