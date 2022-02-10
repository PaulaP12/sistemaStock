<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $maxPage = 5;
        $articles = DB::table('articles')->paginate($maxPage);
        return [
            "pagination"=>[
                'total' => $articles->total(),
                'current_page' => $articles->currentPage(),
                'per_page' => $articles->perPage(),
                'last_page' => $articles->lastPage(),
                'from' => $articles->firstItem(),
                'to' => $articles->lastPage(),
            ],
            "articles" => $articles
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $article= new Article;
        $article->nameArticle=$request->input('nameArticle');
        $article->priceArticle=$request->input('priceArticle');
        $article->stockMinArticle=$request->input('stockMinArticle');
        $article->stockMaxArticle=$request->input('stockMaxArticle');
        $article->dateExpirationArt=$request->input('dateExpirationArt');
        $article->category_id=$request->input('category_id');

        $article->save();
        return $article->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return $article->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->nameArticle=$request->input('nameArticle');
        $article->priceArticle=$request->input('priceArticle');
        $article->stockMinArticle=$request->input('stockMinArticle');
        $article->stockMaxArticle=$request->input('stockMaxArticle');
        $article->dateExpirationArt=$request->input('dateExpirationArt');
        $article->category_id=$request->input('category_id');

        $article->save();
        return response()->json($article,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article::destroy($article->id);
        return response()->json(['Estado' => 'Satisfactorio', 'Mensaje' => 'Artículo eliminado']);
    }
}
