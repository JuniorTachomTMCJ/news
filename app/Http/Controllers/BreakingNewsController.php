<?php

namespace App\Http\Controllers;

use App\Models\BreakingNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BreakingNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breakingNewsList = BreakingNews::query()->latest()->get();
        return view('admin.breakingNews.index')->with('breakingNewsList', $breakingNewsList);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.breakingNewsList.create');
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
            'content' => 'required|string',
            'status' => 'required_if:boolean,individual',
        ]);

        $breakingNews = new BreakingNews();

        $breakingNews->content = $request->content;

        if (isset($request->status)) {
            $breakingNews->active = $request->status == "1" ? true : false;
        } else {
            $breakingNews->active = true;
        }

        try {
            DB::beginTransaction();
            $breakingNews->save();

            if ($breakingNews->active) {
                BreakingNews::query()->where('id', '<>', $breakingNews->id)->update(['active' => 0]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('breakingNews.index')->with('error', "Une erreur s'est produite veuillez réessayer")->withInput();
        }

        return redirect()->route('breakingNews.index')->with('success', 'Nouvelle crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BreakingNews  $breakingNews
     * @return \Illuminate\Http\Response
     */
    public function show(BreakingNews $breakingNews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BreakingNews  $breakingNews
     * @return \Illuminate\Http\Response
     */
    public function edit(BreakingNews $breakingNews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BreakingNews  $breakingNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BreakingNews $breakingNews)
    {
        $this->validate(request(), [
            'content' => 'required|string',
            'status' => 'required_if:boolean,individual',
        ]);

        $breakingNews->content = $request->content;

        if (isset($request->status)) {
            $breakingNews->active = $request->status == "1" ? true : false;
        } else {
            $breakingNews->active = true;
        }

        try {
            DB::beginTransaction();
            $breakingNews->update();

            if ($breakingNews->active) {
                BreakingNews::query()->where('id', '<>', $breakingNews->id)->update(['active' => 0]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            die;
            return redirect()->route('breakingNews.index')->with('error', "Une erreur s'est produite veuillez réessayer")->withInput();
        }

        return redirect()->route('breakingNews.index')->with('success', 'Nouvelle modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BreakingNews  $breakingNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(BreakingNews $breakingNews)
    {
        $breakingNews->delete();
        return redirect()->route('breakingNews.index')->with('success', 'Nouvelle supprimée avec succès');
    }
}