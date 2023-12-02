<?php

namespace App\Http\Controllers\Admin\Market;


use Illuminate\Http\Request;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments  = Comment::orderBy('created_at', 'desc')->where('commentable_type', 'App/Model/Product')->where('parent_id', null)->simplePaginate(15);

        $comment = Comment::find(7);

        foreach ($comments as $comment) {
            $seenresult = $comment->update(['seen' => 1]);
        }
        return view('admin.market.comment.index', compact('comments'));
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {

        // dd($comment->answer);
        $answers = $comment->where('parent_id', $comment->id)->orderBy('created_at', 'desc')->get();
        return view('admin.market.comment.show', compact('comment', 'answers'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($comment->parent_id == null) {
            return abort(404);
        } else {

            $comment->delete();
            return redirect()->route('admin.market.comment.show', $comment->parent_id)->with('success', 'داده شما با موفقیت حذف شد');
        }
    }

    public function approved(Comment $comment)
    {

        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result = $comment->save();

        if ($result) {
            return redirect()->route('admin.market.comment.index')->with('success', $comment->approved == 0 ? 'این نظر از حالت تایید خارج شد' : 'این نظر تایید شد');
        } else {
            return redirect()->route('admin.market.comment.index')->with('error', 'تغیر تایید این نظر با خطا مواجه شد');
        }
        // if ($result) {
        //     if ($comment->approved == 0) {
        //         return  response()->Json(['statusApproved' => true, 'approved' => false]);
        //     } else {
        //         return  response()->Json(['statusApproved' => true, 'approved' => true]);
        //     }
        // }
    }
    public function status(Comment $comment)
    {

        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            if ($comment->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    public function answerStatus(Comment $comment)
    {

        // dd($comment);
        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            return redirect()->route('admin.market.comment.show', $comment->parent_id)->with('success', $comment->status == 0 ? 'کامنت غیر فعال شد' : 'کامنت فعال شد');
        } else {
            return redirect()->route('admin.market.comment.show', $comment->parent_id)->with('error', 'خطا در ذخیره اطلاعات');
        }
    }




    public function answer(Request $request, Comment $comment)
    {

        // dd($comment->post->id);
        $inputs  = $request->all();
        $inputs['parent_id'] = $comment->id;
        $inputs['author_id'] = 1;
        $inputs['commentable_id'] = $comment->product->id;
        $inputs['commentable_type'] = 'App/Model/Product';
        $inputs['seen'] = 1;
        $inputs['approved'] = 1;
        $inputs['status'] = 1;
        // dd($inputs);
        $answer = Comment::create($inputs);

        if ($answer) {
            return redirect()->route('admin.market.comment.show', $comment->id)->with('success', 'پاسخ شما ثبت شد');
        } else {
            return redirect()->route('admin.market.comment.show', $comment->id)->with('error', 'خطا در ذخیره اطلاعات');
        }
    }
}
