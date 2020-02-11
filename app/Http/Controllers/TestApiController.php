<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestApiController extends Controller
{
    public function test()
    {
    	$data = ([
    		[
    			'nama'	=>	'Budianto',
    			'jk'	=>	'L',
    		],
    		[
    			'nama'	=>	'AdeSnth',
    			'jk'	=>	'P',  
    		],
    	]);
    	return $data;
    }

  
}
