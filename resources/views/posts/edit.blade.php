@extends('layouts.app')

@section('title')
    Editar publicación
@endsection

@push('styles')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container sec-indexpost">
        <div class="col-12 col-md-8 mx-auto">
            <h1 class="text-4 text-center m-5 text-secondary">Edita tu publicación</h1>

            <form action="{{ route('post.update', $post->id) }}" method="POST" id="form-create">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Título de la publicación -->
                    <div class="col-md-8 col-12 mb-3">
                        <label for="title" class="form-label fw-bold">Título</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}"
                            required>
                    </div>
                    <!-- Categoría de la publicación -->
                    <div class="col-md-4 col-12 mb-3">
                        <label for="category_id" class="form-label fw-bold">Categoría</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Contenido de la publicación -->
                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Contenido</label>
                    <textarea class="form-control" id="content" name="content" required>{{ $post->content }}</textarea>
                </div>

                <div>
                    <input type="hidden" id="inputImage" name="image" value="{{ $post->image }}">
                </div>
            </form>

            <!-- Dropzone para subir imágenes -->
            <div class="d-flex justify-content-center">
                <div class="card mt-3" style="width: 100%; max-width: 300px; height: 250px; border: none;">
                    <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                        class="dropzone w-100 h-100 d-flex justify-content-center align-items-center"
                        style="border: 2px dashed #cccccc; background-color: #f9f9f9;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Botón para publicar -->
            <div class="d-flex justify-content-center mt-3 mb-5">
                <button type="submit" style="padding: 0.6rem 5rem;" class="btn btn-primary"
                    id="submit-create">Publicar</button>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
