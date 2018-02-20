<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Surat Keluar</h3>
                <?php if($this->session->flashdata('notifs')):?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('notifs');?></div>
                <?php endif;?>
                <?php if($this->session->flashdata('notifg')):?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('notifg');?></div>
                <?php endif;?>
            </div>
            <div class="panel-body">
                    <div class="row">
                        <?php if($this->session->userdata('jabatan') == 'Sekretaris'):?>
                            <div class="col-md-4">
                                <a href="#" data-toggle="modal" data-target="#modal_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Surat</a>
                            </div>
                        <?php endif;?>
                        <div class="col-md-3 pull-right">
                            <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Subject ....">
                        </div>
                    </div>
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mail Code</th>
                            <th>Incoming At</th>
                            <th>Mail To</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <?php if($this->session->userdata('jabatan') == 'Sekretaris'):?>
                                <th>Action</th>
                            <?php endif;?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        <?php foreach($surat as $mail):?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $mail->mail_code;?></td>
                                <td><?php echo $mail->incoming_at;?></td>
                                <td><?php echo $mail->mail_to;?></td>
                                <td><?php echo $mail->mail_subject;?></td>
                                <td>
                                    <span class="label label-success">
                                        <?php echo $mail->status;?>
                                    </span>
                                </td>
                                <?php if($this->session->userdata('jabatan') == 'Sekretaris'):?>
                                    <td>
                                        <a href="<?php echo base_url();?>assets/img/surat/<?php echo $mail->file_upload;?>" class="btn btn-info btn-sm" target="_blank">
                                            <i class="fa fa-eye fa-lg"></i>
                                        </a>

                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_edit" onclick="getSuratId(<?php echo $mail->id_mail;?>)"><i class="fa fa-edit fa-lg"></i></button>

                                        <a href="<?php echo base_url('index.php');?>/surat/delete_surat_keluar/<?php echo $mail->id_mail?>" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>
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
                            <h4 style="text-align: center">Tambah Surat Keluar</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('index.php');?>/surat/add_surat_keluar" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mail Code</label>
                                            <input type="text" name="mail_code" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Incoming At</label>
                                            <input type="date" name="incoming_at" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Mail Date</label>
                                            <input type="date" name="mail_date" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Mail To</label>
                                            <input type="text" name="mail_to" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" name="mail_subject" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>File (.pdf | .zip | .rar | .png | .jpg)</label>
                                            <input type="file" name="file_upload" class="form-control">
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
                            <h4 style="text-align: center">Edit Surat Keluar</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('index.php');?>/surat/edit_surat_keluar" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="id_mail_edit" class="form-control" id="id_mail_edit">
                                        <div class="form-group">
                                            <label>Mail Code</label>
                                            <input type="text" name="mail_code_edit" class="form-control" id="mail_code_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>Incoming At</label>
                                            <input type="date" name="incoming_at_edit" class="form-control" id="incoming_at_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>Mail Date</label>
                                            <input type="date" name="mail_date_edit" class="form-control" id="mail_date_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>Mail To</label>
                                            <input type="text" name="mail_to_edit" class="form-control" id="mail_to_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" name="mail_subject_edit" class="form-control" id="mail_subject_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>File (.pdf | .zip | .rar | .png | .jpg)</label>
                                            <input type="file" name="file_upload_edit" class="form-control" id="file_upload_edit">
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
        td = tr[i].getElementsByTagName("td")[4];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }

    function getSuratId(id_surat){
        $.getJSON('<?php echo base_url();?>index.php/surat/get_surat_keluar_by_id/'+id_surat, function(data){
            $('#id_mail_edit').val(data.id_mail);
            $('#mail_code_edit').val(data.mail_code);
            $('#incoming_at_edit').val(data.incoming_at);
            $('#mail_to_edit').val(data.mail_to);
            $('#mail_subject_edit').val(data.mail_subject);
        });
    }
</script>