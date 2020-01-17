<section class="card">
      <div class="card-header">
        <h4 class="card-title">Edit admin</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="post" action="<?php echo base_url().$action ?>" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">id_user</label>
              <div class="col-sm-10">
                <input type="text" name="id_user" class="form-control" placeholder="" value="<?php echo $dataedit->id_user?>" readonly>
              </div>
            </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">username</label>
              <div class="col-sm-10">
                <input type="text" name="username" class="form-control" value="<?php echo $dataedit->username?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">password</label>
              <div class="col-sm-10">
                <input type="text" name="password" class="form-control" value="<?php echo $dataedit->password?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">nama_user</label>
              <div class="col-sm-10">
                <input type="text" name="nama_user" class="form-control" value="<?php echo $dataedit->nama_user?>">
              </div>
              </div>
						<div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">NIP</label>
              <div class="col-sm-10">
                <input type="text" name="NIP" class="form-control" value="<?php echo $dataedit->NIP?>">
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
