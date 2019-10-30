<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
     public function index()
    {   
         $waitCampaigns = \App\Campaign::where('confirm',0)->with('brand')->get();
        return view('admin.index',[
            'waitCampaigns' => $waitCampaigns,
        ]);
    }
    public static function confirmCampaign(Request $request){
      DB::table('campaigns')->where('id', $request->nowId)->update(['confirm' => 1]);
        return;
   }
    
}
