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
            <?= form_label('Name', 'name') ?>
            <div class="input-group">
              <div class="custom-file">
            <?= form_input([
            'name' => "name",
            'class' => "form-control",
            'id' => "name",
            'placeholder' => "Enter Name",
            'value' => set_value('name')
            ]) ?>
            <?= form_error('name') ?>
          </div>
        </div>
          </div>
        </div>
       <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Link', 'link') ?>
            <div class="input-group">
              <div class="custom-file">
                <?= form_input([
                'name' => "link",
                'class' => "form-control",
                'id' => "link",
                'placeholder' => "Enter Link",
                'value' => set_value('link')
                ]) ?>
                <?= form_error('link') ?>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-md-6">
          <?= form_button([ 'content' => 'Save',
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