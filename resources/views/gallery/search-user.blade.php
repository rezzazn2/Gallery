@foreach ($users as $user)
                    <tr>
                        <td>1</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
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
                            <a href="" class="button button-aksi button-hapus">Hapus <i class="fa-solid fa-trash"></i></a>
                            <a href="" class="button button-aksi button-edit">Edit <i class="fa-solid fa-user-pen"></i></a>
                        </td>
                    </tr>
                @endforeach
