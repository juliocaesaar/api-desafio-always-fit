<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
        $user = User::findOrFail($id);
        $user->update($data);
        return response()->json($user);
    }
}
