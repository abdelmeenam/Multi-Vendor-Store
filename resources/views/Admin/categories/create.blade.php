@extends('Admin.Layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <form action="{{ route('Admin.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('Admin.categories._form')
    </form>

@endsection
