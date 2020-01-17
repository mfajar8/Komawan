<!--

Pastikan sudah membuat sebuah folder untuk menyimpan file hasil upload dropzone ini
dan permissionnya Read & Write !

Pastikan model sudah terdapat fungsi DBS

1.Copy File Upload PHP ke module
2.Tambahkan fungsi ini di Create Action setelah $this->{namamodel}->insert()

Struktur table image_{blablabla}
-id_img int
-name
-id_{key}

//Start
$insert_id = $this->db->insert_id();
if($_POST['filename'] != ''){
$id_product=$insert_id;//ganti ini
$filename=$this->input->post('filename');
$arrFilename=explode(",",$filename);
for($i=0;$i<count($arrFilename);$i++){
$name=str_replace(" ","_",$arrFilename[$i]);
$dataFoto=array(
'name'=>$name,
'id_product'=>$id_product//ganti juga ini
);
$this->Dbs->insert($dataFoto,'image_product');//ganti nama table ini
}
}
//End

3.Tambahkan Fungsi ini di Update_action
//START
$insert_id = $this->input->post('{id_product}', TRUE); //ganti dengan id dari form yang dikirim dan hapus kurung {}
if($_POST['filename'] != ''){
$id_product=$insert_id;//ganti ini variable ini
$filename=$this->input->post('filename');
$arrFilename=explode(",",$filename);
for($i=0;$i<count($arrFilename);$i++){
$name=str_replace(" ","_",$arrFilename[$i]);
$dataFoto=array(
'name'=>$name,
'id_product'=>$id_product//ganti juga ini
);
$this->Dbs->insert($dataFoto,'image_product');//ganti nama table ini
}
}
//END

3.1 Tambahkan variable ini di function edit()

$getImage=$this->Dbs->getdata(array('id_product'=>$id),'image_product'); //sesuaikan id dengan kondisi database
//jangan lupa tambahkan $getImage kedalam array data untuk di proses di View

4.Tambahkan ini ke model dari Database Controller yang dimaksud
//Start
function get_image_by($id)
{
$this->db->where('id_img', $id);
return $this->db->get('image_product')->row();//ganti nama table
}

function deleteImg($id)
{
    $this->db->where('id_img', $id);
    $this->db->delete('image_product');//ganti nama table
}
//END

4.1 Tambahkan fungsi ini ke controller dalam modul
//Dropzone fungsi
function imageDelete($id){
$row = $this->{namamodel}->get_image_by($id);

if ($row) {
unlink('xfile/{namafolder}/'.$row->name);//menghapus file
$this->{namamodel}->deleteImg($id);//menghapus value di database berdasarkan img_id
$this->session->set_flashdata('message', 'Delete Sukses');
redirect($_SERVER['HTTP_REFERER']);
} else {
$this->session->set_flashdata('message', 'Record Not Found');
redirect($_SERVER['HTTP_REFERER']);
}
}

//dropzone fungsi

4.Tambahkan col-md-4 ini di View Form usahakan col-md-8 dan col-md-4 agar rapih
//START
<div class="col-md-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Upload Foto Produk</h4>
                    <h6 class="card-subtitle">Tarik Gambar atau Pilih Beberapa Gambar</h6>
                    <form action="<?php echo base_url()?>admin/upload/dropzone?pathFolder={namafoldertujuan}" class="dropzone" enctype="multipart/form-data">
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
  </div>
//END

5.Tambahkan col-md-4 ini di Edit Form
//START
<div class="col-md-4">
    <?php if ($getImage->num_rows()>0){ ?>
      <div class="card">
          <div class="card-body p-b-0">
              <h4 class="card-title">Kelola Gambar</h4>
               </div>

          <ul class="nav nav-tabs customtab" role="tablist">
              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Kelola</span></a> </li>
              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Tambah</span></a> </li>
          </ul>

          <div class="tab-content">
              <div class="tab-pane active" id="home2" role="tabpanel">
                  <div class="p-20">
                    <div class="row el-element-overlay">
                          <div class="col-md-12">
                              <h6 class="card-subtitle m-b-20 text-muted">Anda Bisa Mengedit Gambar Dibawah Ini</h6></div>
                              <?php foreach ($getImage->result() as $g): ?>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1"> <img src="<?php echo base_url() ?>xfile/{namafolder}/<?php echo $g->name ?>" alt="user" />
                                                <div class="el-overlay">
                                                    <ul class="el-info">
                                                        <li><a class="btn default btn-outline image-popup-vertical-fit" href="<?php echo base_url() ?>xfile/{namafolder}/<?php echo $g->name ?>"><i class="icon-magnifier"></i></a></li>
                                                        <li><a class="btn default btn-outline" href="<?php echo base_url()?>admin/{namacontroller}/imageDelete/<?php echo $g->id_img ?>"><i class="icon-trash"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="el-card-content">
                                                <small><?php echo $g->name ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <?php endforeach; ?>
                    </div>
                  </div>
              </div>
              <div class="tab-pane  p-20" id="profile2" role="tabpanel">
                <h6 class="card-subtitle m-b-20 text-muted">Tarik Foto atau Upload Disini</h6>
                <form action="<?php echo base_url()?>admin/upload/dropzone?pathFolder={namafoldertujuan}" class="dropzone">
                </form>
              </div>
          </div>
      </div>

    <?php }else{ ?>
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Tambahkan Gambar</h4>
                      <h6 class="card-subtitle">Tarik Gambar atau Pilih Beberapa Gambar</h6>
                      <form action="<?php echo base_url()?>admin/upload/dropzone?pathFolder={namafoldertujuan}" class="dropzone" enctype="multipart/form-data">
                      </form>
                  </div>
              </div>
          </div>
      </div>
    <?php } ?>
  </div>
  //END

6. tambahkan ini di view form dan edit form
<input type="hidden" id="filename" name="filename">

-->
