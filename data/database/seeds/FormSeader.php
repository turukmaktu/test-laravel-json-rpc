<?php

use Illuminate\Database\Seeder;

class FormSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('forms')->insertGetId(
            ['page_uid' => 'uid_one']
        );

        DB::table('form_fields')->insert([
            ['code' => 'uid_one_fild_1', 'form_id' => $id],
            ['code' => 'uid_one_fild_2', 'form_id' => $id]
        ]);

        $id = DB::table('forms')->insertGetId(
            ['page_uid' => 'uid_two']
        );

        DB::table('form_fields')->insert([
            ['code' => 'uid_two_fild_1', 'form_id' => $id],
            ['code' => 'uid_two_fild_2', 'form_id' => $id]
        ]);

    }
}
