<section class="card">
      <div class="card-header">
        <h4 class="card-title">Edit alat</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">id_alat</label>
              <div class="col-sm-10">
                <input type="text" name="id_alat" class="form-control" placeholder="" value="<?php echo $dataedit->id_alat?>" readonly>
              </div>
            </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">nomor_alat</label>
              <div class="col-sm-10">
                <input type="text" name="nomor_alat" class="form-control" value="<?php echo $dataedit->nomor_alat?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">status_alat</label>
              <div class="col-sm-10">
                <input type="text" name="status_alat" class="form-control" value="<?php echo $dataedit->status_alat?>">
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
