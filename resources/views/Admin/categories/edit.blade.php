@extends('Admin.Layouts.dashboard')

@section('title', 'Edit Categorie')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Categorie</li>
@endsection


@section('content')


    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('Admin.categories._form', ['button_label' => 'Update'])
    </form>

@endsection
