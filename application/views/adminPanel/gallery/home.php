<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-success card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-4">
          <h5 class="card-title m-0"><?= ucwords($title) ?> List</h5>
        </div>
        <div class="col-sm-8">
          <?= form_open_multipart($url.'/upload/', ['id' => 'galleryUploadForm'], ['name' => 'jighghg']) ?>
          <div class="row">
            <div class="col-sm-8">
              <div class="form-group">
                <?= form_input([
                'name' => "title",
                'class' => "form-control",
                'id' => "title",
                'placeholder' => "Enter title"
                ]) ?>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <div class="input-group">
                  <div class="custom-file">
                    <?= form_input([
                    'type' => "file",
                    'name' => "image[]",
                    'class' => "custom-file-input",
                    'id' => "image",
                    'accept' => '.png,.jpeg,.jpg,',
                    'onchange' => 'galleryUploadForm()',
                    'multiple' => "multiple"
                    ]) ?>
                    <?= form_label('Select image', 'image', ['class' => 'custom-file-label']) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-striped table-hover datatable">
        <thead>
          <tr>
            <th class="target">Sr. No.</th>
            <th>Title</th>
            <th>Image</th>
            <th class="target">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>