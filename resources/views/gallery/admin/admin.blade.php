
@extends('gallery.template.template')

@section('content')
    <div class="container-admin" style="margin-top: 140px">
        <h1 class="heading">
            Table data users <i class="fa-solid fa-users"></i>
        </h1>
        <div class="list-search">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="input " placeholder="Cari user berdasarkan username" id="search-user">
            </div>
            <div class="filter">
                <select id="filter">
                    <option value="semua">semua</option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </div>
        </div>

        <div class="container-tabel" id="container-tabel">

            <table class="content-table">
                <thead>
                  <tr>
                    <th width="10%" style="text-align: center"><i class="fa-solid fa-user"></i></th>
                    <th width="20%">Username/Nama</th>
                    <th width="15%" class="alamat">Alamat</th>
                    <th style="text-align: center" width="10%" class="rol">Role</th>
                    <th width="25%">Tanggal Dibuat/<br> Tanggal Diedit</th>
                    <th width="20%"></th>
                  </tr>
                </thead>
                <tbody id="data-user">
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="table-profil">
                                        @if ($user->fotoProfil == 'default.jpg')
                                        <img src="{{ asset('gallery-c/img/'. $user->fotoProfil) }}" alt="">
                                        @else
                                        <img src="{{ asset('storage/foto/'. $user->fotoProfil) }}"  alt="">
                                        @endif
                                    </div>
                                </td>
                                <td id="username">
                                    <div class="kelompok">
                                        <div class="list">
                                            <p class="username">
                                                {{ $user->username }}/{{ $user->nama }}
                                            </p>

                                        </div>
                                        <div class="list">
                                            <p class="email">{{ $user->email }}</p>
                                        </div>
                                    </div>


                                </td>
                                <td class="alamat">{{ $user->alamat }}</td>
                                @if($user->role == 'admin')
                                    <td><p class="role role-admin rol">{{ $user->role }}</p></td>
                                @else
                                    <td><p class="role role-user rol">{{ $user->role }}</p></td>

                                @endif

                                <td class="tanggal">
                                    {{ $user->created_at }} <br>
                                    {{ $user->updated_at}}
                                </td>
                                <td class="flex-y gap">
                                    <a  class="button button-aksi button-hapus" id="hapus-user" data-idUser="{{ $user->id }}">Hapus <i class="fa-solid fa-trash"></i></a>
                                    <a  class="button button-aksi button-edit" id="edit-user" data-idUser="{{ $user->id }}">Edit <i class="fa-solid fa-user-pen"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <td colspan="6" class="text-center bigger-text"> kosong<i class="fa-regular fa-eye-slash"></i></td>
                            </tr>
                    @endif

                </tbody>
            </table>

            {{$users->links()}}
        </div>

    </div>
    <div class="container-admin">
        <h1 class="heading">
            Table data laporan foto <i class="fa-solid fa-circle-exclamation"></i>
        </h1>
        <div class="list-search">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="input" placeholder="Cari user berdasarkan judul foto" id="search-lapor">
            </div>

        </div>

        <div class="container-tabel" id="container-tabel">

            <table class="content-table">
                <thead>
                  <tr>
                    <th width="10%">No</th>
                    <th width="15%" style="text-align: left">Laporan <i class="fa-solid fa-circle-exclamation"></i></th>
                    <th width="15%">Judul Foto</th>
                    <th width="15%"></th>
                    <th width="20%">Tanggal Dibuat/<br> Tanggal Diedit</th>
                    <th width="25%"></th>
                  </tr>
                </thead>
                <tbody id="data-lapor">
                    @if ($laporan->count() > 0)
                        @foreach ($laporan as $lapor)
                            <tr class="relative">
                                <td>
                                    <p>
                                        {{ $loop->iteration }}
                                    </p>
                                </td>
                                <td>
                                    <p class="username">
                                        {{ $lapor->user->username }} <span class="email">{{ $lapor->user->email }}</span> <br>
                                        <span class="deskripsi">
                                            {{ $lapor->laporan }}
                                        </span>

                                    </p>
                                </td>
                                <td>
                                    {{ $lapor->foto->judulFoto }}
                                </td>

                                <td>
                                    <a class="button button-edit" data-fotoid="{{ $lapor->foto_id }}" id="click-foto">Lihat Foto</a>
                                </td>

                                <td class="tanggal">
                                    {{ $lapor->created_at }} <br>
                                    {{ $lapor->updated_at}}
                                </td>

                                <td class="flex-y gap ">
                                    <a  class="button button-aksi button-hapus" id="hapus-lapor" data-idlapor="{{ $lapor->id }}">Hapus <i class="fa-solid fa-trash"></i></a>
                                    <a  class="button button-aksi button-edit" id="konfirmasi-lapor" data-idlapor="{{ $lapor->id }}">Konfirmasi <i class="fa-solid fa-check"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center bigger-text"> kosong<i class="fa-regular fa-eye-slash"></i></td>
                        </tr>
                    @endif

                </tbody>
            </table>

            {{$laporan->links()}}
        </div>

    </div>

    <div class="container-modal" id="container-modal" >

        <div class="modal-edit-data-user" id="modal-edit-user" >

        </div>

        <div class="foto-preview" id="foto-preview" >

        </div>


    </div>

    <script>
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

            $(document).on('click', '#konfirmasi-lapor', function(){
                var check = confirm(`apakah anda yakin ingin mengonfirmasi laporan ini dan menghapus foto didalamnya?`)
                var id = $(this).data('idlapor')
                if(check){
                    $.ajax({
                        url: '{{ route("konfirmasi-lapor") }}',
                        type: 'GET',
                        data: {
                            'id': id
                        },
                        success:function(data){
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    })
                }
            })
            $(document).on('click', '#hapus-lapor', function(){
                var check = confirm(`apakah anda yakin ingin mengapus?`)
                var id = $(this).data('idlapor')
                if(check){
                    $.ajax({
                        url: '{{ route("hapus-lapor") }}',
                        type: 'GET',
                        data: {
                            'id': id
                        },
                        success:function(data){
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    })
                }
            })

            $(document).on('click', '#click-foto', function(){
                let id = $(this).data('fotoid')
                $.ajax({
                    url:'{{ route("modal-preview-foto")}}',
                    type:'GET',
                    data: {
                        'id': id
                    },
                    success: function(data){
                        $('#foto-preview').html(data)
                        modalMuncul()




                    },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
                })

            })

            $(document).on('click', function(){

                if ($('#foto-preview').children().length > 0) {
                    if (!$(event.target).closest('#foto-preview').length) {
                        if (modal > 1) {
                            $('#foto-preview').empty();
                            updateModal(false);
                        } else {
                            modalOut();
                            $('#foto-preview').empty();
                            updateModal(false);
                        }
                    }
                }

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
                        console.log('oke');
                        if (data.success) {
                            window.location.reload();
                        } else {
                            console.error('Error:', data.error);
                        }
                    },error: function(response) {
                        // Penanganan respons gagal
                        if (response.status === 422) {
                            // Menampilkan pesan kesalahan validasi
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                // Menampilkan pesan kesalahan di bawah elemen dengan ID yang sama
                                console.log('error');
                                $('#' + key + '_error').text(value[0]);
                            });
                        } else {
                            // Menangani kesalahan selain kesalahan validasi
                            console.log('Terjadi kesalahan: ' + response.responseText);
                        }
                    }
                });
            }


        $(document).on('submit', '#editUserForm', function(event) {
            event.preventDefault();
            submitForm();
        });



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
            $(document).on('click', '#edit-user', function(){
                var id = $(this).data('iduser')
                $.ajax({
                    url:'{{ route("modal-edit-user")}}',
                    type:'GET',
                    data: {
                        'id': id
                    },
                    success: function(data){
                        $('#modal-edit-user').html(data)
                        $('#modal-edit-user').fadeIn()
                        modalMuncul()




                    },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }


                })
            })

            $('#filter').on('change', function(){
                var keyword = $('#search-user').val();
                var filter = $(this).val()
                $.ajax({
                    url: '{{ route("search-user") }}',
                    type: 'GET',
                    data: {
                        'keyword': keyword,
                        'filter': filter
                    },
                    success:function(data){
                        $('#data-user').html(data);

                    }
                });
            })
            $('#search-user').on('keyup', function(){
                var keyword = $(this).val();
                var filter = $('#filter').val()
                $.ajax({
                    url: '{{ route("search-user") }}',
                    type: 'GET',
                    data: {
                        'keyword': keyword,
                        'filter': filter
                    },
                    success:function(data){
                        $('#data-user').html(data);

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }

                });
            });
            $('#search-lapor').on('keyup', function(){
                var keyword = $(this).val()
                $.ajax({
                    url: '{{ route("search-lapor") }}',
                    type: 'GET',
                    data: {
                        'keyword': keyword,
                    },
                    success:function(data){
                        $('#data-lapor').html(data);

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }

                });
            });

            $(document).on('click', '#hapus-user', function(){
                var username = $(this).parent().siblings('#username').html()
                var check = confirm(`apakah anda yakin ingin mengapus ${username}`)
                var id = $(this).data('iduser')
                if(check){
                    $.ajax({
                        url: '{{ route("hapus-user") }}',
                        type: 'GET',
                        data: {
                            'id': id
                        },
                        success:function(data){
                            location.reload();
                        }
                    })
                }
            })
            $(document).on('click', '#hapus-user', function(){
                var username = $(this).parent().siblings('#username').html()
                var check = confirm(`apakah anda yakin ingin mengapus ${username}`)
                var id = $(this).data('iduser')
                if(check){
                    $.ajax({
                        url: '{{ route("hapus-user") }}',
                        type: 'GET',
                        data: {
                            'id': id
                        },
                        success:function(data){
                            location.reload();
                        }
                    })
                }
            })

        })
    </script>


@endsection
