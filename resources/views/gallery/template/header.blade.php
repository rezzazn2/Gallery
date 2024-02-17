<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="mviewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="{{ asset('gallery-c') }}/style.css">
    <script src="https://kit.fontawesome.com/18c9c6e968.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" >
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        var modal = 0

        function updateModal(bool){
            if(bool == true){
                modal = modal + 1
            } else if(bool == false){
                modal = modal - 1
            }
        }

        function hapus(text) {
            confirm(`apakah anda yakin ingin menghapus ${text} ini?`)
        }

        function modalMuncul(){
            $('#container-modal').css('display', 'flex');
            $('body').css('overflow-y', 'hidden')
            $('#container-modal').fadeIn();
        }

        function modalOut(){
            $('body').css('overflow-y', 'auto')
            $('#container-modal').fadeOut();
        }
    </script>
</head>
<body>



