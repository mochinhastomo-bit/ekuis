<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nim', 'name', 'prodi_id'])]
class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }

    public function quizTokens(): HasMany
    {
        return $this->hasMany(QuizToken::class);
    }

    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
