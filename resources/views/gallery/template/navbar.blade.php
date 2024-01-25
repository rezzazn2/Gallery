<div class="header">
    <div class="logo">
        <i class="fa-solid fa-image"></i>
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

    <div class="search" style="{{ $judul === 'buat' ? 'opacity: 0; cursor:default; pointer-events:none' : '' }}">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" class="input" placeholder="search" id="searchInput">
    </div>
    <div class="icons">
        <i class="fa-solid fa-bookmark"></i>
        <i class="fa-solid fa-circle-user"></i>
    </div>
</div>
