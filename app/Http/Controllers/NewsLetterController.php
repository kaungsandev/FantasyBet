<?php

namespace App\Http\Controllers;

use App\Services\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function subscribe(NewsLetter $newsletter){
        
        try {
            $newsletter->subscribe(request('email'));
        } catch (\Throwable $th) {
            throw $th;
        }
        $data=[
            'success' => 'true'
        ];
        return response()->json($data, 200);
    }
}
