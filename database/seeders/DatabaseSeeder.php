<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = User::create([
            'name' => 'Dr. Ahmad',
            'email' => 'dosen@test.com',
            'nim' => '1980001',
            'prodi' => 'Teknik Informatika',
            'role' => 'dosen',
            'password' => 'password',
        ]);

        User::create([
            'name' => 'Budi Mahasiswa',
            'email' => 'mahasiswa@test.com',
            'nim' => '2024001',
            'prodi' => 'Teknik Informatika',
            'role' => 'mahasiswa',
            'password' => 'password',
        ]);

        $quiz = $dosen->quizzes()->create([
            'title' => 'Kuis Pemrograman Web',
            'description' => 'Kuis dasar tentang HTML, CSS, dan JavaScript',
            'is_active' => true,
        ]);

        $questions = [
            [
                'text' => 'Apa kepanjangan dari HTML?',
                'time_limit' => 20,
                'options' => [
                    ['text' => 'HyperText Markup Language', 'correct' => true],
                    ['text' => 'High Tech Modern Language', 'correct' => false],
                    ['text' => 'Home Tool Markup Language', 'correct' => false],
                    ['text' => 'Hyperlink and Text Markup Language', 'correct' => false],
                ],
            ],
            [
                'text' => 'CSS digunakan untuk?',
                'time_limit' => 15,
                'options' => [
                    ['text' => 'Mengatur tampilan halaman web', 'correct' => true],
                    ['text' => 'Membuat database', 'correct' => false],
                    ['text' => 'Menulis logika backend', 'correct' => false],
                    ['text' => 'Mengelola server', 'correct' => false],
                ],
            ],
            [
                'text' => 'Manakah yang merupakan framework PHP?',
                'time_limit' => 15,
                'options' => [
                    ['text' => 'Laravel', 'correct' => true],
                    ['text' => 'Django', 'correct' => false],
                    ['text' => 'Express', 'correct' => false],
                    ['text' => 'Spring', 'correct' => false],
                ],
            ],
            [
                'text' => 'Apa fungsi dari JavaScript?',
                'time_limit' => 20,
                'options' => [
                    ['text' => 'Menambahkan interaktivitas pada halaman web', 'correct' => true],
                    ['text' => 'Mendesain tampilan halaman', 'correct' => false],
                    ['text' => 'Membuat struktur halaman', 'correct' => false],
                    ['text' => 'Mengelola database', 'correct' => false],
                ],
            ],
            [
                'text' => 'Tag HTML untuk membuat paragraf adalah?',
                'time_limit' => 10,
                'options' => [
                    ['text' => '<p>', 'correct' => true],
                    ['text' => '<div>', 'correct' => false],
                    ['text' => '<span>', 'correct' => false],
                    ['text' => '<br>', 'correct' => false],
                ],
            ],
        ];

        foreach ($questions as $order => $q) {
            $question = $quiz->questions()->create([
                'question_text' => $q['text'],
                'time_limit' => $q['time_limit'],
                'order' => $order,
            ]);

            foreach ($q['options'] as $opt) {
                $question->options()->create([
                    'option_text' => $opt['text'],
                    'is_correct' => $opt['correct'],
                ]);
            }
        }
    }
}
