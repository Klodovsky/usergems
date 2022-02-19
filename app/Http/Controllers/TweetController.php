<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;



class TweetController extends Controller
{
    public function index(){

        $tweets = Tweet::orderBy('created_at', 'DESC')->with(['user' => function ($q) {
            return $q->withCount([
                'followers as isFollowing' => function ($q) {
                    return $q
                        ->where('follower_id', auth()->user()->id);
                }])
                ->withCasts(['isFollowing' => 'boolean']);
        }
        ])->get();
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
        ]);

        return Redirect::route('tweets.index');
    }

    public function followers()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'followings',
            'following_id',
            'follower_id'
        )
            ->withTimestamps();
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

        return Inertia::render('Tweets/Followings', [
            'followings' => $followings
        ]);
    }

    public function unfollows(User $user)
    {
        Auth::user()->followings()->detach($user);

        return redirect()->back();
    }

    public function follows(User $user)
    {
        Auth::user()->followings()->attach($user);

        return redirect()->back();
    }
    public function profile(User $user)
    {
        $user->loadCount([
            'followers as isFollowing' => function ($q) {
                return $q->where('follower_id', '=', auth()->user()->id)
                    ->withCasts(['isFollowing' => 'boolean']);
            },
            'followings as is_following_you' => function ($q) {
                return $q->where('following_id', auth()->user()->id);
            }
            ]);

        $tweets = $user->tweets;

        return Inertia::render('Tweets/Profile', [
            'profileUser' => $user,
            'tweets' => $tweets
        ]);
    }

}
