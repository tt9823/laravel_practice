<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserProfileController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        return view('user_profile.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('user_profile.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'introduction' => ['string', 'max:255'],
            'birthday' => ['required', 'date'] 
        ]);
        
        $user = User::find($id);
        $user_profile = $user->userProfile;
        
        $user_profile->introduction = $request->input('introduction');
        $user_profile->birthday = $request->input('birthday');
        $user_profile->save();
        
        return redirect()
            ->route('tweets.index');
    }
}
