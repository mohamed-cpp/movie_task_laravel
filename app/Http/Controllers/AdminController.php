<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index()
    {
        $data = User::paginate(config('paginatecount.user_paginate'));
        return view('user.index',compact('data'));
    }

    public function create()
    {
        return $this->edit(new User());
    }

    public function store(UserRequest $userRequest)
    {
        return $this->update($userRequest, new User());
    }

    public function edit(User $user)
    {
        return view('user.create',['user' => $user]);
    }

    public function update(UserRequest $userRequest, User $user)
    {
        $input = $userRequest->validated();
        if($input['password'] == null){
            unset($input['password']);
        }else{
            $input['password'] = Hash::make($input['password']);
        }
        User::updateOrCreate(['id' => $user->id], $input);
        return redirect()->route('admin.index');
    }

    public function destroy (User $user){
        $user->delete();
        return redirect()->back();
    }
}
