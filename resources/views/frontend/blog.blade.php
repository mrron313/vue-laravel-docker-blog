@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <router-view></router-view>
</div>
@endsection

<script>
    window.auth_user = {!! json_encode($auth_user); !!};
</script>