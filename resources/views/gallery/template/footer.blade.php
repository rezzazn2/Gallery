<script>

    $(document).ready(function(){
        // $(document).on('click', '#modal-album-trigger', function(){
        //         $.ajax({
        //             url: '{{ route("modal-album") }}',
        //             type: 'GET',
        //             data:{
        //                 'idAlbum' : $(this).data('idalbum')
        //             },
        //             success: function (response){
        //                 $('#modal-album').html(response);
        //                 $('#modal-album').css('display', 'flex');
        //                 modalMuncul()
        //                 updateModal(true)
        //             },
        //             error: function (xhr, status, error) {
        //                 console.error(xhr.responseText);
        //             }
        //         })
        //     })
        //     $(document).on('click','#modal-album-exit', function(){
        //         console.log(modal);
        //             if(modal > 1){
        //                 $('.modal-album').fadeOut();
        //                 $('.modal-album').empty();
        //                 updateModal(false)

        //             }else{
        //                 modalOut()
        //                 $('.modal-album').fadeOut();
        //                 $('.modal-album').empty();
        //                 updateModal(false)
        //             }
        //     })


            // button kembali-edit-komentar
            $(document).on('click', '#kembali-edit-komentar', function(){
                if(modal > 1){
                    $('#modal-edit-komentar').empty();
                    updateModal(false)
                }else{
                    modalOut()
                    $('#modal-edit-komentar').empty();

                    updateModal(false)

                }

            })




        // edit komentar
        $(document).on('submit', '#edit-komentar', function(){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
            type: "POST",
            url: "{{ route('edit-komentar') }}",
            data: formData,
            success: function(response) {
                window.location.reload();
            },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
        });
        })


        // modal edit-komentar

        $(document).on('click', '#edit-komen', function(){
            let id = $(this).data('idkomen')
            $.ajax({
                url: '{{ route("modal-edit-komen") }}',
                type: 'GET',
                data: {
                    'id' : id
                },
                success:function(response){
                    $('#modal-edit-komentar').html(response);
                    modalMuncul()
                    updateModal(true)
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }

            })
        })

        // live search foto

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

                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // preview foto

        $(document).on('click','#foto', function(){

            var idFoto = $(this).data('id')

            $.ajax({
                url: '{{ route("preview-img") }}',
                type:'GET',
                data:{
                    'idFoto': idFoto
                },
                success:function(data){
                    $('#modal-preview-img').html(data);
                    $('#modal-preview-img').css('display', 'flex');
                    modalMuncul()
                    updateModal(true)
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
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
                    var newComment ='<li class="komen"><div class="table-profil table-profil-komen"><img src="'+ imgP+'"></div><span class="komen-username">'+ username+ '<p class="komen-isi"> '+ value +'</p></span><div class="list-aksi-komentar" id="aksi-komentar"><div class="list"><a id="hapus-komentar" id><i class="fa-regular fa-trash-can" id="hapus-komen" data-idkomen="'+ id +'" ></i></a></div><div class="list"><a id="edit-komentar" id><i class="fa-regular fa-pen-to-square" id="edit-komen" data-idkomen="'+ id +'" ></i></a></div></div></div>';
                    parent.prepend(newComment);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
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
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            })
        })

        // edit profil

        $(document).on('click', '#edit-user', function(){
            $('#container-modal').fadeIn().css('display', 'flex')
            $('#modal-edit-user').fadeIn()
            $('body').css('overflow-y', 'hidden')
            $('.exit').on('click', function(){
                $('#container-modal').fadeOut()
                location.reload()

            })
        })

        // modal lapor

        $(document).on('click', '#lapor', function(){
            let idfoto = $(this).data('idfoto')
            console.log(idfoto);
            $.ajax({
                url: '{{ route("modal-report") }}',
                type: 'GET',
                data: {
                    'idfoto': idfoto
                },
                success: function(response) {
                    $('#modal-report').html(response);
                    modalMuncul()
                    updateModal(true)
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            })
        })


    });


 $(document).ready(function() {
    // hapus komen

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
    // simpan foto ke album
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

    $(document).on('click', '#hapus', function(){
                var kon = confirm("apakah anda yakin ingin mengapus foto ini?")
                var idFoto = $(this).data('idfoto')
                console.log(kon);
                if(kon){
                    console.log(idFoto)
                    $.ajax({
                        url: '{{ route("hapus-foto") }}',
                        type: 'GET',
                        data: {
                            'idFoto': idFoto
                        },
                        success: function (response){
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        }
                    })
                }
            })

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
    $(document).on('click', '#exit-modal-report', function() {
        console.log(modal);
        if(modal > 1){
            $('#modal-report').fadeOut();
            $('#modal-report').empty();
            updateModal(false)
        }else{
            modalOut()
            $('#modal-report').fadeOut();
            $('#modal-report').empty();

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

    $(document).ready(function(){
        function submitForm() {
                var form = $('#reportFoto')[0];
                var formData = new FormData(form);
                console.log(formData);
                $.ajax({
                    url: '{{ route("report-foto") }}',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log('oke');
                        if (data.success) {
                            window.location.reload();
                        } else {
                            console.error('Error:', data.error);
                        }
                    },error: function(response) {
                        // Penanganan respons gagal
                        if (response.status === 422) {
                            // Menampilkan pesan kesalahan validasi
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                // Menampilkan pesan kesalahan di bawah elemen dengan ID yang sama
                                console.log('error');
                                $('#' + key + '_error').text(value[0]);
                            });
                        } else {
                            // Menangani kesalahan selain kesalahan validasi
                            console.log('Terjadi kesalahan: ' + response.responseText);
                        }
                    }
                });
            }

            $(document).on('submit', '#reportFoto', function(event) {
                event.preventDefault();
                submitForm();
            });
    })




});






</script>

<script src="{{ asset('gallery-c') }}/js/script.js"></script>

</body>
</html>
