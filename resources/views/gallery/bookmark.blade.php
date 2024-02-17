@extends('gallery.template.template')

@section('content')
    <div class="container-simpan">
        <div class="header-simpan">
            <p>koleksi-koleksi foto yang telah anda simpan <i class="fa-solid fa-bookmark"></i></p>
            <a class="button button-buat-album">tambah <i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="content-simpan">
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
                    <div class="aksi-album">
                        <a href="hapus-album?idAlbum={{ $album->id }}" onclick="hapus('album')" class="button">hapus</a>
                        <a   class="button" id="edit-album" data-idalbum="{{ $album->id }}">edit</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="container-modal" id="container-modal" >

        <div class="modal-simpan" id="modal-simpan">

        </div>

        <div class="menu-buat-album" >
            <i class="fa-solid fa-xmark exit-2"></i>

            <form action="buat-album" method="post">
                @csrf
                <label for="namaAlbum">Nama Album</label>
                <input type="text" name="namaAlbum" class="normal-input" required>
                <label for="deskripsi">Deksripsi Album</label>
                <textarea name="deskripsi" id="" cols="40" rows="10" class="normal-input" style="resize: none;" required></textarea>
                <button class="button" >Buat Album</button>
            </form>
        </div>

        <div class="modal-album" id="modal-album">

        </div>

        <div class="modal-preview-img" id="modal-preview-img">

        </div>

        <div class="modal-edit-album" id="modal-edit-album">

        </div>



    </div>

    <script>

        $(document).ready(function(){
            $(document).on('click', '#modal-album-trigger', function(){
                $.ajax({
                    url: '{{ route("modal-album") }}',
                    type: 'GET',
                    data:{
                        'idAlbum' : $(this).data('idalbum')
                    },
                    success: function (response){
                        $('#modal-album').html(response);
                        $('#modal-album').css('display', 'flex');
                        modalMuncul()
                        updateModal(true)
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            })
            $(document).on('click','#modal-album-exit', function(){
                $('#container-modal').fadeOut();
                console.log(modal);
                    if(modal > 1){
                        $('.modal-album').fadeOut();
                        $('.modal-album').empty();
                        updateModal(false)

                    }else{
                        modalOut()
                        $('.modal-album').fadeOut();
                        $('.modal-album').empty();
                        updateModal(false)
                    }
            })

            $(document).on('click', '#edit-album', function(){

                $.ajax({
                    url: '{{ route("modal-edit-album") }}',
                    type: 'GET',
                    data:{
                        'idAlbum' : $(this).data('idalbum')
                    },
                    success: function(response){
                        $('#modal-edit-album').html(response)
                        $('#modal-edit-album').css('display', 'block')
                        modalMuncul()
                        updateModal(true)
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })

            })



        })
    </script>

@endsection
