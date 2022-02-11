<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="block-content">
					<div class="single-post-box">
						<div class="grid-box">
							<div class="title-section">
								<h1><span class="world">Facebook Posts</span></h1>
							</div>
							<div class="row">
								<div class="col-md-8">
									<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fmorbitodaynews&tabs=timeline&width=560&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=338557840957387" width="560" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
								</div>
							</div>
						</div>
						<br>
						<div class="jumbotron">
							<div class="share-post-box">
								<ul class="share-box">
									<li><i class="fa fa-share-alt"></i><span>મોરબી ટુડે ને સોશ્યિલ મીડિયા પર ફોલો કરો.</span></li><br><br>
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
								<ul class="share-box">
									<li><i class="fa fa-share-alt"></i><span>અમારા ગ્રુપ માં જોડાવા માટે અહીં ક્લીક કરો.</span></li><br><br>
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