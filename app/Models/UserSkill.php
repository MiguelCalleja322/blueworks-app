<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSkill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'skill_sub_category_id',
        'skill_requirement_id',
        'is_allowed',
        'is_submitted',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function skillSubCategory(): BelongsTo {
        return $this->belongsTo(SkillSubCategory::class);
    }

    public function skillRequirement(): BelongsTo {
        return $this->belongsTo(SkillRequirement::class);
    }
}
