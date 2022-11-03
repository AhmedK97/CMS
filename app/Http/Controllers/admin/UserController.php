<?php

namespace App\Http\Controllers\admin;
use App\Tools\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use ImageUploadTrait;
    public $user;
    public function __construct(User $user)
    {
        return $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.allusers', ['users' => $this->user->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit' , ['user' => $this->user->find($id)]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->find($id)->delete();
        return back();
    }
}
