<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SaveUserRequest; 

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        $user = new User();
        $searchableFields = $user->getFillable();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $searchField = $request->search_field ?? 'all';
            
            if ($searchField == 'all') {
                $query->where(function($q) use ($searchTerm, $searchableFields) {
                    foreach ($searchableFields as $field) {
                        if ($field !== 'password') {
                            $q->orWhere($field, 'like', "%{$searchTerm}%");
                        }
                    }
                });
            } elseif (in_array($searchField, $searchableFields) && $searchField !== 'password') {
                $query->where($searchField, 'like', "%{$searchTerm}%");
            }
        }
        
        $users = $query->orderBy('created_at')->paginate(10);
        
        $users->appends($request->only(['search', 'search_field']));
        
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        return view('users.create', compact('user'));
    }

    public function store(SaveUserRequest $request)
    {
        $userData = $request->validated();
        
        $userData['password'] = Hash::make($userData['password']);
        
        $user = User::create($userData);

        return redirect()->route('users.show', $user)
                         ->with('status', 'User created successfully');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(SaveUserRequest $request, User $user)
    {
        $userData = $request->validated();
        
        if (empty($userData['password'])) {
            unset($userData['password']);
        } else {
            $userData['password'] = Hash::make($userData['password']);
        }
        
        $user->update($userData);

        return redirect()->route('users.show', $user)
                         ->with('status', 'User updated successfully');
    }

    public function destroy(Request $request, User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('users.show', $user)
                             ->with('status', 'You cannot delete your own account while logged in.');
        }
        
        $user->delete();

        return redirect()->route('users.index')
                         ->with('status', 'User deleted successfully');
    }
}