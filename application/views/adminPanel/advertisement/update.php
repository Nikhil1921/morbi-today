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
            <?= form_label('Name', 'name') ?>
            <?= form_dropdown('name', ['Header' => 'Header', 'Post Top' => 'Post Top', 'Post Bottom' => 'Post Bottom'], (!empty(set_value('name'))) ? set_value('name') : $data['name'],
            ['id' => 'name',
            'class' => 'form-control select2',
            ]) ?>
            <?= form_error('name') ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Link', 'link') ?>
            <?= form_input([
            'name' => "link",
            'class' => "form-control",
            'id' => "link",
            'placeholder' => "Enter link",
            'value' => (set_value('link')) ? set_value('link') : $data['link']
            ]) ?>
            <?= form_error('link') ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Advertisement Image', 'image') ?>
            <div class="input-group">
              <div class="custom-file">
                <?= form_input([
                'type' => "file",
                'name' => "image",
                'class' => "custom-file-input",
                'id' => "image",
                'accept' => '.png,.jpeg,.jpg,'
                ]) ?>
                <?= form_label('Select Advertisement image', 'image', ['class' => 'custom-file-label']) ?>
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