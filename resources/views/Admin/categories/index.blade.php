@extends('Admin.Layouts.dashboard')

@section('title' , 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a>Ctaegories</a></li>
@endsection


@section('content')
    <div class="mb-5">
        <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent Category</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2">Operation</th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                <td>{{ $category->parent_id }}</td>

                <td>{{ $category->status }}</td>
                <td>{{ $category->created_at }}</td>

                <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            <!-- Form Method Spoofing -->
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No categories defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>


@endsection
