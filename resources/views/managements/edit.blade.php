{{-- layout으로 create와 통일시킬 수 있을 거 같은디 --}}

<x-app-layout>
    <form method="POST" action="{{ route('managements.update', $management) }}">
    @csrf
    @method('patch')
    
        <label class="block" for="title">Title이 부분에 카테고리 넣으면될 거 같음</label>
        <div class=" block w-full">
            <div class="flex items-center">
            {{-- title --}}
            <input class="@error('title') border border-red-700 @enderror" type="text" name="title" id="title" value="{{ old('title',$management->title) }}">
            {{-- type drop down --}}
                        <!-- 변경된 부분 -->
                        <div class="flex items-center ml-10 relative">
                            <select id="categorySelect" onchange="category_button()" name="type">
                                <option value="{{ old('type',$management->type) }}" disabled selected>{{ old('type',$management->type) }}</option>
                                <!-- 선택할 수 있는 옵션 목록을 생성합니다. -->
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->cat_name }}">{{ $category->cat_name }}</option>
                                @endforeach
                            </select>
                            <script>
                                function category_button() {
                                    // 선택된 값을 가져오는 방식은 이전과 동일하게 구현합니다.
                                    var selectedCategory = document.getElementById('categorySelect').value;
                                    // 이후에 선택된 값을 사용하여 필요한 작업을 수행하면 됩니다.
                                    // 예: 선택된 값으로 폼 제출 또는 다른 동작 수행 등
                                    console.log(selectedCategory);
                                }
                            </script>
                        </div>        
                    </div>
                    {{-- drop down --}}

        </div>        
            <p><textarea class ="h-1/2"  name="body" id="body">
        {{ strip_tags(old('body',$management->body)) }}</textarea></p>
        {{ csrf_field() }}
        <x-input-error :messages="$errors->get('body')" class="mt-2" />
            <div class="mt-4 float-right">
                <x-primary-button>{{ __('저장') }}</x-primary-button>
                <a class="text-sm text-gray-900 font-semibold p-4 mr-12 ml-2 " href="{{ route('tasks.index') }}">{{ __('취소') }}</a>
            </div>
    </form>
    
<script src={{ asset('ckeditor/ckeditor.js') }}></script>

<script>
    ClassicEditor
            .create( document.querySelector( '#body' ) )
            .catch( error => {
                console.error( error );
            } );
</script>


{{--  --}}
    
</x-app-layout>