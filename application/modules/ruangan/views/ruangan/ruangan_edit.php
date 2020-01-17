<section class="card">
      <div class="card-header">
        <h4 class="card-title">Edit ruangan</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">id_ruangan</label>
              <div class="col-sm-10">
                <input type="text" name="id_ruangan" class="form-control" placeholder="" value="<?php echo $dataedit->id_ruangan?>" readonly>
              </div>
            </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">nama_ruangan</label>
              <div class="col-sm-10">
                <input type="text" name="nama_ruangan" class="form-control" value="<?php echo $dataedit->nama_ruangan?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">letak_ruangan</label>
              <div class="col-sm-10">
                <input type="text" name="letak_ruangan" class="form-control" value="<?php echo $dataedit->letak_ruangan?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">keterangan_ruangan</label>
              <div class="col-sm-10">
                <input type="text" name="keterangan_ruangan" class="form-control" value="<?php echo $dataedit->keterangan_ruangan?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">id_gedung</label>
              <div class="col-sm-10">
                <input type="text" name="id_gedung" class="form-control" value="<?php echo $dataedit->id_gedung?>">
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
