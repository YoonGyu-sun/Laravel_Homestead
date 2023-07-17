<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      {{-- 글 작성 form --}}
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
             <textarea
                name="message"
                placeholder="{{ __('글 작성란') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm @error('message') border border-red-700 @enderror"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('전송') }}</x-primary-button>
        </form>
      {{-- 글 작성 form --}}
      
      <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        {{-- 작성 글 list --}}
            @foreach ($tasks->take(5) as $task)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $task->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $task->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($task->created_at->eq($task->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('수정된 글') }}</small>
                                        
                                    @endunless
                            </div>
                        @if ($task->user->is(auth()->user()))
                            <x-dropdown>
                            <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('tasks.edit', $task)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    {{--  글 list --}}
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('tasks.destroy', $task)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                    {{-- 삭제 글 list --}}
                                </x-slot>
                            </x-dropdown>
                        @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">
                            @if(strlen($task->message) > 18)
                                {{ mb_substr($task->message, 0,18) }}...
                            @else
                                {{ $task->message }}
                            @endif
                        </p>
                    </div>

                
                </div>
            @endforeach
        {{-- 작성 글 list --}}
        </div>

    </div>
</x-app-layout>