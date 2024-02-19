<div class="header">
    <div class="logo">
        <h3>Fotopolio</h3>
    </div>

    <div class="links">
        <a href="/beranda" class="{{ $judul === 'beranda' ? 'active' : '' }}">Beranda</a>
        <a href="/buat" class="{{ $judul === 'buat' ? 'active' : '' }}">Buat</a>
    </div>

    <div class="dropdown">
        <div class="select">
            <span class="selected">Beranda</span>
            <div class="caret"></div>
        </div>
        <ul class="menu">
            <li class="active">Beranda</li>
            <li>Buat</li>
        </ul>
    </div>

    <div class="search" style="{{ $search == true ? 'opacity: 0; cursor:default; pointer-events:none' : '' }}">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" class="input" placeholder="search" id="searchInput" data-path="{{ $judul }}">
    </div>
    <div  class="icons">
        <a href="bookmark"><i class="fa-regular fa-bookmark {{ $judul === 'bookmark' ? 'active' : '' }}"></i></a>
        <a href="profil"><i class="fa-solid fa-circle-user {{ $judul === 'profil' ? 'active' : '' }}"></i></a>
    </div>
</div>
