<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Models\Content\PostCategory;
use App\Models\Content\Post;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as UploadImage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        $posts  = Post::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('admin.content.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::orderBy('created_at', 'desc')->get();
        // dd($postCategories);
        return view('admin.content.post.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        // date_default_timezone_set('tehran');
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFilePath = 'images' . DIRECTORY_SEPARATOR . 'Post' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m')  . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR;
            $imageFileName = explode('.', $image->getClientOriginalName())[0] . random_int(111111, 999999) . "." . explode('.', $image->getClientOriginalName())[1];
            if (!file_exists($imageFilePath)) {
                mkdir($imageFilePath, 666, true);
            }
            UploadImage::make($request->file('image')->getRealPath())->save(public_path($imageFilePath . $imageFileName));
            $inputs['image'] = $imageFilePath . $imageFileName;
        }
        if ($request->published_at < time()) {
            return redirect()->back()->withErrors('published_at', 'published_at');
        }
        $inputs['author_id'] = 1;

        //date fixed

        $realetimestampStart = intval(substr($request->published_at, 0, 10));
        $inputs['published_at'] = date('Y-m-d H:i:s', $realetimestampStart);
        Post::create($inputs);
        return redirect()->route('admin.content.post.index')->with('success', 'پست شما با موفقیت ثبت شد');
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
    public function edit(Post $post)
    {

        if ($post) {
            $postCategories  = PostCategory::all();

            return view('admin.content.post.edit', compact(['post', 'postCategories']));
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        if ($post) {
            $inputs = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageFilePath = 'images' . DIRECTORY_SEPARATOR . 'Post' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m')  . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR;
                $imageFileName = explode('.', $image->getClientOriginalName())[0] . random_int(111111, 999999) . "." . explode('.', $image->getClientOriginalName())[1];
                if (!file_exists($imageFilePath)) {
                    mkdir($imageFilePath, 666, true);
                }
                UploadImage::make($request->file('image')->getRealPath())->save(public_path($imageFilePath . $imageFileName));
                unlink(public_path($post->image));
                $inputs['image'] = $imageFilePath . $imageFileName;
            }
            $realetimestampStart = intval(substr($request->published_at, 0, 10));
            $inputs['published_at'] = date('Y-m-d H:i:s', $realetimestampStart);
            $post->update($inputs);

            return redirect()->route('admin.content.post.index')->with('success', "");
        } else {
            abort(404);
        }
    }

    public function status(Post $post)
    {

        $post->status = $post->status == 0 ? 1 : 0;
        $result = $post->save();
        if ($result) {
            if ($post->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function commentable(Post $post)
    {

        $post->commentable = $post->commentable == 0 ? 1 : 0;
        $result = $post->save();
        if ($result) {
            if ($post->commentable == 0) {
                return response()->json(['commantable' => true, 'checked' => false]);
            } else {
                return response()->json(['commantable' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post) {
            $post->delete();
            return redirect()->route('admin.content.post.index')->with('success', "دیتا شما با موفقیت حذف شد");
        } else {
            abort(404);
        }
    }
}
