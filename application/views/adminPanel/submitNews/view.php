<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-success card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($title) ?></h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Name') ?>
            <?= form_input([
            'class' => "form-control",
            'readonly' => "readonly",
            'value' => $data['name']
            ]) ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Mobile') ?>
            <?= form_input([
            'class' => "form-control",
            'readonly' => "readonly",
            'value' => $data['mobile']
            ]) ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Email') ?>
            <?= form_input([
            'class' => "form-control",
            'readonly' => "readonly",
            'value' => $data['email']
            ]) ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Place') ?>
            <?= form_input([
            'class' => "form-control",
            'readonly' => "readonly",
            'value' => $data['place']
            ]) ?>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <?= form_label('Article') ?>
            <?= form_textarea([
            'class' => "form-control",
            'readonly' => "readonly",
            'value' => strip_tags($data['article'])
            ]) ?>
          </div>
        </div>
        <?php if ($data['image1'] != 'No Image'): ?>
        <div class="col-md-12">
          <div class="form-group">
            <?= img(['src' => 'assets/news/'.$data['image1'], 'alt' => '', 'height' => '200', 'width' => '100%']) ?>
          </div>
        </div>
        <?php endif ?>
        <?php if ($data['image2'] != 'No Image'): ?>
        <div class="col-md-12">
          <div class="form-group">
            <?= img(['src' => 'assets/news/'.$data['image2'], 'alt' => '', 'height' => '200', 'width' => '100%']) ?>
          </div>
        </div>
        <?php endif ?>
        <?php if ($data['image2'] != 'No Image'): ?>
        <div class="col-md-12">
          <div class="form-group">
            <?= img(['src' => 'assets/news/'.$data['image2'], 'alt' => '', 'height' => '200', 'width' => '100%']) ?>
          </div>
        </div>
        <?php endif ?>
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-md-6">
          <?= anchor($url, 'Go Back', 'class="btn btn-outline-danger col-md-4"'); ?>
        </div>
      </div>
    </div>
  </div>
</div>