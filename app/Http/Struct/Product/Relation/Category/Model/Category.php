<?php

namespace App\Http\Struct\Product\Relation\Category\Model;

use App\Http\Struct\Media\Relation\MediaPolymorphic\Trait\MediaPolymorphicTrait;
use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use HasFactory, SoftDeletes, MediaPolymorphicTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'category_id',
    ];

    public function parents(): HasMany
    {
        return $this->hasMany(self::class)->with('parents');
    }

    public function scopeMain(): mixed
    {
        return $this->where('category_id', null);
    }

    public function scopeSub(): mixed
    {
        return $this->where('category_id', '!=', null);
    }
}
