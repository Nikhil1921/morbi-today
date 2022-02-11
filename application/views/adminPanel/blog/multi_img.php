<?= link_tag('assets/plugins/image-picker/image-picker/image-picker.css','stylesheet','text/css') ?>
<?php if ($this->input->get('route') == 'upload'): ?>
<select class="image-picker show-html" data-limit="3" multiple="multiple" name="images[]" id="images">
	<?php foreach ($gallery as $k => $v): ?>
	<option data-img-src="<?= base_url('assets/gallery/') ?><?= $v['thumb'] ?>" data-img-class="<?= (($k == count($gallery) - 1) ? 'last' : (($k == 0) ? 'first' : '')) ?>" data-img-alt="Image <?= $k ?> " value="<?= $v['image'] ?>"> Image <?= $k ?></option>
	<?php endforeach ?>
</select>
<?php endif ?>
<?php if ($this->input->get('route') == 'add' || $this->input->get('route') == 'update'): ?>
<select class="image-picker show-html" name="images" id="images" onchange="selectImage(this.value);">
	<option value=""></option>
	<?php foreach ($gallery as $k => $v): ?>
	<option data-img-src="<?= base_url('assets/gallery/') ?><?= $v['thumb'] ?>" data-img-class="<?= (($k == count($gallery) - 1) ? 'last' : (($k == 0) ? 'first' : '')) ?>" data-img-alt="Image <?= $k ?> " value="<?= $v['image'] ?>"> Image <?= $k ?></option>
	<?php endforeach ?>
</select>
<?php endif ?>
<script src="<?= assets('plugins/image-picker/image-picker/image-picker.min.js') ?>"></script>
<script>
$("#images").imagepicker();
</script>