<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::query();
        if ($request->t) {
            $posts = $posts->where('title', 'like', "%$request->t%");
        }
        if ($request->i) {
            $posts = $posts->whereNotNull('image');
        }
        if ($order = $request->o) {
            if ($order == 1) {
                $posts = $posts->latest();
            }
            if ($order == 2) {
                $posts = $posts->orderBy('created_at');
            }
            if ($order == 3) {
                $posts = $posts->orderBy('title');
            }
        }
        $posts = $posts->paginate(10)->withQueryString();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $post = new Post;
        return view('posts.form', compact('post'));
    }

    public function store()
    {
        $data = self::prepareValidation();
        Post::create($data);
        return redirect()->route('posts.index')->withMessage('تغییرات با موفقیت ذخیره شد.');
    }

    public function edit(Post $post)
    {
        return view('posts.form', compact('post'));
    }

    public function update(Post $post)
    {
        $data = self::prepareValidation();
        if (isset($data['image']) && $data['image'] && $post->image) {
            deleteFile($post->image);
        }
        $post->update($data);
        return redirect()->route('posts.index')->withMessage('تغییرات با موفقیت ذخیره شد.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        if ($post->image) {
            deleteFile($post->image);
        }
        return redirect()->route('posts.index')->withMessage('آیتم مورد نظر با موفقیت پاک شد.');
    }

    public static function prepareValidation()
    {
        $data =  request()->validate([
            'title' => 'required|string|between:3,200',
            'description' => 'required|string|between:10,5000',
            'image' => 'nullable|image|max:1000',
        ]);

        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }

        return $data;
    }
}
