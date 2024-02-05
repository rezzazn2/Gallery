<div class="container-preview" id="fotoContainer">
    <div class="box">
        <img src="{{ asset('storage/foto/'. $modalFoto->first()->jalurFoto) }}">
    </div>
</div>
<div class="preview-kanan">
<div class="atas">
    <i class="fa-solid fa-arrow-left close" id="close" style="margin-left: 13px;"></i>
    <div class="dropdown dropdown-active">
        <div class="select" id="select" data-idalbum="">
            <span class="selected" id="selected">Pilih Album Anda</span>
            <div class="caret"></div>
        </div>
        <ul class="menu">

        </ul>
    </div>
</div>
<p class="judul-foto">{{ $modalFoto->first()->judulFoto }}</p>
<p class="deskripsi-foto">{{ $modalFoto->first()->deskripsiFoto }}</p>
<div class="container-komentar">
        <input type="text" class="input-komentar" placeholder="Tambahkan komentar">
</div>
</div>
