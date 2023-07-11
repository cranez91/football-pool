<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BroadcasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            'TUDN' => 'tudn.png',
            'TV AZTECA' => 'tvazteca.png',
            'Fox Sports' => 'foxsports.png',
            'ESPN' => 'espn.png',
            'Afizzionados' => 'afizzionados.png',
            'Vix+' => 'vix.png',
        ];

        foreach ($list as $name => $logo) {
            DB::table('broadcasters')->insert([
                'name' => $name,
                'logo' => $logo
            ]);
        }
    }
}
