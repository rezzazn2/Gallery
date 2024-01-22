<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('gallery-c') }}/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" >

</head>
<body>
    <div class="header">
        <div class="logo">
            <i class="fa-solid fa-image"></i>
        </div>

        <div class="links">
            <a href="">home</a>
            <a href="">Buat</a>
        </div>

        <div class="dropdown">
            <div class="select">
                <span class="selected">Home</span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
                <li class="active">Home</li>
                <li>Buat</li>
            </ul>
        </div>

        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" class="input" placeholder="search">
        </div>
        <div class="icons">
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-circle-user"></i>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/1.jpeg" alt="">
            <span class="simpan">
                <i class="fa-regular fa-bookmark"></i>
                <!-- <i class="fa-solid fa-bookmark"></i> -->
            </span>

        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/2.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/3.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/4.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/5.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/6.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/7.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/8.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/9.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/10.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/11.jpeg" alt="">
        </div>
        <div class="box">
            <img src="{{ asset('gallery-c') }}/img/12.jpeg" alt="">
        </div>
    </div>
</body>
<script src="{{ asset('gallery-c') }}/script.js"></script>
<script src="https://kit.fontawesome.com/18c9c6e968.js" crossorigin="anonymous"></script>
</html>
