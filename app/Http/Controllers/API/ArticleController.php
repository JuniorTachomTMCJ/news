<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $articles = Article::with(['categories'])->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Internal server error', 500]);
        }

        return response()->json(ArticleResource::collection($articles));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'content' => 'required|string',
            'categories' => 'required|array|distinct',
            'categories.*' => 'required|integer|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 402);
        }

        $path = $request->file('image')->store('public/images');

        $article = new Article($request->all());
        $article->urlToImage = $path;

        try {
            DB::beginTransaction();
            $article->saveOrFail();

            $categories = Category::query()->findOrFail($request->categories);
            $article->categories()->attach($categories);
            DB::commit();
        } catch (\Throwable $th) {

            if (Storage::exists($article->urlToImage)) {
                Storage::delete($article->urlToImage);
            }
            DB::rollBack();
            return response()->json(['message' => 'Internal server error', 500]);
        }

        return response()->json(new ArticleResource($article), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}