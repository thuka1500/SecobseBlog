<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Article;
use Carbon\Carbon;

class ArticleController extends Controller
{
    /**
     * Show 5 articles with every page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$articles = Article::latest('published_at')->Paginate(5);
    	return view('welcome', compact('articles'));
    }

    /**
     * Show single article and author.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSingleArticle($id)
    {
    	$article = Article::findOrFail($id); 	
    	$users=DB::table('users')
    	->select('name')
    	->where('id','=', $article->user_id)
    	->get();
    	return view('articles.showSingleArticle', compact('article', 'users'));
    }
}