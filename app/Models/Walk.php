<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Walk extends Model
{
    protected $table = 'walks';    

    
    public function districts()
	{
		return $this->belongsToMany('App\Models\District');
	}

}
