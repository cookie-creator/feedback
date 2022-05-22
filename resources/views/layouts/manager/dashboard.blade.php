<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @foreach($feedbacks as $feedback)
                        <div class="p-4 border-b border-gray-200">
                            @if ($feedback->answered == 0)
                                @csrf
                            @endif

                            <div class="mt-1 mb-2">{{ $feedback->name }} / {{ $feedback->email }} / <span class="text-gray-600">{{ \Carbon\Carbon::parse($feedback->created_at)->diffForHumans() }}</span></div>

                            <div class="mb-2 text-sm text-gray-600">
                                {{ $feedback->subject }}
                            </div>
                            <div class="mb-2 text-sm text-gray-600">
                                {{ $feedback->feedback }}
                            </div>

                            @if($feedback->file)
                                <p class="text-sm">Attached file: <a class="text-indigo-500 hover:text-indigo-600" target="_blank" href="{{ config('app.url') . 'storage/files/' . $feedback->file }}">{{ $feedback->file }}</a></p>
                            @endif

                            @if ($feedback->answered == 0)
                                <div class="flex justify-between items-center mt-3">
                                    <a href="{{ route('manager.feedback.edit', ['feedback' => $feedback->id]) }}" type="submit" class="inline-flex justify-end py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Answer</a>
                                </div>
                            @else
                                <div class="flex justify-between items-center mt-3">
                                    Answered
                                </div>
                            @endif

                            @if ($feedback->answered == 0)

                            @endif
                        </div>
                    @endforeach

                    {{ $feedbacks->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
