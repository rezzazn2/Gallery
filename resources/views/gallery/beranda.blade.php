
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
                    <div class="list-aksi">
                        <span class="lapor" id="lapor" data-idfoto="{{ $foto->id }}">
                            <i class="fa-solid fa-exclamation"></i>
                        </span>
                        @if($foto->albums->contains('userId', auth()->id()))
                            <span class="simpan" id="simpan">
                                <i class="fa-solid fa-bookmark"></i>
                                <!-- <i class="fa-solid fa-bookmark"></i> -->
                            </span>
                        @else

                            <span class="simpan" id="simpan">
                                <i class="fa-regular fa-bookmark"></i>
                                <!-- <i class="fa-solid fa-bookmark"></i> -->
                            </span>
                        @endif

                        @if ($foto->likes->contains('user_id', auth()->id()))
                            <span class="like" id="like" data-idfoto="{{ $foto->id }}">
                                <i class="fa-solid fa-heart"></i>
                                <!-- <i class="fa-solid fa-bookmark"></i> -->
                            </span>
                        @else

                            <span class="like" id="like" data-idfoto="{{ $foto->id }}">
                                <i class="fa-regular fa-heart"></i>
                                <!-- <i class="fa-solid fa-bookmark"></i> -->
                            </span>

                        @endif
                    </div>
                @if ($userlogin->role == "admin")
                    <div class="aksi-admin">
                        <span class="hapus" id="hapus" data-idfoto="{{ $foto->id }}">
                            <i class="fa-regular fa-trash-can"></i>
                        </span>
                    </div>

                @endif
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

        <div class="modal-simpan" id="modal-simpan">

        </div>

        <div class="menu-buat-album">
            <i class="fa-solid fa-xmark exit-2"></i>

            <form action="buat-album" method="post">
                @csrf
                <label for="namaAlbum">Nama Album</label>
                <input type="text" name="namaAlbum" class="normal-input" required>
                <label for="deskripsi">Deksripsi Album</label>
                <textarea name="deskripsi" id="" cols="40" rows="10" class="normal-input" style="resize: none;" required></textarea>
                <button class="button">Buat Album</button>
            </form>
        </div>

        <div class="modal-preview-img" id="modal-preview-img"></div>
        <div class="modal-report" id="modal-report"></div>
        <div class="modal-album" id="modal-album"></div>
        <div class="modal-edit-komentar box-shadow" id="modal-edit-komentar"></div>
</div>



@endsection
