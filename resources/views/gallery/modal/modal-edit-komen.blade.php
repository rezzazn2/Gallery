<form action="edit-komentar" action="post" id="edit-komentar">
    @csrf
    <input type="hidden" name="id" value="{{ $komen->id }}">
    <textarea name="isiKomentar" id="" >{{ $komen->isiKomentar }}</textarea>
    <div class="flex-x gap">
        <a class="button button-hapus" id="kembali-edit-komentar">kembali</a>
        <button  class="button" id="edit-komentar">Edit</button>
    </div>
</form>
