<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    private string $quizCode = 'AKL002';

    public function up(): void
    {
        $quiz = DB::table('quizzes')->where('code', $this->quizCode)->first();
        if (!$quiz) {
            $quizId = DB::table('quizzes')->insertGetId([
                'user_id' => 1,
                'title' => 'UTS Aplikasi Komputer Lanjut: Data, Etika, PDP & Privasi',
                'description' => '70 soal: Data (1-42), Etika Digital, UU PDP & Privasi Data (43-70)',
                'code' => $this->quizCode,
                'is_active' => false,
                'periode_id' => 3,
                'prodi_id' => 1,
                'matakuliah_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $quizId = $quiz->id;
        }

        if (DB::table('questions')->where('quiz_id', $quizId)->exists()) {
            return;
        }

        // Answer key mapped to 0-based index:
        // 1.B=1 2.C=2 3.D=3 4.B=1 5.A=0 6.D=3 7.B=1 8.A=0 9.C=2 10.C=2
        // 11.A=0 12.B=1 13.D=3 14.B=1 15.A=0 16.D=3 17.A=0 18.C=2 19.D=3 20.A=0
        // 21.C=2 22.B=1 23.D=3 24.B=1 25.C=2 26.A=0 27.C=2 28.D=3 29.A=0 30.B=1
        // 31.A=0 32.B=1 33.C=2 34.D=3 35.B=1 36.D=3 37.C=2 38.A=0 39.B=1 40.C=2
        // 41.D=3 42.B=1 43.B=1 44.A=0 45.D=3 46.A=0 47.C=2 48.B=1 49.D=3 50.A=0
        // 51.C=2 52.B=1 53.D=3 54.A=0 55.C=2 56.D=3 57.B=1 58.A=0 59.C=2 60.D=3
        // 61.B=1 62.C=2 63.A=0 64.B=1 65.D=3 66.A=0 67.B=1 68.C=2 69.A=0 70.D=3

        $questions = [
            // === BAGIAN A: DATA (1-42) ===
            ['q' => 'Menurut materi, data adalah …', 'o' => ['Informasi yang sudah diolah dan siap dipakai untuk mengambil keputusan', 'Fakta hasil pengamatan atau pengukuran yang dicatat', 'Kesimpulan peneliti tentang suatu fenomena', 'Opini responden mengenai masalah penelitian'], 'a' => 1],
            ['q' => 'Kata "data" berasal dari bahasa Latin "datum" yang berarti …', 'o' => ['Sesuatu yang diukur', 'Sesuatu yang dihitung', 'Sesuatu yang diberikan', 'Sesuatu yang dicatat'], 'a' => 2],
            ['q' => 'Dalam penelitian, data berperan sebagai …', 'o' => ['Kesimpulan akhir penelitian', 'Pengganti hipotesis penelitian', 'Hasil keluaran (output) JASP', 'Bahan mentah yang diolah untuk menjawab pertanyaan penelitian'], 'a' => 3],
            ['q' => 'Pernyataan "IPK Andi = 3,45" merupakan contoh …', 'o' => ['Data', 'Datum', 'Informasi', 'Keputusan'], 'a' => 1],
            ['q' => 'Perbedaan datum dan data menurut materi adalah …', 'o' => ['Datum adalah satu nilai, sedangkan data adalah kumpulan nilai', 'Datum adalah kumpulan nilai, sedangkan data adalah satu nilai', 'Datum bersifat kualitatif, sedangkan data bersifat kuantitatif', 'Datum berasal dari sumber primer, sedangkan data dari sumber sekunder'], 'a' => 0],
            ['q' => 'Pernyataan "Rata-rata IPK kelas A = 3,29" merupakan contoh …', 'o' => ['Datum', 'Data mentah', 'Data kualitatif', 'Informasi'], 'a' => 3],
            ['q' => 'Menurut materi, sifat informasi adalah …', 'o' => ['Mentah dan belum diolah', 'Sudah diolah dan bermakna', 'Belum dapat digunakan untuk apa pun', 'Selalu berbentuk kategori'], 'a' => 1],
            ['q' => 'Dalam pengolahan dengan JASP, data berperan sebagai …, sedangkan informasi berperan sebagai …', 'o' => ['Masukan (input); keluaran (output)', 'Keluaran (output); masukan (input)', 'Proses; masukan (input)', 'Keluaran (output); proses'], 'a' => 0],
            ['q' => 'Urutan alur yang tepat menurut materi adalah …', 'o' => ['Informasi → Pengolahan → Data → Keputusan', 'Data → Informasi → Pengolahan → Keputusan', 'Data → Pengolahan → Informasi → Keputusan', 'Pengolahan → Data → Keputusan → Informasi'], 'a' => 2],
            ['q' => 'Syarat data yang baik "objektif" berarti data …', 'o' => ['Berkaitan langsung dengan masalah yang diteliti', 'Mewakili populasi yang diteliti', 'Menggambarkan keadaan sebenarnya, bukan opini peneliti', 'Sesuai dengan waktu penelitian dilakukan'], 'a' => 2],
            ['q' => 'Data yang berkaitan langsung dengan masalah yang diteliti memenuhi syarat data yang baik, yaitu …', 'o' => ['Relevan', 'Mutakhir', 'Representatif', 'Objektif'], 'a' => 0],
            ['q' => 'Seorang peneliti ingin meneliti tingkat stres seluruh mahasiswa Psikologi satu angkatan, tetapi hanya mengambil responden dari satu kelas kecil. Syarat data yang baik yang paling dikhawatirkan tidak terpenuhi adalah …', 'o' => ['Mutakhir', 'Representatif', 'Relevan', 'Objektif'], 'a' => 1],
            ['q' => 'Data dikatakan mutakhir apabila …', 'o' => ['Dicatat dengan cara yang sama untuk setiap responden', 'Mewakili populasi yang diteliti', 'Tidak memuat opini peneliti', 'Sesuai dengan waktu penelitian dilakukan'], 'a' => 3],
            ['q' => 'Syarat data yang baik "akurat dan konsisten" berarti data …', 'o' => ['Diambil dari pihak lain yang terpercaya', 'Dicatat benar dan dengan cara yang sama untuk setiap responden', 'Selalu berbentuk angka', 'Dikumpulkan dalam waktu yang singkat'], 'a' => 1],
            ['q' => 'Peneliti memakai data survei kepuasan mahasiswa dari 10 tahun lalu untuk menggambarkan kondisi mahasiswa saat ini. Syarat data yang baik yang tidak terpenuhi adalah …', 'o' => ['Mutakhir', 'Relevan', 'Objektif', 'Akurat'], 'a' => 0],
            ['q' => 'Saat data dimasukkan ke JASP, setiap jenis data (misalnya jenis kelamin atau IPK) ditempatkan sebagai …', 'o' => ['Satu baris', 'Satu file', 'Satu sel', 'Satu kolom'], 'a' => 3],
            ['q' => 'Di JASP, satu responden ditempatkan sebagai …', 'o' => ['Satu baris', 'Satu kolom', 'Satu file', 'Satu sheet'], 'a' => 0],
            ['q' => 'Menurut materi, data dikelompokkan dari tiga sudut pandang, yaitu …', 'o' => ['Bentuk, ukuran, dan lokasi', 'Skala, jumlah, dan sumber', 'Sifat, sumber, dan waktu pengumpulan', 'Primer, sekunder, dan panel'], 'a' => 2],
            ['q' => 'Berdasarkan sifatnya, data dibedakan menjadi …', 'o' => ['Primer dan sekunder', 'Cross-section dan time series', 'Diskrit dan panel', 'Kualitatif dan kuantitatif'], 'a' => 3],
            ['q' => 'Data kualitatif (kategorik) adalah data yang …', 'o' => ['Menyatakan kategori, kelompok, atau sifat', 'Bermakna bila dijumlah atau dirata-rata', 'Diperoleh dengan cara mengukur', 'Selalu berupa bilangan bulat'], 'a' => 0],
            ['q' => 'Manakah yang merupakan contoh data kualitatif?', 'o' => ['Tinggi badan', 'Jumlah SKS', 'Golongan darah', 'Suhu ruangan'], 'a' => 2],
            ['q' => 'Manakah yang merupakan contoh data kuantitatif?', 'o' => ['Merek ponsel', 'IPK', 'Program studi', 'Jenis kelamin'], 'a' => 1],
            ['q' => 'Tingkat kepuasan dengan kategori "puas, cukup, tidak puas" tergolong data …', 'o' => ['Kuantitatif kontinu', 'Kuantitatif diskrit', 'Time series', 'Kualitatif'], 'a' => 3],
            ['q' => 'Jenis kelamin dikode 1 = Laki-laki dan 2 = Perempuan. Pernyataan yang benar adalah …', 'o' => ['Data tersebut menjadi kuantitatif karena berupa angka', 'Angka tersebut hanya label, sehingga datanya tetap kualitatif', 'Data tersebut tergolong kuantitatif diskrit', 'Rata-rata dari kode tersebut dapat ditafsirkan sebagai besaran'], 'a' => 1],
            ['q' => 'Menurut materi, hasil perhitungan "rata-rata jenis kelamin = 1,4" …', 'o' => ['Menunjukkan bahwa data jenis kelamin bersifat kontinu', 'Menunjukkan bahwa responden rata-rata berjenis kelamin campuran', 'Tidak bermakna apa pun', 'Valid apabila dihitung dengan JASP'], 'a' => 2],
            ['q' => 'Di JASP, kolom berisi kode jenis kelamin (1 dan 2) harus diatur sebagai …', 'o' => ['Kategori', 'Angka', 'Teks bebas', 'Tanggal'], 'a' => 0],
            ['q' => 'Data kuantitatif diskrit diperoleh dengan cara …', 'o' => ['Mengukur dengan alat ukur', 'Mengamati sifat objek', 'Menghitung', 'Menafsirkan jawaban responden'], 'a' => 2],
            ['q' => 'Ciri data kuantitatif kontinu adalah …', 'o' => ['Nilainya selalu bilangan bulat', 'Menjawab pertanyaan "berapa banyak?"', 'Menyatakan kategori atau kelompok', 'Diperoleh dengan mengukur dan nilainya bisa pecahan'], 'a' => 3],
            ['q' => 'Manakah yang merupakan contoh data diskrit?', 'o' => ['35 mahasiswa', '165,5 cm', '12,3 menit', '0,75 A'], 'a' => 0],
            ['q' => 'Manakah yang merupakan contoh data kontinu?', 'o' => ['4 komponen rusak', '165,5 cm', '21 SKS', '35 mahasiswa'], 'a' => 1],
            ['q' => 'Data tegangan baterai 3,7 V; 3,9 V; 4,1 V termasuk data …', 'o' => ['Kuantitatif kontinu', 'Kualitatif', 'Kuantitatif diskrit', 'Sekunder'], 'a' => 0],
            ['q' => 'Data yang dikumpulkan langsung oleh peneliti melalui kuesioner, wawancara, observasi, atau pengukuran alat disebut data …', 'o' => ['Sekunder', 'Primer', 'Panel', 'Time series'], 'a' => 1],
            ['q' => 'Manakah yang merupakan contoh data sekunder?', 'o' => ['Hasil wawancara yang dilakukan peneliti', 'Hasil observasi yang dilakukan peneliti', 'Data dari BPS atau PDDikti', 'Hasil kuesioner yang disebar peneliti'], 'a' => 2],
            ['q' => 'Kelebihan data primer menurut materi adalah …', 'o' => ['Cepat diperoleh', 'Tidak memerlukan biaya', 'Sudah tersedia di situs publik', 'Sesuai dengan kebutuhan penelitian'], 'a' => 3],
            ['q' => 'Kekurangan data sekunder menurut materi adalah …', 'o' => ['Membutuhkan waktu dan biaya yang besar', 'Belum tentu sesuai dengan kebutuhan penelitian sehingga perlu dicek keabsahannya', 'Harus dikumpulkan sendiri oleh peneliti', 'Tidak dapat diolah dengan JASP'], 'a' => 1],
            ['q' => 'Data cross-section memiliki ciri …', 'o' => ['Satu objek, banyak waktu', 'Banyak objek, banyak waktu', 'Satu objek, satu waktu', 'Banyak objek, satu waktu'], 'a' => 3],
            ['q' => 'Konsumsi listrik gedung kampus per bulan selama 3 tahun merupakan contoh data …', 'o' => ['Cross-section', 'Panel', 'Time series', 'Kualitatif'], 'a' => 2],
            ['q' => 'IPK 100 mahasiswa yang sama dari semester 1 sampai semester 6 termasuk data …', 'o' => ['Panel', 'Time series', 'Cross-section', 'Kualitatif'], 'a' => 0],
            ['q' => 'IPK 100 mahasiswa pada semester ganjil 2026 termasuk data …', 'o' => ['Time series', 'Cross-section', 'Panel', 'Kualitatif'], 'a' => 1],
            ['q' => 'Menurut materi, latihan JASP di mata kuliah ini sebagian besar memakai data …', 'o' => ['Sekunder time series', 'Sekunder panel', 'Primer cross-section dari kuesioner', 'Primer time series dari observasi'], 'a' => 2],
            ['q' => 'Merek ponsel mahasiswa dalam satu kelas termasuk data …', 'o' => ['Kuantitatif diskrit', 'Kuantitatif kontinu', 'Time series', 'Kualitatif'], 'a' => 3],
            ['q' => 'Jumlah SKS yang diambil mahasiswa pada semester ini termasuk data …', 'o' => ['Kualitatif', 'Kuantitatif diskrit', 'Kuantitatif kontinu', 'Panel'], 'a' => 1],

            // === BAGIAN B: ETIKA DIGITAL, UU PDP & PRIVASI DATA (43-70) ===
            ['q' => 'Menurut materi, dalam penelitian modern kemampuan teknis harus berjalan bersama …', 'o' => ['Kecepatan dan efisiensi kerja', 'Etika, privasi, keamanan, dan tanggung jawab', 'Popularitas dan banyaknya responden', 'Penggunaan software statistik berbayar'], 'a' => 1],
            ['q' => 'Alasan JASP digunakan menurut materi adalah …', 'o' => ['Dapat digunakan untuk analisis statistik tanpa harus menggunakan software statistik berbayar', 'Merupakan satu-satunya software statistik yang tersedia', 'Dapat membuat data responden secara otomatis', 'Tidak memerlukan data untuk menghasilkan analisis'], 'a' => 0],
            ['q' => 'Peran AI dalam penelitian menurut materi adalah …', 'o' => ['Menggantikan responden yang sulit dihubungi', 'Membuat data penelitian agar hasilnya sesuai harapan', 'Tidak boleh digunakan sama sekali dalam penelitian', 'Membantu menyusun instrumen, mengolah ide, dan menjelaskan hasil, tetapi harus digunakan secara bertanggung jawab'], 'a' => 3],
            ['q' => 'Prinsip etika digital "Respect" berarti …', 'o' => ['Menghormati orang lain', 'Jujur dan tidak memanipulasi informasi', 'Menjaga informasi pribadi', 'Menghargai karya dan sumber'], 'a' => 0],
            ['q' => 'Sikap tidak langsung percaya atau menyebarkan informasi merupakan prinsip etika digital …', 'o' => ['Honesty', 'Privacy', 'Critical Thinking', 'Respect'], 'a' => 2],
            ['q' => 'Menghargai karya dan sumber orang lain termasuk prinsip etika digital …', 'o' => ['Responsibility', 'Intellectual Property', 'Privacy', 'Honesty'], 'a' => 1],
            ['q' => 'Prinsip etika digital "Honesty" berarti …', 'o' => ['Bertanggung jawab atas tindakan digital', 'Menghormati orang lain', 'Menjaga informasi pribadi', 'Jujur dan tidak memanipulasi informasi'], 'a' => 3],
            ['q' => '"Bertanggung jawab atas tindakan digital" adalah makna dari prinsip etika digital …', 'o' => ['Responsibility', 'Respect', 'Critical Thinking', 'Intellectual Property'], 'a' => 0],
            ['q' => 'Seorang mahasiswa menyebarkan tangkapan layar jawaban kuesioner temannya beserta nama temannya di grup media sosial. Prinsip etika digital yang paling jelas dilanggar adalah …', 'o' => ['Critical Thinking', 'Intellectual Property', 'Privacy', 'Honesty'], 'a' => 2],
            ['q' => 'Pada konsep THINK Before You Click/Share, huruf T (True) menanyakan …', 'o' => ['Apakah informasi bermanfaat?', 'Apakah informasi benar?', 'Apakah informasi perlu dibagikan?', 'Apakah informasi menghormati orang lain?'], 'a' => 1],
            ['q' => 'Pertanyaan "Apakah perlu dibagikan?" pada konsep THINK diwakili oleh huruf …', 'o' => ['H — Helpful', 'I — Inspiring', 'K — Kind', 'N — Necessary'], 'a' => 3],
            ['q' => 'Huruf K pada konsep THINK Before You Click/Share adalah …', 'o' => ['Kind — apakah menghormati orang lain?', 'Kind — apakah bermanfaat?', 'Knowledge — apakah informasi benar?', 'Keep — apakah perlu disimpan?'], 'a' => 0],
            ['q' => 'Pertanyaan "Apakah memberi dampak positif?" pada konsep THINK diwakili oleh huruf …', 'o' => ['T — True', 'H — Helpful', 'I — Inspiring', 'N — Necessary'], 'a' => 2],
            ['q' => 'Berikut yang BUKAN merupakan etika digital dalam penelitian menurut materi adalah …', 'o' => ['Tidak membuat responden fiktif', 'Tidak mengubah jawaban responden', 'Tidak menyebarkan data responden ke pihak yang tidak berwenang', 'Mengumpulkan data responden sebanyak mungkin walaupun tujuannya belum jelas'], 'a' => 3],
            ['q' => 'Mengubah jawaban responden agar hasil penelitian sesuai harapan merupakan tindakan yang …', 'o' => ['Diperbolehkan jika hasil analisis belum signifikan', 'Dilarang dalam etika digital penelitian', 'Diperbolehkan jika diolah menggunakan JASP', 'Diperbolehkan jika jumlah responden sedikit'], 'a' => 1],
            ['q' => 'Menurut materi, menggunakan AI untuk membuat data penelitian palsu adalah tindakan yang …', 'o' => ['Dilarang', 'Diperbolehkan bila waktu penelitian terbatas', 'Diperbolehkan untuk penelitian mahasiswa', 'Diperbolehkan asalkan dicantumkan di laporan'], 'a' => 0],
            ['q' => 'Seorang mahasiswa menambahkan 20 responden fiktif agar jumlah sampelnya mencukupi. Menurut materi, tindakan ini …', 'o' => ['Diperbolehkan bila datanya mirip dengan responden asli', 'Diperbolehkan bila disetujui teman sekelompok', 'Melanggar etika digital dalam penelitian', 'Diperbolehkan bila dianalisis dengan JASP'], 'a' => 2],
            ['q' => 'Menurut materi, data pribadi adalah …', 'o' => ['Hanya data yang tercantum di KTP', 'Data hasil olahan JASP', 'Data yang dipublikasikan oleh BPS', 'Data tentang seseorang yang dapat mengidentifikasi orang tersebut, secara langsung maupun tidak langsung'], 'a' => 3],
            ['q' => 'Manakah yang termasuk contoh data pribadi menurut materi?', 'o' => ['Rata-rata IPK satu kelas', 'NIM', 'Jumlah mahasiswa satu program studi', 'Konsumsi listrik gedung kampus'], 'a' => 1],
            ['q' => 'Data kesehatan, biometrik, genetika, dan catatan kejahatan termasuk kategori …', 'o' => ['Data pribadi umum', 'Bukan data pribadi', 'Data pribadi spesifik', 'Data publik'], 'a' => 2],
            ['q' => 'Manakah yang termasuk data pribadi umum menurut materi?', 'o' => ['Status perkawinan', 'Data biometrik', 'Data kesehatan', 'Data keuangan pribadi'], 'a' => 0],
            ['q' => 'Menurut materi, data pribadi tertentu memiliki karakteristik lebih sensitif sehingga …', 'o' => ['Boleh disebarkan asalkan untuk penelitian', 'Memerlukan perlindungan lebih ketat', 'Tidak perlu dilindungi', 'Hanya boleh diolah dengan JASP'], 'a' => 1],
            ['q' => 'Pada penelitian "Hubungan penggunaan media sosial dengan tingkat stres mahasiswa", data yang mungkin diperlukan adalah …', 'o' => ['NIK responden', 'Alamat lengkap responden', 'Nomor HP responden', 'Skor instrumen tingkat stres'], 'a' => 3],
            ['q' => 'Pada penelitian "Hubungan penggunaan media sosial dengan tingkat stres mahasiswa", data yang belum tentu diperlukan adalah …', 'o' => ['Nama lengkap dan NIK', 'Kelompok usia', 'Semester', 'Intensitas penggunaan media sosial'], 'a' => 0],
            ['q' => 'Prinsip pengumpulan data penelitian menurut materi adalah …', 'o' => ['Kumpulkan data sebanyak mungkin agar lengkap', 'Kumpulkan data secukupnya untuk mencapai tujuan penelitian', 'Kumpulkan semua data pribadi responden', 'Kumpulkan data hanya dari sumber sekunder'], 'a' => 1],
            ['q' => 'Menurut materi, security (keamanan data) berkaitan dengan …', 'o' => ['Apakah data dikumpulkan sesuai tujuan penelitian', 'Apakah data menghormati hak individu', 'Bagaimana data dilindungi dari akses, perubahan, kehilangan, atau serangan yang tidak sah', 'Apakah data cukup mewakili populasi'], 'a' => 2],
            ['q' => 'Menurut materi, privacy (privasi data) berkaitan dengan …', 'o' => ['Apakah data dikumpulkan dan digunakan dengan cara yang tepat, sesuai tujuan, dan menghormati hak individu', 'Bagaimana data dilindungi dari serangan siber', 'Bagaimana data dicadangkan agar tidak hilang', 'Bagaimana data diolah menjadi informasi'], 'a' => 0],
            ['q' => 'Hubungan antara security dan privacy menurut materi adalah …', 'o' => ['Keduanya sama persis', 'Keduanya tidak berhubungan sama sekali', 'Privacy merupakan bagian dari fitur JASP', 'Keduanya berbeda tetapi saling berkaitan'], 'a' => 3],
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

            foreach ($q['o'] as $j => $optionText) {
                DB::table('options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $optionText,
                    'is_correct' => $j === $q['a'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        $quiz = DB::table('quizzes')->where('code', $this->quizCode)->first();
        if ($quiz) {
            $questionIds = DB::table('questions')->where('quiz_id', $quiz->id)->pluck('id');
            DB::table('options')->whereIn('question_id', $questionIds)->delete();
            DB::table('questions')->where('quiz_id', $quiz->id)->delete();
            DB::table('quizzes')->where('id', $quiz->id)->delete();
        }
    }
};
