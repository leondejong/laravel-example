<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
/**
     * Create a new UserController instance.
     * Inject dependencies and setup auth middleware.
     *
     * @param  \Illuminate\Support\Facades\Auth $auth
     * @param  \Illuminate\Validation\Rule $rule
     * @return void
     */
    public function __construct(Auth $auth, Rule $rule)
    {
        $this->auth = $auth;
        $this->rule = $rule;

        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.edit', ['user' => $this->auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $user = $this->auth::user();

        $validatedData = $request->validate([
            'email' => [
                $this->rule::unique('users')->ignore($user->id)
            ],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('collection.index')
            ->with('success', __('user.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove()
    {
        $this->auth::user()->delete();
        return redirect()->route('dashboard');
    }
}
