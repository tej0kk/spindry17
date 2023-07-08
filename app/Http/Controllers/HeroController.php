<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Helpers\Display;
use App\Http\Requests\RequestHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $pagination = $request->has('pagination') ? $request->pagination : 10;
        if ($q) {
            $heroes = Hero::where('title', 'like', '%' . $q . '%')->paginate($pagination);
        } else {
            $heroes = Hero::paginate($pagination);
        }
        // return $heroes;
        return view('pages.hero', compact('heroes', 'q', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.hero-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestHero $request)
    {
        // return $request;
        // Hero::create($request->all());
        
        $filename = Display::upload_image($request->file('background'), 'heroes');

        $status = $request->has('status') ? 'show' : 'hide';

        // for($i=0;$i<100;$i++)
        // {
        Hero::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'background' => $filename,
            'status' => $status,
        ]);
        // DB::table('hero')->insert([
        //     'title' => $request->title,
        //     'subtitle' => $request->subtitle,
        //     'background' => $filename,
        //     'status' => $status,
        // ]);
        // }
        return redirect('/hero')->with('success', $request->title . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        // return $hero;
        return view('pages.hero-edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
        // return $request;
        $request->validate(
            [
                'title' => 'required|min:5|max:10',
                'subtitle' => 'required|min:10|max:50',
                // 'background' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'title.required' => 'Kolom TITLE tidak boleh kosong om !',
                'title.min' => 'Kolom TITLE terlalu pendek !',
                'title.max' => 'Kolom TITLE terlalu panjang !',
                'subtitle.required' => 'Kolom SUBTITLE tidak boleh kosong om !',
                'subtitle.min' => 'Kolom SUBTITLE terlalu pendek !',
                'subtitle.max' => 'Kolom SUBTITLE terlalu panjang !',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';
        if ($request->has('background')) {
            unlink(public_path('/img/heroes/' . $hero->background));
            $background = $request->file('background');
            $filename = time() . '-' . rand() . '-' . $background->getClientOriginalName();
            $background->move(public_path('/img/heroes/'), $filename);
            Hero::where('id', $hero->id)->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'background' => $filename,
                'status' => $status,
            ]);
        } else {
            Hero::where('id', $hero->id)->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'status' => $status,
            ]);
        }

        return redirect('/hero')->with('success', $request->title . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        if (file_exists(asset('/img/heroes/' . $hero->background))) {
            unlink(public_path('/img/heroes/' . $hero->background));
        }
        Hero::destroy('id', $hero->id);
        // Hero::where('id', $hero->id)->delete();
        return redirect('/hero')->with('success', $hero->title . ' berhasil dihapus');
    }
}
