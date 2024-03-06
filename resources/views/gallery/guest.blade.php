
@extends('gallery.template.template')

@section('content')
<div class="trigger">
    <a  class="button button-edit" id="trigger-foto">Foto-Foto</a>
    <a  class="button" id="trigger-album">Album</a>
</div>
<div class="container-beranda" id="oke">
    <div class="container actived" id="foto-Container">
            @foreach ( $fotos as $foto)
                <div class="box">
                    <img src="{{ asset('storage/foto/'. $foto->jalurFoto) }}" class="foto" id="foto" alt="" data-id="{{ $foto->id }}" data-idalbum="{{ $foto->albumId }}">
                </div>
            @endforeach



    </div>
    <div class="container-simpan-beranda " id="simpanContainer">
        <div class="content-simpan justify-center">
            @foreach ($albums as $album)

            <div class="card">
                <div class="gambar">
                    @if ($album->fotos->count() == 0)
                        <p>kosong</p>
                    @else
                        <img src="{{ asset('storage/foto/'. $album->fotos->first()->jalurFoto) }}" alt="" id="modal-album-trigger" data-idalbum="{{ $album->id }}">
                    @endif

                </div>
                <div class="data-album">
                    <h4>{{ $album->namaAlbum }}
                        <span>{{ $album->fotos->count() }} tersimpan</span>
                    </h4>
                    <div class="aksi-album ">
                        <p class="flex-x">
                            by. {{ $album->user->username}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>


    </div>
</div>
<div class="container-modal" id="container-modal" >
        <div class="modal-preview-img" id="modal-preview-img"></div>
        <div class="modal-album" id="modal-album"></div>
</div>
@endsection
