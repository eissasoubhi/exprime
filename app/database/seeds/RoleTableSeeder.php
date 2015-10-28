<?php
/**
*
*/
class RoleTableSeeder extends Seeder
{

    public function run()
    {
        $name = array('admin', 'user', 'modirator');
        foreach (range(0,2) as $index) {
            Role::create([
                'id' => $index+1,
                'name' => $name[$index]
                ]);
        }
    }
}