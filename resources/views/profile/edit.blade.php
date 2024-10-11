@extends('layouts.app')

@push('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

@endpush

@section('content')
<style>
    .ck-editor__editable_inline {
    height: 100px;
}
</style>
<div class="col-8 mx-auto">
    <h1 class="fs-4 text-center m-5 text-secondary">Actualiza tu información</h1>
    
    <div class="row">
        <div class="col-6">
            <form action=" {{route('profile.update', $user->id)}} " method="POST" id="form-create">
                @csrf 
                @method('PUT')
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label fw-bold">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                    </div>
                </div>
        
                <div class="mb-3">
                    <label for="bio" class="form-label fw-bold">Descripción</label>
                    <textarea class="form-control" id="content" name="bio" required>{{$user->bio}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label fw-bold">Enlace personalizado</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">https://blogool.com/</span>
                    </div>
                    <input type="text" class="form-control" id="slug" name="slug" aria-describedby="basic-addon3" value="{{$user->slug}}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label fw-bold">Facebook</label>
                    <input type="url" class="form-control" id="facebook" name="facebook" value="{{$user->facebook}}">
                </div>
                <div class="mb-3">
                    <label for="twitter" class="form-label fw-bold">Twitter</label>
                    <input type="url" class="form-control" id="twitter" name="twitter" value="{{$user->twitter}}">
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label fw-bold">Instagram</label>
                    <input type="url" class="form-control" id="instagram" name="instagram" value="{{$user->instagram}}">
                </div>
        
                <div>
                    <input type="hidden" id="inputImage" name="profile_picture" value="{{ $user->profile_picture }}">
                </div>
            </form>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-center">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card mt-3" style="width: 250px; height: 250px; border: none;">
                    <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone w-100 h-100 d-flex justify-content-center align-items-center" style="border: 2px dashed #cccccc; background-color: #f9f9f9;">
                        @csrf
                    </form>
                </div>
            </div>
        
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3 mb-5">
        <button type="submit" style="padding: 0.6rem 5rem;" class="btn btn-primary" id="submit-create">Actualizar</button>
    </div>

</div>

@endsection

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#content'),)
        .catch(error => {
            console.error(error);
        });
</script>

@endpush