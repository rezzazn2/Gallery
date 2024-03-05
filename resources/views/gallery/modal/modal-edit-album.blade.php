<i class="fa-solid fa-xmark exit-2"></i>

<form action="edit-album" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $editAlbum->id }}">
    <label for="namaAlbum">Nama Album</label>
    <input type="text" name="namaAlbum" class="normal-input" value="{{ $editAlbum->namaAlbum }}" required>
    <label for="deskripsi">Deksripsi Album</label>
    <textarea name="deskripsi" id="" cols="40" rows="10" class="normal-input" style="resize: none;" required>{{ $editAlbum->deskripsi }}</textarea>
    <button class="button">Edit Album</button>
</form>
