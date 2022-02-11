<?php defined('BASEPATH') OR exit('No direct script access allowed');  ?>
<div class="row">
	<div class="col-12 col-sm-6 col-md-3">
		<?= anchor(admin('blog'),
		'<div class="info-box">
			<span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Blogs</span>
				<span class="info-box-number">'.$this->main->count('blog', ['is_deleted' => 0]).'</span>
			</div>
		</div>', 'class="text-dark"') ?>
	</div>
</div>