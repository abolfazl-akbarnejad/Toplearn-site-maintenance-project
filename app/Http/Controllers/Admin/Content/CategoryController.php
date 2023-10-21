<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content\PostCategory;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Models\Content\Post;
use Intervention\Image\ImageManagerStatic as UploadImage;


use Symfony\Component\CssSelector\Node\ElementNode;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories  = PostCategory::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('admin.content.category.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFilePath = 'images' . DIRECTORY_SEPARATOR . 'Post-category' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m')  . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR;
            $imageFileName = explode('.', $image->getClientOriginalName())[0] . random_int(111111, 999999) . "." . explode('.', $image->getClientOriginalName())[1];
            if (!file_exists($imageFilePath)) {
                mkdir($imageFilePath, 666, true);
            }
            UploadImage::make($request->file('image')->getRealPath())->save(public_path($imageFilePath . $imageFileName));
            $inputs['image'] = $imageFilePath . $imageFileName;
        }

        PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index')->with('success', 'دسته بندی شما با موفقیت ثبت شد');
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
    public function edit(PostCategory $postCategory)
    {
        return view('admin.content.category.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFilePath = 'images' . DIRECTORY_SEPARATOR . 'Post-category' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m')  . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR;
            $imageFileName = explode('.', $image->getClientOriginalName())[0] . random_int(111111, 999999) . "." . explode('.', $image->getClientOriginalName())[1];
            if (!file_exists($imageFilePath)) {
                mkdir($imageFilePath, 666, true);
            }
            UploadImage::make($request->file('image')->getRealPath())->save(public_path($imageFilePath . $imageFileName));
            unlink(public_path($postCategory->image));
            $inputs['image'] = $imageFilePath . $imageFileName;
        }
        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {

        if ($postCategory) {
            $postCategory->delete();
            return redirect()->route('admin.content.category.index')->with('success', 'داده شما با موفقیت حذف شد');
        } else {
            return abort(404);
        }
    }

    public function status(PostCategory $postCategory)
    {
        if ($postCategory->status == 0) {
            $result =  $postCategory->update(['status' => 1]);
        } else {
            $result =  $postCategory->update(['status' => 0]);
        }
        if ($result) {
            if ($postCategory->status == 1) {
                return response()->json(['satus' => true, 'cheked' => true]);
            } else {
                return response()->json(['satus' => true, 'cheked' => false]);
            }
        } else {
            return response()->json(['satus' => false]);
        }
    }
}
