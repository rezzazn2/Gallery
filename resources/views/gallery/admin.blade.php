
@extends('gallery.template.template')

@section('content')
    <div class="container-admin">
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


        <table class="content-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Role</th>
                <th>Foto profil</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="data-user">
                @foreach ($users as $user)
                    <tr>
                        <td>1</td>
                        <td>{{ $user->nama }}</td>
                        <td id="username">{{ $user->username }}</td>
                        <td>{{ $user->alamat }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        @if ($user->fotoProfil == 'default.jpg')
                            <td><img src="{{ asset('gallery-c/img/'. $user->fotoProfil) }}" width="100px" height="100px" alt=""></td>
                        @else
                            <td><img src="{{ asset('storage/foto/'. $user->fotoProfil) }}" width="100px" height="100px" alt=""></td>
                        @endif
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a  class="button button-aksi button-hapus" id="hapus-user" data-idUser="{{ $user->id }}">Hapus <i class="fa-solid fa-trash"></i></a>
                            <a  class="button button-aksi button-edit" >Edit <i class="fa-solid fa-user-pen"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
          </table>

    </div>

    <script>

        $(document).ready(function(){
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
        })
    </script>


@endsection
