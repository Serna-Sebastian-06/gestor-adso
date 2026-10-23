<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Aprendiz;
class AprendizSeeder extends Seeder
{
    public function run(): void
    {
        Aprendiz::factory()->count(25)->create();
    }
}
