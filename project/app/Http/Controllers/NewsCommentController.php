<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use Illuminate\Http\Request;

class NewsCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $article=News::findOrFail($id);
        $comments=Comment::where('news_id','=',$article->id)->get();

        return view('comments.index',compact('article','comments'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $article = News::where('id','=',$id)->firstOrFail();
        return view('comments.create',compact('article'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $request->validate([
            'username'=>'required',
            'comment'=>'required'
        ]);
        $article = News::findOrFail($id);
        $comment=new Comment();
        $comment->news_id=$article->id;
        $comment->username=$request->get('username');
        $comment->comment_text=$request->get('comment');
        $comment->save();
        return redirect()->route('comments.index',$article->id)->with('success','Comment has been created');


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
    public function edit($id1,$id2)
    {
        //
        $comment=Comment::where([
            ['id','=',$id2],
            ['news_id','=',$id1]
        ])->firstOrFail();
        return view('comments.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id1,$id2)
    {
        //
        $request->validate([
            'username'=>'required',
            'comment'=>'required'
        ]);

        // $id = $request->get('id');

        $comment = Comment::find($id2);
        $comment->username = $request->get('username');
        $comment->comment_text = $request->get('comment');
        $comment->save();
        return redirect()->route('comments.index',[$comment->news_id])->with('success','Comment has been created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id1,$id2)
    {
        //
        $comment = Comment::where([
            ['id','=',$id2],
            ['news_id','=',$id1]
        ])->firstOrFail();
        $comment->delete();
        return redirect()->route('comments.index',$comment->news_id);

    }
}
