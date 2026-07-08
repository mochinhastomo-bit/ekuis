<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class WebIotSeeder extends Seeder
{
    public function run(): void
    {
        $quiz = Quiz::where('code', '1XJB0W')->firstOrFail();

        $answers = [
            1=>'A',2=>'B',3=>'B',4=>'B',5=>'B',6=>'B',7=>'C',8=>'D',9=>'B',10=>'C',
            11=>'C',12=>'C',13=>'B',14=>'B',15=>'B',16=>'C',17=>'B',18=>'B',19=>'C',20=>'A',
            21=>'B',22=>'C',23=>'B',24=>'B',25=>'A',26=>'B',27=>'B',28=>'C',29=>'C',30=>'B',
            31=>'A',32=>'B',33=>'C',34=>'B',35=>'A',36=>'C',37=>'B',38=>'B',39=>'B',40=>'B',
            41=>'B',42=>'B',43=>'B',44=>'B',45=>'B',46=>'B',47=>'C',48=>'B',49=>'B',50=>'B',
        ];

        $questions = [
            1 => ['text' => 'HTML merupakan singkatan dari …', 'options' => ['A' => 'Hyper Text Markup Language', 'B' => 'High Tech Modern Language', 'C' => 'Hyper Transfer Markup Logic', 'D' => 'Home Tool Markup Language']],
            2 => ['text' => 'Fungsi utama HTML dalam pembuatan halaman web adalah …', 'options' => ['A' => 'Mengatur logika dan pemrograman server', 'B' => 'Menyusun struktur dan konten halaman web', 'C' => 'Mengelola database secara langsung', 'D' => 'Membuat animasi 3D pada halaman web']],
            3 => ['text' => 'Ekstensi file yang digunakan untuk menyimpan dokumen HTML adalah …', 'options' => ['A' => '.doc dan .pdf', 'B' => '.html dan .htm', 'C' => '.css dan .js', 'D' => '.xml dan .json']],
            4 => ['text' => 'Untuk melihat hasil tampilan file HTML, aplikasi yang digunakan adalah …', 'options' => ['A' => 'Microsoft Excel', 'B' => 'Web browser seperti Chrome, Firefox, atau Edge', 'C' => 'Arduino IDE', 'D' => 'Command Prompt']],
            5 => ['text' => 'Struktur dasar dokumen HTML yang benar terdiri dari elemen …', 'options' => ['A' => '<header>, <main>, <footer>', 'B' => '<html>, <head>, <body>', 'C' => '<div>, <span>, <section>', 'D' => '<table>, <tr>, <td>']],
            6 => ['text' => 'Elemen <head> pada dokumen HTML berfungsi untuk menyimpan …', 'options' => ['A' => 'Konten utama yang ditampilkan di halaman web', 'B' => 'Informasi metadata seperti judul halaman, link CSS, dan pengaturan karakter', 'C' => 'Gambar dan video yang akan ditampilkan', 'D' => 'Script untuk koneksi database']],
            7 => ['text' => 'Tag yang digunakan untuk menentukan judul halaman yang muncul di tab browser adalah …', 'options' => ['A' => '<h1>', 'B' => '<header>', 'C' => '<title>', 'D' => '<meta>']],
            8 => ['text' => 'Seluruh konten yang ditampilkan kepada pengguna di halaman web ditulis di dalam elemen …', 'options' => ['A' => '<head>', 'B' => '<title>', 'C' => '<meta>', 'D' => '<body>']],
            9 => ['text' => 'Deklarasi <!DOCTYPE html> pada baris pertama dokumen HTML berfungsi untuk …', 'options' => ['A' => 'Menambahkan komentar pada kode HTML', 'B' => 'Memberitahu browser bahwa dokumen menggunakan standar HTML5', 'C' => 'Menutup seluruh tag HTML', 'D' => 'Menghubungkan file CSS ke dokumen']],
            10 => ['text' => 'Tag heading pada HTML terdiri dari <h1> sampai <h6>. Tag yang menghasilkan ukuran teks paling besar adalah …', 'options' => ['A' => '<h6>', 'B' => '<h3>', 'C' => '<h1>', 'D' => '<h4>']],
            11 => ['text' => 'Tag yang digunakan untuk membuat paragraf pada HTML adalah …', 'options' => ['A' => '<para>', 'B' => '<text>', 'C' => '<p>', 'D' => '<pg>']],
            12 => ['text' => 'Tag <br> pada HTML berfungsi untuk …', 'options' => ['A' => 'Membuat paragraf baru', 'B' => 'Membuat garis batas bawah (border)', 'C' => 'Membuat pindah baris (line break) tanpa membuat paragraf baru', 'D' => 'Membuat teks menjadi tebal']],
            13 => ['text' => 'Tag <hr> pada HTML digunakan untuk …', 'options' => ['A' => 'Membuat hyperlink', 'B' => 'Menampilkan garis horizontal sebagai pemisah konten', 'C' => 'Menambahkan header pada tabel', 'D' => 'Mengatur warna latar belakang']],
            14 => ['text' => 'Tag HTML yang digunakan untuk membuat teks tebal (bold) adalah …', 'options' => ['A' => '<i> dan <em>', 'B' => '<b> dan <strong>', 'C' => '<u> dan <ins>', 'D' => '<s> dan <del>']],
            15 => ['text' => 'Perbedaan antara tag <b> dan <strong> adalah …', 'options' => ['A' => 'Tidak ada perbedaan sama sekali', 'B' => '<b> hanya mengubah tampilan menjadi tebal, sedangkan <strong> memberikan penekanan semantik yang penting', 'C' => '<b> untuk miring dan <strong> untuk tebal', 'D' => '<strong> tidak didukung oleh browser modern']],
            16 => ['text' => 'Tag yang digunakan untuk membuat teks bergaris bawah (underline) adalah …', 'options' => ['A' => '<b>', 'B' => '<i>', 'C' => '<u>', 'D' => '<s>']],
            17 => ['text' => 'Untuk menampilkan teks dengan efek dicoret (strikethrough), tag yang digunakan adalah …', 'options' => ['A' => '<u>', 'B' => '<del> atau <s>', 'C' => '<sup>', 'D' => '<mark>']],
            18 => ['text' => 'Tag yang digunakan untuk membuat hyperlink pada HTML adalah …', 'options' => ['A' => '<link>', 'B' => '<a>', 'C' => '<href>', 'D' => '<url>']],
            19 => ['text' => 'Atribut pada tag <a> yang menentukan alamat tujuan hyperlink adalah …', 'options' => ['A' => 'src', 'B' => 'link', 'C' => 'href', 'D' => 'url']],
            20 => ['text' => 'Atribut target="_blank" pada tag <a> berfungsi untuk …', 'options' => ['A' => 'Membuka link di tab atau jendela baru', 'B' => 'Membuka link di tab yang sama', 'C' => 'Menonaktifkan hyperlink', 'D' => 'Mengubah warna link menjadi putih (blank)']],
            21 => ['text' => 'Penulisan hyperlink yang benar untuk menuju ke halaman "kontak.html" adalah …', 'options' => ['A' => '<a src="kontak.html">Kontak</a>', 'B' => '<a href="kontak.html">Kontak</a>', 'C' => '<link href="kontak.html">Kontak</link>', 'D' => '<url="kontak.html">Kontak</url>']],
            22 => ['text' => 'Tag yang digunakan untuk menampilkan gambar pada halaman HTML adalah …', 'options' => ['A' => '<picture>', 'B' => '<image>', 'C' => '<img>', 'D' => '<photo>']],
            23 => ['text' => 'Atribut pada tag <img> yang menentukan lokasi file gambar adalah …', 'options' => ['A' => 'href', 'B' => 'src', 'C' => 'link', 'D' => 'url']],
            24 => ['text' => 'Atribut alt pada tag <img> berfungsi untuk …', 'options' => ['A' => 'Mengatur ukuran gambar', 'B' => 'Memberikan teks alternatif yang ditampilkan jika gambar gagal dimuat', 'C' => 'Menentukan posisi gambar di halaman', 'D' => 'Membuat link pada gambar']],
            25 => ['text' => 'Penulisan tag gambar yang benar untuk menampilkan file logo.png dengan lebar 200 piksel adalah …', 'options' => ['A' => '<img src="logo.png" width="200">', 'B' => '<image file="logo.png" size="200">', 'C' => '<img href="logo.png" width="200px">', 'D' => '<pic src="logo.png" w="200">']],
            26 => ['text' => 'Tag yang digunakan untuk membuat daftar tidak berurutan (unordered list) pada HTML adalah …', 'options' => ['A' => '<ol>', 'B' => '<ul>', 'C' => '<dl>', 'D' => '<list>']],
            27 => ['text' => 'Tag <ol> pada HTML digunakan untuk membuat …', 'options' => ['A' => 'Daftar tidak berurutan dengan simbol bullet', 'B' => 'Daftar berurutan dengan penomoran otomatis', 'C' => 'Daftar deskripsi dengan istilah dan definisi', 'D' => 'Daftar gambar yang tersusun horizontal']],
            28 => ['text' => 'Setiap item dalam daftar <ul> maupun <ol> ditulis menggunakan tag …', 'options' => ['A' => '<item>', 'B' => '<dt>', 'C' => '<li>', 'D' => '<dd>']],
            29 => ['text' => 'Tag utama yang digunakan untuk membuat tabel pada HTML adalah …', 'options' => ['A' => '<tabel>', 'B' => '<tab>', 'C' => '<table>', 'D' => '<grid>']],
            30 => ['text' => 'Tag <tr> pada tabel HTML berfungsi untuk …', 'options' => ['A' => 'Membuat kolom tabel', 'B' => 'Membuat baris (row) pada tabel', 'C' => 'Membuat judul tabel', 'D' => 'Menggabungkan sel tabel']],
            31 => ['text' => 'Perbedaan antara tag <td> dan <th> pada tabel HTML adalah …', 'options' => ['A' => '<td> untuk data biasa, <th> untuk header tabel yang tampil tebal dan rata tengah', 'B' => 'Keduanya memiliki fungsi yang sama', 'C' => '<td> untuk header dan <th> untuk data biasa', 'D' => '<th> hanya bisa digunakan di baris terakhir']],
            32 => ['text' => 'Atribut colspan pada tag <td> atau <th> digunakan untuk …', 'options' => ['A' => 'Menggabungkan beberapa baris menjadi satu', 'B' => 'Menggabungkan beberapa kolom menjadi satu sel', 'C' => 'Mengatur lebar kolom', 'D' => 'Menambahkan warna pada sel']],
            33 => ['text' => 'Atribut rowspan pada tabel HTML berfungsi untuk …', 'options' => ['A' => 'Menggabungkan beberapa kolom menjadi satu', 'B' => 'Mengatur tinggi baris', 'C' => 'Menggabungkan beberapa baris menjadi satu sel', 'D' => 'Menambahkan border pada tabel']],
            34 => ['text' => 'Arduino IDE merupakan perangkat lunak yang digunakan untuk …', 'options' => ['A' => 'Mendesain halaman web', 'B' => 'Menulis, mengompilasi, dan mengunggah program ke board mikrokontroler', 'C' => 'Mengedit foto dan video', 'D' => 'Mengelola database server']],
            35 => ['text' => 'ESP32 memiliki keunggulan dibandingkan Arduino Uno karena …', 'options' => ['A' => 'ESP32 memiliki konektivitas Wi-Fi dan Bluetooth bawaan', 'B' => 'ESP32 tidak memerlukan sumber daya listrik', 'C' => 'ESP32 hanya bisa diprogram menggunakan Python', 'D' => 'ESP32 tidak kompatibel dengan Arduino IDE']],
            36 => ['text' => 'Bahasa pemrograman utama yang digunakan dalam Arduino IDE adalah …', 'options' => ['A' => 'Python', 'B' => 'Java', 'C' => 'C/C++', 'D' => 'JavaScript']],
            37 => ['text' => 'Dua fungsi wajib yang harus ada dalam setiap sketch Arduino adalah …', 'options' => ['A' => 'main() dan return()', 'B' => 'setup() dan loop()', 'C' => 'start() dan stop()', 'D' => 'begin() dan end()']],
            38 => ['text' => 'Fungsi setup() pada program Arduino dipanggil …', 'options' => ['A' => 'Berulang-ulang selama board menyala', 'B' => 'Hanya satu kali saat board pertama kali dijalankan atau di-reset', 'C' => 'Hanya saat tombol tertentu ditekan', 'D' => 'Setiap 10 detik secara otomatis']],
            39 => ['text' => 'Sensor DHT11 digunakan untuk mengukur …', 'options' => ['A' => 'Intensitas cahaya dan tekanan udara', 'B' => 'Suhu dan kelembapan udara', 'C' => 'Kecepatan angin dan curah hujan', 'D' => 'Jarak dan kecepatan objek']],
            40 => ['text' => 'Sensor DHT11 memiliki jumlah pin sebanyak …', 'options' => ['A' => '2 pin (VCC dan GND)', 'B' => '3 pin (VCC, DATA, GND) pada modul, atau 4 pin pada komponen mentah', 'C' => '5 pin (VCC, GND, SDA, SCL, INT)', 'D' => '6 pin (VCC, GND, TX, RX, EN, RST)']],
            41 => ['text' => 'Library yang umum digunakan untuk membaca sensor DHT11 di Arduino IDE adalah …', 'options' => ['A' => 'Wire.h', 'B' => 'DHT.h', 'C' => 'SPI.h', 'D' => 'Servo.h']],
            42 => ['text' => 'Perintah Serial.begin(9600) pada program Arduino berfungsi untuk …', 'options' => ['A' => 'Mengaktifkan sensor DHT11 pada pin 9600', 'B' => 'Menginisialisasi komunikasi serial dengan baud rate 9600 bps', 'C' => 'Mengatur tegangan output menjadi 9600 mV', 'D' => 'Menghubungkan Arduino ke Wi-Fi']],
            43 => ['text' => 'Pada library DHT, perintah dht.readTemperature() mengembalikan nilai …', 'options' => ['A' => 'Kelembapan udara dalam persen', 'B' => 'Suhu dalam satuan Celcius (secara default)', 'C' => 'Tekanan udara dalam hPa', 'D' => 'Kecepatan angin dalam m/s']],
            44 => ['text' => 'Library yang digunakan untuk menghubungkan ESP32 ke jaringan Wi-Fi adalah …', 'options' => ['A' => 'ESP8266WiFi.h', 'B' => 'WiFi.h', 'C' => 'Ethernet.h', 'D' => 'Bluetooth.h']],
            45 => ['text' => 'Perintah WiFi.begin(ssid, password) pada ESP32 berfungsi untuk …', 'options' => ['A' => 'Membuat ESP32 menjadi access point', 'B' => 'Menghubungkan ESP32 ke jaringan Wi-Fi dengan SSID dan password yang ditentukan', 'C' => 'Memutus koneksi Wi-Fi', 'D' => 'Mengubah nama jaringan Wi-Fi']],
            46 => ['text' => 'Untuk memeriksa apakah ESP32 sudah terhubung ke Wi-Fi, kondisi yang digunakan adalah …', 'options' => ['A' => 'WiFi.isConnected() == true', 'B' => 'WiFi.status() == WL_CONNECTED', 'C' => 'WiFi.check() == ONLINE', 'D' => 'WiFi.ping() == SUCCESS']],
            47 => ['text' => 'Protokol komunikasi yang umum digunakan ESP32 untuk mengirim data sensor ke server web adalah …', 'options' => ['A' => 'SMTP', 'B' => 'FTP', 'C' => 'HTTP', 'D' => 'POP3']],
            48 => ['text' => 'Library HTTPClient.h pada ESP32 digunakan untuk …', 'options' => ['A' => 'Membaca data dari sensor DHT11', 'B' => 'Melakukan HTTP request (GET/POST) ke server web atau API', 'C' => 'Mengontrol motor servo', 'D' => 'Menampilkan data di LCD']],
            49 => ['text' => 'Metode HTTP yang umum digunakan ESP32 untuk mengirimkan data sensor ke server API adalah …', 'options' => ['A' => 'GET', 'B' => 'POST', 'C' => 'DELETE', 'D' => 'PATCH']],
            50 => ['text' => 'Pada pengiriman data sensor DHT11 ke database online secara berkala, fungsi delay() digunakan untuk …', 'options' => ['A' => 'Menghentikan program secara permanen', 'B' => 'Memberikan jeda waktu antar pengiriman data agar tidak membebani server', 'C' => 'Menghapus data lama dari database', 'D' => 'Mempercepat proses pembacaan sensor']],
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
