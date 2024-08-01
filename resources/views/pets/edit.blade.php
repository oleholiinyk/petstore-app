@extends('layouts.layout')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Edit Pet</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('pets.index') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>

            <form action="{{ route('pets.update', $pet['id']) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="inputName" class="form-label"><strong>Name:</strong></label>
                    <input
                        type="text"
                        name="name"
                        value="{{ $pet['name'] }}"
                        class="form-control @error('name') is-invalid @enderror"
                        id="inputName"
                        placeholder="Name">
                    @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="selectStatus" class="form-label"><strong>Status:</strong></label>
                    <select
                        name="status"
                        class="form-control @error('status') is-invalid @enderror"
                        id="selectStatus">
                        @foreach(App\Enums\PetStatus::cases() as $status)
                            <option
                                value="{{ $status->value }}" {{ $status->value == $pet['status'] ? 'selected' : '' }}>
                                {{ ucfirst($status->value) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update
                </button>
            </form>

        </div>
    </div>
@endsection
