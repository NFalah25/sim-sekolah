<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'title' => 'Penerimaan Siswa Baru Tahun Ajaran 2025/2026',
            'description' => 'SMA Negeri 1 Kongo membuka pendaftaran siswa baru untuk tahun ajaran 2025/2026. Segera daftarkan diri Anda!',
            'content' => 'Kami dengan bangga mengumumkan bahwa pendaftaran siswa baru untuk tahun ajaran 2025/2026 telah dibuka. SMA Negeri 1 Kongo menawarkan berbagai program unggulan dan fasilitas lengkap untuk mendukung perkembangan akademik dan non-akademik siswa. Jangan lewatkan kesempatan ini untuk menjadi bagian dari keluarga besar kami. Untuk informasi lebih lanjut, kunjungi situs web kami atau hubungi kantor penerimaan siswa baru.',
            'image' => 'images/news/news.jpg',
            'status' => 1,
        ]);
        News::create([
            'title' => 'Prestasi Gemilang Siswa SMA Negeri 1 Kongo di Olimpiade Sains Nasional',
            'description' => 'Siswa SMA Negeri 1 Kongo meraih prestasi gemilang di Olimpiade Sains Nasional 2025.',
            'content' => 'Kami dengan bangga mengumumkan bahwa siswa-siswa kami telah meraih prestasi gemilang di Olimpiade Sains Nasional 2025. Beberapa siswa berhasil membawa pulang medali emas, perak, dan perunggu dalam berbagai kategori. Prestasi ini merupakan hasil kerja keras, dedikasi, dan bimbingan dari para guru kami. Kami mengucapkan selamat kepada seluruh siswa yang telah berpartisipasi dan meraih prestasi. Teruslah berprestasi dan menginspirasi!',
            'image' => 'images/news/news.jpg',
            'status' => 1,
        ]);
        News::create([
            'title' => 'Kegiatan Bakti Sosial SMA Negeri 1 Kongo di Desa Tertinggal',
            'description' => 'SMA Negeri 1 Kongo mengadakan kegiatan bakti sosial di desa tertinggal untuk membantu masyarakat sekitar.',
            'content' => 'Sebagai bagian dari komitmen kami untuk memberikan kontribusi positif kepada masyarakat, SMA Negeri 1 Kongo mengadakan kegiatan bakti sosial di desa tertinggal. Kegiatan ini melibatkan siswa, guru, dan staf sekolah yang bekerja sama untuk memberikan bantuan berupa sembako, pakaian, dan kegiatan edukatif bagi anak-anak di desa tersebut. Kami percaya bahwa pendidikan dan kepedulian sosial adalah kunci untuk membangun masa depan yang lebih baik. Terima kasih kepada semua pihak yang telah mendukung kegiatan ini.',
            'image' => 'images/news/news.jpg',
            'status' => 1,
        ]);
        News::create([
            'title' => 'Pelatihan Kepemimpinan untuk Siswa SMA Negeri 1 Kongo',
            'description' => 'SMA Negeri 1 Kongo mengadakan pelatihan kepemimpinan untuk mengembangkan potensi siswa.',
            'content' => 'Dalam upaya mengembangkan potensi kepemimpinan siswa, SMA Negeri 1 Kongo mengadakan pelatihan kepemimpinan yang melibatkan berbagai kegiatan interaktif dan simulasi. Pelatihan ini bertujuan untuk membekali siswa dengan keterampilan komunikasi, kerja sama tim, dan pengambilan keputusan yang efektif. Kami percaya bahwa kepemimpinan adalah kualitas penting yang harus dimiliki oleh generasi muda untuk menghadapi tantangan masa depan. Terima kasih kepada para fasilitator dan peserta yang telah berpartisipasi dalam pelatihan ini.',
            'image' => 'images/news/news.jpg',
            'status' => 1,
        ]);
        News::create([
            'title' => 'SMA Negeri 1 Kongo Meraih Akreditasi A',
            'description' => 'SMA Negeri 1 Kongo berhasil meraih akreditasi A dari Badan Akreditasi Nasional Sekolah/Madrasah (BAN-S/M).',
            'content' => 'Kami dengan bangga mengumumkan bahwa SMA Negeri 1 Kongo telah berhasil meraih akreditasi A dari Badan Akreditasi Nasional Sekolah/Madrasah (BAN-S/M). Prestasi ini merupakan hasil kerja keras seluruh civitas akademika, termasuk guru, staf, siswa, dan orang tua. Akreditasi A ini mencerminkan kualitas pendidikan yang kami berikan dan komitmen kami untuk terus meningkatkan standar pendidikan di sekolah kami. Terima kasih kepada semua pihak yang telah mendukung kami dalam mencapai prestasi ini.',
            'image' => 'images/news/news.jpg',
            'status' => 1,
        ]);
        News::create([
            'title' => 'Festival Seni dan Budaya SMA Negeri 1 Kongo',
            'description' => 'SMA Negeri 1 Kongo mengadakan festival seni dan budaya untuk memperkenalkan kekayaan budaya lokal.',
            'content' => 'Sebagai bagian dari upaya untuk melestarikan dan memperkenalkan kekayaan budaya lokal, SMA Negeri 1 Kongo mengadakan festival seni dan budaya yang melibatkan berbagai pertunjukan seni, pameran kerajinan tangan, dan kuliner tradisional. Festival ini diikuti oleh siswa, guru, orang tua, dan masyarakat sekitar. Kami percaya bahwa seni dan budaya adalah bagian penting dari identitas kita sebagai bangsa. Terima kasih kepada semua pihak yang telah berpartisipasi dan mendukung acara ini.',
            'image' => 'images/news/news.jpg',
            'status' => 1,
        ]);
    }
}
