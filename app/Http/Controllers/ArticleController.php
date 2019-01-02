<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use  App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Getting some articles
        $articles = Article::paginate(15);


        //return collection of articles as resource
        return ArticleResource::collection($articles);

    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //   echo "lllll"; exit;
        // print_r($request->input); exit;
        $article =  $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;

        // print_r($article); exit;
         $article->id = $request->input('article_id');
         $article->title = $request->input('title');
         $article->body = $request->input('body');

        // print_r($article->body); exit;
        if($article->save()){
            return new ArticleResource($article);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $article = Article::findOrFail($id);
        // print_r($article); exit;
       //return single article as a resource
       return  new  ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $article = Article::findOrFail($id);
        if($article->delete()){
            return  new  ArticleResource($article);

        }else{
            return "article not found";
        }

        
    }
}
