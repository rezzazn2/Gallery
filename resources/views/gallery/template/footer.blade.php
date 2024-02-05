<script>

    $(document).ready(function(){
        $('#searchInput').on('keyup', function(){
            var keyword = $(this).val();

            $.ajax({
                url: '{{ route("search") }}',
                type: 'GET',
                data: { 'keyword': keyword },
                success:function(data){
                    $('#fotoContainer').html(data);

                }
            });
        });

        $(document).on('click','#foto', function(){

            var idFoto = $(this).data('id')
            var idAlbum = $(this).data('idalbum')
            console.log(idFoto,idAlbum)

            $.ajax({
                url: '{{ route("preview-img") }}',
                type:'GET',
                data:{
                    'idFoto': idFoto,
                    'idAlbum': idAlbum
                },
                success:function(data){
                    $('#modal-preview-img').html(data);
                    $('#modal-preview-img').css('display', 'flex');
                    $('#container-modal').fadeIn()
                }
            })
        })


    });

 $(document).ready(function() {
    $(document).on('click', '#simpan', function() {
        var dataId = $(this).siblings('img').data('id');
        var idAlbum =  $(this).siblings('img').data('idalbum');
        console.log(dataId);
        console.log(idAlbum);

        $.ajax({
            url: '{{ route("modal-simpan") }}',
            type: 'GET',
            data: {
                'dataId': idAlbum
            },
            success: function (response) {
                $('#modal-simpan').html(response);
                $('#modal-simpan').css('display', 'flex');

                $('#container-modal').fadeIn();

            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        $(document).on('click', '#button-simpan', function(){
        var idAlbum = $('#select').data('idalbum');
        console.log(`idalbum : ${idAlbum} idfoto :${dataId}`)
            $.ajax({
                url: '{{ route("simpan-ke-album") }}',
                type: 'GET',
                data:{
                    'idAlbum': idAlbum,
                    'idFoto': dataId
                },
                success: function(response) {
            // Handle respons dari server jika sukses
            console.log('Sukses:', response);
            location.reload();
        },
        error: function(error) {
            // Handle kesalahan jika ada
            console.log('Error:', error);
        }

            })
        });
    });

    $(document).on('click', '.exit', function() {
        $('#container-modal').fadeOut();
    });
    $(document).on('click', '.exit-2', function() {
        $('.menu-buat-album').fadeOut();
    });
    $(document).on('click', '#close', function() {
        $('#modal-preview-img').fadeOut();
        $('#container-modal').fadeOut();
    });




});


    $(document).ready(function(){
        $(document).on('click', '.button-buat-album', function(){
            $('.menu-buat-album').fadeIn();
        });
    });

$(document).ready(function() {
    // Gunakan event delegation untuk elemen '.dropdown'
    $(document).on('click', '.dropdown .select', function() {
        var dropdown = $(this).closest('.dropdown');
        var select = dropdown.find('.select');
        var caret = dropdown.find('.caret');
        var menu = dropdown.find('.menu');

        select.toggleClass('select-clicked');
        caret.toggleClass('caret-rotate');
        menu.toggleClass('menu-open');
    });

    // Gunakan event delegation untuk elemen '.menu li'
    $(document).on('click', '.dropdown .menu li', function() {
        var dropdown = $(this).closest('.dropdown');
        var select = dropdown.find('.select');
        var caret = dropdown.find('.caret');
        var menu = dropdown.find('.menu');
        var options = dropdown.find('.menu li');
        var selected = dropdown.find('.selected');
        var idAlbum = $(this).data('idalbum');
        console.log(idAlbum )



        selected.text($(this).text());
        select.attr('data-idalbum', idAlbum);
        select.removeClass('select-clicked');
        caret.removeClass('caret-rotate');
        menu.removeClass('menu-open');

        options.removeClass('active');
        $(this).addClass('active');
    });
});




</script>
<script src="{{ asset('gallery-c') }}/script.js"></script>

</body>
</html>
