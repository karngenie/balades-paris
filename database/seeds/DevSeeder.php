<?php

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('districts')->delete();
		DB::table('districts_langs')->delete();

		for($i = 1; $i <= 20; ++$i)
		{			
			DB::table('districts')->insert([
				'id' => $i ,
				'ranking' => $i,			
				'show'=>1
			]);


			DB::table('districts_langs')->insert([
				'district_id' => $i ,
				'lang_code' => 'fr',
				'name' => $i .' arrondissement',
				'name_short' => $i.'eme',
				'desc' => 'bolo bolo bloblo',
			]);			
		}

		DB::table('walks')->delete();
		DB::table('walks_langs')->delete();

		for($i = 1; $i <= 25; ++$i)
		{			
			DB::table('walks')->insert([
				'id' => $i,			
				'ranking' => $i,			
				'show'=>1
			]);

			DB::table('walks_langs')->insert([
				'walk_id' => $i,
				'lang_code' => 'fr',
				'name' => 'parcours '. $i,
				'slug' => 'parcours'. $i,
				'desc' => 'bolo bolo bloblo'
			]);

		}

		DB::table('district_walk')->delete();

		for($i = 1; $i <= 25; ++$i)
		{	

			DB::table('district_walk')->insert([
				'district_id' => rand(1, 20),				
				'walk_id' => $i				
			]);
		
		}

		DB::table('l_spots_icons')->delete();
	
		DB::table('l_spots_icons')->insert([
			'id'=>1,
			'icon_content' =>'glyphicon-share-alt'
		]);
		DB::table('l_spots_icons')->insert([
			'id'=>2,
			'icon_content' =>'glyphicon-eye-open'
		]);
		DB::table('l_spots_icons')->insert([
			'id'=>3,
			'icon_content' =>'glyphicon-arrow-right'
		]);				
		DB::table('l_spots_icons')->insert([
			'id'=>4,
			'icon_content' =>'glyphicon-resize-small'
		]);
		DB::table('l_spots_icons')->insert([
			'id'=>5,
			'icon_content' =>'glyphicon-bell'
		]);				




		DB::table('spots')->delete();
		DB::table('spots_langs')->delete();

		for($i = 1; $i < 100; ++$i)
		{			
			DB::table('spots')->insert([
				'id'=>$i,
				'district_id' =>2,
				'spot_icon_id'=>rand(1, 5),
				'spot_type_id'=>rand(1, 2),
				'pos_x' => '41',
				'pos_y' => '41',
				'show'=>1
			]);

			DB::table('spots_langs')->insert([
				'spot_id'=>$i,
				'lang_code' => 'fr',
				'name' => 'spot_'.$i,
				'desc' => 'bolo bolo bloblo',
	
			]);			
		}

		DB::table('walks_contents')->delete();	
		for($i = 1; $i < 25; ++$i)
		{
			DB::table('walks_contents')->insert([
				'id'=>$i,
				'walk_id' =>1,
				'spot_id'=>$i,
				'ranking'=>$i
			]);

		}

		DB::table('miams')->delete();
		DB::table('miams_langs')->delete();

		for($i = 1; $i < 25; ++$i)
		{
			DB::table('miams')->insert([
				'id'=>$i,
				'district_id' =>rand(1, 20),
				'img'=>'http://static4.pagesjaunes.fr/media/cviv/55819639_N_0001_photo.jpg',
				'show'=>1
			]);

			DB::table('miams_langs')->insert([
				'miam_id'=>$i,
				'lang_code' =>'fr',
				'name'=>'resto'.$i,
				'desc'=>'bolo bolo bolo bolo bolo',
				'url'=>'http://www.google.fr'
			]);
		}

		DB::table('miam_spot')->delete();
		for($i = 1; $i < 25; ++$i)
		{
			if (rand(1, 2)==1)
			{
				$rnd=rand(1, 5);
				for($j = 1; $j < $rnd; ++$j)
				{
					DB::table('miam_spot')->insert([
						'miam_id'=>$i,
						'spot_id' =>rand(1, 25)						
					]);

				}

			}

		}

    }
}
