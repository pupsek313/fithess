<?php

namespace App\Models;

use App\Observers\SpecializationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([SpecializationObserver::class])]
class Specialization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function trainers(): HasMany
    {
        return $this->hasMany(Trainer::class);
    }
}