<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i <30 ; $i++) {
            Student::create([
                //"id"=>$request->get('id'),
                "nama"=>'Budia' . $i,
                "jk" =>$i > 10 ? 'P' : 'L'
            ]);
        }
    }
}
