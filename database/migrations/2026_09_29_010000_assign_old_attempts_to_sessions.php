<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $quizIds = DB::table('quiz_attempts')
            ->whereNull('quiz_session_id')
            ->distinct()
            ->pluck('quiz_id');

        foreach ($quizIds as $quizId) {
            $attempts = DB::table('quiz_attempts')
                ->where('quiz_id', $quizId)
                ->whereNull('quiz_session_id')
                ->orderBy('created_at')
                ->get();

            if ($attempts->isEmpty()) {
                continue;
            }

            $sessionId = DB::table('quiz_sessions')->insertGetId([
                'quiz_id' => $quizId,
                'name' => 'Sesi Sebelumnya',
                'is_active' => false,
                'started_at' => $attempts->first()->created_at,
                'ended_at' => $attempts->last()->created_at,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('quiz_attempts')
                ->where('quiz_id', $quizId)
                ->whereNull('quiz_session_id')
                ->update(['quiz_session_id' => $sessionId]);
        }
    }

    public function down(): void
    {
        $sessionIds = DB::table('quiz_sessions')
            ->where('name', 'Sesi Sebelumnya')
            ->pluck('id');

        DB::table('quiz_attempts')
            ->whereIn('quiz_session_id', $sessionIds)
            ->update(['quiz_session_id' => null]);

        DB::table('quiz_sessions')
            ->whereIn('id', $sessionIds)
            ->delete();
    }
};
