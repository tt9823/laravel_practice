<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\HashTag;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['create', 'edit', 'store', 'edit', 'update', 'destroy']
        ]);
    }

    public function index() 
    {
        $tweets = Tweet::all();
        return view('tweet.index', [
            'tweets' => $tweets,
        ]);
    }

    public function create() 
    {
        return view('tweet.create');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'body' => ['required', 'string', 'max:255'],
            'hash_tags' => ['string', 'max:255']
        ]);
        $tweet = new Tweet;
        $tweet->body = $request->input('body');
        $tweet->user_id = $request->user()->id;
        $tweet->save();

        $hash_tag_names = preg_split('/\s+/', $request->input('hash_tags'), -1, PREG_SPLIT_NO_EMPTY);

        $hash_tag_ids = [];
        foreach ($hash_tag_names as $hash_tag_name) {
            $hash_tag = HashTag::firstOrCreate([
                'name' => $hash_tag_name,
            ]);
            $hash_tag_ids[] = $hash_tag->id;
        }

        $tweet->hashTags()->sync($hash_tag_ids);

        $request->session()->flash('flashmessage', 'ツイートの新規投稿が完了しました');

        return redirect('/tweets');
    }

    public function show($id) 
    {
        $tweet = Tweet::find($id);
        return view('tweet.show', [
            'tweet' => $tweet
        ]);
    }

    public function edit($id) 
    {
        $tweet = Tweet::find($id);
        return view('tweet.edit', [
            'tweet' => $tweet
        ]);
    }

    public function update(Request $request, $id) 
    {
        $tweet = Tweet::find($id);
        $tweet->body = $request->input('body');
        $tweet->save();

        $hash_tag_names = preg_split('/\s+/', $request->input('hash_tags'), -1, PREG_SPLIT_NO_EMPTY);

        $hash_tag_ids = [];
        foreach ($hash_tag_names as $hash_tag_name) {
            $hash_tag = HashTag::firstOrCreate([
                'name' => $hash_tag_name,
            ]);
            $hash_tag_ids[] = $hash_tag->id;
        }

        $tweet->hashTags()->sync($hash_tag_ids);

        return redirect('/tweets');
    }

    public function destroy($id)
    {
        $tweet = Tweet::find($id);
        $tweet->hashTags()->sync([]);
        $tweet->delete();

        return redirect()->route('tweets.index');
    }

    public function showByHashTag($id)
    {
        $hash_tag = HashTag::find($id);

        return view('tweet.index', [
            'tweets' => $hash_tag->tweets
        ]);
    }
}
