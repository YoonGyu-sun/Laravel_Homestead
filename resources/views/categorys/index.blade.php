<x-app-layout>
    <div class="px-60 py-6">
        <div class="text-lg">
            카테고리 관리
        </div>
    {{-- 여기는 select로 @foreach 불러오기 --}}
        <div class="pl-6 pt-4">
            <div class="border border-black h-auto h=3/4 w-3/5 p-1 px-2 bg-slate-200">
                <ul>
                    @foreach ($categorys as $category)
                        @if($category->user->is(auth()->user()))
                            <div class="border border-gray-500 p-2 flex items-center justify-between my-1 bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <li class="pt-1 my-1 ml-2">
                                @if(strlen($category->cat_name) > 50)
                                    {{ mb_substr($category->cat_name, 0,30) }} ···
                                @else
                                    {{ $category->cat_name }}
                                @endif&nbsp;&nbsp;<small>{{ __('count 수') }}</small></li>
                                <button id="modal-open-btn-update" type="button" class="text-sm ml-auto mr-2 border border-gray-400 py-1 px-2 rounded hover:bg-gray-200" data-cat-id="{{ $category->id }}" data-cat-name="{{ $category->cat_name }}">수정</button>
                                
                                <form action="{{ route('categorys.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="text-sm ml-1 mr-2 border border-gray-400 py-1 px-2 rounded hover:bg-gray-200" onclick="return confirm('삭제하시겠습니까?')" window.location.href = '{{ route('categorys.destroy', $category) }}'>{{ __('삭제') }}</button>
                                </form>
                            </div>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{-- 여기는 select로 @foreach 불러오기 --}}

    <br><br><br><br><br><br>


    {{-- 모달 추가 버튼 --}}
        <div>
            <button id="modal-open-btn" class="flex items-center space-x-1 pl-5 absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <span class="font-semibold">카테고리 추가</span>
            </button>  
        </div>
    {{-- 모달 추가 버튼 --}}

        <br><br><br><br><br><br>

    {{-- 추가 모달 페이지 --}}
        <div class="modal-wrapper hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
            <div class="modal-body bg-white w-500 h-500">
                <div class="modal-head flex items-center ">
                    <h3 class="mb-2 pt-2 px-3">카테리고 추가.</h3>

                    <button id="modal-close-btn1" class="ml-auto pr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>


                {{-- 모달에서는 @error() @enderror 구문을 받아들이지 못한다 이 해결방법은? --}}
                <div class="modal-content bg-gray-100 py-10 px-6">
                    <form method="POST" action="{{ route('categorys.store') }}">
                        @csrf
                        <div>
                            <label>카테고리 :</label>
                            <input type="text" name="cat_name" id="cat_name" placeholder="{{ __('카테고리란') }}" class="border border-gray-300 rounded-lg px-4 py-2 mb-2 @error('cat_name') border border-red-700 @enderror" required value="{{ old('cat_name') ? old('cat_name'):'' }}">

                        </div>
                        <div class="flex justify-end space-x-4">
                            <input type="submit" class="hover:cursor-pointer w-12 h-8 rounded-lg border border-gray-300 bg-gray-200 hover:bg-gray-300" value="저장">
                            <button id="modal-close-btn2" class="w-12 h-8 rounded-lg border border-gray-300 bg-gray-200 hover:bg-gray-300">닫기</button>
                        </div>
                    </form>    
                </div>
            </div>        
        </div>
    {{-- 추가 모달 페이지 --}}


    
    {{-- 수정 모달 페이지 --}}
    <div class="modal-wrapper-update hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
        <div class="modal-body bg-white w-500 h-500">
            <div class="modal-head flex items-center ">
                <h3 class="mb-2 pt-2 px-3">카테리고 변경.</h3>
            
                <button id="modal-close-btn1-update" class="ml-auto pr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        
        
            {{-- 모달에서는 @error() @enderror 구문을 받아들이지 못한다 이 해결방법은? --}}
            <div class="modal-content bg-gray-100 py-10 px-6">
                <form method="POST" action="{{ route('categorys.store') }}">
                    @csrf
                    <div>
                        <label>카테고리 :</label>
                        <input type="text" name="cat_name" id="cat_name" placeholder="{{ __('카테고리 변경') }}" class="border border-gray-300 rounded-lg px-4 py-2 mb-2 @error('cat_name') border border-red-700 @enderror" required value="{{ old('cat_name') ? old('cat_name'):'' }}">
                    
                    </div>
                    <div class="flex justify-end space-x-4">
                        <input type="submit" class="hover:cursor-pointer w-12 h-8 rounded-lg border border-gray-300 bg-gray-200 hover:bg-gray-300" value="저장">
                        <button id="modal-close-btn2-update" class="w-12 h-8 rounded-lg border border-gray-300 bg-gray-200 hover:bg-gray-300">닫기</button>
                    </div>
                </form>    
            </div>
        </div>        
    </div>
    {{-- 수정 모달 페이지 --}}
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // 모달 카테고리 추가 (popup 창)
            const modalOpenBtn = document.getElementById("modal-open-btn");
            const modalCloseBtn1 = document.getElementById("modal-close-btn1");
            const modalCloseBtn2 = document.getElementById("modal-close-btn2");
            const modalWrapper = document.querySelector(".modal-wrapper");

            console.log(modalWrapper.style);

            modalOpenBtn.addEventListener("click", () => {
                modalWrapper.classList.remove("hidden");
            });

            modalCloseBtn1.addEventListener("click", () => {
                modalWrapper.classList.add("hidden");
            });

            modalCloseBtn2.addEventListener("click", () => {
                modalWrapper.classList.add("hidden");
            });




             // 모달 카테고리 수정 (popup 창)
            const modalOpenBtn_update = document.getElementById("modal-open-btn-update");
            const modalCloseBtn1_update = document.getElementById("modal-close-btn1-update");
            const modalCloseBtn2_update = document.getElementById("modal-close-btn2-update");
            const modalWrapper_update = document.querySelector(".modal-wrapper-update");

            console.log(modalWrapper_update.style);

            modalOpenBtn_update.addEventListener("click", () => {
                modalWrapper_update.classList.remove("hidden");
            });

            modalCloseBtn1_update.addEventListener("click", () => {
                modalWrapper_update.classList.add("hidden");
            });

            modalCloseBtn2_update.addEventListener("click", () => {
                modalWrapper_update.classList.add("hidden");
            });



        </script>
</x-app-layout>