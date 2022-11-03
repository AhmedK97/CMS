<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promissions')->insert([
            'id' => 1,
            'name' => 'add-post',
            'desc' => 'إضافة المواضيع'
        ]);

        DB::table('promissions')->insert([
            'id' => 2,
            'name' => 'edit-post',
            'desc' => 'تعديل المواضيع'
        ]);

        DB::table('promissions')->insert([
            'id' => 3,
            'name' => 'delete-post',
            'desc' => 'حذف المواضيع'
        ]);

        DB::table('promissions')->insert([
            'id' => 4,
            'name' => 'add-user',
            'desc' => 'إضافة المستخدمين'
        ]);

        DB::table('promissions')->insert([
            'id' => 5,
            'name' => 'edit-user',
            'desc' => 'تعديل بيانات المستخدمين'
        ]);

        DB::table('promissions')->insert([
            'id' => 6,
            'name' => 'delete-user',
            'desc' => 'حذف المستخدمين'
        ]);

    }
}
