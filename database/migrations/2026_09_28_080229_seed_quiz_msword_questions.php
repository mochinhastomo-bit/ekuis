<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $userId = DB::table('users')->where('role', 'dosen')->value('id');

        $quizId = DB::table('quizzes')->insertGetId([
            'user_id' => $userId,
            'title' => 'Pengenalan Microsoft Word',
            'description' => 'Soal Pengenalan MS Word: Tab Home & Tab Insert',
            'code' => '2CWBTE',
            'is_active' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $questions = [
            ['Microsoft Word merupakan program aplikasi...', 25, ['Spreadsheet', 'Pengolah kata', 'Presentasi', 'Database'], 1],
            ['Ekstensi file default Microsoft Word versi 2007 ke atas adalah...', 25, ['.doc', '.docx', '.txt', '.rtf'], 1],
            ['Tampilan awal Microsoft Word yang menampilkan dokumen kosong disebut...', 25, ['Template', 'Blank Document', 'New File', 'Start Page'], 1],
            ['Bagian Microsoft Word yang berisi kumpulan perintah dalam bentuk ikon disebut...', 25, ['Menu Bar', 'Ribbon', 'Status Bar', 'Title Bar'], 1],
            ['Title Bar pada Microsoft Word menampilkan...', 25, ['Nomor halaman', 'Nama dokumen yang sedang dibuka', 'Jenis huruf', 'Ukuran kertas'], 1],
            ['Shortcut keyboard untuk membuat dokumen baru adalah...', 25, ['Ctrl + O', 'Ctrl + N', 'Ctrl + S', 'Ctrl + P'], 1],
            ['Shortcut untuk menyimpan dokumen adalah...', 25, ['Ctrl + N', 'Ctrl + P', 'Ctrl + S', 'Ctrl + Z'], 2],
            ['Shortcut untuk membuka dokumen yang sudah ada adalah...', 25, ['Ctrl + O', 'Ctrl + N', 'Ctrl + W', 'Ctrl + E'], 0],
            ['Untuk membatalkan perintah terakhir (Undo) digunakan shortcut...', 25, ['Ctrl + Y', 'Ctrl + Z', 'Ctrl + X', 'Ctrl + R'], 1],
            ['Shortcut Ctrl + Y berfungsi untuk...', 25, ['Undo', 'Redo', 'Copy', 'Paste'], 1],
            ['Status Bar terletak di bagian...', 25, ['Atas jendela', 'Bawah jendela', 'Samping kiri', 'Samping kanan'], 1],
            ['Quick Access Toolbar secara default berisi tombol...', 25, ['Bold, Italic, Underline', 'Save, Undo, Redo', 'Cut, Copy, Paste', 'Font, Size, Color'], 1],
            ['Ruler pada Microsoft Word berfungsi untuk...', 25, ['Menghitung kata', 'Mengatur margin dan indentasi', 'Mencetak dokumen', 'Menyisipkan gambar'], 1],
            ['Tampilan dokumen yang menampilkan seperti hasil cetakan disebut...', 25, ['Web Layout', 'Print Layout', 'Outline', 'Draft'], 1],
            ['Shortcut untuk mencetak dokumen adalah...', 25, ['Ctrl + S', 'Ctrl + P', 'Ctrl + D', 'Ctrl + E'], 1],
            ['Grup Clipboard pada Tab Home berisi perintah...', 25, ['Font dan Paragraph', 'Cut, Copy, Paste', 'Table dan Picture', 'Header dan Footer'], 1],
            ['Shortcut untuk memotong (Cut) teks adalah...', 25, ['Ctrl + C', 'Ctrl + V', 'Ctrl + X', 'Ctrl + A'], 2],
            ['Shortcut untuk menyalin (Copy) teks adalah...', 25, ['Ctrl + X', 'Ctrl + C', 'Ctrl + V', 'Ctrl + D'], 1],
            ['Shortcut untuk menempel (Paste) teks adalah...', 25, ['Ctrl + C', 'Ctrl + X', 'Ctrl + V', 'Ctrl + P'], 2],
            ['Perintah Bold berfungsi untuk...', 25, ['Memiringkan teks', 'Menebalkan teks', 'Menggarisbawahi teks', 'Mencoret teks'], 1],
            ['Shortcut untuk membuat teks miring (Italic) adalah...', 25, ['Ctrl + B', 'Ctrl + I', 'Ctrl + U', 'Ctrl + E'], 1],
            ['Shortcut Ctrl + U berfungsi untuk...', 25, ['Undo', 'Underline', 'Uppercase', 'Update'], 1],
            ['Perintah Strikethrough memberikan efek...', 25, ['Teks tebal', 'Teks miring', 'Garis coret pada teks', 'Teks bergaris bawah'], 2],
            ['Subscript digunakan untuk menulis...', 25, ['Pangkat atas seperti x²', 'Pangkat bawah seperti H₂O', 'Teks tebal', 'Teks kapital'], 1],
            ['Superscript digunakan untuk menulis...', 25, ['Pangkat bawah', 'Pangkat atas seperti m²', 'Huruf kecil', 'Teks miring'], 1],
            ['Untuk mengubah warna teks digunakan perintah...', 25, ['Highlight Color', 'Font Color', 'Shading', 'Border'], 1],
            ['Text Highlight Color berfungsi untuk...', 25, ['Mengubah warna teks', 'Memberi warna stabilo pada teks', 'Mengubah warna latar halaman', 'Memberi border pada teks'], 1],
            ['Perintah untuk meratakan teks di tengah adalah...', 25, ['Align Left', 'Center', 'Align Right', 'Justify'], 1],
            ['Shortcut Ctrl + J berfungsi untuk...', 25, ['Rata kiri', 'Rata tengah', 'Rata kanan', 'Rata kiri-kanan (Justify)'], 3],
            ['Perintah Line Spacing digunakan untuk...', 25, ['Mengatur jarak antar karakter', 'Mengatur jarak antar baris', 'Mengatur jarak antar paragraf', 'Mengatur jarak antar halaman'], 1],
            ['Bullets digunakan untuk membuat...', 25, ['Daftar bernomor', 'Daftar dengan simbol', 'Tabel', 'Catatan kaki'], 1],
            ['Numbering digunakan untuk membuat...', 25, ['Daftar dengan simbol', 'Daftar bernomor', 'Header halaman', 'Indeks'], 1],
            ['Perintah Increase Indent berfungsi untuk...', 25, ['Mengurangi indentasi', 'Menambah indentasi paragraf', 'Menghapus paragraf', 'Menambah spasi'], 1],
            ['Perintah Change Case dapat mengubah teks menjadi...', 25, ['Bold dan Italic', 'UPPERCASE, lowercase, dll', 'Subscript dan Superscript', 'Warna teks'], 1],
            ['Shortcut Ctrl + A berfungsi untuk...', 25, ['Align Center', 'Select All (memilih semua teks)', 'Add Bookmark', 'AutoSave'], 1],
            ['Perintah untuk menyisipkan tabel terdapat pada tab...', 25, ['Home', 'Insert', 'Layout', 'Design'], 1],
            ['Untuk menyisipkan gambar dari komputer digunakan perintah...', 25, ['Online Pictures', 'Pictures', 'Shapes', 'SmartArt'], 1],
            ['SmartArt digunakan untuk membuat...', 25, ['Tabel data', 'Diagram dan grafik organisasi', 'Catatan kaki', 'Daftar isi'], 1],
            ['Perintah Shapes menyediakan...', 25, ['Template dokumen', 'Bentuk-bentuk geometris', 'Jenis huruf', 'Gaya paragraf'], 1],
            ['Header pada dokumen terletak di...', 25, ['Bagian bawah halaman', 'Bagian atas halaman', 'Bagian tengah halaman', 'Bagian samping halaman'], 1],
            ['Footer pada dokumen terletak di...', 25, ['Bagian atas halaman', 'Bagian bawah halaman', 'Bagian tengah', 'Bagian samping'], 1],
            ['Page Number digunakan untuk...', 25, ['Menghitung kata', 'Menyisipkan nomor halaman', 'Membuat daftar isi', 'Mengatur margin'], 1],
            ['Perintah untuk menyisipkan simbol khusus adalah...', 25, ['Special Paste', 'Symbol', 'Character Map', 'Insert Text'], 1],
            ['WordArt digunakan untuk...', 25, ['Menghitung kata', 'Membuat teks dekoratif/artistik', 'Memeriksa ejaan', 'Menerjemahkan teks'], 1],
            ['Hyperlink berfungsi untuk...', 25, ['Menebalkan teks', 'Membuat tautan ke halaman web atau dokumen lain', 'Menyisipkan gambar', 'Mengatur margin'], 1],
            ['Text Box digunakan untuk...', 25, ['Menghapus teks', 'Membuat kotak teks yang dapat dipindahkan', 'Mengubah font', 'Mencetak dokumen'], 1],
            ['Perintah Chart digunakan untuk menyisipkan...', 25, ['Tabel', 'Grafik/diagram data', 'Gambar', 'Video'], 1],
            ['Drop Cap berfungsi untuk...', 25, ['Menghapus huruf pertama', 'Memperbesar huruf pertama paragraf', 'Mengubah warna huruf', 'Membuat daftar'], 1],
            ['Equation pada Tab Insert digunakan untuk...', 25, ['Menghitung jumlah kata', 'Menyisipkan rumus matematika', 'Membuat tabel', 'Menyisipkan tanggal'], 1],
            ['Page Break berfungsi untuk...', 25, ['Menghapus halaman', 'Memulai halaman baru', 'Mengatur margin', 'Mencetak halaman'], 1],
        ];

        foreach ($questions as $order => $q) {
            $questionId = DB::table('questions')->insertGetId([
                'quiz_id' => $quizId,
                'question_text' => $q[0],
                'time_limit' => $q[1],
                'order' => $order,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($q[2] as $i => $optionText) {
                DB::table('options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $optionText,
                    'is_correct' => $i === $q[3],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        $quiz = DB::table('quizzes')->where('code', '2CWBTE')->first();
        if ($quiz) {
            $questionIds = DB::table('questions')->where('quiz_id', $quiz->id)->pluck('id');
            DB::table('options')->whereIn('question_id', $questionIds)->delete();
            DB::table('questions')->where('quiz_id', $quiz->id)->delete();
            DB::table('quizzes')->where('id', $quiz->id)->delete();
        }
    }
};
