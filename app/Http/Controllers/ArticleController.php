<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::with('author')->get();

        // $array = [];

        // foreach($articles as $article)
        // {
        //     $array[] = [
        //         'id' => $article->id,
        //         'title' => $article->title,
        //         'author_id' => $article->author_id,
        //         'author' => $article->author,
        //         'content' => $article->content
        //     ];

        // }

        $data = [
            'message' => 'Articles fetched successfully',
            'articles' => $articles
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $article = new Article;

        $article->title = $request->title;
        $article->content = $request->content;
        $article->author_id = $request->author_id;
        $article->image = $request->image;

        $article->save();

        $data = [
            'message' => 'Article created successfully',
            'article' => $article
        ];

        return response()->json($data);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //

        $data = [
            'message' => 'Article details',
            'article' => $article,
            'author' => $article->author
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $request->image;

        $article->save();

        $data = [
            'message' => 'Article updated successfully',
            'article' => $article
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();

        $data = [
            'message' => 'Article deleted successfully',
            'article' => $article
        ];

        return response()->json($data);
    }

    public function search(Request $request)
    {
        $query = DB::table('articles');

        // // Buscar por autor
        // if ($request->has('content')) {
        //     $content = $request->input('content');
        //     $query->where('content', $content);
        // }

        // Buscar por palabra clave
        
        $keyword = $request->input('keyword');

        // $query->select('articles.*')->join('authors', 'articles.author_id', '=', 'authors.id')->where('title', 'LIKE', "%{$keyword}%")->orWhere('content', 'LIKE', "%{$keyword}%")->where('authors.name', 'LIKE', "%{$keyword}%")->select('articles.*', 'authors.*');

        $query->join('authors', 'articles.author_id', '=', 'authors.id')->select('articles.*', 'authors.name')->where('title', 'LIKE', "%{$keyword}%")->orWhere('content', 'LIKE', "%{$keyword}%")->orWhere('authors.name', 'LIKE', "%{$keyword}%");

        // Obtener los resultados
        $result = $query->get();

        // Puedes retornar los resultados en formato JSON
        return response()->json($result);
    }


}
