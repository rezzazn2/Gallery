<i class="fa-solid fa-xmark exit"></i>

<div class="dropdown dropdown-active">
    <div class="select" id="select" data-idalbum="">
        <span class="selected" id="selected">Pilih Album Anda</span>
        <div class="caret"></div>
    </div>
    <ul class="menu">
        @if (count($albums) > 0)
            @foreach ($albums as $album)
                <li id="list-album" class="{{ $album->id ==  $albumId ? 'active' : '' }}" data-idAlbum="{{ $album->id }}">{{ $album->namaAlbum }}</li>
            @endforeach
        @else
            <li class="active">Tidak mempunyai Album</li>
        @endif

    </ul>
</div>

<div class="buttons-modal-simpan">
    <span class="button button-buat-album">Buat Album</span>
    <span class="button button-simpan" id="button-simpan">Simpan</span>
</div>
