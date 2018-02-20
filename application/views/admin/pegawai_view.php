<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Surat Masuk</h3>
                <?php if($this->session->flashdata('notifs')):?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('notifs');?></div>
                <?php endif;?>
                <?php if($this->session->flashdata('notifg')):?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('notifg');?></div>
                <?php endif;?>
            </div>
            <div class="panel-body">
                    <div class="row">
                        <?php if($this->session->userdata('jabatan') == 'Kepala Sekolah'):?>
                            <div class="col-md-4">
                                <a href="#" data-toggle="modal" data-target="#modal_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pegawai</a>
                            </div>
                        <?php endif;?>
                        <div class="col-md-3 pull-right">
                            <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Name ....">
                        </div>
                    </div>
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Jabatan</th>
                            <?php if($this->session->userdata('jabatan') == 'Kepala Sekolah'):?>
                                <th>Action</th>
                            <?php endif;?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        <?php foreach($pegawai as $data):?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data->fullname;?></td>
                                <td><?php echo $data->nama_jabatan;?></td>
                                <?php if($this->session->userdata('jabatan') == 'Kepala Sekolah'):?>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal_edit" onclick="getUserId(<?php echo $data->id_user;?>)" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url();?>index.php/surat/delete_pegawai/<?php echo $data->id_user;?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                <?php endif;?>
                            </tr>
                        <?php $no++;?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>

            <div class="modal fade" role="dialog" id="modal_add">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 style="text-align: center">Tambah Surat Masuk</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('index.php');?>/surat/add_pegawai" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>username</label>
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>password</label>
                                            <input type="text" name="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="fullname" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select name="id_jabatan" class="form-control">
                                                <option value="" selected disabled>Pilih Jabatan</option>

                                                <?php foreach($jabatan as $jabat):?>
                                                    <option value="<?php echo $jabat->id_jabatan?>"><?php echo $jabat->nama_jabatan?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right" name="" style="margin-left: 2%">Kirim</button>
                                        <button class="btn btn-danger pull-right" name="" data-dismiss="modal">Keluar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" role="dialog" id="modal_edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 style="text-align: center">Edit Surat Masuk</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('index.php');?>/surat/edit_pegawai" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="id_user_edit" class="form-control" id="id_user_edit">
                                        <div class="form-group">
                                            <label>username</label>
                                            <input type="text" name="username_edit" class="form-control" id="username_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>password</label>
                                            <input type="text" name="password_edit" class="form-control" id="password_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="fullname_edit" class="form-control" id="fullname_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select name="id_jabatan_edit" class="form-control">
                                                <option value="" selected disabled>Pilih Jabatan</option>

                                                <?php foreach($jabatan as $jabat):?>
                                                    <option value="<?php echo $jabat->id_jabatan?>"><?php echo $jabat->nama_jabatan?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right" name="" style="margin-left: 2%">Kirim</button>
                                        <button class="btn btn-danger pull-right" name="" data-dismiss="modal">Keluar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function myFunction() {
      // Declare variables 
      var input, filter, table, tr, td, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }

    function getUserId(id_user){
        $.getJSON('<?php echo base_url();?>index.php/surat/get_pegawai_by_id/'+id_user, function(data){
            $('#id_user_edit').val(data.id_user);
            $('#username_edit').val(data.username);
            $('#password_edit').val(data.password);
            $('#fullname_edit').val(data.fullname);
        });
    }
</script>