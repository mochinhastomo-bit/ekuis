<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama'])]
class Periode extends Model
{
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
