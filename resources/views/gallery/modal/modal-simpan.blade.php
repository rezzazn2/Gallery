

<div class="modal-simpan-album">
    <div class="header-simpan-album">
        <p>Album-album yang telah anda buat <i class="fa-solid fa-bookmark"></i></p>
        <i class="fa-solid fa-xmark exit"></i>
    </div>
    <ul class="content-simpan-album">
        @if ($albums->count() < 1)
            <li class="list-album">
                <p>kosong</p>
            </li>
        @else
            @foreach ($albums as $album)
                <li class="list-album">
                    <div class="kiri">

                        <div class="gambar">
                            @if ($album->fotos->count() > 0)
                            <img src="{{ asset('storage/foto/'. $album->fotos->first()->jalurFoto) }}" alt="">
                            @else
                            <img src="{{ asset('gallery-c/img/empty.jpg')}}" alt="">
                            @endif
                        </div>
                        <div class="data-album">
                            <p class="nama">{{ $album->namaAlbum }}</p>
                            <p class="deskripsi">{{ $album->deskripsi }}</p>
                        </div>
                    </div>
                    @php
                        $isActive = $marked->contains('id', $album->id);
                    @endphp
                    <div id="aksilah">
                        @if ($isActive)
                            <button class="button button-active" id="buang-album-button" data-idalbum="{{ $album->id }}" data-idfoto="{{ $idfoto }}">Buang</button>
                        @else
                            <button class="button" id="simpan-album-button" data-idalbum="{{ $album->id }}" data-idfoto="{{ $idfoto }}">simpan</button>
                        @endif
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="button button-buat-album" >Buat Album</span>
</div>

