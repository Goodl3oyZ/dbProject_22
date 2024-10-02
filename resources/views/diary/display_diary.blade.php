<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('My Diary Entries') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($diaryEntries->isEmpty())
                    <p>No diary entries found.</p>
                    @else
                    @foreach ($diaryEntries as $entry)
                    <div class="diary-entry mb-4 p-4 border rounded">
                        <h3 class="text-xl font-bold mb-2">{{ \Carbon\Carbon::parse($entry->date)->format('F j, Y') }}</h3>
                        <p>{{ $entry->content }}</p>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>