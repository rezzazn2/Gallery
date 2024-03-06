@extends('gallery.template.template')

@section('content')
    
<div class="container-restore" style="margin-top: 140px">
    <div class="list" style="margin: 0 20px">
        <h2>Halaman Restore Foto</h2>
        <p>Pilihlah Foto yang ingin anda restore</p>
    </div>

    <div class="container" id="fotoContainer" style="margin-top: {{ $judul === 'restore' ? '20px' : '' }}   ">
            
        @foreach ( $fotoRestore as $foto)
            <div class="box">
                <img src="{{ asset('storage/foto/'. $foto->jalurFoto) }}" class="foto" id="foto" alt="" data-id="{{ $foto->id }}" data-idalbum="{{ $foto->albumId }}">
                <div class="list-aksi">
                    <span class="restore" id="restore" data-idfoto="{{$foto->id}}">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    </span>
                </div>
            </div>
        @endforeach



</div>
    
    
</div>
<div class="container-modal"></div>

<script>
    

    $(document).ready(function(){
        $(document).on('click', '#restore', function(){
            let foto = confirm('apakah anda yakin ingin merestore foto ini?')
            let idfoto = $(this).data('idfoto')
            let box = $(this).parent().parent()
            console.log(box);
            if(foto){
                $.ajax({
                    url: '{{ route("restore-foto") }}',
                        type: "GET",
                        data: {
                            'idfoto': idfoto
                        },
                        success: function (response){
                            console.log(response.success)
                            box.remove()
                        },
                        error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        }                
    
                })

            }
        })


    })

</script>


@endsection
