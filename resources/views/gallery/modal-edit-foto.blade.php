<div class="container-edit-foto">
    <form action="{{ route("edit-foto") }}"  method="POST" class="buat"  enctype="multipart/form-data">
        @csrf
        <input id="edit-foto-id" type="hidden"  name="id" value="{{ $editFoto->id }}">
        <div class="buat-kiri">
            <input  type="file" name="foto" id="jalurFoto" onchange="previewImageEdit()">
            <label for="jalurFoto" >Masukan Foto
                <img  alt="" class="imgPreview" id="apalah" src="{{ asset('storage/foto/'. $editFoto->jalurFoto) }}">
            </label>
        </div>
        <div class="buat-kanan">
            <label for="judulFoto">Judul Foto</label>

            <input id="judulFoto" type="text" name="judulFoto" class="normal-input" value="{{ $editFoto->judulFoto }}" >
            <label for="deskripsiFoto">Deksripsi Foto</label>
            <textarea name="deskripsiFoto" id="deskripsiFoto" cols="40" rows="10" class="normal-input" style="resize: none;" >{{ $editFoto->deskripsiFoto }}</textarea>
            <div class="list-item">
                <button class="button">Edit</button>
                <a class="button" id="batal-edit">batal</a>
            </div>
        </div>

    </form>
</div>

<script>
    function previewImageEdit() {
        const apalah = $('#jalurFoto')[0];
        const homeforme = $('#apalah')[0];
        console.log( homeforme)

        const oFReader = new FileReader();
        oFReader.readAsDataURL(apalah.files[0]);

        oFReader.onload = function (oFREvent) {
            homeforme.src = oFREvent.target.result;
        };
    }
</script>
