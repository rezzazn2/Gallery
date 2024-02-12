<i class="fa-solid fa-xmark exit"></i>

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
</div>

<div class="buttons-modal-simpan">
    <span class="button button-buat-album" >Buat Album</span>
    <span class="button button-simpan" id="button-simpan" data-idfoto="{{ $idfoto }}">Simpan</span>
</div>
