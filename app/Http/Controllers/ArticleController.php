<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::query()->latest()->get();

        return view('admin.article.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'content' => 'required|string',
            // 'categories' => 'array',
            // 'categories.*' => 'required|integer|min:1',
        ]);

        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/images');

        $article = new Article($request->all());
        $article->urlToImage = $path;

        try {
            $article->saveOrFail();
        } catch (\Throwable $th) {
            if (Storage::exists($article->urlToImage)) {
                Storage::delete($article->urlToImage);
            }
            return back()->with('error', "Une erreur s'est produite veuillez réessayer")->withInput();
        }

        return redirect()->route('article.index')->with('success', 'Article crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(String $slug)
    {
        try {
            $article =  Article::query()->where('slug', $slug)->firstOrFail();
        } catch (\Throwable $th) {
            return back()->with('error', "Une erreur s'est produite veuillez réessayer")->withInput();
        }
        return view('admin.article.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(String $slug)
    {
        try {
            $article =  Article::query()->where('slug', $slug)->firstOrFail();
        } catch (\Throwable $th) {
            return back()->with('error', "Une erreur s'est produite veuillez réessayer")->withInput();
        }
        return view('admin.article.edit')->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $slug)
    {
        $this->validate(request(), [
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required_if:image,individual|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'content' => 'required|string',
            // 'categories' => 'array',
            // 'categories.*' => 'required|integer|min:1',
        ]);


        $oldUrlToImage = "";

        try {
            $article = Article::query()->where('slug', $slug)->firstOrFail();
            $oldUrlToImage = $article->urlToImage;

            if (isset($request->image)) {
                $name = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->store('public/images');

                $article->urlToImage = $path;
            }

            $article->updateOrFail($request->all());
        } catch (\Throwable $th) {
            if (Storage::exists($article->urlToImage)) {
                Storage::delete($article->urlToImage);
            }

            return back()->with('error', "Une erreur s'est produite veuillez réessayer")->withInput();
        }

        if (isset($request->image)) {
            if (Storage::exists($oldUrlToImage)) {
                Storage::delete($oldUrlToImage);
            }
        }

        return redirect()->route('article.index')->with('success', 'Article modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $slug)
    {
        try {
            $article =  Article::query()->where('slug', $slug)->firstOrFail();
            if (Storage::exists($article->urlToImage)) {
                Storage::delete($article->urlToImage);
            }
            $article->delete();
        } catch (\Throwable $th) {
            return back()->with('error', "Une erreur s'est produite veuillez réessayer");
        }
        return redirect()->route('article.index')->with('success', 'Article supprimé avec succès');
    }
}