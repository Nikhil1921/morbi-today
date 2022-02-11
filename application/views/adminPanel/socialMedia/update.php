<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-success card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($title) ?></h5>
    </div>
    <?= form_open_multipart($url.'/update/'.$id, '', ['image' => $data['image']]) ?>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Link', 'link') ?>
            <?= form_input([
            'name' => "link",
            'class' => "form-control",
            'id' => "link",
            'placeholder' => "Enter link",
            'value' => (!empty(set_value('link'))) ? set_value('link') : $data['link']
            ]) ?>
            <?= form_error('link') ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Logo', 'image') ?>
            <div class="input-group">
              <div class="custom-file">
                <?= form_input([
                'type' => "file",
                'name' => "image",
                'class' => "custom-file-input",
                'id' => "image",
                'accept' => '.png'
                ]) ?>
                <?= form_label('Select logo', 'image', ['class' => 'custom-file-label']) ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Counts', 'counts') ?>
            <?= form_input([
            'name' => "counts",
            'class' => "form-control",
            'id' => "counts",
            'placeholder' => "Enter counts",
            'value' => (!empty(set_value('counts'))) ? set_value('counts') : $data['counts']
            ]) ?>
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