<div class="main-content">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Disposisi Keluar</h3>
                <?php if($this->session->flashdata('notifs')):?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('notifs');?></div>
                <?php endif;?>
                <?php if($this->session->flashdata('notifg')):?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('notifg');?></div>
                <?php endif;?>
            </div>
            <div class="panel-body">
                    <div class="row">
                        <?php if($this->session->userdata('id_jabatan') != 5):?>
                            <div class="col-md-4">
                                <a href="#" data-toggle="modal" data-target="#modal_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah disposisi</a>
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
                            <th>Subject</th>
                            <th>Send To</th>
                            <th>Jabatan</th>
                            <th>Disposition At</th>
                            <th>Description</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        <?php foreach($disposisi as $mail):?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $mail->mail_subject;?></td>
                                <td><?php echo $mail->fullname;?></td>
                                <td><?php echo $mail->nama_jabatan;?></td>
                                <td><?php echo $mail->disposition_at;?></td>
                                <td><?php echo $mail->description;?></td>
                                <td>
                                    <span class="label <?php if($mail->status_disposition == 'done'):?>label-success<?php elseif($mail->status_disposition == 'not done'):?>label-warning<?php endif;?>">
                                        <?php echo $mail->status_disposition;?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo base_url();?>assets/img/surat/<?php echo $mail->file_upload;?>" class="btn btn-info btn-sm" target="_blank">
                                        <i class="fa fa-eye fa-lg"></i>
                                    </a>

                                    <a href="<?php echo base_url('index.php');?>/surat/delete_disposition/<?php echo $mail->id_mail;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></a>
                                </td>
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
                            <h4 style="text-align: center">Tambah Disposisi</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('index.php');?>/surat/add_disposisi/<?php echo $this->uri->segment(3); ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mail Subject</label>
                                            <input type="text" name="mail_subject" class="form-control" value="<?php echo $surat->mail_subject;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select onchange="getPegawai(this.value)" class="form-control">
                                                <option value="" selected disabled>Pilih Jabatan</option>}
                                                option
                                                <?php foreach($jabatan as $jabat):?>
                                                    <?php if($this->session->userdata('jabatan') == 'Sekretaris'):?>
                                                        <?php if($jabat->id_jabatan != $this->session->userdata('id_jabatan')):?>
                                                        <option value="<?php echo $jabat->id_jabatan;?>"><?php echo $jabat->nama_jabatan;?></option>
                                                    <?php endif;?>
                                                    <?php elseif($this->session->userdata('jabatan') == 'Kepala Sekolah'):?>
                                                        <?php if($jabat->id_jabatan != $this->session->userdata('id_jabatan') && $jabat->nama_jabatan != 'Sekretaris'):?>
                                                            <option value="<?php echo $jabat->id_jabatan;?>"><?php echo $jabat->nama_jabatan;?></option>
                                                        <?php endif;?>
                                                    <?php else:?>
                                                        <?php if($jabat->id_jabatan != $this->session->userdata('id_jabatan') && $jabat->id_jabatan > $this->session->userdata('id_jabatan')):?>
                                                            <option value="<?php echo $jabat->id_jabatan;?>"><?php echo $jabat->nama_jabatan;?></option>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Disposition to</label>
                                            <select name="disposition_to" class="form-control" id="disposition_to">
                                                <option value="" disabled>Pilih Nama Pegawai</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>description</label>
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary pull-right" name="" style="margin-left: 2%" value="Kirim">
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
                            <form action="<?php echo base_url('index.php');?>/surat/edit_surat_masuk" method="post" enctype="multipart/form-data">
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
                                            <label>Mail From</label>
                                            <input type="text" name="mail_from_edit" class="form-control" id="mail_from_edit">
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
        td = tr[i].getElementsByTagName("td")[2];
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
        $.getJSON('<?php echo base_url();?>index.php/surat/get_surat_masuk_by_id/'+id_surat, function(data){
            $('#id_mail_edit').val(data.id_mail);
            $('#mail_code_edit').val(data.mail_code);
            $('#incoming_at_edit').val(data.incoming_at);
            $('#mail_from_edit').val(data.mail_from);
            $('#mail_subject_edit').val(data.mail_subject);
        });
    }

    function getPegawai(id_jabatan) {
        $.getJSON('<?php echo base_url();?>index.php/surat/get_pegawai_by_id_jabatan/'+id_jabatan, function(data){
            $.each(data, function(index,value){
                $('#disposition_to').append('<option value="'+value.id_user+'">'+value.fullname+'</option>');
            })
        });
    }
</script>