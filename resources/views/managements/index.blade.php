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
                                <form action="{{ route('managements.index') }}" method="GET" id="categoryForm">
                                    <select id="categorySelect"  name="p" onchange="category_button()">
                                        <option value="" disabled selected class>구분</option>
                                        
                                        <!-- 선택할 수 있는 옵션 목록을 생성합니다. -->
                                        @foreach ($categorys as $category)
                                            @if($category->user->is(auth()->user()))
                                                <option value="{{ $category->cat_name }}">{{ $category->cat_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    
                                    
                                </form>
                        </div>
                        <script>
                            function category_button(){
                                document.getElementById("categoryForm").submit();            
                            }
                        </script>
                
                    {{-- 검색 text --}}
                    <div class="ml-2">
                        <form action="{{ route('managements.index') }}" method="GET"> 
                            <input class="w-full focus:outline-none text-xs" type="text" placeholder="검색" name="q">
                            <button type="submit" class="border border-gray-500">전송</button>
                        </form>
                    
                    </div>
                    {{-- 검색 text --}}
            </div>
        
            
            {{-- dropdown --}}
        
                @foreach ($managements->take(10) as $management)
                    @if($management->user->is(auth()->user()))
                        <div class="bg-white w-8/12 border border-gray-300 items-center flex p-6" onmouseenter="showButtons(this)" onmouseleave="hideButtons(this)">
                                <div>
                                    <input type="checkbox" name="all_chk" value="1" class="w-3 h-3">
                                </div>

                                <div class="ml-4 font-bold" onmouseenter="titleUnder(this)" onmouseleave="titleNone(this)">
                                    <a href="{{ route('managements.show', $management) }}"> 
                                     {{ $management->title }}
                                    </a>
                                </div>
                                {{-- 마우스 갖다댔을 때만 수정과 삭제가 뜨게 한 번 해보자 --}}
                                <div class = "ml-auto flex">
                                    <button class="border border-gray-400 p-1 rounded mr-2 hidden" onclick="window.location.href = '{{ route('managements.edit', $management) }}'">{{ __('수정') }}</button>

                                
                                <form action="{{ route('managements.destroy', $management) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="border border-gray-400 p-1 rounded hidden" onclick="return confirm('삭제하시겠습니까?')" window.location.href = '{{ route('managements.destroy', $management) }}'>{{ __('삭제') }}</button>
                                    </form>
                                </div>                    
                        </div>
                    @endif      
                @endforeach
                
                <script>
                    function showButtons(element) {
                        element.classList.remove("bg-white");
                        element.classList.add("bg-gray-200");
                        
                        const buttons = element.querySelectorAll("button");
                        buttons.forEach((button) => {
                            button.classList.remove("hidden");
                        });
                    }

                    function hideButtons(element) {
                        element.classList.remove("bg-gray-200");
                        element.classList.add("bg-white");
                        
                        const buttons = element.querySelectorAll("button");
                        buttons.forEach((button) => {
                            button.classList.add("hidden");
                        });
                    }

                    function titleUnder(element){
                        const hrefs = element.querySelectorAll("a");
                        hrefs.forEach((a)=> {
                            a.classList.add("underline");
                        });
                    }

                    function titleNone(element){
                        const hrefs = element.querySelectorAll("a");
                        hrefs.forEach((a)=> {
                            a.classList.remove("underline");
                        });
                    }

                    
                </script>

                {{-- {{ $managements->links() }} --}}
        </div>    

</x-app-layout>

