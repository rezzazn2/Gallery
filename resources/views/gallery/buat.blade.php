@extends('gallery.template.template')

@section('content')

    <div class="container-buat">
        <h1 class="judul-buat">
            Kirim gambar ke Gallery mu!
        </h1>


            <form action="buat" method="post" class="buat" enctype="multipart/form-data">
                @csrf
                <div class="buat-kiri">
                    {{-- style="background: url(gallery-c/img/1.jpeg); background-size:cover; background-repeat: no-repeat;" --}}
                    <input type="file" name="foto" id="jalurFoto" onchange="previewImage()" placeholder=""  required>
                    <label for="jalurFoto" >Masukan Foto
                        <img  alt="" class="imgPreview">
                    </label>
                    @error('foto')
                        <p class="error">{{ $message }}</p>
                    @enderror

                </div>
                <div class="buat-kanan">
                    <div class="list">
                        <label for="judulFoto">Judul Foto
                            @error('judulFoto')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </label>
                        <input type="text" name="judulFoto" class="normal-input" required>

                    </div>

                    <div class="list">
                        <label for="deskripsi">Deksripsi Foto
                            @error('deskripsiFoto')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </label>
                      <textarea name="deskripsiFoto" id="" cols="40" rows="10" class="normal-input" style="resize: none;" required></textarea>

                    </div>


                    <div class="list relative">
                        <label for="">masukan ke album</label>
                        <a class="button dib w-100 " id="list-album-trigger">Tampilkan album</a>
                        <ul class="listalbum hidden">
                            @if ($albums->count() > 0)
                                @foreach ($albums as $album)
                                <div class="list flex-x">
                                    <li>{{ $album->namaAlbum }} </li><input type="checkbox" name="selectedAlbum[]" style="margin-left: auto" value="{{ $album->id }}">
                                </div>
                                @endforeach
                            @else
                                <li class="deskripsi">kosong</li>
                            @endif
                        </ul>
                    </div>



                    <button class="button button-edit">Buat</button>
                </div>

            </form>


    </div>

    <script>
        // preview Image

    function previewImage(){
        const image = document.querySelector('#jalurFoto')
        const imgPreview = document.querySelector('.imgPreview')

        const oFReader = new FileReader()
        oFReader.readAsDataURL(image.files[0])

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result
        }
    }

    $(document).ready(function () {
        // Add click event to #list-album-trigger
        $("#list-album-trigger").click(function () {
            console.log('oke');
            $("ul.listalbum").toggleClass("hidden");
        });
    });

    </script>
@endsection
