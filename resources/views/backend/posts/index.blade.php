@extends('adminlte::page')

@section('title', 'Dashboard - Posts')

@section('content_header')
    <h1>Posts</h1>
@stop

@section('content')
    
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>User</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Publisthed at</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ $post->user->name }}</td>
                <td> @if($post->approved) Approved @else Not Approved @endif </td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>
                    <a href="/dashboard/posts/{{ $post->id }}">View</a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                'ordering': false
            });
        } );
    </script>
@stop