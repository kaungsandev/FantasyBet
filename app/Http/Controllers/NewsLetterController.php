<?php

namespace App\Http\Controllers;

use App\Services\NewsLetter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsLetterController extends Controller
{
    public function getAllList(NewsLetter $newsletter){   
       ddd($newsletter->listId());
    }
    public function subscribe(NewsLetter $newsletter){
        request()->validate(['email' => 'required|email']);
        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email is not valid for our newsletter'
            ]);
        }
        return back()->with('success','Subscribed to our newsletter');
    }
}
