@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection
@section('content')
    <h1>TRANG CHỦ</h1>

    @if (session('msg'))
            <div class="alert alert-danger">
                {{session('msg')}}
            </div>
    @endif

    @datetime("2024-2-27 10:00:00")
    
    @include('clients.contents.slide')
    @include('clients.contents.about')

    @env('locala')
        <p>Môi trường dev</p>
    @elseenv('local')
        <p>Môi trường local</p>
    @endenv
    {{-- <x-package-alert/> --}}
    <x-alert type="success" :content="$message" data-icon="facebook"/>
    {{-- <x-Inputs.button/>
    <x-forms.button/> --}}
    {{-- <p><img src="https://images2.thanhnien.vn/zoom/896_560/528068263637045248/2024/3/1/cong-nhan-lao-dong4-17033239231031699643677-0-0-586-937-crop-17092921431182124972997.jpg" alt=""></p> --}}
    <p><a href="{{route('download-image').'?image='.public_path('storage/zennetsu.jpg')}}" class="btn btn-primary">Download ảnh</a></p>
@endsection
@section('css')
    <style>
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection
@section('js')

@endsection









{{-- <h1>Trang chủ Unicode</h1>
<h2>{{!empty(request()->keyword)?request()->keyword:'Không có gì'}}</h2>
<div class="container">
    {!! !empty($content)?$content:false !!}
</div> --}}

{{-- @for ($i=1; $i<=10; $i++)
    <p>Phần tử thứ : {{$i}}</p>
@endfor

@while ($index<=10)
    <p>Phần tử thứ : {{$index}}</p>
    @php
       $index++;
    @endphp
@endwhile

@foreach ($dataArr as $key => $item)
    <p>Phần tử : {{$item}} - {{$key}}</p>
@endforeach

@forelse ($dataArr as $item)
    <p>Phần tử: {{$item}}</p>    
@empty
    <p>Không có phần tử nào</p>
@endforelse

@if ($number>=10)
    <p>Đây là giá trị hợp lệ</p>
    @else
    <p>Giá trị không hợp lệ</p>
@endif

@if ($number < 0)
    <p>Số âm</p>
@elseif ($number > 0 && $number < 5)
    <p>Số siêu nhỏ</p>
@elseif ($number > 5 && $number < 10)
    <p>Số trung bình</p>
@else
    <p>Số lớn</p>
@endif

@switch ($number)
    @case(1)
        <p>Số thứ nhất</p>
        @break
    @case(2)
        <p>Số thứ hai</p>
        @break
    @default
        <p>Số còn lại</p>
@endswitch

@for ($i = 1; $i <=10; $i++)
    @if ($i==5)
        @continue
    @endif
    <p>Phần tử thứ : {{$i}}</p>
@endfor

@php
    $number = 10;
    $total = $number + 20;
@endphp
<h3>Kết quả: {{$number}} - {{$total}}</h3> --}}
{{-- @verbatim
<script>
    Hello, @{{name}}
</script>
@endverbatim

@php
    $message = 'Đặt hàng thành công';
@endphp
@include('parts.notice') --}}
