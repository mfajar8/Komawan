<section class="card">
      <div class="card-header">
        <h4 class="card-title">Tambah Data</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">nama_ruangan</label>
                <div class="col-sm-10">
                  <input type="text" name="nama_ruangan" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">letak_ruangan</label>
                <div class="col-sm-10">
                  <input type="text" name="letak_ruangan" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">keterangan_ruangan</label>
                <div class="col-sm-10">
                  <input type="text" name="keterangan_ruangan" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">id_gedung</label>
                <div class="col-sm-10">
                  <input type="text" name="id_gedung" class="form-control">
                </div>
              </div>
</div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect
           waves-light float-right">Simpan</button>
        </div>
      </form>
      </div>
    </section>