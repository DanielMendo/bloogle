@extends('layouts.app')

@section('content')
<section class="d-flex align-items-center text-center" id="hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-uppercase text-white fs-5 mb-0">Hola gente bienvenidos a</p>
                <h2 class="text-uppercase text-white mt-0 mb-4" style="font-size: 5.2rem">B l o g o o l</h2>
                <p class="text-uppercase text-white fs-4">Explora, comparte y descubre temas interesantes</p>
            </div>
        </div>
    </div>
</section>

<section style="margin: 8rem;">
    <div class="col-8 mx-auto">
        <h3 class="fs-5 fw-normal text-center mb-5">Explora los posts por las siguients categorias:</h3>
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="#" class="text-decoration-none text-black"><h5 class="text-center mb-0 pb-5 pt-5"> {{$category->name}} </h5></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> 

<section class="m-5">
    <div class="col-9 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0 h-50">
                        <a href="#" class="text-decoration-none text-black">
                            <img src="{{ asset('img/posts/1.webp') }}" alt="Descripción de la imagen" class="w-100">
                            <div style="padding: 3rem!important;">
                                <p class="mt-3 mb-4"><span class="fw-bold">Autor: </span>Jesús Daniel Hernández Mendoza</p>
                                <h4 class="mb-3">Éxitos de Siddharta</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil accusantium quam laborum impedit explicabo? Tenetur at illo, corrupti esse expedita reiciendis dolores mollitia eius consequuntur vel inventore molestiae asperiores voluptatem.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection