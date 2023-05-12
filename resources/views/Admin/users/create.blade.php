@extends('Admin.Layouts.dashboard')
@section('title', 'Create User')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('Admin.users._form')
    </form>

@endsection
