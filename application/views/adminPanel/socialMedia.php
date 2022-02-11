<div class="row">
  <div class="col-6">
    <div class="card card-success card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <?= img(['src' => 'assets/images/favicon.png', 'alt' => '', 'class' => 'profile-user-img img-fluid img-circle']) ?>
        </div>
        <h3 class="profile-username text-center">Update Social Media</h3>
        <p class="text-muted text-center"></p>
        <?= form_open(admin('socialMedia')) ?>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Facebook</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'facebook',
            'class' => 'form-control',
            'placeholder' => 'Enter facebook link',
            'value' => $social['facebook']
            ]) ?>
          </li>
          <li class="list-group-item">
            <b>Instagram</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'instagram',
            'class' => 'form-control',
            'placeholder' => 'Enter instagram link',
            'value' => $social['instagram']
            ]) ?>
          </li>
          <li class="list-group-item">
            <b>Youtube</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'youtube',
            'class' => 'form-control',
            'placeholder' => 'Enter youtube link',
            'value' => $social['youtube']
            ]) ?>
          </li>
          <li class="list-group-item">
            <b>Twitter</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'twitter',
            'class' => 'form-control',
            'placeholder' => 'Enter twitter link',
            'value' => $social['twitter']
            ]) ?>
          </li>
        </ul>
        <?= form_button([ 'content' => '<b>Update Social Media</b>',
        'type'  => 'submit',
        'class' => 'btn btn-outline-primary btn-block']) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card card-success card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <?= img(['src' => 'assets/images/favicon.png', 'alt' => '', 'class' => 'profile-user-img img-fluid img-circle']) ?>
        </div>
        <h3 class="profile-username text-center">Change Whats's App Group</h3>
        <p class="text-muted text-center"></p>
        <?= form_open(admin('whatsapp')) ?>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Whats's App Group</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'whatsapp',
            'class' => 'form-control',
            'placeholder' => 'Enter Whats\'s App Group',
            'value' => $social['whatsapp']
            ]) ?>
          </li>
        </ul>
        <?= form_button([ 'content' => "<b>Change Whats's App Group</b>",
        'type'  => 'submit',
        'class' => 'btn btn-outline-primary btn-block']) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>