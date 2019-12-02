<?php

use \App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'clave' => 'ASAM4265984',
            'nom_com' => 'Alan',
            'raz_soc' => 'ASAM S.A DE C.V',
            'rfc' => 'AAMA9203285I3',
            'edad' => '27',
            'domicilio' => 'Río Grijalva, Boca del río, Veracruz',
            'estatus' => '1',
        ]);
    }
}