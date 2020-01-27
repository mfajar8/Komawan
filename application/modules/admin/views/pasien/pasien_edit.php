<section class="card">
      <div class="card-header">
        <h4 class="card-title">Edit pasien</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">id_pasien</label>
              <div class="col-sm-10">
                <input type="text" name="id_pasien" class="form-control" placeholder="" value="<?php echo $dataedit->id_pasien?>" readonly>
              </div>
            </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">nama_pasien</label>
              <div class="col-sm-10">
                <input type="text" name="nama_pasien" class="form-control" value="<?php echo $dataedit->nama_pasien?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">jenis_kelamin</label>
              <div class="col-sm-10">
                <input type="text" name="jenis_kelamin" class="form-control" value="<?php echo $dataedit->jenis_kelamin?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">ttl</label>
              <div class="col-sm-10">
                <input type="text" name="ttl" class="form-control" value="<?php echo $dataedit->ttl?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">alamat</label>
              <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" value="<?php echo $dataedit->alamat?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">id_rekam_medis</label>
              <div class="col-sm-10">
                <input type="text" name="id_rekam_medis" class="form-control" value="<?php echo $dataedit->id_rekam_medis?>">
              </div>
              </div>

        </div>
        <input type="hidden" id="deleteFiles" name="deleteFiles">
        <div class="col-12">
          <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect
           waves-light float-right">Simpan</button>
        </div>
      </form>
      </div>
    </section>
