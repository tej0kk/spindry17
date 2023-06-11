<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = Hero::all();
        // return $heroes;
        return view('pages.hero', compact('heroes'));
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
    public function store(Request $request)
    {
        // return $request;
        // Hero::create($request->all());

        $request->validate([
            'title' => 'required|min:5|max:10',
            'subtitle' => 'required|min:10|max:30',
            'background' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $background = $request->file('background');
        $filename = time() . '-' . rand() . '-' . $background->getClientOriginalName();
        $background->move(public_path('/img/heroes/'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Hero::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'background' => $filename,
            'status' => $status,
        ]);

        return redirect('/hero');
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
        $request->validate([
            'title' => 'required|min:5|max:10',
            'subtitle' => 'required|min:10|max:50',
            // 'background' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $status = $request->has('status') ? 'show' : 'hide';
        if ($request->has('background')) {
            unlink(public_path('/img/heroes/'.$hero->background));
            $background = $request->file('background');
            $filename = time() . '-' . rand() . '-' . $background->getClientOriginalName();
            $background->move(public_path('/img/heroes/'), $filename);
            Hero::where('id', $hero->id)->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'background' => $filename,
                'status' => $status,
            ]);
        }else{
            Hero::where('id', $hero->id)->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'status' => $status,
            ]);
        }
        
        return redirect('/hero');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        if(file_exists(asset('/img/heroes/'.$hero->background))){
            unlink(public_path('/img/heroes/'.$hero->background));
        }
        Hero::destroy('id', $hero->id);
        // Hero::where('id', $hero->id)->delete();
        return redirect('/hero');
    }
}
