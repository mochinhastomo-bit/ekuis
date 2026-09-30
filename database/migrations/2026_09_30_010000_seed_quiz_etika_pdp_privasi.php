<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $quizId = DB::table('quizzes')->insertGetId([
            'user_id' => 1,
            'title' => 'Etika Digital, PDP & Privasi Data',
            'description' => 'Soal Etika Digital, UU Perlindungan Data Pribadi, dan Privasi Data dalam Penelitian',
            'code' => strtoupper(Str::random(6)),
            'is_active' => true,
            'periode_id' => 3,
            'prodi_id' => 1,
            'matakuliah_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $questions = [
            // === ETIKA DIGITAL (1-25) ===
            [
                'q' => 'Salah satu prinsip etika digital yang berkaitan dengan menghormati orang lain adalah …',
                'options' => ['Respect', 'Responsibility', 'Honesty', 'Critical Thinking'],
                'answer' => 0,
            ],
            [
                'q' => 'Prinsip etika digital yang menekankan tanggung jawab atas tindakan di dunia digital adalah …',
                'options' => ['Privacy', 'Responsibility', 'Honesty', 'Respect'],
                'answer' => 1,
            ],
            [
                'q' => 'Prinsip etika digital "Honesty" berarti …',
                'options' => ['Jujur dan tidak memanipulasi informasi', 'Menghormati orang lain', 'Menjaga informasi pribadi', 'Menghargai karya orang lain'],
                'answer' => 0,
            ],
            [
                'q' => 'Menjaga informasi pribadi orang lain merupakan prinsip etika digital yang disebut …',
                'options' => ['Honesty', 'Respect', 'Privacy', 'Responsibility'],
                'answer' => 2,
            ],
            [
                'q' => 'Prinsip "Intellectual Property" dalam etika digital berkaitan dengan …',
                'options' => ['Menghargai karya dan sumber', 'Menjaga keamanan data', 'Berpikir kritis', 'Bertanggung jawab'],
                'answer' => 0,
            ],
            [
                'q' => 'Prinsip etika digital yang mengajarkan untuk tidak langsung percaya atau menyebarkan informasi adalah …',
                'options' => ['Honesty', 'Privacy', 'Critical Thinking', 'Respect'],
                'answer' => 2,
            ],
            [
                'q' => 'Huruf "T" dalam prinsip THINK sebelum membagikan informasi berarti …',
                'options' => ['True', 'Thankful', 'Thoughtful', 'Timely'],
                'answer' => 0,
            ],
            [
                'q' => 'Dalam prinsip THINK, huruf "H" memiliki arti …',
                'options' => ['Honest', 'Helpful', 'Harmless', 'Hopeful'],
                'answer' => 1,
            ],
            [
                'q' => 'Huruf "I" dalam THINK berarti …',
                'options' => ['Important', 'Inspiring', 'Intelligent', 'Inclusive'],
                'answer' => 1,
            ],
            [
                'q' => 'Huruf "N" dalam THINK berarti …',
                'options' => ['Neutral', 'Normal', 'Necessary', 'Natural'],
                'answer' => 2,
            ],
            [
                'q' => 'Huruf "K" dalam THINK berarti …',
                'options' => ['Kind', 'Knowledgeable', 'Keen', 'Key'],
                'answer' => 0,
            ],
            [
                'q' => 'Sebelum membagikan informasi di media sosial, kita sebaiknya menerapkan prinsip …',
                'options' => ['SMART', 'THINK', 'SWOT', 'PDCA'],
                'answer' => 1,
            ],
            [
                'q' => 'Dalam etika digital penelitian, yang TIDAK boleh dilakukan adalah …',
                'options' => ['Mengambil data responden tanpa tujuan yang jelas', 'Meminta persetujuan responden', 'Menjaga kerahasiaan data', 'Menggunakan instrumen yang valid'],
                'answer' => 0,
            ],
            [
                'q' => 'Mengubah jawaban responden agar hasil penelitian sesuai harapan termasuk pelanggaran prinsip …',
                'options' => ['Privacy', 'Honesty', 'Critical Thinking', 'Intellectual Property'],
                'answer' => 1,
            ],
            [
                'q' => 'Membuat responden fiktif dalam penelitian merupakan pelanggaran etika karena …',
                'options' => ['Menghasilkan data palsu yang tidak dapat dipertanggungjawabkan', 'Membuat penelitian lebih mudah', 'Menghemat waktu', 'Mempercepat proses analisis'],
                'answer' => 0,
            ],
            [
                'q' => 'Menyebarkan data responden ke pihak yang tidak berwenang melanggar prinsip …',
                'options' => ['Honesty', 'Responsibility', 'Privacy', 'Critical Thinking'],
                'answer' => 2,
            ],
            [
                'q' => 'Mengklaim hasil penelitian orang lain sebagai milik sendiri disebut …',
                'options' => ['Plagiarisme', 'Manipulasi', 'Fabrikasi', 'Falsifikasi'],
                'answer' => 0,
            ],
            [
                'q' => 'Menggunakan AI untuk membuat data penelitian palsu termasuk pelanggaran …',
                'options' => ['Etika digital', 'Hak akses', 'Lisensi software', 'Hak cipta AI'],
                'answer' => 0,
            ],
            [
                'q' => 'Berikut yang merupakan tindakan etis dalam penelitian digital adalah …',
                'options' => ['Meminta informed consent dari responden', 'Mengubah data agar sesuai hipotesis', 'Membagikan data responden di media sosial', 'Membuat responden palsu'],
                'answer' => 0,
            ],
            [
                'q' => 'Prinsip THINK diterapkan untuk …',
                'options' => ['Mengevaluasi informasi sebelum dibagikan', 'Membuat password yang kuat', 'Menganalisis data statistik', 'Merancang kuesioner'],
                'answer' => 0,
            ],
            [
                'q' => 'Jumlah prinsip etika digital yang dibahas dalam materi adalah …',
                'options' => ['4', '5', '6', '7'],
                'answer' => 2,
            ],
            [
                'q' => 'Yang BUKAN termasuk prinsip etika digital adalah …',
                'options' => ['Respect', 'Profitability', 'Honesty', 'Privacy'],
                'answer' => 1,
            ],
            [
                'q' => 'Etika digital penting dalam penelitian karena …',
                'options' => ['Penelitian modern banyak menggunakan teknologi digital', 'Etika hanya berlaku di dunia nyata', 'Data digital tidak dapat disalahgunakan', 'Penelitian tidak memerlukan etika'],
                'answer' => 0,
            ],
            [
                'q' => 'Sikap "tidak langsung percaya informasi yang diterima" mencerminkan prinsip …',
                'options' => ['Respect', 'Responsibility', 'Privacy', 'Critical Thinking'],
                'answer' => 3,
            ],
            [
                'q' => 'Prinsip etika digital yang paling berkaitan dengan menghindari penyebaran hoaks adalah …',
                'options' => ['Intellectual Property', 'Critical Thinking', 'Respect', 'Privacy'],
                'answer' => 1,
            ],

            // === UU PERLINDUNGAN DATA PRIBADI (26-50) ===
            [
                'q' => 'Data pribadi adalah data tentang seseorang yang dapat …',
                'options' => ['Mengidentifikasi orang tersebut', 'Diakses oleh semua orang', 'Diperjualbelikan secara bebas', 'Disimpan tanpa izin'],
                'answer' => 0,
            ],
            [
                'q' => 'Berikut yang termasuk contoh data pribadi adalah …',
                'options' => ['Cuaca hari ini', 'Nama dan NIM', 'Nama negara', 'Judul buku'],
                'answer' => 1,
            ],
            [
                'q' => 'Yang BUKAN termasuk contoh data pribadi adalah …',
                'options' => ['Nomor telepon', 'NIK', 'Nama kota', 'Alamat email'],
                'answer' => 2,
            ],
            [
                'q' => 'Data pribadi dapat mengidentifikasi seseorang secara …',
                'options' => ['Langsung maupun tidak langsung', 'Langsung saja', 'Tidak langsung saja', 'Acak'],
                'answer' => 0,
            ],
            [
                'q' => 'Yang termasuk data pribadi umum adalah …',
                'options' => ['Data kesehatan', 'Nama lengkap dan jenis kelamin', 'Data biometrik', 'Catatan kejahatan'],
                'answer' => 1,
            ],
            [
                'q' => 'Berikut yang termasuk data pribadi spesifik adalah …',
                'options' => ['Nama lengkap', 'Jenis kelamin', 'Data kesehatan', 'Kewarganegaraan'],
                'answer' => 2,
            ],
            [
                'q' => 'Data biometrik termasuk kategori data pribadi …',
                'options' => ['Umum', 'Spesifik', 'Publik', 'Terbuka'],
                'answer' => 1,
            ],
            [
                'q' => 'Data genetika termasuk dalam kategori …',
                'options' => ['Data pribadi umum', 'Data pribadi spesifik', 'Data publik', 'Data terbuka'],
                'answer' => 1,
            ],
            [
                'q' => 'Catatan kejahatan seseorang termasuk data pribadi …',
                'options' => ['Umum', 'Spesifik', 'Terbuka', 'Bebas'],
                'answer' => 1,
            ],
            [
                'q' => 'Data keuangan pribadi termasuk dalam kategori …',
                'options' => ['Data pribadi umum', 'Data pribadi spesifik', 'Data publik', 'Data organisasi'],
                'answer' => 1,
            ],
            [
                'q' => 'Data anak termasuk dalam kategori data pribadi …',
                'options' => ['Umum', 'Spesifik', 'Bebas', 'Tidak dilindungi'],
                'answer' => 1,
            ],
            [
                'q' => 'Status perkawinan termasuk dalam kategori data pribadi …',
                'options' => ['Spesifik', 'Umum', 'Sensitif tinggi', 'Rahasia negara'],
                'answer' => 1,
            ],
            [
                'q' => 'Agama seseorang termasuk dalam kategori data pribadi …',
                'options' => ['Spesifik', 'Umum', 'Publik', 'Bebas'],
                'answer' => 1,
            ],
            [
                'q' => 'Prinsip pengumpulan data dalam penelitian adalah …',
                'options' => ['Kumpulkan data secukupnya untuk tujuan penelitian', 'Kumpulkan sebanyak mungkin data', 'Data pribadi tidak perlu dilindungi', 'Semua data harus dikumpulkan'],
                'answer' => 0,
            ],
            [
                'q' => 'Dalam penelitian "Hubungan penggunaan media sosial dengan tingkat stres mahasiswa", data yang mungkin diperlukan adalah …',
                'options' => ['NIK dan alamat lengkap', 'Kelompok usia dan intensitas penggunaan medsos', 'Nomor HP dan nama lengkap', 'Rekening bank dan gaji'],
                'answer' => 1,
            ],
            [
                'q' => 'Data yang BELUM TENTU diperlukan dalam penelitian tentang stres mahasiswa adalah …',
                'options' => ['Semester', 'Skor instrumen', 'NIK', 'Kelompok usia'],
                'answer' => 2,
            ],
            [
                'q' => 'Data pribadi spesifik memerlukan perlindungan yang …',
                'options' => ['Lebih ketat', 'Sama dengan data umum', 'Lebih longgar', 'Tidak perlu perlindungan'],
                'answer' => 0,
            ],
            [
                'q' => 'Foto seseorang termasuk …',
                'options' => ['Data pribadi', 'Data publik', 'Data bebas', 'Bukan data'],
                'answer' => 0,
            ],
            [
                'q' => 'Alamat email seseorang termasuk …',
                'options' => ['Bukan data pribadi', 'Data pribadi', 'Data organisasi', 'Data bebas'],
                'answer' => 1,
            ],
            [
                'q' => 'Dalam penelitian, mahasiswa harus mempertimbangkan apakah data yang dikumpulkan …',
                'options' => ['Benar-benar diperlukan', 'Sebanyak mungkin', 'Termasuk data sensitif', 'Bisa diperjualbelikan'],
                'answer' => 0,
            ],

            // === PRIVASI DATA & SECURITY (51-60) ===
            [
                'q' => 'SECURITY dalam konteks data berarti …',
                'options' => ['Bagaimana data dilindungi dari akses tidak sah', 'Bagaimana data dikumpulkan sesuai tujuan', 'Bagaimana data dibagikan ke publik', 'Bagaimana data dihapus'],
                'answer' => 0,
            ],
            [
                'q' => 'PRIVACY dalam konteks data berarti …',
                'options' => ['Bagaimana data dilindungi dari serangan', 'Apakah data dikumpulkan dan digunakan dengan cara yang tepat', 'Bagaimana data disimpan di server', 'Bagaimana data dienkripsi'],
                'answer' => 1,
            ],
            [
                'q' => 'Hubungan antara security dan privacy adalah …',
                'options' => ['Berbeda tetapi saling berkaitan', 'Sama persis', 'Tidak ada hubungan', 'Bertentangan'],
                'answer' => 0,
            ],
            [
                'q' => 'Melindungi data dari perubahan yang tidak sah termasuk aspek …',
                'options' => ['Security', 'Privacy', 'Etika', 'Estetika'],
                'answer' => 0,
            ],
            [
                'q' => 'Memastikan data dikumpulkan sesuai tujuan dan menghormati hak individu termasuk aspek …',
                'options' => ['Security', 'Privacy', 'Backup', 'Recovery'],
                'answer' => 1,
            ],
            [
                'q' => 'Melindungi data dari kehilangan atau serangan termasuk aspek …',
                'options' => ['Privacy', 'Etika', 'Security', 'Estetika'],
                'answer' => 2,
            ],
            [
                'q' => 'Contoh tindakan yang berkaitan dengan security data adalah …',
                'options' => ['Menggunakan password yang kuat', 'Meminta izin responden', 'Mengumpulkan data secukupnya', 'Menjelaskan tujuan penelitian'],
                'answer' => 0,
            ],
            [
                'q' => 'Contoh tindakan yang berkaitan dengan privacy data adalah …',
                'options' => ['Mengenkripsi database', 'Mengumpulkan data sesuai tujuan penelitian', 'Memasang firewall', 'Membuat backup data'],
                'answer' => 1,
            ],
            [
                'q' => 'Yang BUKAN merupakan ancaman terhadap security data adalah …',
                'options' => ['Serangan hacker', 'Kehilangan data', 'Meminta informed consent', 'Akses tidak sah'],
                'answer' => 2,
            ],

            // === PENELITIAN, AI & JASP (61-70) ===
            [
                'q' => 'Penelitian modern banyak dilakukan menggunakan …',
                'options' => ['Teknologi digital', 'Kertas dan pulpen saja', 'Telegraf', 'Radio'],
                'answer' => 0,
            ],
            [
                'q' => 'Pengumpulan data responden sering dilakukan melalui …',
                'options' => ['Google Forms atau platform online', 'Surat pos', 'Telegram kawat', 'Faksimili'],
                'answer' => 0,
            ],
            [
                'q' => 'JASP adalah software yang digunakan untuk …',
                'options' => ['Desain grafis', 'Analisis statistik', 'Membuat presentasi', 'Mengedit video'],
                'answer' => 1,
            ],
            [
                'q' => 'Keunggulan JASP dibandingkan software statistik lain adalah …',
                'options' => ['Gratis (tidak berbayar)', 'Hanya bisa digunakan online', 'Tidak memerlukan instalasi', 'Hanya untuk data kecil'],
                'answer' => 0,
            ],
            [
                'q' => 'AI dapat membantu dalam penelitian untuk …',
                'options' => ['Menyusun instrumen, mengolah ide, dan menjelaskan hasil', 'Menggantikan seluruh proses penelitian', 'Membuat data palsu', 'Menghilangkan kebutuhan analisis'],
                'answer' => 0,
            ],
            [
                'q' => 'Penggunaan AI dalam penelitian harus dilakukan secara …',
                'options' => ['Aman, kritis, dan bertanggung jawab', 'Bebas tanpa batasan', 'Rahasia dan tersembunyi', 'Otomatis tanpa pengawasan'],
                'answer' => 0,
            ],
            [
                'q' => 'Kemampuan teknis dalam penelitian harus berjalan bersama dengan …',
                'options' => ['Etika, privasi, keamanan, dan tanggung jawab', 'Kecepatan dan efisiensi saja', 'Kemampuan finansial', 'Popularitas peneliti'],
                'answer' => 0,
            ],
            [
                'q' => 'Data penelitian yang dikumpulkan secara online dapat mengandung …',
                'options' => ['Informasi pribadi', 'Hanya data publik', 'Data yang tidak perlu dilindungi', 'Informasi yang selalu anonim'],
                'answer' => 0,
            ],
            [
                'q' => 'Alur dasar penelitian kuantitatif mencakup …',
                'options' => ['Pengumpulan data, analisis, dan interpretasi hasil', 'Hanya menulis laporan', 'Hanya membuat kuesioner', 'Hanya mengumpulkan data'],
                'answer' => 0,
            ],
            [
                'q' => 'Yang merupakan pernyataan BENAR tentang hubungan etika, teknologi, dan penelitian adalah …',
                'options' => ['Teknologi menggantikan kebutuhan etika', 'Etika tidak relevan di era digital', 'Kemampuan teknis dan etika harus berjalan bersama', 'Penelitian digital tidak memerlukan privasi'],
                'answer' => 2,
            ],
        ];

        $now = now();
        foreach ($questions as $i => $q) {
            $questionId = DB::table('questions')->insertGetId([
                'quiz_id' => $quizId,
                'question_text' => $q['q'],
                'time_limit' => 30,
                'order' => $i,
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
        $quiz = DB::table('quizzes')->where('title', 'Etika Digital, PDP & Privasi Data')->first();
        if ($quiz) {
            $questionIds = DB::table('questions')->where('quiz_id', $quiz->id)->pluck('id');
            DB::table('options')->whereIn('question_id', $questionIds)->delete();
            DB::table('questions')->where('quiz_id', $quiz->id)->delete();
            DB::table('quizzes')->where('id', $quiz->id)->delete();
        }
    }
};
