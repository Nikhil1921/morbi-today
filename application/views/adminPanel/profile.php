<div class="row">
  <div class="col-md-4">
    <div class="card card-success card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <?= img(['src' => 'assets/images/favicon.png', 'alt' => '', 'class' => 'profile-user-img img-fluid img-circle']) ?>
        </div>
        <h3 class="profile-username text-center">Update Profile</h3>
        <p class="text-muted text-center"></p>
        <?= form_open(admin('profile')) ?>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Profile Name</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'name',
            'class' => 'form-control',
            'placeholder' => 'Enter Profile Name',
            'value' => $this->session->name
            ]) ?>
            <?= form_error('name') ?>
          </li>
          <li class="list-group-item">
            <b>Mobile No.</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'mobile',
            'class' => 'form-control',
            'placeholder' => 'Enter Mobile No.',
            'value' => $this->session->mobile,
            'maxlength' => '10'
            ]) ?>
            <?= form_error('mobile') ?>
          </li>
          <li class="list-group-item">
            <b>Email Address</b>
            <?= form_input([
            'type' => 'email',
            'name' => 'email',
            'class' => 'form-control',
            'placeholder' => 'Enter Email Address',
            'value' => $this->session->email
            ]) ?>
            <?= form_error('email') ?>
          </li>
        </ul>
        <?= form_button([ 'content' => '<b>Update Profile</b>',
        'type'  => 'submit',
        'class' => 'btn btn-outline-primary btn-block']) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-success card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <?= img(['src' => 'assets/images/favicon.png', 'alt' => '', 'class' => 'profile-user-img img-fluid img-circle']) ?>
        </div>
        <h3 class="profile-username text-center">Change Password</h3>
        <p class="text-muted text-center"></p>
        <?= form_open(admin('changePassword')) ?>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Password</b>
            <?= form_input([
            'type' => 'password',
            'name' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Enter Password'
            ]) ?>
            <?= form_error('password') ?>
          </li>
        </ul>
        <?= form_button([ 'content' => '<b>Change Password</b>',
        'type'  => 'submit',
        'class' => 'btn btn-outline-primary btn-block']) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card card-success card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <?= img(['src' => 'assets/images/favicon.png', 'alt' => '', 'class' => 'profile-user-img img-fluid img-circle']) ?>
        </div>
        <h3 class="profile-username text-center">Change Groups</h3>
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
          <li class="list-group-item">
            <b>Telegram Group</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'telegram',
            'class' => 'form-control',
            'placeholder' => 'Enter Telegram Group',
            'value' => $social['telegram']
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