@extends('Admin.Layouts.dashboard')

@section('title', 'Starter page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a>Starter page</a></li>
@endsection


@section('content')
    <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Dashboard</h5>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
