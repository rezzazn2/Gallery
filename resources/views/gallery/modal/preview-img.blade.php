<div class="container-foto-preview">

    <div class="container-preview" id="fotoContainer">
        <div class="data-foto">
            <div class="flex-y  space-between ">
                <p class="judul-foto dib">
                    {{$modalFoto->first()->judulFoto}}
                </p>
                <p class="tanggal-foto deskripsi dib">
                    {{ \Carbon\Carbon::parse($modalFoto->first()->created_at)->format('l, d F Y') }}

                </p>

            </div>

        </div>
        <div class="box">
            <img src="{{ asset('storage/foto/'. $modalFoto->first()->jalurFoto) }}">
        </div>
    </div>
    <div class="preview-kanan">
        <div class="atas">
            <div class="data-user-foto">
                <i class="fa-solid fa-arrow-left close" id="close"></i>
                <div class="table-profil table-profil-preview">

                    @if ($modalFoto->first()->user->fotoProfil == 'default.jpg')
                    <img src="{{ asset('gallery-c/img/'. $modalFoto->first()->user->fotoProfil) }}" alt="" id="img-profil">
                    @else
                    <img src="{{ asset('storage/foto/'. $modalFoto->first()->user->fotoProfil) }}"  alt="" id="img-profil">
                    @endif
                </div>
                <p class="pembuat-foto">{{ $modalFoto->first()->user->username }}</p>
            </div>
            <div class="list-aksi list-aksi-preview nyala">
                @if ($modalFoto->first()->likes->contains('user_id', auth()->id()))
                    <span class="simpan" id="simpan" data-idfoto="{{ $modalFoto->first()->id }}">
                        <i class="fa-regular fa-bookmark"></i>
                        <!-- <i class="fa-solid fa-bookmark"></i> -->
                    </span>
                    <span id="countlike" class="countlike">{{$modalFoto->first()->likes->count()}}</span>
                    <span class="like" id="like" data-idfoto="{{ $modalFoto->first()->id }}">
                        <i class="fa-solid fa-heart"></i>
                        <!-- <i class="fa-solid fa-bookmark"></i> -->
                    </span>
                @else
                    <span class="simpan" id="simpan" data-idfoto="{{ $modalFoto->first()->id }}">
                        <i class="fa-regular fa-bookmark"></i>
                        <!-- <i class="fa-solid fa-bookmark"></i> -->
                    </span>
                    <span id="countlike" class="countlike">{{$modalFoto->first()->likes->count()}}</span>
                    <span class="like" id="like" data-idfoto="{{ $modalFoto->first()->id }}">
                        <i class="fa-regular fa-heart"></i>
                        <!-- <i class="fa-solid fa-bookmark"></i> -->
                    </span>

                @endif
            </div>
        </div>
        <div class="bawah">
            {{-- <p class="judul-foto">{{ $modalFoto->first()->judulFoto }}</p>
            <p class="deskripsi-foto">{{ $modalFoto->first()->deskripsiFoto }}</p> --}}
            <div class="container-komentar">

                <div class="komentar-list">
                    <ul class="ul-komentar">
                        @foreach ( $komentars as $komentar)

                        <li class="komen">


                                <div class="table-profil table-profil-komen">

                                    @if ($komentar->user->fotoProfil == 'default.jpg')
                                    <img src="{{ asset('gallery-c/img/'. $komentar->user->fotoProfil) }}" alt="">
                                    @else
                                    <img src="{{ asset('storage/foto/'. $komentar->user->fotoProfil) }}"  alt="">
                                    @endif
                                </div>

                                <span class="komen-username">{{ $komentar->user->username }} <p class="komen-isi"> {{ $komentar->isiKomentar }}</p></span>

                                @if($komentar->userId == auth()->id())
                                    <div class="list-aksi-komentar" id="aksi-komentar">
                                        <div class="list">
                                            <a id="hapus-komentar" ><i class="fa-regular fa-trash-can" id="hapus-komen" data-idkomen="{{$komentar->id}}" ></i></a>
                                        </div>
                                        <div class="list">

                                            <a id="edit-komentar" ><i class="fa-regular fa-pen-to-square" id="edit-komen" data-idkomen="{{$komentar->id}}" ></i></a>
                                        </div>
                                    </div>
                                @elseif($userlogin == 'admin')
                                    <div class="list-aksi-komentar" id="aksi-komentar">
                                        <div class="list">
                                            <a id="hapus-komentar" ><i class="fa-regular fa-trash-can" id="hapus-komen" data-idkomen="{{$komentar->id}}" ></i></a>
                                        </div>
                                        <div class="list">

                                            <a id="edit-komentar" ><i class="fa-regular fa-pen-to-square" id="edit-komen" data-idkomen="{{$komentar->id}}" ></i></a>
                                        </div>
                                    </div>
                                @endif




                        </li>

                        @endforeach
                    </ul>
                    <div class="container-input">
                        <input type="text" class="input-komentar" placeholder="Tambahkan komentar">
                        <button class="button btn-komentar" id="tambahKomentar" data-idFoto="{{ $idFoto }}"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
