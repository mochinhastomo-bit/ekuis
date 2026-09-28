<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama'])]
class Kelas extends Model
{
    protected $table = 'kelas';

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
