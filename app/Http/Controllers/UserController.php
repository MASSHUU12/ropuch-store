<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = min($request->query('limit', 16), 256);

        $users = User::paginate($limit, ['*'], 'page', $page);

        return response($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return response([
                'message' => 'User not found.'
            ], 404);
        }

        return response($user);
    }

    public function show_current(Request $request)
    {
        return response($request->user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email',
            'password' => 'string|min:8|confirmed'
        ]);

        $user = User::find($id);

        if ($user === null) {
            return response([
                'message' => 'User not found.'
            ], 404);
        }

        if (isset($fields['password'])) {
            $fields['password'] = bcrypt($fields['password']);
        }

        $user->update($fields);

        return response($user);
    }

    public function update_current(Request $request)
    {
        return $this->update($request, $request->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return response([
                'message' => 'User not found.'
            ], 404);
        }

        $user->delete();

        return response([
            'message' => 'User deleted.'
        ]);
    }

    public function destroy_current(Request $request)
    {
        return $this->destroy($request->user()->id);
    }
}
