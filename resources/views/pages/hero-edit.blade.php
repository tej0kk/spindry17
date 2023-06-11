@extends('app')

@section('title', 'Edit Hero')
@section('page-heading', 'Edit Hero')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="row-10">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('/hero/'.$hero->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ $hero->title }}">
                                </div>
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                        id="subtitle" name="subtitle" value="{{ $hero->subtitle }}">
                                </div>
                                <div class="mb-3">
                                    <label for="background" class="form-label">Background</label>
                                    <input type="file" class="form-control @error('background') is-invalid @enderror"
                                        id="background" name="background">
                                    <img src="{{ asset('/img/heroes/' . $hero->background) }}" alt="{{ $hero->background }}">
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status"
                                        name="status" @if ($hero->status == 'show') checked @endif>
                                    <label class="form-check-label" for="status">Geser Untuk Menampilkan</label>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
