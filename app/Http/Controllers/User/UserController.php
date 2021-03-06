<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserProfile;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profile()
    {
        return view('me.profile', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('me.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(UpdateUserProfile $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        $path = null;
        if (!empty($data['avatar'])) {
            $path = $data['avatar']->store('avatars', 'public');
            //$path = $data['avatar']->storeAs('avatars', $user->id() . '.png', 'public');

            if ($path) {
                Storage::disk('public')->delete($user->avatar);
                $data['avatar'] = $path;
            }
        }

        // logika zapisu
        $this->userRepository->updateModel(Auth::user(), $data);

        return redirect()
            ->route('me.profile')
            ->with('success', 'Profil zaktualizowany');
    }

    public function updateValidationRules(Request $request)
    {
        //dd($request->all());
        // name
        // email
        // phone
        $request->validate([
            //'email' => 'required|email',
            'email' => 'required|unique:users|email',
            'name' => 'required|max:2'
        ]);

        /*$request->validate([
            'email' => ['required', 'unique:users', 'email'],
            'name' => ['required', 'max:20']
        ]);*/

        // logika zapisu/aktualizacji;

        return redirect()
            ->route('me.profile')
            ->with('success', 'Profil zaktualizowany');
    }
}
