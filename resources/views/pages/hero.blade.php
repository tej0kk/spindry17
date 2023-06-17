@extends('app')

@section('title', 'Hero')
@section('page-heading', 'Hero')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="row mb-3">
                <div class="col">
                    <a href="{{ url('/hero/create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="fa-solid fa-circle-check fa-bounce"></i> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row-12 mb-5">
                        <form action="">
                            <div class="col-4 d-flex justify-content-end">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="{{ $q }}" placeholder="Cari...">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Subitle</th>
                                        <th>Background</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($heroes as $hero)
                                            <tr>
                                                <td>{{ $hero->id }}</td>
                                                <td>{{ $hero->title }}</td>
                                                <td>{{ $hero->subtitle }}</td>
                                                <td>{{ $hero->background }}</td>
                                                <td>{{ $hero->status }}</td>
                                                <td>
                                                    <a href="{{ url('/hero/' . $hero->id . '/edit') }}"
                                                        class="btn btn-warning">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                    <form class="d-inline" action="{{ url('/hero/' . $hero->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
