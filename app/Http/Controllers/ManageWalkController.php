<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class ManageWalkController extends Controller
{
	public function index($walk)
	{	
		//récupération de la walk
		$currentWalk = DB::table('walks_langs')		
		->select('walks_langs.walk_id' ,'name')
		->where('slug', '=', $walk)
		->where('lang_code', '=', 'fr')
		->get();	

      
		if (count($currentWalk))
		{
			$walkId=$currentWalk[0]->walk_id;

			$listSpots = DB::table('walks_contents')		
			->select('walks_contents.walk_id','spots_langs.spot_id' ,'spots_langs.name','spots_langs.desc','pos_x','pos_y','icon_content','spot_type_id')
			->join('spots', 'spots.id', '=', 'walks_contents.spot_id')
			->join('spots_langs', 'spots_langs.spot_id', '=', 'spots.id')
			->join('l_spots_icons', 'l_spots_icons.id', '=', 'spots.spot_icon_id')
			->where('walks_contents.walk_id', '=', $walkId)
			->where('spots_langs.lang_code', '=', 'fr')
			->where('spots.show', '=', '1')
			->orderBy('walks_contents.ranking', 'asc')
			->get();


			$listMiams = DB::table('miam_spot')		
			->select('miams_langs.miam_id','walks_contents.spot_id','miams.img','miams_langs.name','miams_langs.desc','miams_langs.url')
			->join('walks_contents', 'walks_contents.spot_id', '=', 'miam_spot.spot_id')
			->join('miams', 'miams.id', '=', 'miam_spot.miam_id')
			->join('miams_langs', 'miams_langs.miam_id', '=', 'miams.id')

			->where('walks_contents.walk_id', '=', $walkId)
			->where('miams_langs.lang_code', '=', 'fr')
			->where('miams.show', '=', '1')			
			->get();




			//$filterSpotId=array_pluck($listMiams,"spot_id");


			return view('admin.ManageWalk',  compact('listSpots','listMiams','walkId'));



		}
		else
		{
			return "erreur";
            return view('admin.ManageWalk');
		}        

    }

	public function manage(Request $request)
	{
		
		//var_dump($request->input('name'));

		$camel = camel_case('foo_bar');
		var_dump($request->input());

	/*	$first_names = array_build($request->input('name'), function ($key, $name) {
			return array($key, array('first_name'=>is_array($name) ? $name[0] : $name));
		});*/



    }    
}
