<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LinkedSocialAccount extends Model
{
    protected $fillable = [
        'provider',
        'provider_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
