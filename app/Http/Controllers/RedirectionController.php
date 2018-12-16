<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\LinkHit;

class RedirectionController extends Controller
{
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}
    
    public function redirect(Request $request)
    {
        $url = $request->input('u');
        if(!isset($url))
        {
           return view('index');
        }
        $IP = $_SERVER['REMOTE_ADDR'];
        $ip = self::getUserIP();
        
        //sample
        //$ip = "103.78.115.41";//jakarta
        //$ip = "8.8.8.8";//Mountain view
        
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        
        $oriUrl = DB::table('link_datas')
                    ->where('shorten_url',$url)
                    ->first();
        
        //add Hit
        $hit = (int)$oriUrl->hit + 1;
        
        $updates = DB::table('link_datas')
            ->where('link_id', $oriUrl->link_id)
            ->update(['hit' => $hit]);
        
        $hitData = LinkHit::create([
            'link_id' => $oriUrl->link_id,
            'region' => $details->city,
            'hit' => "0"
        ])->save();
        
        return redirect()->to($oriUrl->original_url);
    }
    
    private function getUserIP()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
    
        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
    
        return $ip;
    }
}
