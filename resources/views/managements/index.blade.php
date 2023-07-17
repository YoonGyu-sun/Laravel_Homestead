<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 flex justify-between items-center">
        <div class="text-lg">작성글 수 <small class="text-neutral-500"> : {{ $count }}</small> </div>
            
        <div>
            <a href="{{ route('managements.create') }}"><x-primary-button>
                {{ __('글쓰기') }}
            </x-primary-button></a>
        </div>
    </div>
     <div class="grid place-items-center w-full">   {{-- 전체 div --}}
        <div class="bg-white w-8/12 p-5 flex border border-gray-300 items-center mb-4">
            <div class="text-sm">
                <input type="checkbox" name="all_chk" value="1" class="w-3 h-3">  전체선택
            </div>
            
            {{-- dropdown --}}
           
            <div class="flex items-center ml-auto relative">
                <button type="button" onclick="toggleOptions()" class="flex items-center space-x-1 py-2 px-4 rounded-md shadow-md hover:bg-gray-200">
                    <span class="text-sm">구분</span>
                    <svg class="w-4 h-4 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="ml-2">
                    <input type="text" placeholder="검색 " class="w-full focus:outline-none text-xs">
                </div>
            </div>
            
            {{-- absolute right-1/4 top-56 --}}
            <div id="options" class="hidden absolute right-1/4 top-56 bg-white  shadow-md"> 
                 <ul>
                     @foreach ($categorys as $category)
                         <li class="hover:bg-gray-100 cursor-pointer  px-24 py-1 text-sm" onclick="category_button()">{{ $category->cat_name }}</li>
                         
                     @endforeach
                     
                 </ul>    
            </div>
        </div>
        
            <script>
                function toggleOptions() {
                    var options = document.getElementById("options");
                    options.classList.toggle("hidden");
                }
            </script>
            {{-- dropdown --}}

        @foreach ($managements->take(5) as $management)
            @if($management->user->is(auth()->user()))
                <div class="bg-white w-8/12 border border-gray-300 items-center flex p-6">
                        <div>
                            <input type="checkbox" name="all_chk" value="1" class="w-3 h-3">
                        </div>
                        
                        <div class="ml-4">
                            {{ $management->type }}
                        </div>
                        
                        <div class="ml-4">
                            {{ $management->title }}
                        </div>
                    
                        {{-- 마우스 갖다댔을 때만 수정과 삭제가 뜨게 한 번 해보자 --}}
                        <div class = "ml-auto flex">
                            <button class="border border-slate-90 p-1 rounded mr-2" onclick="window.location.href = '{{ route('managements.edit', $management) }}'">{{ __('수정') }}</button>
                            

                        <form action="{{ route('managements.destroy', $management) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="border border-slate-90 p-1 rounded" onclick="return confirm('삭제하시겠습니까?')" window.location.href = '{{ route('managements.destroy', $management) }}'>{{ __('삭제') }}</button>
                            </form>
                        </div>                    
                </div>
            @endif      
        @endforeach
    </div>    
</x-app-layout>

