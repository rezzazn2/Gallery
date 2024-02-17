<div class="container-preview" id="fotoContainer">
    <div class="box">
        <img src="{{ asset('storage/foto/'. $modalFoto->first()->jalurFoto) }}">
    </div>
</div>
<div class="preview-kanan">
<div class="atas">
    <i class="fa-solid fa-arrow-left close" id="close" style="margin-left: 13px;"></i>
    <div class="list-aksi nyala">
        @if ($modalFoto->first()->likes->contains('user_id', auth()->id()))
            <span class="simpan" id="simpan" data-idfoto="{{ $modalFoto->first()->id }}">
                <i class="fa-regular fa-bookmark"></i>
                <!-- <i class="fa-solid fa-bookmark"></i> -->
            </span>
            <span class="like" id="like" data-idfoto="{{ $modalFoto->first()->id }}">
                <i class="fa-solid fa-heart"></i>
                <!-- <i class="fa-solid fa-bookmark"></i> -->
            </span>
        @else
            <span class="simpan" id="simpan" data-idfoto="{{ $modalFoto->first()->id }}">
                <i class="fa-regular fa-bookmark"></i>
                <!-- <i class="fa-solid fa-bookmark"></i> -->
            </span>
            <span class="like" id="like" data-idfoto="{{ $modalFoto->first()->id }}">
                <i class="fa-regular fa-heart"></i>
                <!-- <i class="fa-solid fa-bookmark"></i> -->
            </span>

        @endif
    </div>
</div>
<p class="pembuat-foto">{{ $modalFoto->first()->user->username }}</p>
<p class="judul-foto">{{ $modalFoto->first()->judulFoto }}</p>
<p class="deskripsi-foto">{{ $modalFoto->first()->deskripsiFoto }}</p>
<div class="container-komentar">
    <div class="container-input">
        <input type="text" class="input-komentar" placeholder="Tambahkan komentar">
        <button class="button btn-komentar" id="tambahKomentar" data-idFoto="{{ $idFoto }}">Kirim</button>
    </div>
    <div class="komentar-list">
        <ul>
            @foreach ( $komentars as $komentar)

            <li class="komen">
                <span class="komen-username">{{ $komentar->user->username }}</span>
                <p class="komen-isi">{{ $komentar->isiKomentar }}</p>
            </li>

            @endforeach
        </ul>
    </div>
</div>
</div>
