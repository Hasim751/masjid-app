<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Masjid;

class MasjidSeeder extends Seeder
{
    public function run()
    {
        Masjid::create([
            'name' => 'Faizan-e-Madina Islamic Center Regina',
            'address' => '1169 Athol St, Regina, SK S4T 3C3',
            'city' => 'Regina',
            'country' => 'Canada',
            'latitude' => 50.4733,
            'longitude' => -104.6331,
            'timezone' => 'America/Regina',
            'calculation_method' => 'ISNA',
            'status' => 'pending',
            'created_by' => 1 // Assuming the first Super Admin (ID=1)
        ]);
    }
}
