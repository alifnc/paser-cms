<div class="row">
  <div class="col-md-8">
    <section class="card mb-4">
      <header class="card-header">
        <h2 class="card-title">Semua <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="dd" id="nestable">
          <ol class="dd-list">
            <li class="dd-item">
              <div class="dd-handle text-muted">Beranda</div>
            </li>
            <?php
            foreach($menu as $row)
            {
              if($row->menu_role == 0)
              {
                $enc_id = $this->encryption->encrypt($row->menu_ID);
                $enc_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
                echo '<li class="dd-item">';
                echo anchor('pasery/setting/menu/'.$enc_id,'<div class="dd-handle">'.$row->menu_title.'</div>');
                $parent = $this->M_menus->get_by_parent($row->menu_ID);
                if($parent)
                {
                  echo '<ol class="dd-list">';
                  foreach($parent as $row_parent)
                  {
                    echo '<li class="dd-item">';
                    $enc_id_parent = $this->encryption->encrypt($row_parent->menu_ID);
                    $enc_id_parent = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id_parent);
                    echo anchor('pasery/setting/menu/'.$enc_id_parent,'<div class="dd-handle">'.$row_parent->menu_title.'</div>');
                    $subparent = $this->M_menus->get_by_parent($row_parent->menu_ID);
                    if($subparent)
                    {
                      echo '<ol class="dd-list">';
                      foreach($subparent as $row_subparent)
                      {
                        echo '<li class="dd-item">';
                        $enc_id_subparent = $this->encryption->encrypt($row_subparent->menu_ID);
                        $enc_id_subparent = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id_subparent);
                        echo anchor('pasery/setting/menu/'.$enc_id_subparent,'<div class="dd-handle">'.$row_subparent->menu_title.'</div>');
                        echo '</li>';
                      }
                      echo '</ol>';
                    }
                    echo '</li>';
                  }
                  echo '</ol>';
                }
                echo '</li>';
              }
            }
            ?>
          </ol>
        </div>
      </div>
    </section>
  </div>
  <div class="col-md-4">
    <section class="card mb-4">
      <?php echo form_open('admin/menu/update/'.$this->uri->segment(4));?>
      <header class="card-header">
        <div class="card-actions">
          <?php echo anchor('pasery/setting/menu','<i class="fas fa-plus btn btn-sm btn-default" title="Tambah Menu"></i>',array('class'=>'card-action'));?>
        </div>
        <h2 class="card-title">Sunting <?php echo $subpage;?></h2>
      </header>
      <div class="card-body">
        <div class="form-group">
          <?php
          echo form_label('Nama','menu_title');
          echo form_input('menu_title',set_value('menu_title',$data->menu_title),array('class'=>'form-control'));
          echo form_error('menu_title','<span class="text-danger">','</span>');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label('Link','menu_url');
          echo form_input('menu_url',set_value('menu_url',$data->menu_url),array('class'=>'form-control'));
          echo form_error('menu_url','<span class="text-danger">','</span>');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label('Induk','menu_parent');
          $mn = array('0'=>'Tanpa Induk');
          foreach($menu as $rows)
          {
            if($rows->menu_ID != $data->menu_ID and $rows->menu_role < 2)
            $mn[$rows->menu_ID] = $rows->menu_title;
          }
          echo form_dropdown('menu_parent',$mn,set_value('menu_parent',$data->menu_parent),'data-plugin-selectTwo class="form-control populate"');
          echo form_error('menu_parent','<span class="text-danger">','</span>');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label('Urutan','menu_order');
          echo '<div data-plugin-spinner data-plugin-options="{ "value":0, "min": 0, "max": 10 }">
                          <div class="input-group">
                            <input type="text" name="menu_order" value="'.set_value('menu_order',$data->menu_order).'" class="spinner-input form-control" maxlength="2" readonly>
                            <div class="input-group-append">
                              <button type="button" class="btn btn-default spinner-up">
                                <i class="fas fa-angle-up"></i>
                              </button>
                              <button type="button" class="btn btn-default spinner-down">
                                <i class="fas fa-angle-down"></i>
                              </button>
                            </div>
                          </div>
                        </div>';
          echo form_error('menu_order','<span class="text-danger">','</span>');
          ?>
        </div>
      </div>
      <footer class="card-footer text-right">
        <div class="btn-group">
          <?php
          echo form_button(array('type'=>'submit','name'=>'btn_save','content'=>'<i class="fas fa-save"></i> Perbarui '.$subpage,'class'=>'btn btn-sm btn-primary'));
          echo '<a href="#modalDelete" class="modal-with-form btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>';
          ?>
        </div>
      </footer>
      <?php echo form_close();?>
    </section>
  </div>
</div>
<!-- start: modal -->
<div id="modalDelete" class="modal-block modal-block-primary mfp-hide">
  <section class="card">
    <?php
    echo form_open('admin/menu/delete/'.$this->uri->segment(4));
    ?>
    <header class="card-header">
      <h2 class="card-title">Hapus <?php echo $subpage;?></h2>
    </header>
    <div class="card-body">
      <p>Apakah Anda yakin menghapus data ini?</p>
      <div class="form-group row">
        <?php
        echo form_label('Nama','menu_title',array('class'=>'col-md-3 control-label pt-2'));
        echo '<div class="col-md-9">';
        echo form_input(array('name'=>'menu_title','value'=>$data->menu_title,'class'=>'form-control'));
        echo '</div>';
        ?>
      </div>
      <div class="form-group row">
        <?php
        echo form_label('Link','menu_url',array('class'=>'col-md-3 control-label pt-2'));
        echo '<div class="col-md-9">';
        echo form_input(array('name'=>'menu_url','value'=>$data->menu_url,'class'=>'form-control'));
        echo '</div>';
        ?>
      </div>
    </div>
    <footer class="card-footer">
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="btn-group">
          <?php
          echo form_button(array('type'=>'submit','name'=>'btn_remove','content'=>'<i class="fas fa-trash text-white"></i> Hapus','class'=>'btn btn-sm btn-danger'));
          echo form_button(array('content'=>'<i class="fas fa-times text-dark"></i> Batal','class'=>'btn btn-sm btn-default modal-dismiss'));
          ?>
        </div>
        </div>
      </div>
    </footer>
    <?php echo form_close();?>
  </section>
</div>
<!-- end: modal -->
