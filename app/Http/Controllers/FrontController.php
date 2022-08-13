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

        $articles = Article::query()->where('created_at', Carbon::today())->latest('created_at')->get();
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
}