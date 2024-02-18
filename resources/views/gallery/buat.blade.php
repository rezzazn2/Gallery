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
                    <label for="judulFoto">Judul Foto
                        @error('judulFoto')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </label>

                    <input type="text" name="judulFoto" class="normal-input" required>
                    <label for="judulFoto">Deksripsi Foto
                        @error('deskripsiFoto')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </label>



                    <textarea name="deskripsiFoto" id="" cols="40" rows="10" class="normal-input" style="resize: none;" required></textarea>
                    <button class="button">Buat</button>
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

    </script>
@endsection
