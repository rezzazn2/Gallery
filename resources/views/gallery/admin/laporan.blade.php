
@extends('gallery.template.template')

@section('content')
    <div class="container-admin" style="margin-top: 140px">
        <h1 class="heading">
            Table data laporan foto <i class="fa-solid fa-circle-exclamation"></i>
        </h1>
        <div class="list-search">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="input" placeholder="Cari user berdasarkan judul foto" id="search-lapor">
            </div>
            <a href="{{ route("data-user") }}" class="button button-edit" style="margin-left: auto">data user</a>


        </div>

        <div class="container-tabel" id="container-tabel-laporan">

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

        <div class="foto-preview" id="foto-preview" >

        </div>


    </div>

    <script>



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

        })
    </script>


@endsection
