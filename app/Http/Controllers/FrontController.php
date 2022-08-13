<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{
    public function index()
    {
        $date = new DateTime();

        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => 'a',
            'from' => $date->format('Y-m-d'),
            'to' => $date->format('Y-m-d'),
            'sortBy' => 'publishedAt',
            'language' => 'fr',
            'apiKey' => env('API_KEY_NEWS')
        ]);




        $data = $response->object();

        $articles = Article::query()->where('created_at', 'like', $date->format('Y-m-d') . '%')->latest('created_at')->get();

        $categories = Category::query()->latest()->get();

        if ($data && $data->status == "ok") {
            $output = [];
            $i = 0;
            $j = 0;

            while ($i < count($articles) || $j < count($data->articles)) {

                if ($i >= count($articles)) {
                    $output[] = $data->articles[$j];
                    $j++;
                } elseif ($j >= count($data->articles)) {
                    $output[] = $articles[$i];
                    $i++;
                } else {
                    $dateLocal = new DateTime($articles[$i]->created_at);
                    $dateAPI = new DateTime($data->articles[$j]->publishedAt);

                    if ($dateAPI > $dateLocal) {
                        $output[] = $data->articles[$j];
                        $j++;
                    } else {
                        $output[] = $articles[$i];
                        $i++;
                    }
                }
            }
        } else {
            $output = $articles;
        }


        return view('front.showArticles')->with(['articles' => $output, 'categories' => $categories]);
    }

    public function articleDetails(Request $request, String $slug)
    {
        $date = new DateTime();

        $currentArticle = null;

        if ($request->online == "true") {
            $response = Http::get('https://newsapi.org/v2/everything', [
                'q' => 'a',
                'from' => $date->format('Y-m-d'),
                'to' => $date->format('Y-m-d'),
                'sortBy' => 'publishedAt',
                'language' => 'fr',
                'apiKey' => env('API_KEY_NEWS')
            ]);

            $data = $response->object();

            if ($data && $data->status == "ok") {
                $articles = $data->articles;

                foreach ($articles as $article) {
                    if ($article->publishedAt == $slug) {
                        $currentArticle = $article;
                        break;
                    }
                }
            }
        } elseif ($request->online == "false") {
            try {
                $currentArticle = Article::query()->where('slug', $slug)->firstOrFail();
            } catch (\Throwable $th) {
                return redirect()->route('front.articles');
            }
        }

        if (!$currentArticle) {
            return redirect()->route('front.articles');
        }

        $categories = Category::query()->latest()->get();
        return view('front.detailArticle')->with(['article' => $currentArticle, 'categories' => $categories]);
    }

    public function showArticlesByCategory(Request $request, String $slugCategory)
    {
        $category = null;

        try {
            $category = Category::query()->where('slug', $slugCategory)->first();
        } catch (\Throwable $th) {
            return redirect()->route('front.articles');
        }

        $date = new DateTime();

        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => 'a',
            'from' => $date->format('Y-m-d'),
            'to' => $date->format('Y-m-d'),
            'sortBy' => 'publishedAt',
            'category', $request->label,
            'language' => 'fr',
            'apiKey' => env('API_KEY_NEWS')
        ]);

        $data = $response->object();

        if ($category) {
            $articles = $category->articles()->where('articles.created_at', 'like', $date->format('Y-m-d') . '%')->latest()->get();
        }

        $categories = Category::query()->latest()->get();

        if ($data && $data->status == "ok") {
            $output = [];
            $i = 0;
            $j = 0;

            while ($i < count($articles) || $j < count($data->articles)) {

                if ($i >= count($articles)) {
                    $output[] = $data->articles[$j];
                    $j++;
                } elseif ($j >= count($data->articles)) {
                    $output[] = $articles[$i];
                    $i++;
                } else {
                    $dateLocal = new DateTime($articles[$i]->created_at);
                    $dateAPI = new DateTime($data->articles[$j]->publishedAt);

                    if ($dateAPI > $dateLocal) {
                        $output[] = $data->articles[$j];
                        $j++;
                    } else {
                        $output[] = $articles[$i];
                        $i++;
                    }
                }
            }
        } else {
            $output = $articles;
        }

        if (!$output || count($output) < 1) {
            return redirect()->route('front.articles');
        }

        return view('front.showArticlesByCategory')->with(['articles' => $output, 'categories' => $categories, 'label' => $request->label]);
    }
}