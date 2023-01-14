<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::paginate(config('paginatecount.category_paginate'));
        return view('category.index',compact('data'));
    }

    public function create()
    {
        return $this->edit(new Category());
    }

    public function store(CategoryRequest $categoryRequest)
    {
        return $this->update($categoryRequest, new Category());
    }

    public function edit(Category $category)
    {
        return view('category.create',['category' => $category]);
    }

    public function update(CategoryRequest $categoryRequest, Category $category)
    {
        Category::updateOrCreate(['id' => $category->id],$categoryRequest->validated());
        return redirect()->route('category.index');
    }

    public function destroy (Category $category){
        $category->delete();
        return redirect()->back();
    }
}
