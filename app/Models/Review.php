<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reviewer_id',
        'reviewee_id',
        'title',
        'message',
        'images',
        'rating',
    ];

    public function ownerReview(): BelongsTo {
        return $this->belongsTo(User::class, 'reviewer_id', 'id');
    }

    public function personReviewed(): BelongsTo {
        return $this->belongsTo(User::class, 'reviewee_id', 'id');
    }
}
