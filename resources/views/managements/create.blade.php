<x-app-layout>
    <style>
        .ck.ck-editor {
            max-width: 2000;
        }
        .ck-editor__editable {
            min-height: 500px;   
        }
    </style>
    <form method="POST" action="{{ route('managements.store') }}">
    @csrf
        
            <div class="flex items-center border-t border-gray-500">
                <input type="text" name="title" id="title" placeholder="{{ __('') }}" required value="{{ old('title')? old('title'):'' }}" class="@error('title') border border-red-700 @enderror w-full h-32 text-lg border border-gray-200 mb-5">
                    
                {{-- drop down --}}
                        <!-- 변경된 부분 -->
                        <div class="flex items-center ml-10 relative">
                            <select id="categorySelect" onchange="category_button()" name="type" class="w-32 px-2 py-1 border border-gray-300 rounded sm:hidden lg:inline">
                                <option value="" disabled selected >구분</option>
                                <!-- 선택할 수 있는 옵션 목록을 생성합니다. -->
                                @foreach ($categorys as $category)
                                    @if($category->user->is(auth()->user()))
                                        <option value="{{ $category->cat_name }}">{{ $category->cat_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <script>
                                function category_button() {
                                    var selectedCategory = document.getElementById('categorySelect').value;
                                }
                            </script>
                        </div>        
                    {{-- drop down --}}
            </div>  
            

            {{-- CKeditor 사용 --}}
                <p><textarea class ="h-3/4"  name="body" id="body"></textarea></p>
                {{ csrf_field() }}

            <x-primary-button class="mt-4 float-right"> {{ __('완료') }} </x-primary-button>
    </form>
    <script src={{ asset('ckeditor/ckeditor.js') }}></script>
    
            <script>
                ClassicEditor
                        .create( document.querySelector( '#body' ) )
                        .catch( error => {
                            console.error( error );
                        } );
            </script>
</x-app-layout>

{{-- drop down button,list --}}
                    {{-- <div class="flex items-center ml-20 relative">
                        <button type="button" onclick="toggleOptions()" class="flex items-center space-x-1 py-2 px-4 rounded-md shadow-md hover:bg-gray-200">
                            <span id="selectCategory" class="text-sm">구분</span>
                                <svg class="w-4 h-4 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                               <path d="M19 9l-7 7-7-7" />
                                </svg>
                        </button>
                        <div id="options" class="hidden fixed top-32 left-32 bg-white  shadow-md"> 
                            <ul>
                                @foreach ($categorys as $category)
                                    <li name="type" class="hover:bg-gray-100 cursor-pointer  px-24 py-1 text-sm" onclick="category_button()">{{ $category->cat_name }}</li>
                                @endforeach
                            </ul>    
                        </div>
                        <script>
                            function toggleOptions() {
                                var options = document.getElementById("options");
                                options.classList.toggle("hidden");
                            }

                            function category_button(selectCategory){
                                document.getElementById("selectCategory").innerText = selectedCategiry;
                            }
                        </script>
                    </div> --}}.
                    {{-- drop down --}}




{{-- mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm --}}







{{-- <x-app-layout>
    <form method="POST" action="{{ route('managements.store') }}">
    @csrf
        <label class="block" for="title">Title이 부분에 카테고리 넣으면될 거 같음</label>
            <div class="flex items-center">
                <input class="@error('title') border border-red-700 @enderror" type="text" name="title" id="title" placeholder="{{ __('제목을 입력하세요') }}" required value="{{ old('title')? old('title'):'' }}">
                    
                {{-- drop down --}}
                        <!-- 변경된 부분 -->
                        {{-- <div class="flex items-center ml-10 relative">
                            <select id="categorySelect" onchange="category_button()" name="type">
                                <option value="" disabled selected>구분</option>
                                <!-- 선택할 수 있는 옵션 목록을 생성합니다. -->
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->cat_name }}">{{ $category->cat_name }}</option>
                                @endforeach
                            </select>
                            <script>
                                function category_button() {
                                    var selectedCategory = document.getElementById('categorySelect').value;
                                }
                            </script>
                        </div>         --}}
                    {{-- drop down --}}
           {{-- </div>  
            <textarea name="body" placeholder="{{ __('제목을 입력하세요') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm @error('body') border border-red-700 @enderror"> {{ old('body') }} </textarea>
            <x-primary-button class="mt-4 float-right"> {{ __('완료') }} </x-primary-button>
    </form>
</x-app-layout> --}}


{{-- //필요 없는 거 같음 --}}
{{-- drop down button,list --}}
                    {{-- <div class="flex items-center ml-20 relative">
                        <button type="button" onclick="toggleOptions()" class="flex items-center space-x-1 py-2 px-4 rounded-md shadow-md hover:bg-gray-200">
                            <span id="selectCategory" class="text-sm">구분</span>
                                <svg class="w-4 h-4 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                               <path d="M19 9l-7 7-7-7" />
                                </svg>
                        </button>
                        <div id="options" class="hidden fixed top-32 left-32 bg-white  shadow-md"> 
                            <ul>
                                @foreach ($categorys as $category)
                                    <li name="type" class="hover:bg-gray-100 cursor-pointer  px-24 py-1 text-sm" onclick="category_button()">{{ $category->cat_name }}</li>
                                @endforeach
                            </ul>    
                        </div>
                        <script>
                            function toggleOptions() {
                                var options = document.getElementById("options");
                                options.classList.toggle("hidden");
                            }

                            function category_button(selectCategory){
                                document.getElementById("selectCategory").innerText = selectedCategiry;
                            }
                        </script>
                    </div> --}}
                    {{-- drop down --}}



