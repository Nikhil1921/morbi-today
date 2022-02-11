<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block-content">
					<div class="contact-form-box single-post-box">
						<div class="title-post">
							<h1><?= $title ?></h1>
						</div>
							<p>"આપના માટે અવસર": મોરબી શહેર અને જીલ્લાના કોઇપણ વિસ્તારમાંથી તમે તમારા નામ સહિતની વિગત સાથે મોરબી ટુડેમાં ફોટો અને માહિતી સાથે સમાચાર તેમજ લોકો માટે જાણવા જેવા અન્ય મહિતીસભર આર્ટીકલ પણ મોકલાવી શકો છો.</p>
						<form id="contact-form" method="post" enctype="multipart/form-data" >
							<div class="row">
								<div class="col-md-6">
									<label for="name">Name*</label>
									<input id="name" name="name" value="<?= set_value('name') ?>" type="text">
									<?= form_error('name') ?>
								</div>
								<div class="col-md-6">
									<label for="email">E-mail*</label>
									<input id="email" name="email" value="<?= set_value('email') ?>" type="text">
									<?= form_error('email') ?>
								</div>
								<div class="col-md-6">
									<label for="place">Place</label>
									<input id="place" name="place" value="<?= set_value('place') ?>" type="text">
									<?= form_error('place') ?>
								</div>
								<div class="col-md-6">
									<label for="mobile">Mobile Number</label>
									<input id="mobile" name="mobile" value="<?= set_value('mobile') ?>" type="text" maxlength="10">
									<?= form_error('mobile') ?>
								</div>
								<div class="col-md-3">
									<label for="image1">Image (Please upload jpg, jpeg or png only)</label>
									<input id="image1" name="image1" type="file" maxlength="10">
								</div>
								<div class="col-md-3">
									<label for="image2">Image (Please upload jpg, jpeg or png only)</label>
									<input id="image2" name="image2" type="file" maxlength="10">
								</div>
								<div class="col-md-3">
									<label for="image3">Image (Please upload jpg, jpeg or png only)</label>
									<input id="image3" name="image3" type="file" maxlength="10">
								</div>
							</div><br>
							<label for="article">Your Article*</label>
							<textarea id="article" name="article"><?= set_value('article') ?></textarea>
							<?= form_error('article') ?>
							<button type="submit" id="submit-contact">
							<i class="fa fa-paper-plane"></i> <?= $title ?>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>