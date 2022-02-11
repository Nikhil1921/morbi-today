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
            <?php $cat = []; foreach ($cats as $v):
            $cat[$v['id']] = ucwords($v['cat_name']);
            endforeach ?>
            <?= form_label('Blog Category', 'cat_id', ['class'=>'control-label']) ?>
            <?= form_dropdown('cat_id', $cat, set_value('cat_id'),
            ['id' => 'cat_id',
            'class' => 'form-control select2',
            ]) ?>
            <?= form_error('cat_id') ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Blog Title', 'title') ?>
            <?= form_input([
            'name' => "title",
            'class' => "form-control",
            'id' => "title",
            'placeholder' => "Enter Blog Title",
            'value' => set_value('title')
            ]) ?>
            <?= form_error('title') ?>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <?= form_label('Blog Image', 'image') ?>
            <div class="input-group">
              <div class="custom-file">
                <?= form_input([
                'type' => "file",
                'name' => "image",
                'class' => "custom-file-input",
                'id' => "image",
                'onchange' => "document.getElementById('gallery_image').value = ''",
                'accept' => '.png,.jpeg,.jpg,'
                ]) ?>
                <?= form_label('Select blog image', 'image', ['class' => 'custom-file-label']) ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1 text-center">
          <?= form_label('OR', '', ['class' => 'mt-4']) ?>
          <input type="hidden" name="gallery_image" id="gallery_image" />
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <?= form_label('Select from gallery') ?>
            <br>
            <button type="button" class="btn btn-outline-primary col-md-12" onclick="getGallery()">
            Select image
            </button>
          </div>
        </div>
        <div class="col-md-2">
          <img src="" alt="" id="show-img" height="100%" width="100%">
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <?= form_label('Blog Detail', 'details') ?>
            <?= form_textarea([
            'name' => "details",
            'class' => "form-control ckeditor",
            'id' => "details",
            'placeholder' => "Enter Blog Detail",
            'value' => set_value('details')
            ]) ?>
            <?= form_error('details') ?>
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
<div class="modal fade" id="select-gallery">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select from gallery</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>