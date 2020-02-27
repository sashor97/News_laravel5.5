<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news=News::orderBy('created_at','desc')->limit(3)->get();

        return view('news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('news.create');
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
        $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);
        $news=new News;
        $news->news_title=$request->get('title');
        $news->news_link=$request->get('title');
        $news->news_description=$request->get('description');
        $news->save();
        return redirect('/news')->with('success','New article has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($link)
    {
        //

        $article = News::where('news_link', '=', $link)->firstOrFail();;
       $comments = Comment::where('news_id','=',$article->id)->get();
        return view('news.show',compact('article','comments'));
    }
    public function upvote($id)
    {
        $article=News::find($id);
        $oldupvote=$article->num_upvotes;
        $article->num_upvotes=$oldupvote+1;
        $article->save();
        return redirect('/news')->with('success','Someone upvoted');
    }
    public function mostpopular(){
        $news = News::orderBy('num_upvotes','desc')->limit(2)->get();
        return view('news.mostpopular', compact('news'));
    }
    public function downvote($id)
    {
        $article=News::find($id);
        $oldupvote=$article->num_upvotes;
        $article->num_upvotes=$oldupvote-1;
        $article->save();
        return redirect('/news')->with('success','Someone downvote');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article=News::find($id);
        return view('news.edit',compact('article'));

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
        //
        $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);
        $article=News::find($id);
        $article->news_title=$request->get('title');
        $link=$request->get('title');
        $article->news_link=strtolower($link);
        $article->news_description=$request->get('description');
        $article->save();
        return redirect('/news')->with('success','Article has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $article=News::find($id);
        $article->delete();
        return redirect('/news')->with('success','Article has been deleted');
    }
}
