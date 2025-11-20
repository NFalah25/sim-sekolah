<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'name' => 'Mushola',
            'description' => 'Mushola yang bersih dan nyaman untuk beribadah.',
            'image' => 'images/facilities/mushola.jpg',
        ]);
        Facility::create([
            'name' => 'Perpustakaan',
            'description' => 'Perpustakaan lengkap dengan berbagai koleksi buku.',
            'image' => 'images/facilities/library.jpg',
        ]);
        Facility::create([
            'name' => 'Laboratorium Komputer',
            'description' => 'Laboratorium komputer dengan perangkat terbaru.',
            'image' => 'images/facilities/computer_lab.jpg',
        ]);
        Facility::create([
            'name' => 'Lapangan Olahraga',
            'description' => 'Lapangan olahraga untuk berbagai kegiatan fisik.',
            'image' => 'images/facilities/sports_field.jpg',
        ]);
        Facility::create([
            'name' => 'Kantin',
            'description' => 'Kantin yang menyediakan makanan dan minuman sehat.',
            'image' => 'images/facilities/canteen.jpg',
        ]);
        Facility::create([
            'name' => 'Ruang Kelas',
            'description' => 'Ruang kelas yang nyaman dan dilengkapi dengan teknologi modern.',
            'image' => 'images/facilities/classroom.jpg',
        ]);
    }
}
