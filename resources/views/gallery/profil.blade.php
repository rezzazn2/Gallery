@extends('gallery.template.template')

@section('content')
    <div class="container-profil">
        <div class="profil">
            <div class="profil-img">
                @if ($dataUser->fotoProfil == 'default.jpg')
                    <img src="gallery-c/img/default.jpg" alt="" >
                @else
                    <img src="{{ asset('storage/foto/'. $dataUser->fotoProfil) }}" alt="" >
                @endif
            </div>
            <p class="username">{{ $dataUser->username }}</p>
            <p class="email">{{ $dataUser->email }}</p>
            <div class="data">
                <div class="list-data">
                    <span>Gambar</span>
                    <p>{{ $jmlFoto }}</p>
                </div>
                <span class="gap">|</span>
                <div class="list-data">
                    <span>Album</span>
                    <p>{{ $jmlAlbum }}</p>
                </div>
                <span class="gap">|</span>

                <div class="list-data">
                    <span>Like</span>
                    <p id="countlike" class="countlike">{{ $jmlLike }}</p>
                </div>
            </div>
            <div class="list-button">
                <a class="button btn-profil" id="edit-user">Edit Profil</a>
                <a class="button btn-profil logout" href="logout" id="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                @if($isAdmin == 'admin')
                    <a class="button btn-profil admin" href="admin" id="admin"><i class="fa-solid fa-user-tie"></i> Admin</a>
                @endif
            </div>

            @error('foto')
                    <p>Error : {{ $message }}</p>
                @enderror
            @error('judulFoto')
                    <p>Error : {{ $message }}</p>
                @enderror
            @error('deskripsiFoto')
                    <p>Error : {{ $message }}</p>
                @enderror

            <i class="fa-solid fa-images icon-img"></i>
        </div>
        <div class="container" id="fotoContainer" style="margin-top: {{ $judul === 'profil' ? '20px' : '' }}   ">
                @foreach ( $fotoUser as $foto)
                    <div class="box">
                        <img src="{{ asset('storage/foto/'. $foto->jalurFoto) }}" class="foto" id="foto" alt="" data-id="{{ $foto->id }}" data-idalbum="{{ $foto->albumId }}">
                        <div class="list-aksi">
                            @if ($foto->likes->contains('user_id', auth()->id()))
                            <span class="edit" id="edit">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </span>
                            <div class="list-edit" id="list-edit">
                                <ul>
                                    <li id="edit-foto" data-idFoto="{{ $foto->id }}" >Edit <i class="fa-solid fa-pen-to-square"></i></li>
                                    <li id="hapus" data-idfoto="{{ $foto->id }}">Hapus <i class="fa-solid fa-trash" ></i></li>
                                </ul>
                            </div>

                                <span class="simpan" id="simpan">
                                    <i class="fa-regular fa-bookmark"></i>
                                    <!-- <i class="fa-solid fa-bookmark"></i> -->
                                </span>
                                <span class="like" id="like" data-idfoto="{{ $foto->id }}">
                                    <i class="fa-solid fa-heart"></i>
                                    <!-- <i class="fa-solid fa-bookmark"></i> -->
                                </span>
                            @else
                            <span class="edit" id="edit">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </span>
                            <div class="list-edit" id="list-edit">
                                <ul>
                                    <li id="edit-foto" data-idFoto="{{ $foto->id }}" >Edit <i class="fa-solid fa-pen-to-square"></i></li>
                                    <li id="hapus" data-idfoto="{{ $foto->id }}">Hapus <i class="fa-solid fa-trash" ></i></li>
                                </ul>
                            </div>
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
        <div class="container-modal" id="container-modal">

            <div class="modal-simpan" id="modal-simpan">

            </div>

            <div class="menu-buat-album">
                <i class="fa-solid fa-xmark exit-2"></i>

                <form action="buat-album" method="post">
                    @csrf
                    <label for="namaAlbum">Nama Album</label>
                    <input type="text" name="namaAlbum" class="normal-input" required>
                    <label for="deskripsi">Deksripsi Album</label>
                    <textarea name="deskripsi" id="" cols="40" rows="10" class="normal-input" style="resize: none;" required></textarea>
                    <button class="button">Buat Album</button>
                </form>
            </div>

            <div class="modal-preview-img" id="modal-preview-img">

            </div>

            <div class="modal-edit-data-user" id="modal-edit-user" >
                <div class="container-edit-user">
                    <form action="edit-user" method="POST" class="edit-user" id="editUserForm" enctype="multipart/form-data">
                        <i class="fa-solid fa-xmark exit"></i>
                        @csrf
                        <div class="foto-profil">
                            <div class="profil-img">
                                @if ($dataUser->fotoProfil == 'default.jpg')
                                    <img src="gallery-c/img/default.jpg" alt="" id="fotoPreview">
                                @else
                                <img src="{{ asset('storage/foto/'. $dataUser->fotoProfil) }}" alt="" id="fotoPreview">

                                @endif
                            </div>
                            <input type="file" name="fotoProfil" id="fotop" onchange="previewImage()">
                            <label for="fotop" class="button">Ubah Foto </label>
                        </div>
                        <div class="kelompok">
                            <div class="list">
                                <label for="username">Username</label>
                                <input type="text" name="username" value="{{ $dataUser["username"] }}" class="" id="username">
                            </div>
                            <div class="list">
                                <label for="namalengkap">Nama Lengkap</label>
                                <input type="text" name="namaLengkap" value="{{ $dataUser["nama"] }}" class="" id="namalengkap">
                            </div>
                        </div>
                        <div class="list">
                            <label for="alamat">alamat</label>
                            <input type="text" name="alamat" value="{{ $dataUser["alamat"] }}" class="">

                        </div>
                        <div class="list">
                            <label for="email">email</label>
                            <input type="email" name="email" value="{{ $dataUser["email"] }}" class="">

                        </div>
                        <div class="list" style="margin: 10px 0">
                            <span class="button" id="btn-password">tampilkan</span>
                        </div>

                        <div class="edit-password" id="edit-password">
                            <div class="list">
                                <label for="password">password lama</label>
                                <input type="password" name="passwordLama" value="" class="">

                            </div>
                            <div class="list">
                                <label for="password">password baru</label>
                                <input type="password" name="passwordBaru" value="" class="">

                            </div>

                        </div>
                        <button class="button btn-edit">Simpan perubahan</button>
                    </form>
                </div>
            </div>

            <div class="modal-edit-foto" id="modal-edit-foto">

            </div>

        </div>





    </div>

    <script>
        // preview Image

    function previewImage(){
        const image = document.querySelector('#fotop')
        const imgPreview = document.querySelector('#fotoPreview')

        const oFReader = new FileReader()
        oFReader.readAsDataURL(image.files[0])

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result
        }
    }

    $(document).ready(function(){
        $(document).on('click', '#btn-password', function(){
            if($(this).text() == 'tampilkan'){
                $('#edit-password').fadeIn()
                $(this).text('sembunyikan')
                console.log($(this).text())
            }else{
                $('#edit-password').fadeOut()
                $(this).text('tampilkan')
            }
        })

        $(document).on('click', '#edit', function(){
            var listEdit = $(this).siblings('#list-edit')
            if(listEdit.css('display') == 'block'){
                listEdit.fadeOut()
            }else{
                listEdit.fadeIn()
            }

            $(document).on('click', '#hapus', function(){
                var kon = confirm("apakah anda yakin ingin mengapus foto ini?")
                var idFoto = $(this).data('idfoto')
                console.log(kon);
                if(kon){
                    console.log(idFoto)
                    $.ajax({
                        url: '{{ route("hapus-foto") }}',
                        type: 'GET',
                        data: {
                            'idFoto': idFoto
                        },
                        success: function (response){
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        }
                    })
                }
            })

            $(document).on('click', '#edit-foto', function(){
                console.log($(this).data('idfoto'))
                var idFoto = $(this).data('idfoto')
                $.ajax({
                    url: '{{ route("modal-edit-foto") }}',
                    type: "GET",
                    data: {
                        'idFoto': idFoto
                    },
                    success: function (response){
                        $('#modal-edit-foto').html(response)
                        $('body').css('overflow-y', 'hidden')
                        $('#container-modal').fadeIn()



                        // ketika menekan batal
                        $('#batal-edit').on('click', function(){
                            $('#modal-edit-foto').empty()
                            $('body').css('overflow-y', 'visible')
                            $('#container-modal').fadeOut()
                        })
                    },
                    error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    }
                })
            })
        })

        $(document).on('mouseleave','.box', function(){
            $('.list-edit').fadeOut()
        })

        function submitForm() {
            var form = $('#editUserForm')[0];
            var formData = new FormData(form);

            // Use AJAX to submit the form data
            $.ajax({
                url: '{{ route("edit-user") }}',
                method: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    // Check if the submission was successful
                    if (data.success) {
                        // Update the modal content if successful
                        updateModalContent();
                    } else {
                        // Handle errors if needed
                        console.error('Error:', data.error);
                    }
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }

    // Function to update the modal content
    function updateModalContent() {
        $.ajax({
        url: '{{ route("lastestUserData") }}',
        method: 'GET',
        success: function(data) {
            $.ajax({
                url: '{{ route("success-message") }}',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Refresh atau perbarui halaman jika diperlukan
                        window.location.reload();
                    }
                },
                error: function(error) {
                    console.error('Error adding success message:', error);
                }
            });
        },
        error: function(error) {
            console.error('Error fetching latest user data:', error);
        }
    });
    }

        $('#editUserForm').submit(function (event) {
            event.preventDefault();
            submitForm();
        });


    })

    </script>


@endsection
