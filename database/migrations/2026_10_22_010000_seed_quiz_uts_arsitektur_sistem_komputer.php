<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $quizCode = 'V3CQ5K';

        $quiz = DB::table('quizzes')->where('code', $quizCode)->first();

        if (! $quiz) {
            $quizId = DB::table('quizzes')->insertGetId([
                'user_id' => 1,
                'title' => 'UTS Arsitektur Sistem Komputer',
                'description' => 'Soal Pilihan Ganda Arsitektur Sistem Komputer: Sistem Operasi, Perangkat Input, Perangkat Output, Memori, Media Penyimpanan',
                'code' => $quizCode,
                'is_active' => true,
                'periode_id' => 3,
                'prodi_id' => 3,
                'matakuliah_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $quizId = $quiz->id;
        }

        if (DB::table('questions')->where('quiz_id', $quizId)->exists()) {
            return;
        }

        $questions = [
            // Bagian 1 — Sistem Operasi (1-14)
            ['Menurut materi, sistem operasi adalah …', [
                ['Perangkat lunak yang mengatur dan mengendalikan sumber daya komputer', 1],
                ['Pengguna yang bertugas mengoperasikan komputer', 0],
                ['Bahasa pemrograman yang digunakan untuk membuat aplikasi', 0],
                ['Perangkat keras yang memproses instruksi aritmetika dan logika', 0],
            ]],
            ['Dalam susunan lapisan sistem komputer, posisi sistem operasi berada …', [
                ['Sejajar dengan brainware sebagai pengguna sistem', 0],
                ['Di bawah perangkat keras sebagai pengendali aliran listrik', 0],
                ['Di antara pengguna/aplikasi dan perangkat keras', 1],
                ['Di luar sistem komputer sebagai layanan tambahan', 0],
            ]],
            ['Sistem komputer terdiri atas hardware, software, dan brainware. Sistem operasi termasuk ke dalam unsur …', [
                ['Software', 1],
                ['Hardware', 0],
                ['Brainware', 0],
                ['Perangkat input', 0],
            ]],
            ['Berdasarkan pembagian unsur sistem komputer pada materi, yang termasuk brainware adalah …', [
                ['Bahasa query', 0],
                ['Administrator', 1],
                ['Sistem operasi', 0],
                ['CPU (prosesor)', 0],
            ]],
            ['Fungsi sistem operasi dalam mengelola memori adalah …', [
                ['Melakukan alokasi RAM untuk program', 1],
                ['Membuat, menyimpan, membuka, dan menghapus file', 0],
                ['Mengatur proses dan waktu penggunaan prosesor', 0],
                ['Mengatur komunikasi dengan printer dan monitor', 0],
            ]],
            ['Pengaturan proses dan pembagian waktu penggunaan prosesor merupakan fungsi sistem operasi dalam …', [
                ['Mengelola memori', 0],
                ['Mengelola input/output', 0],
                ['Mengelola CPU', 1],
                ['Mengelola file', 0],
            ]],
            ['Seorang mahasiswa menghapus dokumen lama dari sebuah folder di laptopnya. Fungsi sistem operasi yang paling berperan dalam kegiatan tersebut adalah …', [
                ['Menjalankan program aplikasi', 0],
                ['Mengelola memori (alokasi RAM)', 0],
                ['Mengelola CPU', 0],
                ['Mengelola file', 1],
            ]],
            ['Saat pengguna mencetak dokumen dari aplikasi pengolah kata ke printer, sistem operasi berperan mengatur komunikasi dengan printer. Fungsi ini termasuk …', [
                ['Menyediakan antarmuka pengguna', 0],
                ['Mengelola file', 0],
                ['Mengelola input/output', 1],
                ['Mengelola memori', 0],
            ]],
            ['Antarmuka pengguna yang disediakan oleh sistem operasi dapat berbentuk …', [
                ['Suara dan getaran', 0],
                ['Grafis dan teks', 1],
                ['Hanya teks', 0],
                ['Hanya grafis', 0],
            ]],
            ['Berikut ini yang termasuk sistem operasi mobile menurut materi adalah …', [
                ['Windows', 0],
                ['Linux', 0],
                ['macOS', 0],
                ['iOS', 1],
            ]],
            ['Kelompok berikut yang seluruhnya merupakan contoh sistem operasi komputer adalah …', [
                ['Windows, Linux, macOS', 1],
                ['Linux, Android, macOS', 0],
                ['Android, iOS, Windows', 0],
                ['iOS, macOS, Android', 0],
            ]],
            ['Alasan paling tepat mengapa terdapat sistem operasi komputer dan sistem operasi mobile yang berbeda adalah …', [
                ['Sistem operasi mobile tidak memerlukan pengelolaan sumber daya', 0],
                ['Setiap sistem operasi dirancang sesuai karakteristik perangkat dan kebutuhan penggunanya', 1],
                ['Perangkat mobile tidak memiliki CPU dan memori sehingga butuh sistem operasi khusus', 0],
                ['Sistem operasi komputer tidak dapat menjalankan program aplikasi', 0],
            ]],
            ['Jika sebuah komputer tidak memiliki sistem operasi, kondisi yang paling mungkin terjadi adalah …', [
                ['Perangkat keras tetap terkelola otomatis oleh brainware tanpa perantara', 0],
                ['RAM berubah sifat menjadi non-volatile', 0],
                ['Pengguna kesulitan menjalankan aplikasi karena tidak ada penghubung yang mengatur sumber daya antara aplikasi dan perangkat keras', 1],
                ['Aplikasi berjalan lebih efisien karena tidak ada lapisan perantara', 0],
            ]],
            ['Membuka aplikasi pengolah kata di laptop menjadi mudah dan stabil. Hal ini terjadi karena sistem operasi …', [
                ['Menggantikan peran pengguna dalam mengetik dokumen', 0],
                ['Mengatur penggunaan CPU, RAM, penyimpanan, dan perangkat I/O untuk aplikasi tersebut', 1],
                ['Menuliskan kode program aplikasi pengolah kata', 0],
                ['Mengganti komponen perangkat keras secara otomatis', 0],
            ]],
            // Bagian 2 — Perangkat Input (15-28)
            ['Perangkat input adalah …', [
                ['Komponen yang mengubah data biner hasil pemrosesan menjadi informasi yang dapat dipahami manusia', 0],
                ['Media yang digunakan untuk menyimpan data dalam jangka panjang', 0],
                ['Komponen perangkat keras untuk memasukkan data, informasi, perintah, atau sinyal kontrol ke dalam sistem komputer', 1],
                ['Perangkat lunak yang mengatur dan mengendalikan sumber daya komputer', 0],
            ]],
            ['Cara kerja perangkat input yang tepat adalah …', [
                ['Mengolah data menjadi keluaran akhir tanpa melalui prosesor', 0],
                ['Mengubah data digital menjadi cahaya, suara, atau cetakan', 0],
                ['Menyimpan data secara permanen meskipun listrik padam', 0],
                ['Menerima masukan dari pengguna atau lingkungan, lalu mengubahnya menjadi sinyal atau data digital', 1],
            ]],
            ['Setelah data dari perangkat input diterima komputer, tahap berikutnya adalah …', [
                ['Data dihapus agar memori tidak penuh', 0],
                ['Data langsung dicetak tanpa diproses', 0],
                ['Data dikembalikan ke pengguna sebagai masukan ulang', 0],
                ['Data diolah oleh prosesor dan komponen lain untuk menghasilkan keluaran tertentu', 1],
            ]],
            ['Fungsi perangkat input sebagai "pengonversi data" berarti …', [
                ['Mengubah data digital menjadi getaran suara pada speaker', 0],
                ['Mengubah perintah atau informasi dari manusia menjadi data digital yang dapat diproses komputer', 1],
                ['Mengubah data piksel menjadi emisi cahaya pada layar', 0],
                ['Mengubah file menjadi bentuk cadangan (backup)', 0],
            ]],
            ['Seorang staf administrasi menggunakan scanner untuk memindahkan berkas fisik ke komputer sehingga pekerjaan lebih cepat dan hemat tenaga. Menurut materi, contoh ini paling tepat menggambarkan fungsi perangkat input sebagai …', [
                ['Peningkat efisiensi dan produktivitas', 1],
                ['Media interaksi', 0],
                ['Penampil hasil pemrosesan', 0],
                ['Kontrol operasi', 0],
            ]],
            ['Pengguna membuka sebuah aplikasi dengan cara mengklik ikonnya menggunakan mouse. Fungsi perangkat input yang paling sesuai dengan kegiatan ini adalah …', [
                ['Kontrol operasi', 1],
                ['Menyimpan data jangka panjang', 0],
                ['Mengubah data menjadi cetakan fisik', 0],
                ['Mengubah sinyal audio menjadi getaran', 0],
            ]],
            ['Keyboard, mouse, dan mikrofon disebut sebagai sarana komunikasi antara manusia dan komputer agar pengguna dapat memberikan perintah. Fungsi ini disebut …', [
                ['Transduksi keluaran', 0],
                ['Penyangga (buffer) data', 0],
                ['Media interaksi', 1],
                ['Kontrol operasi', 0],
            ]],
            ['Keyboard berfungsi untuk …', [
                ['Mengubah data piksel menjadi emisi cahaya RGB', 0],
                ['Mengontrol pergerakan kursor pada layar', 0],
                ['Menggantikan mouse pada laptop melalui bantalan sentuh', 0],
                ['Memasukkan huruf, angka, simbol, dan perintah melalui tombol-tombol', 1],
            ]],
            ['Perangkat input yang digunakan untuk mengontrol pergerakan kursor pada layar komputer adalah …', [
                ['Speaker', 0],
                ['Mouse', 1],
                ['Printer', 0],
                ['Keyboard', 0],
            ]],
            ['Touchpad pada laptop berfungsi sebagai …', [
                ['Media penyimpanan portabel', 0],
                ['Bantalan sentuh pengganti mouse', 1],
                ['Papan ketik pengganti keyboard', 0],
                ['Layar tambahan pengganti monitor', 0],
            ]],
            ['Berikut ini yang termasuk kelebihan perangkat input adalah …', [
                ['Kerusakan perangkat dapat menghambat pekerjaan', 0],
                ['Beberapa perangkat membutuhkan biaya pembelian', 0],
                ['Perangkat tertentu memerlukan perawatan', 0],
                ['Membantu mengurangi kesalahan saat memasukkan data', 1],
            ]],
            ['Berikut ini yang termasuk kekurangan perangkat input adalah …', [
                ['Mempercepat pekerjaan', 0],
                ['Sebagian perangkat membutuhkan keterampilan untuk digunakan', 1],
                ['Mendukung kebutuhan belajar, bekerja, dan bermain', 0],
                ['Memudahkan komunikasi antara manusia dan komputer', 0],
            ]],
            ['Keyboard laptop seorang mahasiswa tiba-tiba rusak saat ia harus menyelesaikan laporan sebelum tenggat. Kondisi ini paling tepat menggambarkan kekurangan perangkat input, yaitu …', [
                ['Tidak semua perangkat cocok untuk setiap jenis pekerjaan', 0],
                ['Sebagian perangkat membutuhkan keterampilan untuk digunakan', 0],
                ['Beberapa perangkat membutuhkan biaya pembelian', 0],
                ['Kerusakan perangkat dapat menghambat pekerjaan', 1],
            ]],
            ['Pernyataan yang paling tepat menjelaskan mengapa perangkat input disebut bagian penting sistem komputer adalah …', [
                ['Perangkat input menyimpan data agar tidak hilang ketika listrik padam', 0],
                ['Perangkat input menghubungkan manusia dengan mesin sehingga data dan perintah dapat masuk untuk diproses', 1],
                ['Perangkat input menampilkan hasil pemrosesan kepada pengguna', 0],
                ['Perangkat input mengatur alokasi RAM untuk setiap program', 0],
            ]],
            // Bagian 3 — Perangkat Output (29-42)
            ['Fungsi utama perangkat output adalah …', [
                ['Menyimpan data dan instruksi yang sedang digunakan CPU', 0],
                ['Mengatur pembagian waktu penggunaan prosesor', 0],
                ['Mengubah data biner hasil pemrosesan menjadi informasi yang dapat dipahami manusia atau sistem lain', 1],
                ['Memasukkan data dan perintah ke dalam sistem komputer', 0],
            ]],
            ['Bentuk keluaran yang dihasilkan perangkat output menurut materi mencakup …', [
                ['Visual, audio, cetakan fisik, dan sinyal kendali mekanis', 1],
                ['Hanya visual dan audio', 0],
                ['Ketikan, klik, dan sentuhan pengguna', 0],
                ['Data biner mentah yang dikirim kembali ke CPU', 0],
            ]],
            ['Urutan jalur data dari pemrosesan menuju perangkat output yang benar adalah …', [
                ['CPU/GPU → I/O Controller → System Bus → Output Device', 0],
                ['CPU/GPU → System Bus → I/O Controller → Output Device', 1],
                ['System Bus → CPU/GPU → Output Device → I/O Controller', 0],
                ['I/O Controller → CPU/GPU → System Bus → Output Device', 0],
            ]],
            ['I/O Controller diperlukan sebagai jembatan antara CPU dan perangkat output karena …', [
                ['CPU tidak dapat terhubung ke system bus', 0],
                ['Kecepatan CPU jauh lebih tinggi daripada banyak perangkat output fisik', 1],
                ['Perangkat output bekerja jauh lebih cepat daripada CPU', 0],
                ['I/O Controller berfungsi menyimpan data secara permanen', 0],
            ]],
            ['Peran buffer pada jalur output adalah …', [
                ['Menyimpan data secara permanen sebagai cadangan', 0],
                ['Mengubah data piksel menjadi cahaya RGB', 0],
                ['Menyimpan data sementara agar aliran data tetap stabil', 1],
                ['Mempercepat kerja CPU dengan menambah inti prosesor', 0],
            ]],
            ['Saat laptop disambungkan ke monitor eksternal, controller mengubah data biner menjadi protokol/sinyal khusus untuk tampilan visual. Contoh protokol yang sesuai adalah …', [
                ['G-code', 0],
                ['DAC', 0],
                ['PostScript', 0],
                ['HDMI/DisplayPort', 1],
            ]],
            ['Agar file musik digital dapat dikeluarkan melalui speaker, data biner diubah menjadi sinyal audio oleh …', [
                ['DAC', 1],
                ['DisplayPort', 0],
                ['G-code', 0],
                ['HDMI', 0],
            ]],
            ['Kelompok perangkat output hard copy terdiri atas …', [
                ['Motor getar, lengan robot, dan braille display', 0],
                ['Speaker, headphone, dan buzzer', 0],
                ['Monitor LCD/OLED, proyektor, dan VR headset', 0],
                ['Printer inkjet/laser, plotter, dan 3D printer', 1],
            ]],
            ['Braille display yang membantu tunanetra membaca keluaran komputer termasuk kelompok perangkat output …', [
                ['Visual', 0],
                ['Audio', 0],
                ['Haptic/actuator', 1],
                ['Hard copy', 0],
            ]],
            ['Proses transduksi pada monitor adalah …', [
                ['Data piksel diubah menjadi emisi cahaya RGB', 1],
                ['Instruksi G-code menggerakkan motor dan material cetak', 0],
                ['Data biner diubah menjadi getaran motor', 0],
                ['Sinyal audio diubah menjadi getaran diafragma', 0],
            ]],
            ['Instruksi seperti G-code atau PostScript digunakan untuk menggerakkan motor dan material cetak pada …', [
                ['VR headset', 0],
                ['Monitor', 0],
                ['Printer', 1],
                ['Speaker', 0],
            ]],
            ['Perangkat output yang digunakan pada era 1940–1950-an adalah …', [
                ['Display CRT, line printer, dan dot matrix', 0],
                ['OLED/AMOLED dan AR/VR', 0],
                ['Teleprinter dan punched card', 1],
                ['LCD, plasma, dan GPU berantarmuka PCIe', 0],
            ]],
            ['Tren riset perangkat output AR/VR diarahkan pada …', [
                ['Penggunaan kembali punched card sebagai media keluaran', 0],
                ['Micro-LED dan optical waveguide dengan latency rendah, refresh rate di atas 120 Hz, dan konsumsi daya rendah', 1],
                ['Electro-tactile dan pneumatic micro-actuators untuk mereplikasi tekstur rabaan', 0],
                ['Real-time I/O control untuk mengurangi jitter pada koordinasi motor cetak', 0],
            ]],
            ['Sebuah komputer memiliki CPU yang cepat, tetapi tampilan pada monitornya sering tersendat. Berdasarkan inti materi, analisis yang paling tepat adalah …', [
                ['Kinerja output hanya ditentukan oleh kecepatan CPU, sehingga masalahnya pasti pada CPU', 0],
                ['Buffer menyimpan data secara permanen sehingga tampilan menjadi lambat', 0],
                ['Monitor tidak terhubung dengan system bus sehingga tidak dapat menampilkan gambar', 0],
                ['Kinerja output bergantung pada kerja bersama CPU/GPU, system bus, I/O controller, buffer, dan perangkat akhir, sehingga hambatan dapat terjadi di salah satu tahap tersebut', 1],
            ]],
            // Bagian 4 — Memori (43-56)
            ['Memori dalam sistem komputer berfungsi untuk …', [
                ['Menghubungkan pengguna dengan perangkat keras melalui antarmuka grafis', 0],
                ['Mengubah data biner menjadi informasi visual dan audio', 0],
                ['Memasukkan perintah dari pengguna ke dalam komputer', 0],
                ['Menyimpan data, instruksi, dan informasi yang diperlukan CPU saat menjalankan program', 1],
            ]],
            ['Perbedaan utama primary memory dan secondary memory adalah …', [
                ['Primary memory mendukung proses yang sedang berlangsung, sedangkan secondary memory menyimpan data jangka panjang', 1],
                ['Secondary memory berhubungan lebih erat dengan CPU daripada primary memory', 0],
                ['Primary memory menyimpan data jangka panjang, sedangkan secondary memory mendukung proses yang sedang berlangsung', 0],
                ['Primary memory selalu lebih besar kapasitasnya daripada secondary memory', 0],
            ]],
            ['Kelompok berikut yang seluruhnya termasuk primary memory adalah …', [
                ['Hard disk, flashdisk, dan RAM', 0],
                ['ROM, hard disk, dan cache memory', 0],
                ['Flashdisk, cache memory, dan hard disk', 0],
                ['RAM, ROM, dan cache memory', 1],
            ]],
            ['RAM bersifat volatile, artinya …', [
                ['Data hanya dapat dibaca dan tidak dapat diubah', 0],
                ['Data hilang ketika sumber daya listrik terputus', 1],
                ['Data tersimpan dalam piringan magnetik', 0],
                ['Data tetap tersimpan saat komputer dimatikan', 0],
            ]],
            ['Seorang mahasiswa sedang mengetik makalah tanpa menyimpannya, lalu listrik padam dan laptop (tanpa baterai) mati. Ketika dinyalakan kembali, ketikan tersebut hilang. Penyebab paling tepat adalah …', [
                ['Hard disk bersifat volatile sehingga data hilang', 0],
                ['ROM terhapus karena listrik padam', 0],
                ['Kapasitas cache memory terlalu besar', 0],
                ['Data yang belum disimpan berada di RAM yang bersifat volatile', 1],
            ]],
            ['Kapasitas RAM pada komputer memengaruhi …', [
                ['Banyaknya data dan aplikasi yang dapat ditampung secara bersamaan', 1],
                ['Lama data tersimpan setelah komputer dimatikan', 0],
                ['Resolusi gambar yang ditampilkan monitor', 0],
                ['Jenis firmware yang digunakan saat booting', 0],
            ]],
            ['Ciri DRAM menurut materi adalah …', [
                ['Bekerja sinkron dengan clock sistem sejak generasi pertama', 0],
                ['Memerlukan refresh berkala', 1],
                ['Bersifat non-volatile', 0],
                ['Digunakan untuk menyimpan firmware booting', 0],
            ]],
            ['Jenis RAM yang bekerja sinkron dengan clock sistem adalah …', [
                ['ROM', 0],
                ['DRAM', 0],
                ['SDRAM', 1],
                ['EDO RAM', 0],
            ]],
            ['Urutan perkembangan teknologi RAM yang benar adalah …', [
                ['DRAM → EDO RAM → SDRAM → DDR SDRAM', 1],
                ['DDR SDRAM → SDRAM → EDO RAM → DRAM', 0],
                ['EDO RAM → DDR SDRAM → DRAM → SDRAM', 0],
                ['SDRAM → DRAM → EDO RAM → DDR SDRAM', 0],
            ]],
            ['Menurut catatan sumber dalam materi, kecepatan DDR5 pada 2024 disebut mencapai hingga …', [
                ['3.200 MT/s', 0],
                ['6.400 MT/s', 1],
                ['640 MT/s', 0],
                ['64.000 MT/s', 0],
            ]],
            ['ROM (Read Only Memory) digunakan untuk …', [
                ['Menyimpan firmware yang dibutuhkan saat proses booting', 1],
                ['Mempercepat akses CPU ke data yang sering dipakai', 0],
                ['Menampung aplikasi yang sedang berjalan', 0],
                ['Memindahkan data antarperangkat melalui USB', 0],
            ]],
            ['Pernyataan yang benar tentang cache memory adalah …', [
                ['Memori berkapasitas lebih besar dari RAM tetapi aksesnya lebih lambat', 0],
                ['Memori berkecepatan tinggi untuk data/instruksi yang sering dipakai CPU dengan kapasitas lebih kecil dari RAM', 1],
                ['Memori sekunder untuk penyimpanan data jangka panjang', 0],
                ['Memori non-volatile untuk menyimpan firmware booting', 0],
            ]],
            ['Cache memory memiliki tingkatan L1, L2, dan L3. Pernyataan yang tepat adalah …', [
                ['L3 berkapasitas paling kecil dan paling cepat', 0],
                ['L1, L2, dan L3 memiliki kapasitas dan kecepatan yang sama', 0],
                ['L1 berkapasitas paling kecil dan sangat cepat', 1],
                ['L1 berkapasitas paling besar di antara ketiganya', 0],
            ]],
            ['Komputer A dan B memiliki spesifikasi sama, kecuali kapasitas RAM komputer A lebih besar. Analisis yang paling tepat adalah …', [
                ['Komputer A dapat menampung lebih banyak data dan aplikasi secara bersamaan, tetapi kinerjanya tetap dipengaruhi kecepatan RAM dan komponen lain', 1],
                ['Komputer B lebih cepat karena RAM yang kecil selalu lebih cepat', 0],
                ['Komputer A dapat menyimpan data secara permanen saat dimatikan karena RAM-nya lebih besar', 0],
                ['Kapasitas RAM tidak berpengaruh apa pun terhadap kinerja komputer', 0],
            ]],
            // Bagian 5 — Media Penyimpanan (57-70)
            ['Media penyimpanan adalah …', [
                ['Perangkat lunak yang mengatur sumber daya komputer', 0],
                ['Komponen yang memasukkan perintah ke dalam komputer', 0],
                ['Perangkat yang mengubah data biner menjadi informasi visual', 0],
                ['Perangkat keras atau layanan untuk menyimpan data digital, baik sementara maupun permanen', 1],
            ]],
            ['Hard Disk Drive (HDD) menyimpan data menggunakan …', [
                ['Piringan magnetik', 1],
                ['Memori flash', 0],
                ['Sinar laser pada cakram optik', 0],
                ['Server melalui internet', 0],
            ]],
            ['SSD lebih tahan terhadap getaran dibandingkan HDD karena …', [
                ['SSD menyimpan data di server penyedia layanan', 0],
                ['SSD menggunakan piringan magnetik yang lebih tebal', 0],
                ['SSD menggunakan memori flash tanpa komponen mekanis bergerak', 1],
                ['SSD dibaca menggunakan laser', 0],
            ]],
            ['Sebuah laptop lama terasa lambat saat booting dan membuka aplikasi. Penggantian media penyimpanan yang paling tepat untuk mempercepatnya adalah …', [
                ['Mengganti SSD dengan HDD', 0],
                ['Menggunakan optical disc sebagai media utama', 0],
                ['Mengganti HDD dengan SSD', 1],
                ['Menyimpan sistem operasi pada kartu memori', 0],
            ]],
            ['Sebuah instansi membutuhkan media untuk backup dan arsip data skala besar dengan biaya per kapasitas rendah, sedangkan kecepatan akses bukan prioritas. Media yang paling sesuai adalah …', [
                ['Magnetic tape', 1],
                ['Flash drive', 0],
                ['SSD', 0],
                ['Kartu memori', 0],
            ]],
            ['Data pada optical disc seperti CD, DVD, dan Blu-ray dibaca menggunakan …', [
                ['Memori flash', 0],
                ['Koneksi internet', 0],
                ['Laser', 1],
                ['Piringan magnetik', 0],
            ]],
            ['Penggunaan optical disc semakin menurun karena …', [
                ['Optical disc lebih mahal daripada magnetic tape untuk semua kebutuhan', 0],
                ['Optical disc membutuhkan koneksi internet', 0],
                ['Optical disc tidak dapat menyimpan musik dan video', 0],
                ['Berkembangnya media flash dan internet', 1],
            ]],
            ['Kekurangan cloud storage menurut materi adalah …', [
                ['Bergantung pada koneksi internet dan keamanan akun', 1],
                ['Tidak dapat diakses dari berbagai perangkat', 0],
                ['Hanya dapat dibaca dengan perangkat khusus berbasis laser', 0],
                ['Memiliki komponen mekanis yang rentan benturan', 0],
            ]],
            ['Seorang fotografer membutuhkan media penyimpanan kecil dan ringan yang dapat dipasang langsung pada kamera digital. Media yang paling tepat adalah …', [
                ['Hard Disk Drive', 0],
                ['Magnetic tape', 0],
                ['Kartu memori (SD/microSD)', 1],
                ['Optical disc', 0],
            ]],
            ['Urutan perkembangan media penyimpanan menurut materi adalah …', [
                ['Cloud → HDD/SSD → USB flash → CD/DVD → Floppy disk', 0],
                ['USB flash → Floppy disk → CD/DVD → Cloud → HDD/SSD', 0],
                ['CD/DVD → Floppy disk → Cloud → USB flash → HDD/SSD', 0],
                ['Floppy disk → CD/DVD → USB flash → HDD/SSD → Cloud', 1],
            ]],
            ['Pasangan media penyimpanan dan teknologinya yang benar adalah …', [
                ['Cloud storage – pita magnetik', 0],
                ['Flash drive – flash', 1],
                ['Optical disc – magnetik', 0],
                ['HDD – optik', 0],
            ]],
            ['Seorang mahasiswa menyimpan file skripsi yang sangat penting. Berdasarkan cara memilih media penyimpanan, langkah paling tepat adalah …', [
                ['Menyimpan salinan pada lebih dari satu media sebagai cadangan', 1],
                ['Menyimpan hanya di RAM agar cepat diakses', 0],
                ['Menyimpan hanya di satu flash drive agar mudah dibawa', 0],
                ['Menghapus salinan lama agar tidak membingungkan', 0],
            ]],
            ['Untuk menjaga keamanan data pada layanan cloud storage, tindakan yang dianjurkan dalam materi adalah …', [
                ['Menyimpan media di tempat panas agar tetap kering', 0],
                ['Menggunakan kata sandi yang kuat dan mengaktifkan autentikasi tambahan', 1],
                ['Membagikan kata sandi ke rekan agar ada cadangan akses', 0],
                ['Menonaktifkan sinkronisasi agar akun tidak dapat diakses', 0],
            ]],
            ['Seorang mahasiswa sering membawa laptopnya bepergian dengan sepeda motor sehingga laptop kerap terkena guncangan. Pilihan media penyimpanan dan alasan yang paling tepat adalah …', [
                ['SSD, karena harga per kapasitasnya lebih rendah daripada HDD', 0],
                ['HDD, karena piringan magnetiknya tahan terhadap benturan', 0],
                ['HDD, karena kecepatan baca/tulisnya lebih tinggi daripada SSD', 0],
                ['SSD, karena tidak memiliki komponen mekanis bergerak sehingga lebih tahan getaran', 1],
            ]],
        ];

        $order = 1;
        foreach ($questions as [$questionText, $opts]) {
            $qId = DB::table('questions')->insertGetId([
                'quiz_id' => $quizId,
                'question_text' => $questionText,
                'time_limit' => 30,
                'order' => $order++,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($opts as [$optText, $isCorrect]) {
                DB::table('options')->insert([
                    'question_id' => $qId,
                    'option_text' => $optText,
                    'is_correct' => $isCorrect,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        $quiz = DB::table('quizzes')->where('code', 'V3CQ5K')->first();
        if ($quiz) {
            $questionIds = DB::table('questions')->where('quiz_id', $quiz->id)->pluck('id');
            DB::table('options')->whereIn('question_id', $questionIds)->delete();
            DB::table('questions')->where('quiz_id', $quiz->id)->delete();
            DB::table('quizzes')->where('id', $quiz->id)->delete();
        }
    }
};
