@extends('Admin.Layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('Admin.products._form' ,['button_label' => 'Create'])

    </form>

@endsection
