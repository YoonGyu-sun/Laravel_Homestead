<?php

namespace App\Http\Controllers;

use App\Models\Management;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response; // 그냥 바로 웹페이지에 return Response로 보여줄 수 있음.
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $userId = null;
        $count=0;

        if(Auth::check()){
            $userId=Auth::user()->id;
            $count = DB::table('managements')
            ->where('user_id', Auth::user()->id)
            ->count();
        }


        return view('managements.index',[
            'managements' =>Management::with('user')->latest()->get(),
            'count'=>$count,
            'categorys' =>Category::with('user')->get(), // Category에서 갖고옴
            // 'type_option'=>Management::with('user')->first()->type,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('managements.create',[
            'categorys' =>Category::with('user')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'type' => 'required|string'
        ]);
 
        $request->user()->managements()->create($validated);
 
        return redirect(route('managements.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Management $management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Management $management): View
    {
        $this->authorize('update', $management);
 
        return view('managements.edit', [
            'management' => $management,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Management $management): RedirectResponse
    {
        $this->authorize('update', $management);

        $validated = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'type' => 'required|string'
        ]);

        $management->update($validated);

        return redirect(route('managements.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Management $management): RedirectResponse
    {
        $this->authorize('delete', $management);
        $management->delete();
        return redirect(route('managements.index'));
    }
}

