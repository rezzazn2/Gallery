{{-- <i class="fa-solid fa-xmark exit"></i>

<div class="dropdown dropdown-active">

    <div class="select" id="select" data-idalbum="">
        <span class="selected" id="selected">
            @if(count($marked) > 0)
                {{ $marked->first()->namaAlbum }}
            @else
                kosong
            @endif
        </span>
        <div class="caret"></div>
    </div>
    <ul class="menu">
        @if (count($albums) > 0)
            @foreach ($albums as $album)
            @php
                $isActive = $marked->contains('id', $album->id);
            @endphp
            <li id="list-album" class="{{ $isActive ? 'active' : '' }}" data-idAlbum="{{ $album->id }}">{{ $album->namaAlbum }}</li>
         @endforeach

        @else
            <li class="active">Tidak mempunyai Album</li>
        @endif

    </ul>
</div> --}}

<div class="modal-simpan-album">
    <div class="header-simpan-album">
        <p>Album-album yang telah anda buat <i class="fa-solid fa-bookmark"></i></p>
        <i class="fa-solid fa-xmark exit"></i>
    </div>
    <ul class="content-simpan-album">
        @foreach ($albums as $album)
            <li class="list-album">
                <div class="kiri">

                    <div class="gambar">
                        <img src="{{ asset('storage/foto/'. $album->fotos->first()->jalurFoto) }}" alt="">
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
    </ul>
    <span class="button button-buat-album" >Buat Album</span>
</div>

{{-- <div class="buttons-modal-simpan">
    <span class="button button-buat-album" >Buat Album</span>
    <span class="button button-simpan" id="button-simpan" data-idfoto="{{ $idfoto }}">Simpan</span>
</div> --}}
