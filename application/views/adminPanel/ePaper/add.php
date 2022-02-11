<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-success card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($title) ?></h5>
    </div>
    <?= form_open_multipart($url.'/add') ?>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Category Name', 'cat_name') ?>
            <select name="cat_name" id="cat_name" class="form-control">
              <?php foreach ($cats as $k => $c): ?>
              <option value="<?= $c['id'] ?>"><?= $c['cat_name'] ?></option>
              <?php endforeach ?>
            </select>
            <?= form_error('cat_name') ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('E Paper Date', 'paper_date') ?>
            <div class="input-group date" id="paper_date" data-target-input="nearest">
              <input type="text" name="paper_date" class="form-control datetimepicker-input" data-target="#paper_date" data-toggle="datetimepicker">
            </div>
            <?= form_error('paper_date') ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('E Paper', 'image') ?>
            <div class="input-group">
              <div class="custom-file">
                <?= form_input([
                'type' => "file",
                'name' => "image",
                'class' => "custom-file-input",
                'id' => "image",
                'accept' => '.pdf'
                ]) ?>
                <?= form_label('Select E Paper', 'image', ['class' => 'custom-file-label']) ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-md-6">
          <?= form_button([ 'content' => 'Submit',
          'type'  => 'submit',
          'class' => 'btn btn-outline-primary col-md-4']) ?>
        </div>
        <div class="col-md-6">
          <?= anchor($url, 'Cancel', 'class="btn btn-outline-danger col-md-4"'); ?>
        </div>
      </div>
    </div>
    <?= form_close() ?>
  </div>
</div>