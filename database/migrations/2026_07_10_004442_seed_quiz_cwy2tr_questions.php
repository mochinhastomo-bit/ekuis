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
            'title' => 'Desain Web Pagi',
            'description' => 'Ujian Akhir untuk Mata Kuliah Desain Web Mahasiswa Teknik Elektro',
            'code' => 'CWY2TR',
            'is_active' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $questions = [
            // A. HTML Web Design (1-20)
            ['Fungsi utama HTML adalah...', 25, ['Mengatur tampilan website', 'Membuat struktur halaman web', 'Mengelola database', 'Menjalankan server'], 1],
            ['Tag HTML untuk membuat hyperlink adalah...', 25, ['<link>', '<a>', '<href>', '<url>'], 1],
            ['Atribut yang digunakan untuk menentukan alamat tujuan hyperlink adalah...', 25, ['src', 'link', 'href', 'target'], 2],
            ['Tag yang digunakan untuk menampilkan gambar adalah...', 25, ['<image>', '<img>', '<picture>', '<src>'], 1],
            ['Atribut alt pada tag <img> berfungsi untuk...', 25, ['Mengubah ukuran gambar', 'Memberikan teks alternatif', 'Mengganti format gambar', 'Mengatur posisi gambar'], 1],
            ['HTML5 menggunakan deklarasi...', 25, ['<!DOCTYPE HTML PUBLIC>', '<!DOCTYPE html>', '<DOCTYPE html5>', '<HTML5>'], 1],
            ['Tag untuk membuat daftar tidak berurutan adalah...', 25, ['<ol>', '<dl>', '<ul>', '<list>'], 2],
            ['Tag <thead> digunakan untuk...', 25, ['Isi tabel', 'Header tabel', 'Footer tabel', 'Kolom pertama'], 1],
            ['Elemen HTML5 yang digunakan untuk navigasi adalah...', 25, ['<menu>', '<navigate>', '<nav>', '<section>'], 2],
            ['Tag untuk membuat formulir adalah...', 25, ['<input>', '<form>', '<submit>', '<textarea>'], 1],
            ['Input bertipe email ditulis sebagai...', 25, ['type="mail"', 'type="email"', 'type="textmail"', 'type="gmail"'], 1],
            ['Atribut required berfungsi...', 25, ['Menyembunyikan input', 'Menjadikan input wajib diisi', 'Menghapus data', 'Menampilkan placeholder'], 1],
            ['Tag semantik untuk artikel adalah...', 25, ['<content>', '<section>', '<article>', '<body>'], 2],
            ['CSS eksternal dihubungkan menggunakan tag...', 25, ['<css>', '<style>', '<link>', '<script>'], 2],
            ['JavaScript dituliskan menggunakan tag...', 25, ['<javascript>', '<js>', '<script>', '<code>'], 2],
            ['Atribut target="_blank" berarti...', 25, ['Membuka halaman baru', 'Menutup halaman', 'Refresh halaman', 'Download halaman'], 0],
            ['Fungsi <meta charset="UTF-8"> adalah...', 25, ['Menentukan ukuran layar', 'Menentukan karakter encoding', 'Menentukan warna', 'Menentukan bahasa'], 1],
            ['Tag untuk membuat paragraf adalah...', 25, ['<text>', '<paragraph>', '<p>', '<para>'], 2],
            ['HTML merupakan bahasa...', 25, ['Pemrograman', 'Markup', 'Query', 'Database'], 1],
            ['Tujuan penggunaan HTML semantik adalah...', 25, ['Mempercepat internet', 'Mempermudah struktur dokumen dan SEO', 'Menggantikan CSS', 'Menggantikan JavaScript'], 1],

            // B. Arduino (21-35)
            ['Arduino Uno menggunakan mikrokontroler...', 25, ['ESP32', 'STM32', 'ATmega328P', 'PIC16F877'], 2],
            ['Fungsi setup() adalah...', 25, ['Berjalan terus-menerus', 'Berjalan sekali saat awal', 'Menghapus program', 'Menampilkan Serial Monitor'], 1],
            ['Fungsi loop() dijalankan...', 25, ['Sekali', 'Dua kali', 'Berulang terus-menerus', 'Saat reset saja'], 2],
            ['Fungsi untuk mengatur pin sebagai output adalah...', 25, ['pinMode()', 'digitalWrite()', 'analogRead()', 'digitalRead()'], 0],
            ['Perintah untuk menyalakan LED adalah...', 25, ['analogRead()', 'digitalWrite(HIGH)', 'pinMode(HIGH)', 'digitalRead()'], 1],
            ['Nilai HIGH menunjukkan...', 25, ['0 Volt', '1 Volt', 'Logika tinggi', "\u{2212}5 Volt"], 2],
            ['Fungsi membaca sinyal analog adalah...', 25, ['analogRead()', 'analogWrite()', 'digitalRead()', 'pinMode()'], 0],
            ['Resolusi ADC Arduino Uno adalah...', 25, ['8 bit', '10 bit', '12 bit', '16 bit'], 1],
            ['Nilai maksimum ADC Arduino Uno adalah...', 25, ['255', '512', '1023', '4095'], 2],
            ['Fungsi Serial.begin(9600) adalah...', 25, ['Menghapus data', 'Mengatur komunikasi serial', 'Membaca sensor', 'Menyalakan LED'], 1],
            ['PWM digunakan untuk...', 25, ['Membaca suhu', 'Mengatur intensitas output', 'Menghubungkan WiFi', 'Menyimpan data'], 1],
            ['Pin bertanda "~" menunjukkan...', 25, ['Pin analog', 'Pin PWM', 'Pin Ground', 'Pin Reset'], 1],
            ['Library digunakan untuk...', 25, ['Menghapus sketch', 'Menambah fungsi tertentu', 'Mempercepat upload', 'Menambah RAM'], 1],
            ['Arduino IDE digunakan untuk...', 25, ['Mendesain PCB', 'Menulis dan mengunggah program', 'Membuat website', 'Membuat database'], 1],
            ['Komunikasi I2C menggunakan pin...', 25, ['TX dan RX', 'SDA dan SCL', 'MOSI dan MISO', 'PWM'], 1],

            // C. ESP32 dan Sensor DHT11 (36-50)
            ['ESP32 memiliki fitur utama...', 25, ['WiFi dan Bluetooth', 'Ethernet', 'USB', 'VGA'], 0],
            ['Sensor DHT11 mengukur...', 25, ['Cahaya', 'Suhu dan kelembapan', 'Tekanan', 'Jarak'], 1],
            ['Rentang pengukuran suhu DHT11 adalah...', 25, ["\u{2212}40\u{2013}125\u{00B0}C", "0\u{2013}50\u{00B0}C", "0\u{2013}100\u{00B0}C", "\u{2212}20\u{2013}80\u{00B0}C"], 1],
            ['Akurasi suhu DHT11 sekitar...', 25, ["\u{00B1}0,1\u{00B0}C", "\u{00B1}2\u{00B0}C", "\u{00B1}5\u{00B0}C", "\u{00B1}10\u{00B0}C"], 1],
            ['Library yang umum digunakan untuk DHT11 adalah...', 25, ['LiquidCrystal', 'DHT.h', 'Servo.h', 'SPIFFS.h'], 1],
            ['Fungsi membaca suhu adalah...', 25, ['readTemperature()', 'getTemp()', 'readADC()', 'analogRead()'], 0],
            ['Fungsi membaca kelembapan adalah...', 25, ['readHumidity()', 'humidityRead()', 'getHumidity()', 'analogHumidity()'], 0],
            ['Jika pembacaan sensor gagal biasanya menghasilkan nilai...', 25, ['0', 'NULL', 'NaN', "\u{2212}1"], 2],
            ['Tegangan logika ESP32 adalah...', 25, ['1,8 Volt', '3,3 Volt', '5 Volt', '12 Volt'], 1],
            ['Resolusi ADC ESP32 adalah...', 25, ['8 bit', '10 bit', '12 bit', '16 bit'], 2],
            ['Fungsi WiFi.begin() digunakan untuk...', 25, ['Mematikan WiFi', 'Menghubungkan ESP32 ke jaringan WiFi', 'Menghapus jaringan', 'Reset ESP32'], 1],
            ['MQTT pada ESP32 digunakan untuk...', 25, ['Menggambar grafik', 'Komunikasi IoT berbasis publish-subscribe', 'Membaca ADC', 'Mengatur PWM'], 1],
            ['Sensor DHT11 menggunakan komunikasi...', 25, ['SPI', 'I2C', 'Single-wire', 'UART'], 2],
            ['Salah satu penerapan ESP32 dan DHT11 adalah...', 25, ['Robot line follower', 'Monitoring suhu dan kelembapan berbasis IoT', 'Printer 3D', 'Scanner barcode'], 1],
            ['Pada sistem IoT, data dari DHT11 umumnya dikirim ke...', 25, ['Microsoft Word', 'Cloud Server atau Dashboard IoT', 'BIOS', 'Compiler'], 1],
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
        $quiz = DB::table('quizzes')->where('code', 'CWY2TR')->first();
        if ($quiz) {
            $questionIds = DB::table('questions')->where('quiz_id', $quiz->id)->pluck('id');
            DB::table('options')->whereIn('question_id', $questionIds)->delete();
            DB::table('questions')->where('quiz_id', $quiz->id)->delete();
            DB::table('quizzes')->where('id', $quiz->id)->delete();
        }
    }
};
