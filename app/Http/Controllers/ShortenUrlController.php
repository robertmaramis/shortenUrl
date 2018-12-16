<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use App\LinkData;
use App\LinkHit;
use Response;

class ShortenUrlController extends Controller
{
    const BASE_ADDR = "http://127.0.0.1:8000/";
    
    public function shorten(Request $request) 
    {
        $response = new \stdClass();
        
        $url=$request->input('url');
        $short_url=substr(md5($url.mt_rand()),0,6);
        
        $shortUrl = LinkData::create([
            'original_url' => $url,
            'shorten_url' => $short_url,
            'hit' => "0"
        ]);
        
        $success =$shortUrl->save();
        
        $response->result = self::BASE_ADDR."?u=".$short_url;
        if(!$success){
            $res = $this->renderResponse("1","ERROR",$response);
        } else {
            $res = $this->renderResponse("0","SUCCESS",$response);
        }
        
        return Response::json($res,200);
    }
    
    public function report(Request $request) 
    {
        $linkList = DB::select(DB::raw("SELECT * FROM link_datas ORDER BY created_at DESC LIMIT 10"));
        $top10Klik = DB::select(DB::raw("SELECT * FROM link_datas ORDER BY hit DESC LIMIT 10"));
        $top10Country = DB::select(DB::raw("SELECT region FROM link_hits GROUP BY region ORDER BY COUNT(region) DESC  LIMIT 10"));
        
        $response = new \stdClass();
        $response->link_list = $linkList;
        $response->top10 = $top10Klik;
        $response->topCountry = $top10Country;
        
        $res = $this->renderResponse("0","SUCCESS",$response);
        
        return Response::json($res,200);
    }
}
