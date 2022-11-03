<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Tools\ImageUploadTrait;
use GuzzleHttp\Promise\Create;

class ProfileController extends Controller
{
    use ImageUploadTrait;

    public $profile;
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function getByUser($id)
    {
        // $content = $this->user->with('profile')->find($id);
        // $content = Profile::where('user_id', $id)->with('user')->first();

        $content = $this->profile->where('user_id', $id)->with('user')->first();
        if (!$content) {
            $this->profile->create([
                'user_id' => auth()->user()->id,
            ]);
            $content = $this->profile->where('user_id', $id)->with('user')->first();
            return view('user.profile', compact('content'));
        }

        return view('user.profile', compact('content'));
    }

    public function settings()
    {
        $user = user::find(auth()->user()->id);
        // dd($user);
        return view('user.setting', compact('user'));
    }


    public function updatesettings(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', Rule::unique('users', 'email')->ignore(auth()->user()->id)]
        ]);
        // dd($request);

        if ($request->hasfile('avatar_file')) {
            $avatar = $this->uploadAvatar($request->avatar_file);
            $request->merge(['avatar' => $avatar]);
        }
        // dd($request);

        auth()->user()->update($request->only('name', 'email'));
        auth()->user()->profile()->updateOrCreate(['user_id' => auth()->user()->id], $request->only('bio', 'website', 'avatar'));
        return back()->with('success', trans('تمت عمليه التعديل'));
    }
}
