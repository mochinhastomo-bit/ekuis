<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $quiz = DB::table('quizzes')->where('code', 'VPNUV6')->first();
        if (!$quiz) {
            $quizId = DB::table('quizzes')->insertGetId([
                'user_id' => 1,
                'title' => 'Ujian Tengah Semester',
                'description' => 'UTS Aplikasi Komputer Dasar: Microsoft Word & Microsoft Excel',
                'code' => 'VPNUV6',
                'is_active' => false,
                'periode_id' => 3,
                'prodi_id' => 2,
                'matakuliah_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $quiz = (object) ['id' => $quizId];
        }

        if (DB::table('questions')->where('quiz_id', $quiz->id)->exists()) {
            return;
        }

        $startOrder = 0;

        // Answer key: question number => correct option index (0-based)
        // 1.C=2, 2.B=1, 3.D=3, 4.A=0, 5.B=1, 6.A=0, 7.C=2, 8.D=3, 9.C=2, 10.B=1
        // 11.A=0, 12.D=3, 13.A=0, 14.B=1, 15.C=2, 16.A=0, 17.D=3, 18.B=1
        // 19.C=2, 20.D=3, 21.B=1, 22.C=2, 23.A=0, 24.B=1, 25.D=3, 26.A=0
        // 27.B=1, 28.A=0, 29.C=2, 30.D=3, 31.B=1, 32.A=0, 33.C=2, 34.D=3, 35.A=0
        // 36.C=2, 37.B=1, 38.D=3, 39.A=0, 40.C=2, 41.B=1
        // 42.C=2, 43.D=3, 44.A=0, 45.B=1, 46.D=3, 47.A=0, 48.B=1, 49.C=2, 50.C=2
        // 51.A=0, 52.B=1, 53.C=2, 54.D=3, 55.B=1, 56.A=0, 57.C=2, 58.D=3
        // 59.A=0, 60.C=2, 61.B=1, 62.D=3, 63.C=2, 64.A=0, 65.B=1, 66.A=0, 67.C=2, 68.D=3, 69.B=1, 70.B=1

        $questions = [
            ['q' => 'Bagian paling atas jendela Microsoft Word yang menampilkan nama dokumen yang sedang dibuka disebut …', 'o' => ['Ribbon', 'Status Bar', 'Title Bar', 'Ruler'], 'a' => 2],
            ['q' => 'Deretan tab berisi kumpulan perintah seperti Home, Insert, Layout, dan References disebut …', 'o' => ['Quick Access Toolbar', 'Ribbon', 'Status Bar', 'Navigation Pane'], 'a' => 1],
            ['q' => 'Kumpulan tombol kecil di pojok kiri atas jendela (misalnya Save, Undo, Redo) yang isinya dapat diatur sendiri oleh pengguna disebut …', 'o' => ['Title Bar', 'Ribbon', 'Status Bar', 'Quick Access Toolbar'], 'a' => 3],
            ['q' => 'Informasi yang umumnya ditampilkan pada Status Bar Word adalah …', 'o' => ['Nomor halaman aktif, jumlah halaman, dan jumlah kata', 'Daftar jenis huruf yang tersedia', 'Riwayat dokumen yang pernah dibuka', 'Daftar tab pada Ribbon'], 'a' => 0],
            ['q' => 'Ruler (penggaris) pada Word berfungsi untuk …', 'o' => ['Mengatur jenis dan ukuran huruf', 'Mengatur indentasi paragraf dan tab stop', 'Menyimpan dokumen', 'Mencetak dokumen'], 'a' => 1],
            ['q' => 'Pada tab Home terdapat kelompok perintah bernama Font dan Paragraph. Kelompok perintah di dalam sebuah tab disebut …', 'o' => ['Group', 'Section', 'Tab', 'Window'], 'a' => 0],
            ['q' => 'Tab File (Backstage View) berisi perintah-perintah seperti …', 'o' => ['Bold, Italic, Underline', 'Margins, Orientation, Size', 'Save As, Print, Open', 'Table, Picture, Shapes'], 'a' => 2],
            ['q' => 'Ekstensi bawaan file dokumen Microsoft Word versi 2007 ke atas adalah …', 'o' => ['.xlsx', '.pptx', '.txt', '.docx'], 'a' => 3],
            ['q' => 'Mode tampilan (view) yang menampilkan dokumen sesuai bentuknya saat dicetak adalah …', 'o' => ['Read Mode', 'Web Layout', 'Print Layout', 'Outline'], 'a' => 2],
            ['q' => 'Tombol panah kecil di pojok kanan bawah sebuah group (dialog box launcher) berfungsi untuk …', 'o' => ['Menyembunyikan Ribbon', 'Membuka kotak dialog berisi pengaturan yang lebih lengkap dari group tersebut', 'Menambahkan tab baru', 'Menyimpan dokumen'], 'a' => 1],

            ['q' => 'Perintah Page Number untuk menyisipkan nomor halaman terdapat pada tab …', 'o' => ['Insert', 'Home', 'Layout', 'View'], 'a' => 0],
            ['q' => 'Agar nomor halaman muncul di bagian bawah setiap halaman, pilihan yang digunakan pada menu Page Number adalah …', 'o' => ['Top of Page', 'Page Margins', 'Current Position', 'Bottom of Page'], 'a' => 3],
            ['q' => 'Area di bagian atas halaman yang isinya muncul berulang di setiap halaman disebut …', 'o' => ['Header', 'Footer', 'Footnote', 'Margin'], 'a' => 0],
            ['q' => 'Untuk mengubah format nomor halaman menjadi angka Romawi kecil (i, ii, iii), digunakan perintah …', 'o' => ['Remove Page Numbers', 'Format Page Numbers', 'Page Setup', 'Columns'], 'a' => 1],
            ['q' => 'Agar nomor halaman pada Bab I dimulai lagi dari angka 1, pada kotak dialog Format Page Numbers dipilih …', 'o' => ['Continue from previous section', 'Include chapter number', 'Start at: 1', 'Different First Page'], 'a' => 2],
            ['q' => 'Agar halaman sampul (halaman pertama) tidak menampilkan nomor halaman, opsi yang diaktifkan pada Header & Footer adalah …', 'o' => ['Different First Page', 'Different Odd & Even Pages', 'Link to Previous', 'Show Document Text'], 'a' => 0],
            ['q' => 'Opsi Different Odd & Even Pages digunakan ketika …', 'o' => ['Dokumen hanya terdiri dari satu halaman', 'Nomor halaman ingin dihapus semuanya', 'Halaman pertama tidak ingin diberi nomor', 'Nomor halaman ganjil dan genap ingin ditempatkan pada posisi yang berbeda'], 'a' => 3],
            ['q' => 'Untuk keluar dari mode pengeditan header dan footer, tombol yang diklik adalah …', 'o' => ['Remove Footer', 'Close Header and Footer', 'Delete', 'Undo'], 'a' => 1],

            ['q' => 'Perintah Breaks untuk menyisipkan Section Break terdapat pada tab …', 'o' => ['Home', 'Insert', 'Layout', 'Review'], 'a' => 2],
            ['q' => 'Jenis Section Break yang membuat section baru dimulai di halaman berikutnya adalah …', 'o' => ['Continuous', 'Even Page', 'Column', 'Next Page'], 'a' => 3],
            ['q' => 'Jenis Section Break yang membuat section baru dimulai pada halaman yang sama adalah …', 'o' => ['Next Page', 'Continuous', 'Odd Page', 'Text Wrapping'], 'a' => 1],
            ['q' => 'Pada skripsi, bagian awal (kata pengantar, daftar isi) bernomor i, ii, iii, sedangkan Bab I dan seterusnya bernomor 1, 2, 3. Cara yang paling tepat adalah …', 'o' => ['Membuat dua file yang terpisah', 'Mengetik nomor halaman secara manual di setiap halaman', 'Menyisipkan Section Break (Next Page) di antara bagian awal dan Bab I, lalu mengatur format nomor halaman tiap section', 'Menyisipkan Page Break di antara bagian awal dan Bab I'], 'a' => 2],
            ['q' => 'Agar perubahan header/footer pada section 2 tidak ikut mengubah header/footer section 1, tombol yang harus dinonaktifkan adalah …', 'o' => ['Link to Previous', 'Different First Page', 'Show Next', 'Page Color'], 'a' => 0],
            ['q' => 'Sebuah dokumen berorientasi portrait memiliki satu halaman tabel lebar yang harus landscape. Cara yang tepat adalah …', 'o' => ['Mengubah orientasi seluruh dokumen menjadi landscape', 'Menyisipkan Section Break (Next Page) sebelum dan sesudah halaman tersebut, lalu mengubah orientasi khusus section itu', 'Memutar tabel menggunakan Text Direction', 'Menyisipkan Page Break sebelum dan sesudah halaman tersebut'], 'a' => 1],
            ['q' => 'Untuk menampilkan tanda Section Break yang biasanya tersembunyi, tombol yang digunakan adalah …', 'o' => ['Zoom', 'Ruler', 'Gridlines', 'Show/Hide ¶'], 'a' => 3],
            ['q' => 'Perbedaan Page Break dan Section Break yang benar adalah …', 'o' => ['Page Break hanya memindahkan teks ke halaman berikutnya, sedangkan Section Break membuat bagian baru yang dapat memiliki pengaturan layout berbeda', 'Keduanya sama sekali tidak memiliki perbedaan', 'Section Break hanya dapat digunakan pada tabel', 'Page Break dapat mengubah orientasi halaman, sedangkan Section Break tidak'], 'a' => 0],

            ['q' => 'Sebuah file Microsoft Excel disebut …', 'o' => ['Worksheet', 'Workbook', 'Cell', 'Range'], 'a' => 1],
            ['q' => 'Lembar kerja yang berada di dalam sebuah file Excel disebut …', 'o' => ['Worksheet', 'Workbook', 'Chart', 'Template'], 'a' => 0],
            ['q' => 'Pertemuan antara kolom dan baris pada lembar kerja Excel disebut …', 'o' => ['Range', 'Kolom', 'Cell (sel)', 'Baris'], 'a' => 2],
            ['q' => 'Pada Excel, penamaan kolom dan baris yang benar adalah …', 'o' => ['Kolom diberi angka, baris diberi huruf', 'Kolom dan baris sama-sama diberi huruf', 'Kolom dan baris sama-sama diberi angka', 'Kolom diberi huruf, baris diberi angka'], 'a' => 3],
            ['q' => 'Name Box pada Excel menampilkan …', 'o' => ['Isi rumus dari sel aktif', 'Alamat (nama) sel yang sedang aktif', 'Nama file workbook', 'Jumlah worksheet'], 'a' => 1],
            ['q' => 'Formula Bar pada Excel berfungsi untuk …', 'o' => ['Menampilkan dan mengedit isi atau rumus pada sel aktif', 'Mengganti nama worksheet', 'Mengatur lebar kolom', 'Menyimpan workbook'], 'a' => 0],
            ['q' => 'Penulisan range yang benar untuk sel A1 sampai D10 adalah …', 'o' => ['A1;D10', 'A1-D10', 'A1:D10', 'A1/D10'], 'a' => 2],
            ['q' => 'Ekstensi bawaan file Microsoft Excel versi 2007 ke atas adalah …', 'o' => ['.docx', '.pptx', '.txt', '.xlsx'], 'a' => 3],
            ['q' => 'Setiap penulisan rumus di Excel harus diawali dengan tanda …', 'o' => ['=', '#', '@', '$'], 'a' => 0],

            ['q' => 'Tombol pintas (shortcut) untuk mengubah range data menjadi tabel (Insert Table) adalah …', 'o' => ['Ctrl+B', 'Ctrl+P', 'Ctrl+T', 'Ctrl+S'], 'a' => 2],
            ['q' => 'Saat membuat tabel, opsi "My table has headers" dicentang. Artinya …', 'o' => ['Tabel otomatis diberi warna', 'Baris pertama pada range dijadikan judul kolom (header)', 'Tabel diberi judul di atasnya', 'Kolom pertama dikunci'], 'a' => 1],
            ['q' => 'Tombol panah kecil yang muncul pada setiap judul kolom tabel berfungsi untuk …', 'o' => ['Menghapus kolom', 'Menambah kolom baru', 'Mengubah warna kolom', 'Mengurutkan (sort) dan menyaring (filter) data'], 'a' => 3],
            ['q' => 'Untuk menambahkan garis tepi pada sel-sel tabel, perintah yang digunakan adalah …', 'o' => ['Borders', 'Fill Color', 'Font Color', 'Wrap Text'], 'a' => 0],
            ['q' => 'Fitur Total Row pada tabel Excel berfungsi untuk …', 'o' => ['Menjumlahkan semua worksheet', 'Menambahkan kolom nomor urut', 'Menambahkan baris di bagian bawah tabel untuk menampilkan ringkasan seperti jumlah atau rata-rata', 'Mencetak tabel'], 'a' => 2],
            ['q' => 'Untuk menggabungkan beberapa sel menjadi satu sekaligus meletakkan teks di tengah (misalnya untuk judul tabel), perintah yang digunakan adalah …', 'o' => ['Wrap Text', 'Merge & Center', 'Center', 'Orientation'], 'a' => 1],

            ['q' => 'Fungsi Excel untuk menjumlahkan sekumpulan angka adalah …', 'o' => ['COUNT', 'MAX', 'SUM', 'AVERAGE'], 'a' => 2],
            ['q' => 'Nama fungsi yang benar untuk menghitung nilai rata-rata di Excel adalah …', 'o' => ['AVG', 'MEAN', 'RATA', 'AVERAGE'], 'a' => 3],
            ['q' => 'Tombol AutoSum untuk menjumlahkan data secara cepat terdapat pada tab …', 'o' => ['Home', 'Insert', 'View', 'Review'], 'a' => 0],
            ['q' => 'Rumus yang benar untuk menjumlahkan isi sel B2 sampai B6 adalah …', 'o' => ['=SUM(B2-B6)', '=SUM(B2:B6)', 'SUM(B2:B6)', '=TOTAL(B2:B6)'], 'a' => 1],
            ['q' => 'Sel B2 sampai B6 berisi angka 70, 85, 60, 90, dan 75. Hasil dari rumus =SUM(B2:B6) adalah …', 'o' => ['370', '375', '390', '380'], 'a' => 3],
            ['q' => 'Sel B2 sampai B6 berisi angka 70, 85, 60, 90, dan 75. Hasil dari rumus =AVERAGE(B2:B6) adalah …', 'o' => ['76', '75', '80', '380'], 'a' => 0],
            ['q' => 'Sel B2 sampai B6 berisi angka 70, 85, 60, 90, dan 75. Hasil dari rumus =MIN(B2:B6) adalah …', 'o' => ['70', '60', '75', '90'], 'a' => 1],
            ['q' => 'Sel B2 sampai B6 berisi angka 70, 85, 60, 90, dan 75. Hasil dari rumus =MAX(B2:B6) adalah …', 'o' => ['85', '75', '90', '380'], 'a' => 2],
            ['q' => 'Sel B2, B3, B5, dan B6 berisi angka 70, 85, 90, dan 75, sedangkan sel B4 kosong. Hasil dari rumus =AVERAGE(B2:B6) adalah …', 'o' => ['64', '76', '80', '320'], 'a' => 2],
            ['q' => 'Sel B2 sampai B6 berisi angka 70, 85, 60, 90, dan 75. Hasil dari rumus =MAX(B2:B6)-MIN(B2:B6) adalah …', 'o' => ['30', '15', '60', '150'], 'a' => 0],
            ['q' => 'Sel B2 berisi 70, sel B3 berisi 85, dan sel B4 berisi 60. Hasil dari rumus =SUM(B2,B4) adalah …', 'o' => ['215', '130', '70', '60'], 'a' => 1],

            ['q' => 'Fitur Text to Columns terdapat pada tab …', 'o' => ['Home', 'Insert', 'Data', 'View'], 'a' => 2],
            ['q' => 'Fungsi utama fitur Text to Columns adalah …', 'o' => ['Menggabungkan beberapa kolom menjadi satu', 'Mengubah teks menjadi huruf kapital', 'Membuat grafik dari data teks', 'Memisahkan isi satu kolom menjadi beberapa kolom berdasarkan pemisah atau lebar tertentu'], 'a' => 3],
            ['q' => 'Data responden tertulis dalam satu sel: Andi;Laki-laki;21. Agar terpisah menjadi tiga kolom, pengaturan Text to Columns yang tepat adalah …', 'o' => ['Fixed Width', 'Delimited dengan pemisah Semicolon', 'Delimited dengan pemisah Comma', 'Delimited dengan pemisah Tab'], 'a' => 1],
            ['q' => 'Pilihan Fixed Width pada Text to Columns tepat digunakan apabila …', 'o' => ['Setiap bagian data memiliki lebar (jumlah karakter) yang tetap', 'Data dipisahkan oleh tanda koma', 'Data berupa angka desimal', 'Data berisi rumus'], 'a' => 0],
            ['q' => 'Kolom A berisi nama lengkap seperti "Rina Kartika". Agar nama depan dan nama belakang terpisah ke dua kolom, pemisah (delimiter) yang dipilih adalah …', 'o' => ['Tab', 'Comma', 'Space', 'Semicolon'], 'a' => 2],
            ['q' => 'Sebelum menjalankan Text to Columns, kolom di sebelah kanan data sebaiknya dikosongkan karena …', 'o' => ['Agar ukuran file lebih kecil', 'Agar chart dapat muncul', 'Agar rumus dapat berjalan', 'Hasil pemisahan akan menimpa data yang sudah ada di kolom sebelah kanan'], 'a' => 3],

            ['q' => 'Menu untuk membuat chart (grafik) di Excel terdapat pada tab …', 'o' => ['Insert', 'Data', 'Home', 'Formulas'], 'a' => 0],
            ['q' => 'Jenis chart yang paling tepat untuk membandingkan jumlah mahasiswa Psikologi per angkatan adalah …', 'o' => ['Pie', 'Line', 'Column', 'Scatter'], 'a' => 2],
            ['q' => 'Jenis chart yang paling tepat untuk menunjukkan proporsi (persentase) setiap bagian terhadap keseluruhan adalah …', 'o' => ['Line', 'Pie', 'Column', 'Scatter'], 'a' => 1],
            ['q' => 'Jenis chart yang paling tepat untuk menunjukkan tren skor stres mahasiswa dari bulan ke bulan adalah …', 'o' => ['Pie', 'Doughnut', 'Radar', 'Line'], 'a' => 3],
            ['q' => 'Elemen chart yang menjelaskan arti warna atau simbol setiap seri data disebut …', 'o' => ['Axis Title', 'Data Label', 'Legend', 'Gridlines'], 'a' => 2],
            ['q' => 'Jika angka pada data sumber sebuah chart diubah, maka …', 'o' => ['Chart otomatis ikut menyesuaikan dengan data yang baru', 'Chart akan terhapus', 'Chart harus dibuat ulang dari awal', 'Excel menolak perubahan data tersebut'], 'a' => 0],

            ['q' => 'Susunan argumen fungsi IF yang benar adalah …', 'o' => ['=IF(nilai_jika_benar, uji_logika, nilai_jika_salah)', '=IF(uji_logika, nilai_jika_benar, nilai_jika_salah)', '=IF(uji_logika, nilai_jika_salah, nilai_jika_benar)', '=IF(nilai_jika_salah, nilai_jika_benar, uji_logika)'], 'a' => 1],
            ['q' => 'Sel C2 berisi nilai 75. Hasil rumus =IF(C2>=70,"Lulus","Tidak Lulus") adalah …', 'o' => ['Lulus', 'Tidak Lulus', '75', '#NAME?'], 'a' => 0],
            ['q' => 'Sel C2 berisi nilai 65. Hasil rumus =IF(C2>=70,"Lulus","Tidak Lulus") adalah …', 'o' => ['Lulus', '65', 'Tidak Lulus', 'FALSE'], 'a' => 2],
            ['q' => 'Operator perbandingan "tidak sama dengan" pada uji logika fungsi IF ditulis …', 'o' => ['!=', '><', '=/', '<>'], 'a' => 3],
            ['q' => 'Sel D2 berisi skor kecemasan 45. Hasil rumus =IF(D2>50,"Tinggi","Rendah") adalah …', 'o' => ['Tinggi', 'Rendah', '45', 'TRUE'], 'a' => 1],
            ['q' => 'Sel E2 berisi nilai 72. Hasil rumus =IF(E2>=80,"A",IF(E2>=70,"B","C")) adalah …', 'o' => ['A', 'B', 'C', '#VALUE!'], 'a' => 1],
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
        $quiz = DB::table('quizzes')->where('code', 'VPNUV6')->first();
        if ($quiz) {
            $questionIds = DB::table('questions')->where('quiz_id', $quiz->id)->pluck('id');
            DB::table('options')->whereIn('question_id', $questionIds)->delete();
            DB::table('questions')->where('quiz_id', $quiz->id)->delete();
        }
    }
};
