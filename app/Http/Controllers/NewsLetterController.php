<?php

namespace App\Http\Controllers;

use App\Mail\NewGameweekInvitation;
use App\Models\Fixture;
use App\Models\User;
use App\Services\NewsLetter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class NewsLetterController extends Controller
{
    public function getAllList(NewsLetter $newsletter)
    {
        ddd($newsletter->listId());
    }

    public function subscribe(NewsLetter $newsletter)
    {
        request()->validate(['email' => 'required|email']);
        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email is not valid for our newsletter',
            ]);
        }

        return back()->with('success', 'Subscribed to our newsletter');
    }

    // single user
    public function sendNewGameweekInvitation(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $fixture = Fixture::where('home_team', $user->fav_team)->orWhere('away_team', $user->fav_team)->orderBy('id', 'ASC')->get();
        $fixture = $fixture->where('finished', false)->first();

        Mail::to($user)->send(new NewGameweekInvitation($user, $fixture));

        return back()->with('success', 'Invitation has been sent');
    }
}
