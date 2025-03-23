<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Group;


class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => '11'],
            ['name' => '12'],
            ['name' => '13'],
            ['name' => '14'],
            ['name' => '21'],
            ['name' => '22'],
            ['name' => '23'],
            ['name' => '24'],
            ['name' => '31'],
            ['name' => '32'],
            ['name' => '33'],
            ['name' => '34'],
            ['name' => '41'],
            ['name' => '42'],
            ['name' => '43'],
            ['name' => '44'],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
