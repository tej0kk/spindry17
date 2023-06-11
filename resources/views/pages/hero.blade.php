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
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Subitle</th>
                                    <th>Background</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach ($heroes as $hero)
                                        <tr>
                                            <td>{{ $hero->id }}</td>
                                            <td>{{ $hero->title }}</td>
                                            <td>{{ $hero->subtitle }}</td>
                                            <td>{{ $hero->background }}</td>
                                            <td>{{ $hero->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
