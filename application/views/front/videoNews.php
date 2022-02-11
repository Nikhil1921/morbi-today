<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="block-content">
					<div class="single-post-box">
						<div class="grid-box">
							<div class="title-section">
								<h1><span class="world">Video News</span></h1>
							</div>
							<div style="text-align:center;">
								<div style="display:none;margin:0 auto;" class="html5gallery" data-skin="vertical" data-width="400" data-height="225" data-resizemode="fill">
									<?php if (isset($mainNews)): $image = explode('/', $mainNews['link']) ?>
									<a href="<?= $mainNews['link']; ?>">
										<img src="https://img.youtube.com/vi/<?= end($image) ?>/hqdefault.jpg" alt="Youtube Video">
									</a>
									<?php endif ?>
									<?php foreach ($videos as $vid): $img = explode('/', $vid['link']) ?>
									<?php if (isset($mainNews) && $vid['id'] == $mainNews['id']): continue; endif ?>
									<a href="<?= $vid['link']; ?>">
										<img src="https://img.youtube.com/vi/<?= end($img) ?>/hqdefault.jpg" alt="Youtube Video">
									</a>
									<?php endforeach ?>
								</div>
							</div>
							<br>
							<div class="row">
								<?php foreach ($videos as $vid): $img = explode('/', $vid['link']) ?>
								<?php
								$videoid = end($img);
								$apikey = 'AIzaSyBXOXJIQLVD8FFSRDeiJpNub4S1ipzcKRQ';
								$json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=' . $videoid . '&key=' . $apikey . '&part=snippet');
								$data = json_decode($json, true);
								$title = $data['items'][0]['snippet']['title'];
								?>
								<div class="col-md-2">
									<div class="video-post">
										<a href="<?= base_url('video?vid='.e_id($vid['id'])) ?>">
											<img src="https://img.youtube.com/vi/<?= end($img) ?>/default.jpg" alt="Youtube Video">
											<p><?= $title ?></p>
										</a>
									</div>
								</div>
								<?php endforeach ?>
							</div>
						</div>
						<br>
						<div class="jumbotron">
							<div class="share-post-box">
								<div class="title-section">
									<h1><span class="world">MORBI TODAY SOCIAL MEDIA PLATFORM</span></h1>
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
									<h1><span class="world">JOIN OUR GROUP</span></h1>
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
			<div class="col-sm-4">
				<div class="sidebar">
					<?php $this->load->view('front/recent_news') ?>
				</div>
			</div>
		</div>
	</section>