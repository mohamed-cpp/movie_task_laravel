<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $data = Movie::with('category')
        ->when($request->has('title'), function ($query) use ($request) {
            $query->where('title', 'like', "%{$request->title}%");
        })
        ->when($request->has('rate') && is_numeric($request->rate), function ($query) use ($request) {
            $query->where('rate', $request->rate);
        })
        ->when($request->has('category_id') && is_numeric($request->category_id), function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        })
        ->paginate(config('paginatecount.movie_paginate'));
        return view('movie.index',compact('data'));
    }

    public function create()
    {
        return $this->edit(new Movie());
    }

    public function store(MovieRequest $movieRequest)
    {
        return $this->update($movieRequest, new Movie());
    }

    public function edit(Movie $movie)
    {
        return view('movie.create',['movie' => $movie]);
    }

    public function update(MovieRequest $movieRequest, Movie $movie)
    {
        Movie::updateOrCreate(['id' => $movie->id],$movieRequest->validated());
        return redirect()->route('movie.index');
    }

    public function destroy (Movie $movie){
        $movie->delete();
        return redirect()->back();
    }
}
