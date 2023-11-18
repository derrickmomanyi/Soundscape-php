<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // truncate the table if it has data.
        DB::table('artists')->truncate();
        DB::table('artists')->insert([
            [
                'name'=> 'Beyonce',
                'image' => "https://t2.genius.com/unsafe/837x0/https%3A%2F%2Fimages.genius.com%2F25f7450d84a95225c33e8de77ce2c6b7.1000x1000x1.jpg", 
                'bio' => "Beyoncé's musical story started when she was nine years old, spending time with a group of friends dancing and singing their way into vocal competitions and performing at the rodeo, local clubs and concert venues in Houston, Texas. The group of girls gradually morphed into becoming Destiny's Child, one of the most successful female recording groups of all-time. Destiny's Child amassed worldwide hits with both singles and albums and in 2001 BEYONCÉ became the first African-American woman and the second woman ever to take home the ASCAP Pop Songwriter of the Year Award for her work with the band. Following her success with Destiny's Child and making the change to becoming a solo artist, BEYONCÉ has become one of the defining artists of our generation. A singer, songwriter, performer, actor, filmmaker, Beyoncé is a creative tour-de-force who has captivated, astonished and is celebrated by the world."
            ]
        ]);
        // enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
