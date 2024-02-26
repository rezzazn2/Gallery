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
                    modalMuncul()
                    updateModal(true)
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
            var parent= $(this).parent().siblings('.ul-komentar')
            var imgP = $('#img-profil').attr('src')
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
                    var id = response.id
                    console.log(id)
                    inputElement.val('');
                    // Menambahkan komentar baru di bawah container-input
                    var newComment ='<li class="komen"><div class="table-profil table-profil-komen"><img src="'+ imgP+'"></div><span class="komen-username">'+ username+ '<p class="komen-isi"> '+ value +'</p></span><a id="hapus-komentar" id><i class="fa-regular fa-trash-can" id="hapus-komen" data-idkomen="'+ id +'" ></i></a>';
                    parent.prepend(newComment);
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
            var counting = $('#countlike')
            var count = parseInt(counting.text(), 10);
            $.ajax({
                url: '{{ route("likefoto") }}',
                type: 'GET',
                data:{
                    'idFoto': idFoto,
                },
                success: function(response) {
                    if(classIcon == 'fa-regular'){
                        counting.html(count + 1)
                        icon.removeClass('fa-regular')
                        icon.removeClass('fa-heart')
                        icon.addClass('fa-solid')
                        icon.addClass('fa-heart')
                    } else {
                        counting.html(count - 1)
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

        $(document).on('click', '#edit-user', function(){
            $('#container-modal').fadeIn().css('display', 'flex')
            $('#modal-edit-user').fadeIn()
            $('body').css('overflow-y', 'hidden')
            $('.exit').on('click', function(){
                $('#container-modal').fadeOut()
                location.reload()

            })
        })


    });

 $(document).ready(function() {

    $(document).on('click', '#hapus-komen', function(){
        var check = confirm('apakah anda yakin ingin menghapus pesan?')
        if(check){
            var id = $(this).data('idkomen')
            var parent = $(this).closest('.komen');
            console.log(id);

            $.ajax({
                url: '{{ route("hapus-komen") }}',
                type: 'GET',
                data: {
                    'id': id,
                },
                success: function (response) {
                    parent.remove()
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            })
        }
    })
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
                    modalMuncul()
                    updateModal(true)
                    console.log(modal);
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
                    modalMuncul()
                    updateModal(true)
                    console.log(modal);

                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        }
        $(document).off('click', '#simpan-album-button').on('click', '#simpan-album-button', function(){
            var idAlbum = $(this).data('idalbum');
            var dataId = $(this).data('idfoto');
            console.log(`idalbum : ${idAlbum} idfoto :${dataId}`)
            var button = $(this)
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
                        button.replaceWith(response)

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }

                })
            });
        $(document).off('click', '#buang-album-button').on('click', '#buang-album-button', function(){
            var idAlbum = $(this).data('idalbum');
            var dataId = $(this).data('idfoto');
            console.log(`idalbum : ${idAlbum} idfoto :${dataId}`)
            var button = $(this)
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
                        button.replaceWith(response)

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }

                })
            });
    });

    $(document).on('click', '.exit', function() {
        console.log(modal);
        if(modal > 1){
            $('#modal-simpan').fadeOut();
            $('#modal-simpan').empty();
            updateModal(false)
        }else{
            modalOut()
            $('#modal-simpan').fadeOut();
            $('#modal-simpan').empty();

            updateModal(false)

        }



    });
    $(document).on('click', '.exit-2', function() {
        console.log(modal);
        if(modal > 1){
            $('.menu-buat-album').fadeOut();
            updateModal(false)

        }else{
            modalOut()
            $('.menu-buat-album').fadeOut();
            updateModal(false)
        }
    });
    $(document).on('click', '#close', function() {
        if(modal > 1){
            $('#modal-preview-img').fadeOut();
            $('#modal-preview-img').empty();
            updateModal(false)

        }else{
            modalOut()
            $('#modal-preview-img').fadeOut();
            $('#modal-preview-img').empty();
            updateModal(false)
        }
    });




});


    $(document).ready(function(){
        $(document).on('click', '.button-buat-album', function(){
            modalMuncul()

            $('.menu-buat-album').fadeIn();
            updateModal(true)
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
<script src="{{ asset('gallery-c') }}/js/script.js"></script>

</body>
</html>
