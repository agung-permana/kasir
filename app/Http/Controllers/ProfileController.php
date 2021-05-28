<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('profil/index', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        return view('profil/edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $profile->update([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone
        ]);

        alert()->success('Sukses','Berhasil Diedit');
        return redirect()->route('profile.index');
    }
}
