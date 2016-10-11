<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';


    public function walks()
	{
		return $this->belongsToMany('App\Models\Walk',"district_walk");
	}
}
