<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization_id',
        'name',
        'phone',
        'bio',
        'experience',
        'price',
        'is_active',
        'photo',
        'attachment'
    ];

    protected function casts(): array
    {
        return [
            'experience' => 'integer',
            'price'      => 'decimal:2',
            'is_active'  => 'boolean',
        ];
    }

    protected function photoUrl(): Attribute
{
    return Attribute::get(fn () => $this->photo
        ? asset('storage/' . $this->photo)
        : asset('images/no-photo.svg'));
}

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function (Builder $q, string $term) {
            $q->where(function (Builder $q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('bio', 'like', "%{$term}%");
            });
        });
    }
}