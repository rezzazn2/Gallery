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
