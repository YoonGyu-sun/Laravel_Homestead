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
    
    public function index(Request $request): View
    {
        //변수 선언
        $userId = null;
        $count=0;                          
        $p = $request->input('p');
        $q = $request->input('q');

        // 설명 ->table에서 managements값 불러오고 auth를 이용해 인증된 사람의 게시물 카운트
        if(Auth::check()){
            $userId=Auth::user()->id;
            $count = Management::where('user_id', Auth::user()->id)->count();
        }  

        // 검색어가 있는 경우, title 컬럼에 대해 like 검색을 수행합니다.
        $query = Management::with('user')->latest();
    if($p!=null){
       $query = $query->when($p, function ($query, $p) {
            return $query->where('type', 'like', "%$p%");
        });
        } else {
           $query = $query->when($q, function ($query, $q) {
                return $query->where('title', 'like', "%$q%")
                ->orWhere('body', 'like', "%$q%");
            });
        }

        // 카테고리 갖고오기
        
        $categorys = Category::with('user')->get();
        $managements = $query->orderByDesc('id')->paginate(5);
        $managements->appends(['p' => $p, 'q' => $q]);
        
        

        return view('managements.index',[
            compact('managements'),
            'managements' =>$managements,
            'count'=>$count,
            'categorys' => $categorys, // Category에서 갖고옴
        ]);   
    }  
    
    public function create(): View
    {
        return view('managements.create',[
            'categorys' =>Category::with('user')->get(),
        ]);
    }   // 설명 -> catogry 받아오기

  
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'type' => 'required|string'
        ]);     // 설명 ->create에서 나온 값 넣기
 
        $request->user()->managements()->create($validated); // 설명 모름
        
        return redirect(route('managements.index'));
    }

    public function show(Management $management): View
    {
        return view('managements.show',[
            'manage_users' =>Management::with('user')->latest()->get(),
            'management' => $management,
            
        ]);
    }

    
    public function edit(Management $management): View
    {
        $this->authorize('update', $management);
 
        return view('managements.edit', [
            'management' => $management,
            'categorys' =>Category::with('user')->get(),
        ]);
    }


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

   
    public function destroy(Management $management): RedirectResponse
    {
        $this->authorize('delete', $management);
        $management->delete();

        
        return redirect(route('managements.index'));
    }


    public function deleteUsers(Request $request, Management $management): RedirectResponse
    {
        $selectedValues = json_decode($request->input('selectedValues'));
        foreach ($selectedValues as $id){
            Management::find($id)->delete();
        }
        return redirect(route('managements.index'));
    }   
}

