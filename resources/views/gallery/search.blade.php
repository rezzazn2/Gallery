@foreach ( $fotos as $foto)
            <div class="box">
                <img src="{{ asset('storage/foto/'. $foto->jalurFoto) }}" class="foto" id="foto" alt="" data-id="{{ $foto->id }}" data-idalbum="{{ $foto->albumId }}">
                <span class="simpan" id="simpan">
                    <i class="fa-regular fa-bookmark"></i>
                    <!-- <i class="fa-solid fa-bookmark"></i> -->
                </span>
            </div>
        @endforeach
