<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="block-content">
					<div class="single-post-box">
						<div class="title-post">
							<h1>E paper | <?= date('d-m-Y', $epaper['paper_date']) ?></h1>
							<ul class="post-tags">
								<li><i class="fa fa-clock-o"></i><?= date('d-m-Y') ?></li>
							</ul>
						</div>
						<?php if ($epaper): ?>
						<div >
							<embed src="<?= $epaper['image'] ?>" width="100%" height="2100px" />
						</div>
						<?php else: ?>
						<div class="jumbotron">
							No E paper available.
						</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>