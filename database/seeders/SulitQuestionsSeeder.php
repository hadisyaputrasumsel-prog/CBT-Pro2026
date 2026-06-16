<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class SulitQuestionsSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            // TPA (10)
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Jika semua dokter adalah lulusan universitas dan beberapa penulis adalah dokter, maka...', 'pilihan_a' => 'Semua penulis adalah lulusan universitas.', 'pilihan_b' => 'Beberapa penulis adalah lulusan universitas.', 'pilihan_c' => 'Tidak ada penulis yang lulusan universitas.', 'pilihan_d' => 'Semua lulusan universitas adalah dokter.', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Seri angka: 2, 5, 14, 41, 122, ... Angka selanjutnya adalah?', 'pilihan_a' => '365', 'pilihan_b' => '367', 'pilihan_c' => '362', 'pilihan_d' => '368', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Pilihlah padanan kata yang paling tepat: KISI-KISI : TERALI = ...', 'pilihan_a' => 'Kipas : Angin', 'pilihan_b' => 'Buku : Kertas', 'pilihan_c' => 'Pakaian : Kain', 'pilihan_d' => 'Batas : Pagar', 'jawaban' => 'D', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Sebuah proyek dapat diselesaikan oleh 12 orang dalam 15 hari. Jika proyek ingin dipercepat menjadi 10 hari, berapa tambahan pekerja yang dibutuhkan?', 'pilihan_a' => '4 orang', 'pilihan_b' => '6 orang', 'pilihan_c' => '8 orang', 'pilihan_d' => '18 orang', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Dalam sebuah pertemuan, 15 orang saling berjabat tangan masing-masing tepat satu kali. Berapa jumlah total jabat tangan yang terjadi?', 'pilihan_a' => '105', 'pilihan_b' => '120', 'pilihan_c' => '210', 'pilihan_d' => '225', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Anton, Budi, Citra, dan Dian duduk mengelilingi meja bundar. Jika Anton dan Budi tidak boleh duduk bersebelahan, ada berapa cara mereka duduk?', 'pilihan_a' => '2', 'pilihan_b' => '4', 'pilihan_c' => '6', 'pilihan_d' => '8', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'P, Q, R, S, T adalah 5 bilangan bulat berurutan. Jika rata-rata kelimanya adalah 20, berapakah nilai terkecil dari kelima bilangan tersebut?', 'pilihan_a' => '16', 'pilihan_b' => '17', 'pilihan_c' => '18', 'pilihan_d' => '19', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Jika a + b = 10 dan ab = 21, berapakah nilai dari a^2 + b^2?', 'pilihan_a' => '58', 'pilihan_b' => '42', 'pilihan_c' => '100', 'pilihan_d' => '79', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Lengkapilah deret huruf berikut: B, E, H, K, N, ...', 'pilihan_a' => 'O', 'pilihan_b' => 'P', 'pilihan_c' => 'Q', 'pilihan_d' => 'R', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'TPA', 'mapel' => 'TPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Sebuah kereta api berangkat dengan kecepatan 80 km/jam. Setengah jam kemudian kereta kedua menyusul dengan kecepatan 100 km/jam. Pada jarak berapa kereta pertama tersusul?', 'pilihan_a' => '150 km', 'pilihan_b' => '180 km', 'pilihan_c' => '200 km', 'pilihan_d' => '240 km', 'jawaban' => 'C', 'bobot' => 4],

            // Matematika (10)
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Nilai dari integral (3x^2 + 2x - 1) dx dengan batas 1 sampai 2 adalah...', 'pilihan_a' => '8', 'pilihan_b' => '9', 'pilihan_c' => '10', 'pilihan_d' => '11', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Jika f(x) = (2x - 1)/(x + 3), maka f invers dari (1) adalah...', 'pilihan_a' => '-4', 'pilihan_b' => '-2', 'pilihan_c' => '4', 'pilihan_d' => '2', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Jika matriks A = [[2, 3], [1, 4]] dan matriks B = [[1, 0], [-1, 2]], maka determinan dari matriks (A x B) adalah...', 'pilihan_a' => '10', 'pilihan_b' => '14', 'pilihan_c' => '18', 'pilihan_d' => '20', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Limit x mendekati 0 untuk (sin 3x + tan 2x) / x adalah...', 'pilihan_a' => '1', 'pilihan_b' => '3', 'pilihan_c' => '5', 'pilihan_d' => '6', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Sebuah kotak berisi 5 bola merah dan 3 bola biru. Jika diambil 2 bola secara acak, peluang terambilnya keduanya bola merah adalah...', 'pilihan_a' => '5/14', 'pilihan_b' => '5/28', 'pilihan_c' => '10/28', 'pilihan_d' => '15/28', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Akar-akar persamaan kuadrat x^2 - 5x + c = 0 adalah p dan q. Jika p^2 + q^2 = 13, maka nilai c adalah...', 'pilihan_a' => '4', 'pilihan_b' => '5', 'pilihan_c' => '6', 'pilihan_d' => '7', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Suku ke-4 dan suku ke-7 suatu barisan aritmatika berturut-turut adalah 17 dan 29. Suku ke-25 barisan tersebut adalah...', 'pilihan_a' => '97', 'pilihan_b' => '101', 'pilihan_c' => '105', 'pilihan_d' => '109', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Jika cos A = 3/5 dan A berada di kuadran IV, maka nilai dari sin 2A adalah...', 'pilihan_a' => '-24/25', 'pilihan_b' => '24/25', 'pilihan_c' => '-12/25', 'pilihan_d' => '12/25', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Pusat dan jari-jari lingkaran dengan persamaan x^2 + y^2 - 4x + 6y - 12 = 0 adalah...', 'pilihan_a' => '(2, -3) dan r = 5', 'pilihan_b' => '(-2, 3) dan r = 5', 'pilihan_c' => '(2, -3) dan r = 25', 'pilihan_d' => '(-2, 3) dan r = 25', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Matematika', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Jika turunan pertama dari f(x) = ax^3 + bx^2 + c adalah f\'(x) = 6x^2 - 10x, maka nilai a dan b berturut-turut adalah...', 'pilihan_a' => '2 dan -5', 'pilihan_b' => '3 dan -5', 'pilihan_c' => '2 dan 5', 'pilihan_d' => '3 dan 5', 'jawaban' => 'A', 'bobot' => 4],

            // IPA (10)
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Sebuah benda bermassa 2 kg jatuh bebas dari ketinggian 20 m. Energi kinetik benda saat berada pada ketinggian 5 m dari tanah adalah... (g=10 m/s2)', 'pilihan_a' => '100 J', 'pilihan_b' => '200 J', 'pilihan_c' => '300 J', 'pilihan_d' => '400 J', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Proses pembentukan energi pada respirasi seluler eukariotik yang menghasilkan ATP terbanyak terjadi pada tahap...', 'pilihan_a' => 'Glikolisis', 'pilihan_b' => 'Dekarboksilasi Oksidatif', 'pilihan_c' => 'Siklus Krebs', 'pilihan_d' => 'Transpor Elektron', 'jawaban' => 'D', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Kecepatan reaksi suatu gas meningkat menjadi 2 kali lipat setiap kenaikan suhu 10 derajat celcius. Jika pada suhu 30 derajat lajunya v, maka pada suhu 60 derajat lajunya adalah...', 'pilihan_a' => '2v', 'pilihan_b' => '4v', 'pilihan_c' => '6v', 'pilihan_d' => '8v', 'jawaban' => 'D', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Sebuah trafo ideal memiliki rasio lilitan primer dan sekunder 1:4. Jika tegangan primer 220V dan arus sekunder 2A, berapakah daya primernya?', 'pilihan_a' => '440 W', 'pilihan_b' => '880 W', 'pilihan_c' => '1760 W', 'pilihan_d' => '3520 W', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Volume 22 gram gas CO2 (Ar C=12, O=16) pada keadaan STP adalah...', 'pilihan_a' => '5,6 L', 'pilihan_b' => '11,2 L', 'pilihan_c' => '22,4 L', 'pilihan_d' => '44,8 L', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Hormon yang berperan merangsang pematangan buah pada tumbuhan adalah...', 'pilihan_a' => 'Auksin', 'pilihan_b' => 'Sitokinin', 'pilihan_c' => 'Giberelin', 'pilihan_d' => 'Etilen', 'jawaban' => 'D', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Dua buah muatan masing-masing Q1 = +4 uC dan Q2 = -9 uC terpisah sejauh 10 cm. Letak titik yang medan listriknya nol berada pada jarak...', 'pilihan_a' => '20 cm dari Q1 menjauhi Q2', 'pilihan_b' => '20 cm dari Q2 menjauhi Q1', 'pilihan_c' => '10 cm dari Q1 mendekati Q2', 'pilihan_d' => '10 cm dari Q2 mendekati Q1', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Apabila larutan penyangga mengandung NH3 dan NH4Cl dengan perbandingan mol 1:1, dan Kb NH3 = 10^-5, berapakah pH larutan tersebut?', 'pilihan_a' => '5', 'pilihan_b' => '7', 'pilihan_c' => '9', 'pilihan_d' => '11', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Peristiwa pindah silang (crossing over) kromosom homolog yang menyebabkan variasi genetik terjadi pada fase meiosis...', 'pilihan_a' => 'Profase I', 'pilihan_b' => 'Metafase I', 'pilihan_c' => 'Anafase I', 'pilihan_d' => 'Profase II', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'IPA', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Suatu unsur transisi memiliki konfigurasi elektron [Ar] 4s2 3d5. Unsur tersebut berada pada golongan...', 'pilihan_a' => 'V A', 'pilihan_b' => 'V B', 'pilihan_c' => 'VII A', 'pilihan_d' => 'VII B', 'jawaban' => 'D', 'bobot' => 4],

            // Bahasa Indonesia (10)
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Penggunaan tanda koma yang TIDAK tepat terdapat pada kalimat...', 'pilihan_a' => 'Dia lupa akan janjinya, karena sibuk.', 'pilihan_b' => 'Oleh karena itu, kita harus waspada.', 'pilihan_c' => 'Ayah membaca koran, dan ibu memasak.', 'pilihan_d' => 'Saya ingin datang, tetapi hari hujan.', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Kalimat yang efektif adalah...', 'pilihan_a' => 'Kepada para mahasiswa diharapkan berkumpul di aula.', 'pilihan_b' => 'Bagi yang kehilangan dompet harap lapor ke pos satpam.', 'pilihan_c' => 'Mereka saling pukul-memukul dalam perkelahian itu.', 'pilihan_d' => 'Penyusunan laporan itu membutuhkan waktu yang lama.', 'jawaban' => 'D', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Kata serapan yang penulisannya sesuai EYD V adalah...', 'pilihan_a' => 'Praktek', 'pilihan_b' => 'Analisa', 'pilihan_c' => 'Sistem', 'pilihan_d' => 'Resiko', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Manakah kata yang bermakna peyoratif?', 'pilihan_a' => 'Bunting', 'pilihan_b' => 'Tunanetra', 'pilihan_c' => 'Istri', 'pilihan_d' => 'Karyawan', 'jawaban' => 'A', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Kalimat pasif transitif terdapat pada kalimat...', 'pilihan_a' => 'Dia tertidur di sofa karena kelelahan.', 'pilihan_b' => 'Surat itu sedang diketik oleh sekretaris.', 'pilihan_c' => 'Burung bernyanyi di pagi hari.', 'pilihan_d' => 'Rumahnya kebanjiran semalam.', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Penggunaan huruf kapital yang benar terdapat pada...', 'pilihan_a' => 'Gubernur DKI jakarta meresmikan jalan baru.', 'pilihan_b' => 'Dia berlayar melintasi Teluk Tomini.', 'pilihan_c' => 'Bapak Ir. soekarno adalah presiden pertama.', 'pilihan_d' => 'Hari ini saya membeli Gula Jawa.', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Makna imbuhan pe- pada kata "petinju" bermakna...', 'pilihan_a' => 'Alat', 'pilihan_b' => 'Orang yang melakukan pekerjaan', 'pilihan_c' => 'Orang yang memiliki sifat', 'pilihan_d' => 'Hasil perbuatan', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Paragraf yang kalimat utamanya terletak di awal dan di akhir disebut...', 'pilihan_a' => 'Deduktif', 'pilihan_b' => 'Induktif', 'pilihan_c' => 'Campuran', 'pilihan_d' => 'Naratif', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Sinonim dari kata "Evokasi" adalah...', 'pilihan_a' => 'Penilaian', 'pilihan_b' => 'Penggugah rasa', 'pilihan_c' => 'Penyingkiran', 'pilihan_d' => 'Izin', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Indonesia', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Antonim dari kata "Skeptis" adalah...', 'pilihan_a' => 'Ragu-ragu', 'pilihan_b' => 'Curiga', 'pilihan_c' => 'Yakin', 'pilihan_d' => 'Apatis', 'jawaban' => 'C', 'bobot' => 4],

            // Bahasa Inggris (10)
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'By the time you arrive, I ... my work.', 'pilihan_a' => 'will finish', 'pilihan_b' => 'would finish', 'pilihan_c' => 'will have finished', 'pilihan_d' => 'have finished', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'If he had known about the problem, he ... us.', 'pilihan_a' => 'would help', 'pilihan_b' => 'will help', 'pilihan_c' => 'would have helped', 'pilihan_d' => 'had helped', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'The committee ... a new president right now.', 'pilihan_a' => 'elects', 'pilihan_b' => 'are electing', 'pilihan_c' => 'is electing', 'pilihan_d' => 'has elected', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Scarcely ... the room when the phone rang.', 'pilihan_a' => 'he had entered', 'pilihan_b' => 'had he entered', 'pilihan_c' => 'did he enter', 'pilihan_d' => 'he entered', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Despite ... hard, he failed the exam.', 'pilihan_a' => 'he studied', 'pilihan_b' => 'studied', 'pilihan_c' => 'studying', 'pilihan_d' => 'of studying', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Not only ... the piano, but she also sings beautifully.', 'pilihan_a' => 'she plays', 'pilihan_b' => 'plays she', 'pilihan_c' => 'does she play', 'pilihan_d' => 'she does play', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'The man ... wallet was stolen called the police.', 'pilihan_a' => 'who', 'pilihan_b' => 'whom', 'pilihan_c' => 'whose', 'pilihan_d' => 'which', 'jawaban' => 'C', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'It is crucial that the document ... immediately.', 'pilihan_a' => 'is sent', 'pilihan_b' => 'be sent', 'pilihan_c' => 'sent', 'pilihan_d' => 'will be sent', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'I would rather you ... here yesterday.', 'pilihan_a' => 'were', 'pilihan_b' => 'had been', 'pilihan_c' => 'have been', 'pilihan_d' => 'are', 'jawaban' => 'B', 'bobot' => 4],
            ['kategori' => 'Akademik', 'mapel' => 'Bahasa Inggris', 'tingkat_kesulitan' => 'Sulit', 'soal' => 'Choose the synonym of "Ubiquitous".', 'pilihan_a' => 'Rare', 'pilihan_b' => 'Omnipresent', 'pilihan_c' => 'Unique', 'pilihan_d' => 'Obsolete', 'jawaban' => 'B', 'bobot' => 4],
        ];

        foreach($questions as $q) {
            Question::firstOrCreate(
                ['soal' => $q['soal']],
                $q
            );
        }

        // Tambahan Soal Dummy untuk memenuhi kuota 50 soal per tab
        $mapels = ['TPA', 'Matematika', 'IPA', 'Bahasa Indonesia', 'Bahasa Inggris'];
        foreach ($mapels as $mapel) {
            $currentCount = Question::where('mapel', $mapel)->count();
            if ($currentCount < 50) {
                $needed = 50 - $currentCount;
                for ($i = 1; $i <= $needed; $i++) {
                    Question::firstOrCreate(
                        ['soal' => "Soal Tambahan $mapel Nomor $i"],
                        [
                            'kategori' => $mapel === 'TPA' ? 'TPA' : 'Akademik',
                            'mapel' => $mapel,
                            'tingkat_kesulitan' => 'Sedang',
                            'pilihan_a' => 'Pilihan A',
                            'pilihan_b' => 'Pilihan B',
                            'pilihan_c' => 'Pilihan C',
                            'pilihan_d' => 'Pilihan D',
                            'jawaban' => 'A',
                            'bobot' => 2
                        ]
                    );
                }
            }
        }
    }
}
