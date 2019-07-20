<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    public function index() 
    {
        $tweets = Tweet::all();
        return view('tweet.index',[
            'tweets' => $tweets,
        ]);
    }

    public function create() 
    {
        return view('tweet.create');
    }

    public function store(Request $request) 
    {
        $tweet = new Tweet;
        $tweet->body = $request->input('body');
        $tweet->save();

        return redirect('/tweets');
    }
}
