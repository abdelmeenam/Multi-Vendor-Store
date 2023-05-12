@extends('Admin.Layouts.dashboard')
@section('title', 'Create Role')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admins</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.admins.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('Admin.admins._form')
    </form>

@endsection
