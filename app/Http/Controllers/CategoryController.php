<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('categorys.index',[
            'categorys' =>Category::with('user')->get(),
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cat_name' => 'required|string|max:100',
        ]);
        $request->user()->categorys()->create($validated);
        
        return redirect(route('categorys.index'));
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('categorys.index',[
            'categorys' =>Category::with('user')->get(),
        ]);
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): ResponseRedirect
    {
       $this->authorize('update',$category);
       $validated = $request->validate([
            'cat_name' => 'required|string|max:100',
       ]);

       $category->update($validated);
       return redirect(route('categorys.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category):RedirectResponse
    {
        $this->authorize('delete', $category);
        $category->delete();
        return redirect(route('categorys.index'));
    }
}


