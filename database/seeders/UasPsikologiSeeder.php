<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class UasPsikologiSeeder extends Seeder
{
    public function run(): void
    {
        $quiz = Quiz::where('code', 'CAILD7')->firstOrFail();

        $answers = [
            1 => 'B', 2 => 'D', 3 => 'B', 4 => 'C', 5 => 'B',
            6 => 'B', 7 => 'B', 8 => 'B', 9 => 'B', 10 => 'C',
            11 => 'B', 12 => 'B', 13 => 'B', 14 => 'A', 15 => 'C',
            16 => 'A', 17 => 'B', 18 => 'A', 19 => 'B', 20 => 'B',
            21 => 'B', 22 => 'B', 23 => 'B', 24 => 'B', 25 => 'C',
            26 => 'C', 27 => 'C', 28 => 'B', 29 => 'D', 30 => 'B',
            31 => 'C', 32 => 'B', 33 => 'A', 34 => 'B', 35 => 'B',
            36 => 'B', 37 => 'B', 38 => 'B', 39 => 'B', 40 => 'B',
            41 => 'B', 42 => 'B', 43 => 'B', 44 => 'C', 45 => 'C',
            46 => 'B', 47 => 'B', 48 => 'A', 49 => 'D', 50 => 'A',
        ];

        $questions = [
            1 => [
                'text' => 'Bagian antarmuka Microsoft Word yang berisi kumpulan tab seperti Home, Insert, dan Page Layout disebut …',
                'options' => ['A' => 'Status Bar', 'B' => 'Ribbon', 'C' => 'Quick Access Toolbar', 'D' => 'Title Bar'],
            ],
            2 => [
                'text' => 'Tab Home pada Microsoft Word berisi grup perintah berikut, KECUALI …',
                'options' => ['A' => 'Font', 'B' => 'Paragraph', 'C' => 'Clipboard', 'D' => 'Charts'],
            ],
            3 => [
                'text' => 'Quick Access Toolbar pada Microsoft Word berfungsi untuk …',
                'options' => [
                    'A' => 'Menampilkan jumlah halaman dokumen',
                    'B' => 'Menyediakan akses cepat ke perintah yang sering digunakan seperti Save, Undo, dan Redo',
                    'C' => 'Mengatur ukuran kertas secara otomatis',
                    'D' => 'Menampilkan daftar font yang tersedia',
                ],
            ],
            4 => [
                'text' => 'Area utama di Microsoft Word tempat pengguna mengetik dan mengedit teks disebut …',
                'options' => ['A' => 'Ribbon', 'B' => 'Navigation Pane', 'C' => 'Lembar kerja (Document Area)', 'D' => 'Status Bar'],
            ],
            5 => [
                'text' => 'Untuk menyimpan dokumen baru dengan nama tertentu di Microsoft Word, digunakan perintah …',
                'options' => ['A' => 'Save (Ctrl+S)', 'B' => 'Save As (F12)', 'C' => 'Print (Ctrl+P)', 'D' => 'New (Ctrl+N)'],
            ],
            6 => [
                'text' => 'Fungsi dari Status Bar yang terletak di bagian bawah jendela Microsoft Word adalah …',
                'options' => [
                    'A' => 'Menampilkan daftar file yang baru dibuka',
                    'B' => 'Menampilkan informasi seperti jumlah halaman, jumlah kata, dan mode tampilan dokumen',
                    'C' => 'Menyimpan dokumen secara otomatis',
                    'D' => 'Mengatur margin halaman',
                ],
            ],
            7 => [
                'text' => 'Shortcut keyboard Ctrl+Z pada Microsoft Word digunakan untuk …',
                'options' => [
                    'A' => 'Menyimpan dokumen',
                    'B' => 'Membatalkan perintah terakhir (Undo)',
                    'C' => 'Menempel teks dari clipboard',
                    'D' => 'Memilih seluruh teks dalam dokumen',
                ],
            ],
            8 => [
                'text' => 'Untuk menyisipkan nomor halaman pada dokumen Word, menu yang digunakan adalah …',
                'options' => [
                    'A' => 'Home → Page Number',
                    'B' => 'Insert → Page Number',
                    'C' => 'View → Page Number',
                    'D' => 'References → Page Number',
                ],
            ],
            9 => [
                'text' => 'Apa fungsi Section Break pada Microsoft Word?',
                'options' => [
                    'A' => 'Menghapus halaman tertentu dari dokumen',
                    'B' => 'Membagi dokumen menjadi beberapa bagian dengan format yang dapat berbeda-beda',
                    'C' => 'Menambahkan gambar ke dalam dokumen',
                    'D' => 'Mengubah jenis huruf pada seluruh dokumen',
                ],
            ],
            10 => [
                'text' => 'Jenis Section Break yang memulai bagian baru pada halaman berikutnya adalah …',
                'options' => ['A' => 'Continuous', 'B' => 'Even Page', 'C' => 'Next Page', 'D' => 'Odd Page'],
            ],
            11 => [
                'text' => 'Opsi \'Different First Page\' pada Header & Footer digunakan untuk …',
                'options' => [
                    'A' => 'Menghapus semua header dan footer',
                    'B' => 'Membuat header/footer halaman pertama berbeda dari halaman lainnya',
                    'C' => 'Menambahkan watermark pada halaman pertama',
                    'D' => 'Mengubah orientasi halaman pertama',
                ],
            ],
            12 => [
                'text' => 'Agar penomoran halaman pada section baru dimulai dari angka 1, langkah yang dilakukan adalah …',
                'options' => [
                    'A' => 'Menghapus semua section break',
                    'B' => 'Menggunakan Format Page Numbers → Start at: 1',
                    'C' => 'Mengubah orientasi halaman menjadi landscape',
                    'D' => 'Menyisipkan Page Break biasa',
                ],
            ],
            13 => [
                'text' => 'Untuk memutus hubungan header/footer antar section, tombol yang harus dinonaktifkan adalah …',
                'options' => [
                    'A' => 'Insert Header',
                    'B' => 'Link to Previous',
                    'C' => 'Close Header and Footer',
                    'D' => 'Different Odd & Even Pages',
                ],
            ],
            14 => [
                'text' => 'Section Break jenis Continuous digunakan ketika …',
                'options' => [
                    'A' => 'Ingin memulai section baru di halaman yang sama',
                    'B' => 'Ingin memulai section baru di halaman ganjil',
                    'C' => 'Ingin menghapus halaman kosong',
                    'D' => 'Ingin mengubah seluruh dokumen menjadi landscape',
                ],
            ],
            15 => [
                'text' => 'Format penomoran halaman yang menggunakan angka romawi kecil (i, ii, iii) biasanya digunakan pada bagian …',
                'options' => [
                    'A' => 'Isi/konten utama dokumen',
                    'B' => 'Daftar pustaka',
                    'C' => 'Halaman awal seperti kata pengantar dan daftar isi',
                    'D' => 'Lampiran dokumen',
                ],
            ],
            16 => [
                'text' => 'Perbedaan antara Page Break dan Section Break adalah …',
                'options' => [
                    'A' => 'Page Break memindahkan teks ke halaman baru tanpa mengubah format, sedangkan Section Break memungkinkan perubahan format antar bagian',
                    'B' => 'Keduanya memiliki fungsi yang sama persis',
                    'C' => 'Page Break hanya bisa digunakan di halaman pertama',
                    'D' => 'Section Break hanya berfungsi untuk mengubah font',
                ],
            ],
            17 => [
                'text' => 'Mail Merge pada Microsoft Word digunakan untuk …',
                'options' => [
                    'A' => 'Mengirim email secara langsung dari Word',
                    'B' => 'Membuat dokumen massal yang dipersonalisasi menggunakan data dari sumber tertentu',
                    'C' => 'Menggabungkan beberapa file Word menjadi satu',
                    'D' => 'Mengonversi dokumen Word ke format PDF',
                ],
            ],
            18 => [
                'text' => 'Dalam proses Mail Merge, komponen utama yang diperlukan adalah …',
                'options' => [
                    'A' => 'Dokumen utama (main document) dan sumber data (data source)',
                    'B' => 'Template PowerPoint dan file gambar',
                    'C' => 'Spreadsheet dan database SQL',
                    'D' => 'File PDF dan file teks biasa',
                ],
            ],
            19 => [
                'text' => 'Sumber data (data source) untuk Mail Merge dapat berasal dari …',
                'options' => [
                    'A' => 'Hanya file Word saja',
                    'B' => 'File Excel, Access, CSV, atau daftar kontak Outlook',
                    'C' => 'Hanya file PDF',
                    'D' => 'Hanya file gambar',
                ],
            ],
            20 => [
                'text' => 'Merge Field dalam Mail Merge berfungsi untuk …',
                'options' => [
                    'A' => 'Menambahkan gambar ke dalam dokumen',
                    'B' => 'Menandai posisi di dokumen utama yang akan diisi data secara otomatis dari sumber data',
                    'C' => 'Menghitung jumlah halaman',
                    'D' => 'Membuat daftar isi otomatis',
                ],
            ],
            21 => [
                'text' => 'Langkah pertama dalam wizard Mail Merge di Microsoft Word adalah …',
                'options' => [
                    'A' => 'Menyisipkan Merge Field',
                    'B' => 'Memilih jenis dokumen (Letters, E-mail, Envelopes, Labels, atau Directory)',
                    'C' => 'Mencetak hasil merge',
                    'D' => 'Mengedit sumber data',
                ],
            ],
            22 => [
                'text' => 'Tombol \'Preview Results\' pada Mail Merge digunakan untuk …',
                'options' => [
                    'A' => 'Menghapus semua merge field',
                    'B' => 'Melihat pratinjau dokumen yang sudah digabungkan dengan data sebelum dicetak',
                    'C' => 'Menambahkan sumber data baru',
                    'D' => 'Menyimpan dokumen sebagai template',
                ],
            ],
            23 => [
                'text' => 'Contoh penggunaan Mail Merge dalam dunia nyata adalah …',
                'options' => [
                    'A' => 'Membuat presentasi slide',
                    'B' => 'Mencetak sertifikat dengan nama peserta yang berbeda-beda secara otomatis',
                    'C' => 'Mengedit foto secara massal',
                    'D' => 'Membuat animasi pada dokumen',
                ],
            ],
            24 => [
                'text' => 'PivotTable pada Microsoft Excel digunakan untuk …',
                'options' => [
                    'A' => 'Membuat grafik 3D',
                    'B' => 'Mengolah, menganalisis, dan merangkum data dalam jumlah besar secara dinamis',
                    'C' => 'Mengirim email dari Excel',
                    'D' => 'Mengonversi file Excel ke Word',
                ],
            ],
            25 => [
                'text' => 'Untuk membuat PivotTable, data sumber harus memenuhi syarat berikut, KECUALI …',
                'options' => [
                    'A' => 'Memiliki header (judul kolom) pada setiap kolom',
                    'B' => 'Tidak boleh ada baris kosong di tengah data',
                    'C' => 'Data harus dalam format gambar',
                    'D' => 'Setiap kolom berisi jenis data yang konsisten',
                ],
            ],
            26 => [
                'text' => 'Area pada PivotTable yang digunakan untuk menempatkan data numerik yang ingin dihitung disebut …',
                'options' => ['A' => 'Rows', 'B' => 'Columns', 'C' => 'Values', 'D' => 'Filters'],
            ],
            27 => [
                'text' => 'Jika ingin menampilkan total penjualan per bulan dalam PivotTable, maka field \'Bulan\' ditempatkan di area …',
                'options' => ['A' => 'Values', 'B' => 'Filters', 'C' => 'Rows atau Columns', 'D' => 'Data Source'],
            ],
            28 => [
                'text' => 'Fungsi \'Refresh\' pada PivotTable digunakan untuk …',
                'options' => [
                    'A' => 'Menghapus PivotTable',
                    'B' => 'Memperbarui PivotTable agar sesuai dengan perubahan data sumber terbaru',
                    'C' => 'Menambahkan grafik baru',
                    'D' => 'Mengubah warna PivotTable',
                ],
            ],
            29 => [
                'text' => 'Jika ingin menyaring data PivotTable agar hanya menampilkan data dari departemen tertentu, maka field \'Departemen\' ditempatkan di area …',
                'options' => ['A' => 'Rows', 'B' => 'Values', 'C' => 'Columns', 'D' => 'Filters'],
            ],
            30 => [
                'text' => 'Data Validation pada Microsoft Excel berfungsi untuk …',
                'options' => [
                    'A' => 'Menghapus data yang salah secara otomatis',
                    'B' => 'Mengontrol dan membatasi jenis data yang dapat dimasukkan ke dalam sel',
                    'C' => 'Mengubah format angka menjadi teks',
                    'D' => 'Menyembunyikan kolom tertentu',
                ],
            ],
            31 => [
                'text' => 'Untuk membuat daftar drop-down di sebuah sel menggunakan Data Validation, pengaturan \'Allow\' yang dipilih adalah …',
                'options' => ['A' => 'Whole Number', 'B' => 'Decimal', 'C' => 'List', 'D' => 'Date'],
            ],
            32 => [
                'text' => 'Tab \'Input Message\' pada Data Validation digunakan untuk …',
                'options' => [
                    'A' => 'Menampilkan pesan kesalahan saat data tidak valid',
                    'B' => 'Menampilkan pesan petunjuk saat sel dipilih/diklik',
                    'C' => 'Menghapus isi sel secara otomatis',
                    'D' => 'Mengunci sel agar tidak bisa diedit',
                ],
            ],
            33 => [
                'text' => 'Jika Data Validation diatur agar hanya menerima angka antara 1 sampai 100, maka pengaturan yang benar adalah …',
                'options' => [
                    'A' => 'Allow: Whole Number, Data: between, Minimum: 1, Maximum: 100',
                    'B' => 'Allow: Text Length, Data: equal to, Value: 100',
                    'C' => 'Allow: List, Source: 1-100',
                    'D' => 'Allow: Date, Data: greater than, Value: 1',
                ],
            ],
            34 => [
                'text' => 'Tab \'Error Alert\' pada Data Validation berfungsi untuk …',
                'options' => [
                    'A' => 'Menampilkan pesan ketika sel dipilih',
                    'B' => 'Menampilkan pesan peringatan atau kesalahan ketika data yang dimasukkan tidak memenuhi kriteria',
                    'C' => 'Menghitung jumlah data yang valid',
                    'D' => 'Mewarnai sel yang berisi data tidak valid',
                ],
            ],
            35 => [
                'text' => 'Fitur Define Name pada Microsoft Excel digunakan untuk …',
                'options' => [
                    'A' => 'Mengubah nama file Excel',
                    'B' => 'Memberi nama pada range sel atau konstanta agar mudah digunakan dalam rumus',
                    'C' => 'Mengganti nama sheet',
                    'D' => 'Menambahkan komentar pada sel',
                ],
            ],
            36 => [
                'text' => 'Jika range A1:A5 diberi nama \'Daftar_Kota\', maka dalam rumus VLOOKUP, range tersebut dapat dipanggil dengan …',
                'options' => [
                    'A' => '=VLOOKUP(B1, A1:A5, 1, FALSE)',
                    'B' => '=VLOOKUP(B1, Daftar_Kota, 1, FALSE)',
                    'C' => '=VLOOKUP(B1, Sheet1, 1, FALSE)',
                    'D' => '=VLOOKUP(B1, "Daftar_Kota", 1, FALSE)',
                ],
            ],
            37 => [
                'text' => 'Salah satu manfaat penggunaan Define Name untuk Data Validation adalah …',
                'options' => [
                    'A' => 'Mempercepat koneksi internet',
                    'B' => 'Membuat sumber daftar drop-down yang dinamis dan mudah dikelola',
                    'C' => 'Menghapus data duplikat secara otomatis',
                    'D' => 'Mengubah format angka menjadi mata uang',
                ],
            ],
            38 => [
                'text' => 'Untuk membuat Define Name melalui menu, langkah yang benar adalah …',
                'options' => [
                    'A' => 'Home → Define Name',
                    'B' => 'Formulas → Define Name',
                    'C' => 'Insert → Define Name',
                    'D' => 'View → Define Name',
                ],
            ],
            39 => [
                'text' => 'Fungsi CONCATENATE atau CONCAT pada Microsoft Excel digunakan untuk …',
                'options' => [
                    'A' => 'Menjumlahkan nilai dari beberapa sel',
                    'B' => 'Menggabungkan teks dari beberapa sel menjadi satu string',
                    'C' => 'Mencari nilai tertinggi dalam range',
                    'D' => 'Menghitung rata-rata data',
                ],
            ],
            40 => [
                'text' => 'Jika sel A1 berisi "Mochin" dan B1 berisi "Hastomo", rumus =CONCATENATE(A1," ",B1) akan menghasilkan …',
                'options' => [
                    'A' => 'MochinHastomo',
                    'B' => 'Mochin Hastomo',
                    'C' => 'Mochin,Hastomo',
                    'D' => 'Mochin-Hastomo',
                ],
            ],
            41 => [
                'text' => 'Format angka kustom (Custom Number Format) di Excel digunakan untuk …',
                'options' => [
                    'A' => 'Menghapus angka desimal secara permanen',
                    'B' => 'Mengubah tampilan angka tanpa mengubah nilai aslinya di dalam sel',
                    'C' => 'Mengonversi angka menjadi teks secara permanen',
                    'D' => 'Menghitung ulang semua rumus di workbook',
                ],
            ],
            42 => [
                'text' => 'Jika ingin menampilkan angka 1500000 menjadi "1.500.000" dengan pemisah ribuan, format kustom yang digunakan adalah …',
                'options' => ['A' => '#.##0', 'B' => '#,##0', 'C' => '0.000', 'D' => '0,000'],
            ],
            43 => [
                'text' => 'Untuk membuat grafik (chart) di Microsoft Excel, langkah pertama yang harus dilakukan adalah …',
                'options' => [
                    'A' => 'Memilih jenis grafik terlebih dahulu',
                    'B' => 'Memilih (blok) data yang akan divisualisasikan',
                    'C' => 'Mengatur warna grafik',
                    'D' => 'Menambahkan judul grafik',
                ],
            ],
            44 => [
                'text' => 'Jenis grafik yang paling tepat untuk menampilkan perbandingan proporsi atau persentase dari keseluruhan data adalah …',
                'options' => ['A' => 'Bar Chart', 'B' => 'Line Chart', 'C' => 'Pie Chart', 'D' => 'Scatter Chart'],
            ],
            45 => [
                'text' => 'Elemen grafik yang menjelaskan warna atau simbol yang mewakili setiap seri data disebut …',
                'options' => ['A' => 'Axis Title', 'B' => 'Data Label', 'C' => 'Legend', 'D' => 'Gridlines'],
            ],
            46 => [
                'text' => 'Jenis grafik yang paling tepat digunakan untuk menampilkan tren data dari waktu ke waktu adalah …',
                'options' => ['A' => 'Pie Chart', 'B' => 'Line Chart', 'C' => 'Doughnut Chart', 'D' => 'Radar Chart'],
            ],
            47 => [
                'text' => 'Fungsi VLOOKUP pada Microsoft Excel digunakan untuk …',
                'options' => [
                    'A' => 'Mengurutkan data dalam tabel',
                    'B' => 'Mencari nilai tertentu di kolom pertama tabel dan mengembalikan nilai dari kolom lain pada baris yang sama',
                    'C' => 'Menghitung jumlah sel yang berisi teks',
                    'D' => 'Menggabungkan dua tabel secara otomatis',
                ],
            ],
            48 => [
                'text' => 'Sintaks yang benar untuk fungsi VLOOKUP adalah …',
                'options' => [
                    'A' => '=VLOOKUP(lookup_value, table_array, col_index_num, [range_lookup])',
                    'B' => '=VLOOKUP(table_array, lookup_value, row_index_num)',
                    'C' => '=VLOOKUP(col_index_num, lookup_value, table_array)',
                    'D' => '=VLOOKUP(range_lookup, table_array, lookup_value, col_index_num)',
                ],
            ],
            49 => [
                'text' => 'Pada fungsi VLOOKUP, jika parameter range_lookup diisi FALSE, artinya …',
                'options' => [
                    'A' => 'Pencarian menggunakan perkiraan terdekat (approximate match)',
                    'B' => 'Pencarian harus menemukan kecocokan persis (exact match)',
                    'C' => 'Data tidak perlu diurutkan',
                    'D' => 'B dan C benar',
                ],
            ],
            50 => [
                'text' => 'Perbedaan utama antara VLOOKUP dan HLOOKUP adalah …',
                'options' => [
                    'A' => 'VLOOKUP mencari data secara vertikal (kolom), sedangkan HLOOKUP mencari secara horizontal (baris)',
                    'B' => 'VLOOKUP hanya untuk angka, HLOOKUP hanya untuk teks',
                    'C' => 'VLOOKUP digunakan di Word, HLOOKUP digunakan di Excel',
                    'D' => 'Tidak ada perbedaan, keduanya sama',
                ],
            ],
        ];

        foreach ($questions as $num => $q) {
            $question = $quiz->questions()->create([
                'question_text' => $q['text'],
                'time_limit' => 60,
                'order' => $num - 1,
            ]);

            $correctLetter = $answers[$num];

            foreach ($q['options'] as $letter => $text) {
                $question->options()->create([
                    'option_text' => $text,
                    'is_correct' => $letter === $correctLetter,
                ]);
            }
        }
    }
}
