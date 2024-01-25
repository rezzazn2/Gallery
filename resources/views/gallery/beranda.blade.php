{{-- {{ dd($foto) }} --}}
@extends('gallery.template.template')

@section('content')
    <div class="container" id="fotoContainer">
        @foreach ( $fotos as $foto)
            <div class="box">
                <img src="{{ asset('storage/foto/'. $foto->jalurFoto) }}" alt="">
                <span class="simpan">
                    <i class="fa-regular fa-bookmark"></i>
                    <!-- <i class="fa-solid fa-bookmark"></i> -->
                </span>
                <div class="modal-simpan" id="modal-simpan">
                    
                </div>
            </div>
        @endforeach



    </div>
@endsection
