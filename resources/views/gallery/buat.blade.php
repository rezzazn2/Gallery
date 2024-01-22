@extends('gallery.template.template')

@section('content')

    <div class="container-buat">
        <h1 class="judul-buat">
            Kirim gambar ke Gallery mu!
        </h1>

            <form action="" class="buat">
                <div class="buat-kiri">
                    <input type="file" name="jalurFoto" id="jalurFoto">
                    <label for="jalurFoto">Masukan Foto</label>
                </div>
                <div class="buat-kanan">
                    <label for="judulFoto">Judul Foto</label>
                    <input type="text" name="judulFoto" class="normal-input">
                    <label for="judulFoto">Deksripsi Foto</label>
                    <textarea name="deskripsiFoto" id="" cols="40" rows="10" class="normal-input" style="resize: none;"></textarea>
                    <button>Buat</button>
                </div>

            </form>


    </div>
@endsection
