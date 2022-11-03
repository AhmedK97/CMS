<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Tools\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    use ImageUploadTrait;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index',  ['posts' => $this->post::with('user:id,name')->approved()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->post->create($request->all()+['user_id'=>auth()->user()->id]);
        // dd($this->uploadImage($request->image));
        if ($request->hasFile('image')) {
            $image_name = $this->uploadImage($request->image);
        }

        $request->user()->posts()->create($request->all() + ['image_path' => $image_name ?? 'default.jpg']);

        return back()->with('success', trans('تم انشاء موضوع جديد وستتم مراجعته'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->post->find($id);
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->findorfail($id);

        abort_unless(auth()->user()->can('edit-post', $post), 403);

        return view('post.edit', compact('post'));
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
        if ($request->hasFile('image')) {
            $request->user()->posts()->find($id)->update($request->all() + ['image_path' => $this->uploadImage($request->image)]);
        } else {
            $request->user()->posts()->find($id)->update($request->all());
        }
        return back()->with('success', trans('تم التعديل'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->post->find($id)->delete();
        return back();
    }

    public function getByCategory($id)
    {
        $post = $this->post::with('user:id,name')->where('category_id', $id)->approved()->paginate(5);
        return view('index', ['posts' => $post]);
    }


    public function search(Request $request)
    {

        $posts = $this->post->where('body', 'like', "%{$request->keyword}%")->with('user:id,name')->approved()->paginate(5);

        return view('index', compact('posts'));
    }
}
