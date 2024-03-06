<div class="header">
    <div class="logo">
        <h3>Fotopolio</h3>
    </div>

    @if($userlogin !== false)

        <div class="links">
            <a href="/beranda" class="{{ $judul === 'beranda' ? 'active' : '' }}">Beranda</a>
            <a href="/buat" class="{{ $judul === 'buat' ? 'active' : '' }}">Upload</a>
        </div>

    @endif


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
        @if($userlogin !== false)
        <a class="table-profil" href="profil">

                @if ($userlogin->fotoProfil == 'default.jpg')

                    <img src="{{ asset('gallery-c/img/'. $userlogin->fotoProfil) }}" alt="">

                @else

                    <img src="{{ asset('storage/foto/'. $userlogin->fotoProfil) }}"  alt="">

                @endif

            </a>
        @else
        <a href="login" class="button button-edit">Login</a>
        @endif
    </div>
</div>
