<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
