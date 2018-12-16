<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function renderResponse($statusCode, $msg, $obj) {
        $jsonResponse = new \stdClass();
        $jsonResponse->error_code = $statusCode;
        $jsonResponse->message = $msg;
		
		if(!is_null($obj)) {
			$jsonResponse->data =$obj;	
		}
        
        return $jsonResponse;
    }
}
