<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-success card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-10">
          <h5 class="card-title m-0"><?= ucwords($title) ?> List</h5>
        </div>
        <div class="col-sm-2">
          <?= anchor($url.'/add', 'Add', 'class="btn btn-block btn-outline-success btn-sm"'); ?>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-striped table-hover datatable">
        <thead>
          <tr>
            <th class="target">Sr. No.</th>
            <th>Title</th>
            <th>Category</th>
            <th>Views</th>
            <th>Created</th>
            <th class="target">Link</th>
            <th class="target">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">News Link</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="news-link"></p>
      </div>
      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  function newsLink(link)
  {
    document.getElementById("news-link").innerHTML = link;
  }
</script>