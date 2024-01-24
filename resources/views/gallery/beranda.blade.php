{{-- {{ dd($foto) }} --}}
@extends('gallery.template.template')

@section('content')
    <div class="container">
        @foreach ( $fotos as $foto)
            <div class="box">
                <img src="{{ asset('storage/foto/'. $foto->jalurFoto) }}" alt="">
                <span class="simpan">
                    <i class="fa-regular fa-bookmark"></i>
                    <!-- <i class="fa-solid fa-bookmark"></i> -->
                </span>
            </div>
        @endforeach

        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/2.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/3.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/4.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/5.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/6.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/7.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/8.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/9.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/10.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/11.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/12.jpeg" alt="">
        </div>
    </div>
@endsection
