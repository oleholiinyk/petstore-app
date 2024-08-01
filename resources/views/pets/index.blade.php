@extends('layouts.layout')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Pets list</h2>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success btn-sm" href="{{ route('pets.create') }}"><i class="fa fa-plus"></i> Create
                    New Pet</a>
            </div>

            <table class="table table-bordered table-striped mt-4">
                <thead>
                <tr>
                    <th width="80px">ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th width="250px">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($pets as $pet)
                    <tr>
                        <td>{{ $pet->id }}</td>
                        <td>{{ $pet->name }}</td>
                        <td>{{ ucfirst($pet->status->value) }}</td>
                        <td>
                            <form action="{{ route('pets.delete',$pet->id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('pets.show',$pet->id) }}"><i
                                        class="fa-solid fa-list"></i> Show</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('pets.edit',$pet->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">There are no data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
