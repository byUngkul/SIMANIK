<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Dokter;
use App\Resepsionist;
use App\Apoteker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
        	'username' => 'admin',
        	'password' => bcrypt('admin'),
        	'level' => 'admin',
        ]);

        // Dokter::create([
        //     'id' => 'DK001',
        //     'username' => 'dokter',
        //     'password' => bcrypt('dokter'),
        //     'level' => 'dokter',
        //     'nama' => 'dokter adam',
        //     'alamat' => 'mojokerto',
        //     'tgl_lahir' => '1998-10-03',
        //     'spesialis' => 'bedah',
        //     'photo' => ' ',
        // ]);

        // Apoteker::create([
        //     'id' => 'AP001',
        //     'username' => 'apoteker',
        //     'password' => bcrypt('apoteker'),
        //     'level' => 'apoteker',
        //     'nama' => 'apoteker hendrik',
        //     'alamat' => 'mojokerto',
        //     'tgl_lahir' => '1998-10-03',
        //     'photo' => ' ',

        // ]);

        // Resepsionist::create([
        //     'id' => 'RS001',
        //     'username' => 'resepsionist',
        //     'password' => bcrypt('resepsionist'),
        //     'level' => 'resepsionist',
        //     'nama' => 'resepsionist syarif',
        //     'alamat' => 'mojokerto',
        //     'tgl_lahir' => '1998-10-03',
        //     'photo' => ' ',

        // ]);

    }
}
