<?php

namespace App\Http\Controllers;

use App\Models\BreakingNews;
use App\Models\BreakingNewsSettings;
use Illuminate\Http\Request;

class BreakingNewsSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breakingNews = BreakingNews::query()->where('active', true)->first();
        $breakingNewsSettings = BreakingNewsSettings::query()->first();

        if ($breakingNewsSettings) {
            return view('admin.breakingNewsSettings.edit')->with(['breakingNewsSettings' => $breakingNewsSettings, 'breakingNews' => $breakingNews]);
        } else {
            return view('admin.breakingNewsSettings.create')->with('breakingNews', $breakingNews);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'textColor' => 'required|string',
            'bgColor' => 'required|string',
        ]);

        $breakingNewsSettings = new BreakingNewsSettings();

        $breakingNewsSettings->text_color = $request->textColor;
        $breakingNewsSettings->bg_color = $request->bgColor;

        $breakingNewsSettings->save();

        return redirect()->route('breakingNews.setting.index')->with('success', 'Paramèttres enregistrés avec succèss');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BreakingNewsSettings  $breakingNewsSettings
     * @return \Illuminate\Http\Response
     */
    public function show(BreakingNewsSettings $breakingNewsSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BreakingNewsSettings  $breakingNewsSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(BreakingNewsSettings $breakingNewsSettings)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BreakingNewsSettings  $breakingNewsSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $setting)
    {
        $this->validate(request(), [
            'textColor' => 'required|string',
            'bgColor' => 'required|string',
        ]);

        $breakingNewsSettings = BreakingNewsSettings::query()->find($setting);
        $breakingNewsSettings->text_color = $request->textColor;
        $breakingNewsSettings->bg_color = $request->bgColor;

        $breakingNewsSettings->update();

        return redirect()->route('breakingNews.setting.index')->with('success', 'Paramèttres enregistrés avec succèss');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BreakingNewsSettings  $breakingNewsSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(BreakingNewsSettings $breakingNewsSettings)
    {
        //
    }
}