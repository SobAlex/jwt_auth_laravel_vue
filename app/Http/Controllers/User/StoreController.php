<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function store(StoreRequest $request) {

        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::where('email', $data['email'])->first();

        if($user) return response(['error' => 'Пользователь с таким email уже зарегистрирован!'], 403);

        $user = User::create($data);

        $token = auth()->tokenById($user->id);

        return response(['access_token' => $token]);
    }
}
