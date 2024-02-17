<div class="container-modal-album">
    <div class="atas">
        <div class="list">
            <p>Judul Album</p>
            <i class="fa-solid fa-xmark" id="modal-album-exit"></i>
        </div>
        <p>Deskripsi Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, placeat illo minus animi vel laborum tempora vitae dicta voluptatum sed!</p>
    </div>

    <div class="modal-album-content">
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
</div>
