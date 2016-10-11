<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Walk;
use App\Models\District;

use Illuminate\Http\Request;
use App\Http\Requests;


class IndexController extends Controller
{
	public function index()
	{	
		//$walksq = Walk::all();
		//$editeurs = \DB::table('walks')->get();

		//$walks = new Walk;
		//$getWalks=$walks::all();
		//$walks = Walk::all();
		//$test = Walk::all()->districts();
		
		//$walkstest = new Walk;

		//$walkstest->districts()->orderBy("walk_id");

		//$district = new District;

		//$roles = \App\Models\District::find(1)->first()->district()->orderBy('name')->get();

		//$district::all()->walks;
		/*
		foreach ($district->walks as $role) {
			echo "dsfsdf";
		    echo '$role->walk_id()';
		}
		*/
/*
		$user = \App\Models\District::all();

		foreach ($user->walks as $role) {
		    echo "rr";
		}
*/
		$walks = DB::table('walks')		
		->select('walks_langs.walk_id' ,'walks_langs.name AS walk_name' ,'district_walk.district_id', 'districts_langs.name AS district_name', 'districts_langs.name_short', 'walks.show AS current','slug')
		->join('district_walk', 'district_walk.walk_id', '=', 'walks.id')
		->join('districts', 'districts.id', '=', 'district_walk.district_id')
		->join('districts_langs', 'districts_langs.district_id', '=', 'districts.id')
		->join('walks_langs', 'walks_langs.walk_id', '=', 'walks.id')
		->where('districts_langs.lang_code', '=', 'fr')
		->where('walks_langs.lang_code', '=', 'fr')
		->orderBy('walks.ranking', 'asc')
		->orderBy('districts.ranking', 'asc')
		->get();

		return view('index',  compact('walks'));
	}
}
