<script>

    $(document).ready(function(){
        $('#searchInput').on('keyup', function(){
            var keyword = $(this).val();
            var path = $(this).data("path")
            $.ajax({
                url: '{{ route("search") }}',
                type: 'GET',
                data: {
                    'keyword': keyword,
                    'path': path
                },
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
                    $('body').css('overflow-y', 'hidden');
                    $('#container-modal').fadeIn()
                },
                error: function(error) {
                // Handle error di sini
                console.error('Error:', error);
            }
            })
        })

        // Tambah Komentar

        $(document).on('click', '#tambahKomentar', function(){
            var idFoto = $(this).data('idfoto')
            var inputElement = $(this).siblings('input');
            var value = inputElement.val();
            var parent= $(this).parent().siblings('.komentar-list').children('ul')

            $.ajax({
                url: '{{ route("tambah-komentar") }}',
                type: 'GET',
                data:{
                    'idFoto': idFoto,
                    'value': value
                },
                success: function(response) {
                    // Handle respons sukses di sini
                    console.log('Sukses:', response);
                    var username = response.username;
                    console.log(username)
                    // Mengosongkan nilai input setelah berhasil
                    inputElement.val('');
                    // Menambahkan komentar baru di bawah container-input
                    var newComment ='<li class="komen"><span class="komen-username">'+ username+ '</span><p class="komen-isi">'+ value +'</p></li>';
                    parent.append(newComment)
                },
                error: function(error) {
                // Handle error di sini
                console.error('Error:', error);
            }
            })
        })

        // LIke

        $(document).on('click', '#like', function(){
            var idFoto = $(this).data('idfoto')
            var icon = $(this).children()
            var classIcon = icon.attr('class').split(' ')[0]
            $.ajax({
                url: '{{ route("likefoto") }}',
                type: 'GET',
                data:{
                    'idFoto': idFoto,
                },
                success: function(response) {
                    if(classIcon == 'fa-regular'){
                        icon.removeClass('fa-regular')
                        icon.removeClass('fa-heart')
                        icon.addClass('fa-solid')
                        icon.addClass('fa-heart')
                    } else {
                        icon.removeClass('fa-solid')
                        icon.removeClass('fa-heart')
                        icon.addClass('fa-regular')
                        icon.addClass('fa-heart')
                    }
                },
                error: function(error) {
                // Handle error di sini
                console.error('Error:', error);
                }
            })
        })


    });

 $(document).ready(function() {
    $(document).on('click', '#simpan', function() {

        if(Object.keys($(this).data()).length > 0){
            var dataId = $(this).data('idfoto');
            var idAlbum =  $(this).data('albumid');
            console.log(dataId);
            console.log(idAlbum);

            $.ajax({
                url: '{{ route("modal-simpan") }}',
                type: 'GET',
                data: {
                    'dataId': idAlbum,
                    'idFoto': dataId
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
        } else {

            var dataId = $(this).parent().siblings('img').data('id');
            var idAlbum =  $(this).parent().siblings('img').data('idalbum');
            console.log(dataId);
            console.log(idAlbum);

            $.ajax({
                url: '{{ route("modal-simpan") }}',
                type: 'GET',
                data: {
                    'dataId': idAlbum,
                    'idFoto': dataId
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

        }
        $(document).on('click', '#button-simpan', function(){
            var idAlbum = $('#select').data('idalbum');
            var dataId = $(this).data('idfoto');
            console.log(`idalbum : ${idAlbum} idfoto :${dataId}`)
                $.ajax({
                    url: '{{ route("simpan-ke-album") }}',
                    type: 'GET',
                    data:{
                        'idAlbum': idAlbum,
                        'idFoto': dataId
                    },
                    // Handle respons dari server jika sukses
                    success: function(response) {
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
        var p = $(this).parent().siblings().eq(1)
        if(p.css('display') == 'none')
        {
            $('#container-modal').fadeOut();
            $('#modal-simpan').fadeOut();
        }else{
            $('#modal-simpan').fadeOut();
        }



    });
    $(document).on('click', '.exit-2', function() {
        $('.menu-buat-album').fadeOut();
    });
    $(document).on('click', '#close', function() {
        $('body').css('overflow-y', 'scroll')
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
