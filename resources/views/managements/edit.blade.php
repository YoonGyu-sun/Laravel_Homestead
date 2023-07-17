{{-- layout으로 create와 통일시킬 수 있을 거 같은디 --}}

<x-app-layout>
    <form method="POST" action="{{ route('managements.update', $management) }}">
    @csrf
    @method('patch')
    
        <label class="block" for="title">Title이 부분에 카테고리 넣으면될 거 같음</label>
        <div class=" block w-full">
            {{-- title --}}
            <input class="@error('title') border border-red-700 @enderror" type="text" name="title" id="title" value="{{ old('title',$management->title) }}">
            {{-- type --}}
            <input class="@error('type') border border-red-700 @enderror" type="text" name="type" id="type" value="{{ old('type',$management->type) }}">
        </div>        
            <textarea
            name="body"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm @error('body') border border-red-700 @enderror"
        >{{ old('body',$management->body) }}</textarea>
        <x-input-error :messages="$errors->get('body')" class="mt-2" />
            <div class="mt-4 float-right">
                <x-primary-button>{{ __('저장') }}</x-primary-button>
                <a class="text-sm text-gray-900 font-semibold p-4 mr-12 ml-2 " href="{{ route('tasks.index') }}">{{ __('취소') }}</a>
            </div>
    </form>
    
</x-app-layout>