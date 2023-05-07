@extends('Admin.Layouts.dashboard')
@section('title', 'Create Role')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.roles.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('Admin.roles._form')
    </form>

@endsection
