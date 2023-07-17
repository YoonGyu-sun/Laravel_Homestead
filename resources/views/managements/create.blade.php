<x-app-layout>
    <form method="POST" action="{{ route('managements.store') }}">
    @csrf
        <label class="block" for="title">Title이 부분에 카테고리 넣으면될 거 같음</label>
            <div class="flex items-center">
                <input class="@error('title') border border-red-700 @enderror" type="text" name="title" id="title" placeholder="{{ __('제목을 입력하세요') }}" required value="{{ old('title')? old('title'):'' }}">
                    {{-- drop down --}}
                    <div class="flex items-center ml-20 relative">
                        <button type="button" onclick="toggleOptions()" class="flex items-center space-x-1 py-2 px-4 rounded-md shadow-md hover:bg-gray-200">
                            <span class="text-sm">구분</span>
                                <svg class="w-4 h-4 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                               <path d="M19 9l-7 7-7-7" />
                                </svg>
                        </button>
                        <div id="options" class="hidden fixed top-32 left-32 bg-white  shadow-md"> 
                            <ul>
                                @foreach ($categorys as $category)
                                    <li class="hover:bg-gray-100 cursor-pointer  px-24 py-1 text-sm" onclick="category_button()">{{ $category->cat_name }}</li>
                                @endforeach
                            </ul>    
                        </div>
                        <script>
                            function toggleOptions() {
                                var options = document.getElementById("options");
                                options.classList.toggle("hidden");
                            }
                        </script>
                    </div>
                    {{-- drop down --}}
            </div>  
            <textarea name="body" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm @error('body') border border-red-700 @enderror"> {{ old('body') }} </textarea>
            <x-primary-button class="mt-4 float-right"> {{ __('완료') }} </x-primary-button>
    </form>
</x-app-layout>




