<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkillSubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'skill_category_id',
        'name',
    ];

    public function skillCategory(): BelongsTo {
        return $this->belongsTo(SkillCategory::class);
    }
}
