@extends("layouts.basic")
@section("body")
{{--  view single post page {{$post_id}}--}}
<div class="m-20">

    <livewire:view-post :$post_id/>

</div>
@endsection
