
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

  
