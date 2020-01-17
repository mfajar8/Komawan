<section class="card">
    <div class="card-header">
        <h4 class="card-title">Description</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
          <form action="<?= base_url()?>setup/crud/process" method="post">
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">Table</label>
              <div class="col-sm-10">
                <select class="form-control" name="tableName">
                  <?php foreach ($tables as $table): ?>
                    <option value="<?= $table ?>"><?= $table ?></option>
                  <?php endforeach; ?>
                </select>
                <!-- <input type="text" class="form-control" name="tableName"> -->
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">Modul Target</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="moduleTarget">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">Nama Controller</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="cName">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Datatable</label>
              <div class="col-sm-10">
                <select class="form-control" name="serverSide">
                  <option value="0">ClientSide</option>
                  <option value="1">ServerSide</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-rounded btn-primary btn-outline">
              <i class="ti-save-alt"></i> Generate
            </button>

        </div>

       </form>
        </div>
    </div>
</section>
