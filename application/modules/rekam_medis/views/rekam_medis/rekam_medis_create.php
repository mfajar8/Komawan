<section class="card">
      <div class="card-header">
        <h4 class="card-title">Tambah Data</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">berat_infus</label>
                <div class="col-sm-10">
                  <input type="text" name="berat_infus" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">waktu_pasang</label>
                <div class="col-sm-10">
                  <input type="text" name="waktu_pasang" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">waktu_selesai</label>
                <div class="col-sm-10">
                  <input type="text" name="waktu_selesai" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">id_ruangan</label>
                <div class="col-sm-10">
                  <input type="text" name="id_ruangan" class="form-control">
                </div>
              </div>
						<div class="form-group row">
                <label class="col-sm-2 col-form-label">id_user</label>
                <div class="col-sm-10">
                  <input type="text" name="id_user" class="form-control">
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