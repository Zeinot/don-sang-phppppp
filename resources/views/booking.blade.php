@extends("layouts.basic")
@section("body")
    <style>
        .fi-ta-content
    </style>
    <div class="flex justify-center">
        <main class="my-24 md:mx-10 mx-5 lg:w-1/2 w-full">
            <div class="flex justify-center">
                <div
                    class="rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4 xl:w-3/4 lg:4/5 w-full"
                >
                    <livewire:booking-form :$post_id/>
                </div>
            </div>
        </main>
    </div>
@endsection
