<div class="modal-container-report">              
      <form class="form-report" action="report-foto" method="POST" id="reportFoto">
        @csrf
          <div class="header-report">
              <i class="fa-solid fa-xmark exit" id="exit-modal-report"></i>
          </div>
          <input type="hidden" name="idfoto" value="{{ $idfoto }}">
          <div class="list-form checkbox">
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="spam">
                  <div class="flex-y">
                      <label>Spam</label>
                          <p class="deskripsi">Postingan yang menyesatkan atau berulang</p>                          
                  </div>
              </div>
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="pornografi">
                  <div class="flex-y">
                      <label>Ketelanjangan, pornografi, atau konten seksual</label>
                          <p class="deskripsi">Konten seksual eksplisit yang melibatkan orang dewasa atau ketelanjangan, bukan ketelanjangan, atau penyalahgunaan yang disengaja yang melibatkan anak di bawah umur</p>                          
                  </div>
              </div>
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="Melukai diri sendiri">
                  <div class="flex-y">
                      <label>Melukai diri sendiri</label>
                          <p class="deskripsi">Gangguan makan, memotong bagian tubuh, bunuh diri</p>                          
                  </div>
              </div>
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="Kegiatan penuh kebencian">
                  <div class="flex-y">
                      <label>Kegiatan penuh kebencian</label>
                          <p class="deskripsi">Prasangka, stereotip, supremasi kulit putih, hinaan</p>                          
                  </div>
              </div>
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="Barang berbahaya">
                  <div class="flex-y">
                      <label>Barang berbahaya</label>
                          <p class="deskripsi">Narkoba, senjata, produk yang diatur undang-undang</p>                          
                  </div>
              </div>  
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="Pelecehan atau kritik">
                  <div class="flex-y">
                      <label>Pelecehan atau kritik</label>
                          <p class="deskripsi">Penghinaan, ancaman, gambar telanjang tanpa izin pemilik</p>                          
                  </div>
              </div>
              
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="Kekerasan eksplisit">
                  <div class="flex-y">
                      <label>Kekerasan eksplisit</label>
                          <p class="deskripsi">Gambar kekerasan atau promosi kekerasan</p>                          
                  </div>
              </div>
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="Pelanggaran privasi">
                  <div class="flex-y">
                      <label>Pelanggaran privasi</label>
                          <p class="deskripsi">
                              Foto pribadi, informasi pribadi</p>                          
                  </div>
              </div>
              <div class="check-report flex-x">
                  <input type="checkbox" name="reportType[]"  value="Hak kekayaan intelektual saya">
                  <div class="flex-y">
                      <label>Hak kekayaan intelektual saya</label>
                          <p class="deskripsi">
                              Pelanggaran hak cipta atau merek dagang</p>                          
                  </div>
              </div>
          </div>
          <div class="list-form">
              <label for="laporan" class="judul-input">Masukan laporan</label>
              <textarea name="laporan" id="laporan" cols="30" rows="10"></textarea>
          </div>
          <button class="button btn-right btn-edit" >simpan laporan</button>
      </form>
  </div>