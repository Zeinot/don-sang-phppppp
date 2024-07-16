@extends("layouts.basic")
@section("body")

    <main class="my-24 md:mx-10 mx-5 ">
        <livewire:dev-tools/>
        <section class="lg:flex lg:justify-center">
            <div class="xl:w-3/4 lg:w-4/5 w-full mb-4">
{{--            <div--}}
{{--                class="rounded-lg border-gray-300 dark:border-gray-600 h-96 "--}}
{{--            >--}}
                <livewire:list-posts/>
{{--            </div>--}}
            </div>
        </section>
    </main>
    {{--    <div class="md:m-48">--}}
    {{--        --}}
    {{--    </div>--}}
@endsection
