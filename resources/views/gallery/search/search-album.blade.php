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
