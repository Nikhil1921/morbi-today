<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="block-content">
					<div class="single-post-box">
						<div class="title-post">
							<h1>E paper </h1>
							<div class="col-sm-12 pull-left">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									<input type="text" name="archive-news-date" class="form-control col-sm-6" id="datepicker" value="<?= $this->input->get('paper-date') ?>" placeholder="Choose e-paper date" style="width:25%;" onchange="location.href = '<?= base_url() ?>'+'epaper?paper-date='+this.value;">
								</div>
							</div>
						</div>
						<div class="grid-box">
							<div class="row">
							<?php foreach ($papers as $paper): ?>
								<div class="col-md-3" onclick="window.open('<?= base_url('paper/'.e_id($paper['id'])) ?>', '_blank')">
									<div class="title-section">
        								<h1><span><a href="<?= base_url('paper/'.e_id($paper['id'])) ?>" target="_blank"><?= $paper['cat_name'] ?></a></span></h1>
        							</div>
									<div class="news-post image-post2">
										<div class="post-gallery">
											<?= img(['src' => $paper['image'], 'alt' => ""]) ?>
											<div class="hover-box">
												<div class="inner-hover">
													
												</div>
											</div>
										</div>
									</div>
								</div>
						    <?php endforeach ?>
							</div>
						</div>
						<br>
						<div class="jumbotron">
							<div class="share-post-box">
								<div class="title-section">
									<h1><span>MORBI TODAY SOCIAL MEDIA PLATFORM</span></h1>
								</div>
								<ul class="share-box">
									
									<?php
									$social = $this->main->get('social_media', 'facebook, instagram, youtube, twitter, whatsapp, telegram', []);
									if (!$social) {
									$this->main->add(['facebook' => '', 'instagram' => '', 'youtube' => '', 'twitter' => '', 'whatsapp' => '', 'telegram' => ''], 'social_media');
									$social = $this->main->get('social_media', 'facebook, instagram, youtube, twitter, whatsapp, telegram', []);
									}
									foreach ($this->main->getall('social_links', 'link, image', ['is_deleted' => 0]) as $link): ?>
									<li><a href="<?= $link['link'] ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/'.$link['image']) ?>" alt="twitter"></a></li>
									<?php endforeach ?>
								</ul>
							</div>
							<?php if ($social['whatsapp'] || $social['telegram']): ?>
							<br>
							<div class="share-post-box">
								<div class="title-section">
									<h1><span>JOIN OUR GROUP</span></h1>
								</div>
								<ul class="share-box">
									<?php if ($social['whatsapp']): ?>
									<li><a href="<?= $social['whatsapp'] ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/whatsapp.png') ?>" alt="whatsapp"></a></li>
									<?php endif ?>
									<?php if ($social['telegram']): ?>
									<li><a href="<?= $social['telegram'] ?>" target="_blank"><img height="40" width="40" src="<?= base_url('assets/images/telegram.png') ?>" alt="telegram"></a></li>
									<?php endif ?>
								</ul>
							</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>