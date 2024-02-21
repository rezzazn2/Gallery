@if ($button)
    <button class="button" id="simpan-album-button" data-idalbum="{{ $idAlbum }}" data-idfoto="{{ $idfoto }}">simpan</button>
@else
    <button class="button button-active" id="buang-album-button" data-idalbum="{{ $idAlbum }}" data-idfoto="{{ $idfoto }}">Buang</button>
@endif
