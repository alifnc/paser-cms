<div class="row">
  <div class="col-md-12">
    <section class="card mb-4">
      <?php echo form_open('admin/gallery/remove');?>
      <header class="card-header">
        <h2 class="card-title">Semua <?php echo $page;?></h2>
      </header>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <?php
            echo '<div class="btn-group">';
            echo '<a href="#modalAdd" class="modal-with-form btn btn-sm btn-default"><i class="fas fa-plus"></i> Buat Folder</a>';
            echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash"></i> Hapus','class'=>'btn btn-sm btn-default'));
            echo '</div>';
            ?>
          </div>
          <div class="col-md-8 text-right">
            <!-- untuk konten tamahan -->
          </div>
        </div>
        <hr class="dotted short">
        <table class="table table-hover mb-0" id="datatable-default">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" id="check-all"></th>
              <th>Nama</th>
              <th width="50px"><i class="fas fa-eye"></i></th>
              <th width="100px">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <?php echo form_close();?>
      <!-- start: modal -->
      <div id="modalAdd" class="modal-block modal-block-primary mfp-hide">
        <section class="card">
          <?php
          echo form_open_multipart('admin/gallery/insert');
          ?>
          <header class="card-header">
            <h2 class="card-title">Tambah Folder</h2>
          </header>
          <div class="card-body">
            <div class="form-group row">
              <?php
              echo form_label('Nama','gal_title',array('class'=>'col-md-3 text-lg-right pt-2'));
              echo '<div class="col-md-9">';
              echo form_input('gal_title',set_value('gal_title'),array('class'=>'form-control'));
              echo '</div>';
              ?>
            </div>
            <div class="form-group row">
              <?php
              echo form_label('Keterangan','gal_description',array('class'=>'col-md-3 text-lg-right pt-2'));
              echo '<div class="col-md-9">';
              echo form_textarea(array('name'=>'gal_description','value'=>set_value('gal_description'),'class'=>'form-control','rows'=>'3'));
              echo '</div>';
              ?>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-group row">
              <?php
              echo form_label('','btn_save',array('class'=>'col-md-3 control-label pt-2'));
              echo '<div class="col-md-6 btn-group">';
              echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save text-white"></i> Tambahkan Folder','class'=>'btn btn-sm btn-primary'));
              echo form_button(array('content'=>'<i class="fas fa-times text-dark"></i> Batal','class'=>'btn btn-sm btn-default modal-dismiss'));
              echo '</div>';
              ?>
            </div>
          </div>
          <?php echo form_close();?>
        </section>
      </div>
      <!-- end: modal -->
    </section>
  </div>
</div>
