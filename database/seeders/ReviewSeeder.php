<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\DB; // Untuk truncate jika diperlukan

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Opsional: Kosongkan tabel reviews sebelum seeding.
        // Ini berguna jika Anda ingin data review selalu fresh setiap kali seed.
        // Hati-hati jika Anda punya data review manual yang tidak ingin hilang.
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        Review::truncate();
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // Ambil semua ID movie yang ada
        $movieIds = Movie::pluck('id');

        // Ambil beberapa ID user yang ada (misalnya, maksimal 10 user pertama)
        // Pastikan Anda sudah memiliki user di database
        $userIds = User::take(10)->pluck('id');

        // Jika tidak ada user atau movie, hentikan seeder
        if ($userIds->isEmpty() || $movieIds->isEmpty()) {
            $this->command->warn('Tidak ada User atau Movie yang tersedia untuk di-seed reviewnya. Pastikan UserSeeder dan MovieSeeder sudah dijalankan.');
            return;
        }

        $dummyComments = [
            "Film yang sangat menghibur dari awal hingga akhir!",
            "Ceritanya bagus, aktingnya juga memukau.",
            "Tidak menyangka akan sebagus ini, recommended!",
            "Cukup bagus, meskipun ada beberapa plot hole kecil.",
            "Visualnya luar biasa, tapi ceritanya agak standar.",
            "Menegangkan dan penuh aksi, suka sekali!",
            "Endingnya membuat penasaran, semoga ada lanjutannya.",
            "Film keluarga yang hangat dan menyenangkan.",
            "Konsepnya unik, tapi eksekusinya kurang maksimal menurut saya.",
            "Harus nonton! Salah satu yang terbaik tahun ini.",
            "Lumayan untuk mengisi waktu luang.",
            "Aktor utamanya bermain sangat baik.",
            "Musik latarnya sangat mendukung suasana film.",
            "Ada beberapa adegan yang memorable.",
            "Tidak terlalu berkesan, tapi oke lah."
        ];

        foreach ($movieIds as $movieId) {
            // Setiap film akan mendapatkan minimal 1 review
            // Anda bisa mengatur jumlah review per film di sini (misalnya, rand(1, 3) untuk 1 sampai 3 review)
            $numberOfReviews = 1; // Atau rand(1, 2) jika ingin variasi

            for ($i = 0; $i < $numberOfReviews; $i++) {
                // Pilih user secara acak untuk memberikan review
                // Hindari satu user mereview film yang sama berkali-kali di seeder ini (jika numberOfReviews > 1)
                // Untuk kesederhanaan, kita ambil user acak saja. Jika ada unique constraint (user_id, movie_id), ini mungkin error jika user yang sama terpilih lagi.

                $userId = $userIds->random();

                // Cek apakah user ini sudah mereview film ini sebelumnya (untuk loop ini saja, bukan di database)
                // Untuk seeder sederhana, kita bisa skip pengecekan ini jika numberOfReviews = 1
                // Jika numberOfReviews > 1, Anda mungkin perlu logika lebih kompleks untuk memastikan user unik per film.

                Review::create([
                    'user_id' => $userId,
                    'movie_id' => $movieId,
                    'rating' => rand(3, 5), // Rating random antara 3 dan 5
                    'comment' => $dummyComments[array_rand($dummyComments)], // Ambil komentar random
                    // created_at dan updated_at akan diisi otomatis oleh Eloquent
                ]);
            }
        }

        $this->command->info(Review::count() . ' reviews seeded successfully!');
    }
}