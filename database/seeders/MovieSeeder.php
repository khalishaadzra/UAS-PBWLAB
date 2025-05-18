<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie; // Import model Movie Anda
use Illuminate\Support\Facades\DB; // Untuk truncate jika diperlukan

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengosongkan tabel movies sebelum seeding.
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        Movie::truncate();
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $moviesData = [
            // ==================== MOVIES ====================
            [
                'title' => 'Mickey 17', 'sinopsis' => 'Di masa depan, Mickey adalah seorang "Expendable"—pekerja koloni luar angkasa yang dikloning setiap kali ia mati. Namun, konflik muncul saat dua versi dirinya hidup bersamaan.',
                'tahun_rilis' => 2025, 'sutradara' => 'Bong Joon-ho', 'penulis' => 'Bong Joon-ho, Edward Ashton (novel)', 'negara' => 'Korea Selatan / AS', 'bahasa' => 'Inggris',
                'genre' => 'Fiksi Ilmiah, Komedi Gelap', 'aktor_utama' => 'Robert Pattinson, Steven Yeun, Naomi Ackie, Toni Collette, Mark Ruffalo',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/2/2d/Mickey_17_film_poster.png', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Snow White', 'sinopsis' => 'Putri Snow White melarikan diri dari rencana pembunuhan oleh ibu tirinya, Ratu Jahat, dan bergabung dengan tujuh kurcaci serta pemberontak untuk merebut kembali kerajaannya.',
                'tahun_rilis' => 2025, 'sutradara' => 'Marc Webb', 'penulis' => 'Greta Gerwig, Erin Cressida Wilson', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Fantasi, Musikal, Romantis', 'aktor_utama' => 'Rachel Zegler, Gal Gadot, Andrew Burnap',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/1/1f/Snow_White_%282025_film%29_final_poster.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'The Monkey', 'sinopsis' => 'Dua saudara kembar menemukan mainan monyet yang terkutuk, menyebabkan serangkaian kematian misterius di sekitar mereka. Diadaptasi dari cerita pendek Stephen King.',
                'tahun_rilis' => 2025, 'sutradara' => 'Osgood Perkins', 'penulis' => 'Osgood Perkins, Stephen King (cerita pendek)', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Horor, Supernatural', 'aktor_utama' => 'Theo James, Tatiana Maslany, Elijah Wood, Christian Convery',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/9/9d/The_Monkey_film_poster.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Captain America: Brave New World', 'sinopsis' => 'Sam Wilson, sebagai Captain America baru, terlibat dalam insiden internasional dan harus mengungkap rencana global yang jahat yang melibatkan The Leader.',
                'tahun_rilis' => 2025, 'sutradara' => 'Julius Onah', 'penulis' => 'Malcolm Spellman, Dalan Musson, Matthew Orton', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Superhero, Aksi, Fiksi Ilmiah', 'aktor_utama' => 'Anthony Mackie, Danny Ramirez, Carl Lumbly, Tim Blake Nelson, Shira Haas, Harrison Ford',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/a/a4/Captain_America_Brave_New_World_poster.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Thunderbolts*', 'sinopsis' => 'Sekelompok antihero dan penjahat yang direformasi dikirim dalam misi oleh pemerintah, dipimpin oleh Valentina Allegra de Fontaine.',
                'tahun_rilis' => 2025, 'sutradara' => 'Jake Schreier', 'penulis' => 'Eric Pearson, Lee Sung Jin, Joanna Calo', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Superhero, Aksi, Petualangan', 'aktor_utama' => 'Florence Pugh, Sebastian Stan, David Harbour, Julia Louis-Dreyfus, Wyatt Russell, Hannah John-Kamen, Olga Kurylenko, Harrison Ford',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/9/90/Thunderbolts%2A_poster.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Mission: Impossible - The Final Reckoning', 'sinopsis' => 'Ethan Hunt dan tim IMF-nya melanjutkan misi mereka untuk melacak senjata mengerikan baru yang mengancam seluruh umat manusia sebelum jatuh ke tangan yang salah.',
                'tahun_rilis' => 2025, 'sutradara' => 'Christopher McQuarrie', 'penulis' => 'Christopher McQuarrie, Erik Jendresen', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Aksi, Mata-mata, Thriller', 'aktor_utama' => 'Tom Cruise, Ving Rhames, Henry Czerny, Simon Pegg, Rebecca Ferguson, Vanessa Kirby, Hayley Atwell',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/1/1f/Mission_Impossible_%E2%80%93_The_Final_Reckoning_Poster.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Jurassic World Rebirth', 'sinopsis' => 'Sebuah era baru dimulai di dunia Jurassic, dengan tantangan baru dan dinosaurus yang belum pernah terlihat sebelumnya. Tim ekspedisi melakukan misi berbahaya ke fasilitas penelitian pulau untuk mengekstraksi DNA dari makhluk prasejarah yang tersisa.',
                'tahun_rilis' => 2025, 'sutradara' => 'Gareth Edwards', 'penulis' => 'David Koepp', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Fiksi Ilmiah, Petualangan, Aksi', 'aktor_utama' => 'Scarlett Johansson, Jonathan Bailey, Manuel Garcia-Rulfo, Mahershala Ali',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/a/a5/Jurassic_World_Rebirth_poster.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Komang', 'sinopsis' => 'Seorang pemuda dari Buton jatuh cinta pada Ade, seorang perantau dari Bali, namun hubungan mereka menghadapi tantangan budaya dan keluarga.',
                'tahun_rilis' => 2025, 'sutradara' => 'Naya Anindita', 'penulis' => 'Evelyn Afnilia', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Drama, Romantis', 'aktor_utama' => 'Aurora Ribero, Kiesha Alvaro, Ajil Ditto',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/b/b1/Poster_film_Komang.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Jumbo', 'sinopsis' => 'Seorang anak laki-laki gemuk yang sering dibully bertemu dengan Meri, roh yang membantunya menghadapi masalah keluarga dan menemukan keberanian.',
                'tahun_rilis' => 2025, 'sutradara' => 'Ryan Adriandhy', 'penulis' => 'Ryan Adriandhy, Widya Arifianti', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Animasi, Drama, Fantasi', 'aktor_utama' => 'Prince Poetiray (suara), Denis Setiano (suara), Novia Bachmid (suara)',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/e/e6/Poster_film_Jumbo.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Pabrik Gula', 'sinopsis' => 'Kisah kehidupan para pekerja di pabrik gula tua peninggalan kolonial, menggambarkan perjuangan dan harapan mereka di tengah modernisasi.',
                'tahun_rilis' => 2025, 'sutradara' => 'Awi Suryadi', 'penulis' => 'Lele Laila', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Drama, Sejarah', 'aktor_utama' => 'Arbani Yasiz, Andri Mashadi, Firsan Abdullah',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/2/2e/Poster_Pabrik_Gula.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Norma: Antara Mertua dan Menantu', 'sinopsis' => 'Terinspirasi dari kisah viral, film ini mengikuti Norma yang harus menghadapi kenyataan pahit tentang perselingkuhan suaminya dengan ibu kandungnya sendiri.',
                'tahun_rilis' => 2024, 'sutradara' => 'Guntur Soeharjanto', 'penulis' => 'Oka Aurora, Norma Risma (inspirasi)', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Drama', 'aktor_utama' => 'Tissa Biani, Asri Welas, Bukie B. Mansyur',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/9/9a/Poster_film_Norma.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Qodrat 2', 'sinopsis' => 'Setelah pertempuran sengit melawan Assu’ala di film pertama, Ustadz Qodrat melanjutkan perjalanannya mencari istrinya, Azizah, yang mengalami depresi setelah menyerahkan dirinya pada kekuatan jahat demi menyelamatkan putra mereka, Alif. Azizah yang sempat dirawat di rumah sakit jiwa akhirnya keluar dan bekerja di sebuah pabrik pemintalan. Namun, pabrik tersebut menyimpan rahasia kelam.',
                'tahun_rilis' => 2025, 'sutradara' => 'Charles Gozali', 'penulis' => 'Asaf Antariksa, Gea Rexy, Charles Gozali', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Horor, Aksi, Spiritual', 'aktor_utama' => 'Vino G. Bastian, Acha Septriasa, Randy Pangalila',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/5/5c/Poster_Qodrat_2.jpg', 'tipe' => 'Movie'
            ],

            // ==================== SERIES ====================
            [
                'title' => 'Resident Playbook (Wise Resident Life)', 'sinopsis' => 'Mengisahkan para residen tahun pertama di departemen obstetri dan ginekologi di Yulje Medical Center yang menghadapi tantangan profesional dan pribadi dalam dunia medis yang sibuk.',
                'tahun_rilis' => 2025, 'sutradara' => 'Lee Min-soo', 'penulis' => 'Kim Song-hee', 'negara' => 'Korea Selatan', 'bahasa' => 'Korea',
                'genre' => 'Drama Medis, Komedi, Kehidupan', 'aktor_utama' => 'Go Youn-jung, Shin Si-ah, Kang Yoo-seok, Jung Joon-won',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/2/2e/Wise_Resident_Life_poster.png', 'tipe' => 'Series'
            ],
            [
                'title' => 'The Haunted Palace (Gwi Gong)', 'sinopsis' => 'Sebuah drama sageuk fantasi misteri yang menceritakan kisah seorang pengusir setan yang memasuki istana berhantu untuk menyelesaikan dendam hantu.',
                'tahun_rilis' => 2025, 'sutradara' => 'Yoon Seong-sik', 'penulis' => 'Yoon Soo-jung', 'negara' => 'Korea Selatan', 'bahasa' => 'Korea',
                'genre' => 'Drama, Misteri, Supranatural, Sageuk', 'aktor_utama' => 'Yook Sung-jae, Kim Ji-yeon (Bona)', // Nama Yook Sung Jae diperbaiki
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/5/5b/Haunted_Palace_poster.png', 'tipe' => 'Series'
            ],
            [
                'title' => 'Weak Hero: Class 2', 'sinopsis' => 'Melanjutkan kisah Yeon Si Eun yang pindah ke SMA Eunjang dan berjuang melawan kekerasan serta mencoba melindungi teman-temannya.',
                'tahun_rilis' => 2025, 'sutradara' => 'Yoo Soo-min, Park Dan-hee', 'penulis' => 'Yoo Soo-min, Kim Jin-seok (webtoon)', 'negara' => 'Korea Selatan', 'bahasa' => 'Korea',
                'genre' => 'Aksi, Drama, Sekolah, Remaja', 'aktor_utama' => 'Park Ji-hoon, Ryeoun, Choi Min-young, Yoo Su-bin, Bae Na-ra',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/3/3e/Weak_Hero_Class_1.jpeg', 'tipe' => 'Series' // Link poster dari Wikipedia page Weak Hero (Class 1)
            ],
            [
                'title' => 'Rekaman Terlarang', 'sinopsis' => 'Di tengah kekacauan politik, Rena, putri seorang gubernur konservatif, ditekan untuk menikah dengan Dandy, putra dari sekutu politik kuat ayahnya. Meskipun dia masih memiliki perasaan untuk mantannya, Bayu, yang menjadi penyelenggara pernikahan mereka, skandal muncul.',
                'tahun_rilis' => 2025, 'sutradara' => 'Dinna Jasanti', 'penulis' => 'Fiona Mahdalena', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Drama, Romansa', 'aktor_utama' => 'Clara Bernadeth',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/a/ac/Poster_Rekaman_Terlarang_%282024%29.jpg', 'tipe' => 'Series'
            ],
            [
                'title' => 'The Story of Angkasa', 'sinopsis' => 'Angkasa, remaja pemberontak dan pemimpin geng di sekolahnya, berusaha mengisi kekosongan sosok ibu dalam hidupnya. Setelah berselisih dengan pacarnya, ia bertemu Aurora, yang cocok dengannya dalam hal ego dan keras kepala, memicu romansa.',
                'tahun_rilis' => 2024, 'sutradara' => 'Adhe Darmastrya Sondang', 'penulis' => 'Nurwina Sari', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Drama, Romansa', 'aktor_utama' => 'Yesaya Abraham, Shenina Cinnamon',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/0/0c/Poster_Dia_Angkasa_%282024%29.jpg', 'tipe' => 'Series' // Dari IMDB mediaviewer
            ],
            [
                'title' => 'When Life Gives You Tangerines', 'sinopsis' => 'Menceritakan petualangan Ae-sun, "pemberontak yang luar biasa," dan Gwan-sik, yang nama panggilannya berarti "besi yang tak tergoyahkan," di Pulau Jeju, termasuk ketertarikan Gwan-sik yang sudah lama terhadap Ae-sun sejak mereka masih muda.',
                'tahun_rilis' => 2025, 'sutradara' => 'Kim Won-seok', 'penulis' => 'Im Sang-chun', 'negara' => 'Korea Selatan', 'bahasa' => 'Korea',
                'genre' => 'Romance, Drama, Comedy', 'aktor_utama' => 'IU (Lee Ji-eun), Park Bo-gum',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/e/e8/When_Life_Gives_You_Tangerines_poster.png', 'tipe' => 'Series'
            ],
            [
                'title' => 'Heavenly Ever After', 'sinopsis' => 'Pasangan muda terjebak antara dunia hidup dan mati setelah kecelakaan misterius, menjelajahi kehidupan setelah kematian.',
                'tahun_rilis' => 2025, 'sutradara' => 'Kim Seok-yoon', 'penulis' => 'Lee Nam-gyu, Kim Su-jin', 'negara' => 'Korea Selatan', 'bahasa' => 'Korea',
                'genre' => 'Romansa, Komedi, Fantasi', 'aktor_utama' => 'Kim Hye-ja, Lee Soon-jae',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/a/aa/Heavenly_Ever_After_poster.png', 'tipe' => 'Series'
            ],
            [
                'title' => 'Spring of Youth', 'sinopsis' => 'Sekelompok mahasiswa menghadapi cinta, persahabatan, dan trauma masa lalu dalam musim semi terakhir mereka.',
                'tahun_rilis' => 2025, 'sutradara' => 'Kim Sung-yong', 'penulis' => 'Kim Min-cheol', 'negara' => 'Korea Selatan', 'bahasa' => 'Korea',
                'genre' => 'Romansa, Drama, Musik', 'aktor_utama' => 'Ha Yoo-joon, So Joo-yeon',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/d/d1/Spring_of_Youth_poster.png', 'tipe' => 'Series'
            ],
            [
                'title' => 'Skaya and the Big Boss', 'sinopsis' => 'Skaya menyamar sebagai kembaran identiknya, Skara, yang bersekolah di Millenia High School, memicu petualangan komedi.',
                'tahun_rilis' => 2025, 'sutradara' => 'Kris Agtrian', 'penulis' => 'Momon Sudarma', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Komedi, Drama', 'aktor_utama' => 'Natasha Wilona, Rayn Wijaya',
                'poster_url' => 'https://media.themoviedb.org/t/p/w440_and_h660_face/7Lh6maCuZ8RSH2HK1uutnGeyp2J.jpg', 'tipe' => 'Series'
            ],
            [
                'title' => 'Tastefully Yours', 'sinopsis' => 'Pewaris perusahaan makanan bertemu koki pedesaan yang penuh semangat. Meski tak peduli pada rasa, mereka jatuh cinta saat mengelola restoran kecil bersama.',
                'tahun_rilis' => 2025, 'sutradara' => 'Park Dan-hee', 'penulis' => 'Jung Su-yoon', 'negara' => 'Korea Selatan', 'bahasa' => 'Korea',
                'genre' => 'Komedi, Drama, Romansa', 'aktor_utama' => 'Kang Ha-neul, Lee Yoo-young',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/0/08/Tastefully_Yours_poster.png', 'tipe' => 'Series'
            ],
            [
                'title' => 'American Manhunt: Osama bin Laden', 'sinopsis' => 'Menelusuri perburuan global terhadap Osama bin Laden pasca-serangan 11 September 2001 di Amerika Serikat.',
                'tahun_rilis' => 2025, 'sutradara' => 'Mor Loushy, Floyd Russ', 'penulis' => 'Tim Penulis Dokumenter', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Dokumenter, Kriminal, Sejarah', 'aktor_utama' => 'Aaron L. Ginsburg (narator/ahli)',
                'poster_url' => 'https://media.themoviedb.org/t/p/w440_and_h660_face/aqTUagV31Qojw0rKQghHxVgOBdl.jpg', 'tipe' => 'Series'
            ],
            [
                'title' => 'Dia Angkasa', 'sinopsis' => 'Angkasa, remaja pemberontak dan pemimpin geng, bertemu Aurora, yang cocok dengannya dalam ego dan keras kepala, memicu romansa di tengah dilema persahabatan.',
                'tahun_rilis' => 2025, 'sutradara' => 'Adhe Darmastrya Sondang', 'penulis' => 'Nurwina Sari', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Romansa, Drama', 'aktor_utama' => 'Yesaya Abraham, Shenina Cinnamon',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/0/0c/Poster_Dia_Angkasa_%282024%29.jpg', 'tipe' => 'Series'
            ],

            // ==================== TRENDING ====================
            [
                'title' => 'Thug Life (Film 2025)', 'sinopsis' => 'Drama aksi tentang Rangaraya Sakthivel Nayakar, tokoh berpengaruh dalam dunia kekuasaan dan kesetiaan, menghadapi tantangan besar.',
                'tahun_rilis' => 2025, 'sutradara' => 'Mani Ratnam', 'penulis' => 'Kamal Haasan, Mani Ratnam', 'negara' => 'India (Tamil)', 'bahasa' => 'Tamil',
                'genre' => 'Aksi, Drama, Thriller', 'aktor_utama' => 'Kamal Haasan, Silambarasan, Trisha Krishnan',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/9/95/Thug_Life_2025.jpg', 'tipe' => 'Trending'
            ],
            [
                'title' => 'Splitsville (Film Komedi)', 'sinopsis' => 'Ketika Ashley meminta cerai, Carey mencari dukungan dari teman-temannya, Julie dan Paul, yang memiliki pernikahan terbuka, hingga Carey melanggar batas dan menciptakan kekacauan.',
                'tahun_rilis' => 2025, 'sutradara' => 'Michael Angelo Covino', 'penulis' => 'Michael Angelo Covino, Kyle Marvin', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Komedi', 'aktor_utama' => 'Dakota Johnson, Michael Angelo Covino, Kyle Marvin',
                'poster_url' => 'https://fr.web.img4.acsta.net/c_310_420/img/0a/49/0a495b546db6cae36e83e3db7e023f26.jpg', 'tipe' => 'Trending'
            ],
             [
                'title' => 'Die, My Love (Film Horor)', 'sinopsis' => 'Seorang ibu di daerah pedesaan terpencil berjuang mempertahankan kewarasannya saat menghadapi psikosis.',
                'tahun_rilis' => 2025, 'sutradara' => 'Lynne Ramsay', 'penulis' => 'Lynne Ramsay, Ariana Harwicz (novel)', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Komedi, Horor, Thriller', 'aktor_utama' => 'Jennifer Lawrence, Robert Pattinson',
                'poster_url' => 'https://media.themoviedb.org/t/p/w440_and_h660_face/mgsTwamYMfNZTyTtdE3EjahqYlc.jpg', 'tipe' => 'Trending'
            ],
            [
                'title' => 'Mission: Impossible - The Final Reckoning', 'sinopsis' => 'Ethan Hunt dan tim IMF-nya melanjutkan misi mereka untuk melacak senjata mengerikan baru yang mengancam seluruh umat manusia sebelum jatuh ke tangan yang salah.',
                'tahun_rilis' => 2025, 'sutradara' => 'Christopher McQuarrie', 'penulis' => 'Christopher McQuarrie, Erik Jendresen', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Aksi, Mata-mata, Thriller', 'aktor_utama' => 'Tom Cruise, Ving Rhames, Henry Czerny, Simon Pegg, Rebecca Ferguson, Vanessa Kirby, Hayley Atwell',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/1/1f/Mission_Impossible_%E2%80%93_The_Final_Reckoning_Poster.jpg', 'tipe' => 'Movie'
            ],

            // ==================== MOST ====================
            [
                'title' => 'Ne Zha 2 (Film Animasi)', 'sinopsis' => 'Pasca bencana besar, jiwa Nezha dan Aobing selamat, tetapi tubuh mereka hancur. Taiyi Zhenren menggunakan teratai tujuh warna untuk membangun kembali tubuh mereka.',
                'tahun_rilis' => 2025, 'sutradara' => 'Yu Yang (Jiaozi)', 'penulis' => 'Yu Yang (Jiaozi)', 'negara' => 'Tiongkok', 'bahasa' => 'Mandarin',
                'genre' => 'Animasi, Aksi, Petualangan, Fantasi', 'aktor_utama' => 'Lü Yanting (suara)',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/b/b6/Ne_Zha_2_poster.jpg', 'tipe' => 'Most'
            ],
             [
                'title' => 'Jumbo', 'sinopsis' => 'Seorang anak laki-laki gemuk yang sering dibully bertemu dengan Meri, roh yang membantunya menghadapi masalah keluarga dan menemukan keberanian.',
                'tahun_rilis' => 2025, 'sutradara' => 'Ryan Adriandhy', 'penulis' => 'Ryan Adriandhy, Widya Arifianti', 'negara' => 'Indonesia', 'bahasa' => 'Indonesia',
                'genre' => 'Animasi, Drama, Fantasi', 'aktor_utama' => 'Prince Poetiray (suara), Denis Setiano (suara), Novia Bachmid (suara)',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/e/e6/Poster_film_Jumbo.jpg', 'tipe' => 'Movie'
            ],
            [
                'title' => 'Sinners (Film Horor)', 'sinopsis' => 'Sinners mengambil latar tahun 1932 di Mississippi yang menampilkan saudara kembar identik Smoke dan Stack, diperankan oleh Michael B Jordan. Dikisahkan mereka kembali ke kampung halamannya setelah tujuh tahun tinggal di Chicago.',
                'tahun_rilis' => 2025, 'sutradara' => 'Ryan Coogler', 'penulis' => 'Ryan Coogler', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Horor, Thriller, Drama Periode', 'aktor_utama' => 'Michael B. Jordan',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/5/5f/Sinners_%282025_film%29_poster.jpg', 'tipe' => 'Most'
            ],

            // ==================== POPULER ====================
             [
                'title' => 'Stranger Things: Season 5', 'sinopsis' => 'Bab terakhir dari pertempuran geng Hawkins melawan Upside Down. Saat ancaman Vecna meningkat, Eleven dan teman-temannya menghadapi tantangan tergelap mereka, menghadapi kekuatan supranatural dan pengorbanan pribadi untuk menyelamatkan kota mereka dan satu sama lain.',
                'tahun_rilis' => 2025, 'sutradara' => 'The Duffer Brothers', 'penulis' => 'The Duffer Brothers', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Sci-Fi, Horror, Drama, Mystery, Remaja', 'aktor_utama' => 'Millie Bobby Brown, Finn Wolfhard, Noah Schnapp, Gaten Matarazzo, Caleb McLaughlin, Sadie Sink',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Stranger_Things_5_title_card.webp/500px-Stranger_Things_5_title_card.webp.png', 'tipe' => 'Populer'
            ],
            [
                'title' => 'Detective Chinatown 1990 (Film Komedi)', 'sinopsis' => 'Pada tahun 1900, seorang wanita kulit putih dibunuh di Chinatown, San Francisco, dan tersangka adalah pria Tionghoa, memicu guncangan sosial.',
                'tahun_rilis' => 2025, 'sutradara' => 'Chen Sicheng', 'penulis' => 'Chen Sicheng', 'negara' => 'Tiongkok', 'bahasa' => 'Mandarin',
                'genre' => 'Komedi, Drama, Misteri', 'aktor_utama' => 'Wang Baoqiang, Liu Haoran',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/7/74/DetectiveChinatown1900_Poster.jpg', 'tipe' => 'Populer'
            ],
             [
                'title' => 'Captain America: Brave New World', 'sinopsis' => 'Sam Wilson, sebagai Captain America baru, terlibat dalam insiden internasional dan harus mengungkap rencana global yang jahat yang melibatkan The Leader.',
                'tahun_rilis' => 2025, 'sutradara' => 'Julius Onah', 'penulis' => 'Malcolm Spellman, Dalan Musson, Matthew Orton', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Superhero, Aksi, Fiksi Ilmiah', 'aktor_utama' => 'Anthony Mackie, Danny Ramirez, Carl Lumbly, Tim Blake Nelson, Shira Haas, Harrison Ford',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/a/a4/Captain_America_Brave_New_World_poster.jpg', 'tipe' => 'Movie'
            ],

            // ==================== TOP RATE ====================
            [
                'title' => 'Anora (Film 2024)', 'sinopsis' => 'Seorang penari telanjang muda dari Brooklyn menikahi putra oligarki Rusia secara impulsif, tetapi pernikahannya terancam saat orang tua pria itu berusaha membatalkannya.',
                'tahun_rilis' => 2024, 'sutradara' => 'Sean Baker', 'penulis' => 'Sean Baker', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris, Rusia',
                'genre' => 'Komedi Gelap, Drama, Romansa', 'aktor_utama' => 'Mikey Madison, Mark Eydelshteyn, Yura Borisov',
                'poster_url' => 'https://posters.movieposterdb.com/24_08/2024/28607951/l_anora-movie-poster_d319c94a.jpg', 'tipe' => 'Top Rate'
            ],
            [
                'title' => 'Companion (Film Sci-Fi)', 'sinopsis' => 'Libur akhir pekan bersama teman-teman di kabin terpencil berubah menjadi kekacauan setelah terungkap bahwa salah satu tamu bukan seperti yang terlihat.',
                'tahun_rilis' => 2025, 'sutradara' => 'Drew Hancock', 'penulis' => 'Drew Hancock', 'negara' => 'Amerika Serikat', 'bahasa' => 'Inggris',
                'genre' => 'Fiksi Ilmiah, Thriller', 'aktor_utama' => 'Sophie Thatcher, Jack Quaid, Lukas Gage',
                'poster_url' => 'https://s.movieinsider.com/images/p/600//848264_m1736375468.jpg', 'tipe' => 'Top Rate'
            ],
            [
                'title' => 'Paddington in Peru (Film Animasi)', 'sinopsis' => 'Paddington kembali ke Peru untuk mengunjungi Bibi Lucy di Panti Jompo Beruang, tetapi petualangan seru dimulai saat misteri membawa keluarga Brown ke hutan Amazon.',
                'tahun_rilis' => 2025, 'sutradara' => 'Dougal Wilson', 'penulis' => 'Mark Burton, Jon Foster, James Lamont', 'negara' => 'Inggris, Prancis, Jepang, AS', 'bahasa' => 'Inggris, Spanyol, Prancis',
                'genre' => 'Animasi, Petualangan, Komedi, Keluarga', 'aktor_utama' => 'Ben Whishaw (suara), Hugh Bonneville, Emily Mortimer, Olivia Colman, Antonio Banderas',
                'poster_url' => 'https://image.tmdb.org/t/p/original/1ffZAucqfvQu36x1C49XfOdjuOG.jpg', 'tipe' => 'Top Rate'
            ],
        ];

        foreach ($moviesData as $data) {
            Movie::create($data);
        }

        $this->command->info(count($moviesData) . ' movies/series/categories seeded successfully with updated links!');
    }
}