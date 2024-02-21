
      <div class="container-edit-user">
          <form action="edit-user" method="POST" class="edit-user" id="editUserForm" enctype="multipart/form-data">
              <i class="fa-solid fa-xmark exit"></i>
              @csrf
              <input type="hidden" name="id" value="{{$dataUser['id']}}">
              <div class="foto-profil">
                  <div class="profil-img">
                      @if ($dataUser->fotoProfil == 'default.jpg')
                          <img src="gallery-c/img/default.jpg" alt="" id="fotoPreview">
                      @else
                      <img src="{{ asset('storage/foto/'. $dataUser->fotoProfil) }}" alt="" id="fotoPreview">

                      @endif
                      <p class="error" id="fotoProfil_error"></p>
                  </div>
                  <input type="file" name="fotoProfil" id="fotop" onchange="previewImage()">
                  <label for="fotop" class="button">Ubah Foto </label>
              </div>
              <div class="kelompok">
                  <div class="list">
                      <label for="username">Username</label>
                      <p class="error" id="username_error"></p>

                      <input type="text" name="username" value="{{ $dataUser["username"] }}" class="" id="username">
                  </div>
                  <div class="list">
                      <label for="namaLengkap">Nama Lengkap</label>
                      <p class="error" id="namaLengkap_error"></p>

                      <input type="text" name="namaLengkap" value="{{ $dataUser["nama"] }}" class="" id="namaLengkap">
                  </div>
              </div>
              <div class="kelompok">
                  <div class="list">
                   <label for="role">role</label>
                   <p class="error" id="role_error"></p>
                   
                      <select name="role" id="role">
                        @if ($dataUser["role"] == 'admin')
                              <option value="admin">admin</option>
                              <option value="user">user</option>                        
                        @else
                              <option value="user">user</option>
                              <option value="admin">admin</option>
                        @endif
                      </select>
                  </div>
                  <div class="list">
                      <label for="alamat">alamat</label>
                      <p class="error" id="alamat_error"></p>
                      
                      <input type="text" name="alamat" id="alamat" value="{{ $dataUser["alamat"] }}" class="">
    
                  </div>
              </div>
              <div class="list">
                  <label for="email">email</label>
                  <p class="error" id="email_error"></p>
                  
                  <input type="email" name="email" id="email" value="{{ $dataUser["email"] }}" class="">

              </div>
              <div class="list" style="margin: 10px 0">
                  <span class="button" id="btn-password">tampilkan</span>
              </div>

              <div class="edit-password" id="edit-password">
                  <div class="list">
                      <label for="passwordLama">password lama</label>
                      <p class="error" id="passwordLama_error"></p>
                      
                      <input type="password" name="passwordLama" id="passwordLama" value="" class="">

                  </div>
                  <div class="list">
                        
                      <label for="passwordBaru">password baru</label>
                      <p class="error" id="passwordBaru_error"></p>

                      <input type="password" name="passwordBaru" id="passwordBaru" value="" class="">

                  </div>

              </div>
              <button class="button btn-edit">Simpan perubahan</button>
          </form>
