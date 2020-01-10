<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();

        $statusList = [
            [
                'code' => '',
                'name' => '',
                'description' => '',
            ],
        ];

        foreach ($statusList as $statusData) {


        }

    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */

}
