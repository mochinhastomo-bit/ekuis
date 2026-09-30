<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $quiz = DB::table('quizzes')->where('title', 'Etika Digital, PDP & Privasi Data')->first();
        if (!$quiz) {
            return;
        }

        $startOrder = DB::table('questions')->where('quiz_id', $quiz->id)->max('order') + 1;

        $questions = [
            [
                'q' => 'Pandangan politik seseorang termasuk dalam kategori data pribadi …',
                'options' => ['Umum', 'Spesifik', 'Publik', 'Bebas'],
                'answer' => 1,
            ],
            [
                'q' => 'Orientasi seksual seseorang termasuk dalam kategori data pribadi …',
                'options' => ['Umum', 'Spesifik', 'Terbuka', 'Tidak dilindungi'],
                'answer' => 1,
            ],
            [
                'q' => 'Tujuan utama UU Perlindungan Data Pribadi adalah …',
                'options' => ['Melindungi hak privasi individu atas data pribadinya', 'Memberikan akses bebas ke data semua orang', 'Menghapus semua data pribadi', 'Memperjualbelikan data pribadi'],
                'answer' => 0,
            ],
            [
                'q' => 'Dalam konteks penelitian, informed consent diberikan untuk …',
                'options' => ['Memastikan responden tahu dan setuju data mereka digunakan', 'Menghilangkan tanggung jawab peneliti', 'Meningkatkan jumlah responden', 'Mempercepat pengumpulan data'],
                'answer' => 0,
            ],
            [
                'q' => 'Anonimisasi data dalam penelitian bertujuan untuk …',
                'options' => ['Melindungi identitas responden', 'Membuat data lebih menarik', 'Menambah jumlah data', 'Mempermudah analisis'],
                'answer' => 0,
            ],
            [
                'q' => 'Data dapat dikatakan aman jika memenuhi aspek confidentiality, integrity, dan …',
                'options' => ['Availability', 'Accountability', 'Authenticity', 'Accessibility'],
                'answer' => 0,
            ],
        ];

        $now = now();
        foreach ($questions as $i => $q) {
            $questionId = DB::table('questions')->insertGetId([
                'quiz_id' => $quiz->id,
                'question_text' => $q['q'],
                'time_limit' => 30,
                'order' => $startOrder + $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($q['options'] as $j => $optionText) {
                DB::table('options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $optionText,
                    'is_correct' => $j === $q['answer'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        // Handled by parent migration rollback
    }
};
