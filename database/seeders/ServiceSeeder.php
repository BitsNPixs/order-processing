<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\Service;
use DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();

    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		Service::truncate();

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    	$services = [
    		[
    			'name' => 'Embroidery Digitizing',
    			'img' => 'img/service/digitizing.jpg',
    			'description' => 'Embroidery Digitizing is the process of converting artwork into a stitch file that can be read by an embroidery machine.',
    			'price' => 10,
    			'status' => 1
    		],
    		[
    			'name' => 'Vector Art Services',
    			'img' => 'img/service/vector-art.jpg',
    			'description' => 'Vector Artwork creation is a one key task involved in selling promotional products.',
    			'price' => 10,
    			'status' => 1
    		],

    	];

        foreach ($services as $key => $service) {
        	Service::create( $service );
        }



        Model::reguard();
    }
}
