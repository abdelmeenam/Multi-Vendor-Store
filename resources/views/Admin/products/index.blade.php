@extends('Admin.Layouts.dashboard')

@section('title' , 'products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a>Ctaegories</a></li>
@endsection


@section('content')
    <div class="mb-5">
        <a href="{{route('dashboard.products.create')}}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
        <a href="{{route('dashboard.products.create')}}" class="btn btn-sm btn-outline-dark mr-2">Trash</a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input label="Name" class="mx-2" name="name" :value="request('name')" />

        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected( request('status') =='active') >Active</option>
            <option value="archived" @selected( request('status') =='archived')>Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>status</th>
            <th>Created At</th>
            <th colspan="2">Operation</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $category)
            <tr>
                <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</a></td>
                <td>{{ $category->category->name }}</td>
                <td>{{ $category->store->name }}</td>
                <td>{{ $category->status }}</td>
                <td>{{ $category->created_at }}</td>

                <td>
                        <a href="{{ route('dashboard.products.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                        <form action="{{ route('dashboard.products.destroy', $category->id) }}" method="post">
                            @csrf
                            <!-- Form Method Spoofing -->
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No products defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
{{$products->withQueryString()->links()}}
@endsection
