<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;



class TweetController extends Controller
{
    public function index(){

        $tweets = Tweet::orderBy('created_at', 'DESC')->with('user')->get();

        return Inertia::render('Tweets/index',[
            'tweets' => $tweets
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['exists:users,id'],
            'content' => ['required', 'max:281']
        ]);

        Tweet::create([
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return Redirect::route('tweets.index');
    }

    public function followings()
    {
        $followings = Tweet::with('user')
            ->whereIn('user_id', auth()->user()->followings->pluck('id'))
            ->orderBy('created_at', 'DESC')
            ->with([
                'user' => function ($q) {
                    return $q->withCount([
                        'followings as isFollowingUser' => function ($q) {
                            return $q
                                ->where('following_id', '=', auth()->user()->id);
                        }])
                        ->withCasts(['isFollowingUser' => 'boolean']);
                }
            ])->get();

        return Inertia::render('Tweet/Followings', [
            'followings' => $followings
        ]);
    }
}
