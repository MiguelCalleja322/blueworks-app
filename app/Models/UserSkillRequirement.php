<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSkillRequirement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_skill_id',
        'name',
        'validity',
        'url_reference',
    ];

    public function userSkill(): BelongsTo {
        return $this->belongsTo(UserSkill::class);
    }
}
