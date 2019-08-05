@extends('adminlte::page')

@section('title', 'Dashboard - Approve Post')

@section('content_header')
    <h1>Approve Post</h1>
@stop

@section('content')

<div class="card" style="width: 100%">
    <div class="card-body">

        @if(\Session::has('success'))
            <div class="alert alert-success">
                {!! \Session::get('success') !!}
            </div>
        @endif

        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->body }}</p>

        {{--  @if( $post->approved !== 1 )  --}}
            <form action="{{ route('backend.post.approve') }}" method="post">
                @csrf
                {{ method_field('PUT') }}
    
                <input type="hidden" value="{{ $post->id }}" name="post_id">
                <button class="btn btn-primary" type="submit" >Approve</button>
            </form>
        {{--  @endif  --}}

    </div>
</div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop