@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@push('scripts')
    <script>
        console.log('Push lần 2');
    </script>
@endpush
@section('sidebar')
    @parent
    <h3>Product sidebar</h3>
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{session('msg')}}
        </div>
    @endif
    <h1>SẢN PHẨM</h1>
    <button type="button" class="show">Show</button>
@endsection
@section('css')
<style>
    header{
        background: yellow;
        color: black;
    }
</style>
@endsection
@prepend('scripts')
    <script>
        console.log('Push lần 1');
    </script>
@endprepend
