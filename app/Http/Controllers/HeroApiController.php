<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HeroApiController extends Controller
{
    public function getData()
    {
        $heroes = Hero::all();
        $data = [
            'status'=>'success',
            'message'=>'data heroes berhasil diambil',
            'data'=>$heroes
        ];
        return response()->json($data);
    }
}
