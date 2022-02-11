<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($title) ?></h5>
    </div>
    <?= form_open_multipart($url.'/upload/'.$id, 'id = imageUploadForm') ?>
    <input type="hidden" id="upload-id" value="<?= $id ?>" />
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <?= form_label('Select Image', 'image') ?>
            <div class="input-group">
              <div class="custom-file">
                <?= form_input([
                'type' => "file",
                'name' => "image[]",
                'class' => "custom-file-input",
                'id' => "image",
                'accept' => '.png,.jpeg,.jpg,',
                'onchange' => 'uploadImage()',
                'multiple' => "multiple"
                ]) ?>
                <?= form_label('Select image', 'image', ['class' => 'custom-file-label']) ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1 text-center">
          <?= form_label('OR', '', ['class' => 'mt-4']) ?>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <?= form_label('Select from gallery') ?>
            <br>
            <button type="button" class="btn btn-outline-primary col-md-12" onclick="getGallery()">
            Select images
            </button>
          </div>
        </div>
      </div>
      <h6 class="sub-title">Uploaded Images</h6>
      <div class="row" id="uploaded-images">
      </div>
    </div>
    <?= form_close() ?>
    <div class="card-footer">
      <div class="row">
        <div class="col-md-6">
          <?= anchor($url, 'Go Back', 'class="btn btn-outline-danger col-md-4"'); ?>
        </div>
      </div>
    </div>
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
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-primary" onclick="uploadImages()">Select Images</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
showImages('<?= $id ?>');
});
</script>