<?php

namespace Database\Seeders;

use App\Http\Requests\restItem;
use App\Models\menu;
use App\Models\restItem as RestItemModel;
use App\Models\reviews;
use App\Models\User ;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->count(1)->create();
        // RestItemModel::factory()->count(1)->create();
        menu::factory()->count(5)->create();
        reviews::factory()->count(5)->create();
    }
}
