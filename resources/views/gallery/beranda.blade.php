
@extends('gallery.template.template')

@section('content')
    <div class="container" id="fotoContainer">
            @foreach ( $fotos as $foto)
                <div class="box">
                    <img src="{{ asset('storage/foto/'. $foto->jalurFoto) }}" class="foto" id="foto" alt="" data-id="{{ $foto->id }}" data-idalbum="{{ $foto->albumId }}">
                    <div class="list-aksi">
                        @if ($foto->likes->contains('user_id', auth()->id()))
                            <span class="simpan" id="simpan">
                                <i class="fa-regular fa-bookmark"></i>
                                <!-- <i class="fa-solid fa-bookmark"></i> -->
                            </span>
                            <span class="like" id="like" data-idfoto="{{ $foto->id }}">
                                <i class="fa-solid fa-heart"></i>
                                <!-- <i class="fa-solid fa-bookmark"></i> -->
                            </span>
                        @else
                            <span class="simpan" id="simpan">
                                <i class="fa-regular fa-bookmark"></i>
                                <!-- <i class="fa-solid fa-bookmark"></i> -->
                            </span>
                            <span class="like" id="like" data-idfoto="{{ $foto->id }}">
                                <i class="fa-regular fa-heart"></i>
                                <!-- <i class="fa-solid fa-bookmark"></i> -->
                            </span>

                        @endif
                    </div>
                </div>
            @endforeach



    </div>
    <div class="container-modal" id="container-modal">

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

        <div class="modal-preview-img" id="modal-preview-img">

        </div>

    </div>

@endsection
