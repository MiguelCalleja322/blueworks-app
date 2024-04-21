<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserIdentification extends Model
{
    use HasFactory, SoftDeletes;

    protected  $fillable = [
        'user_id',
        'identification_type',
        'identification_number',
        'identification_issued_date',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
