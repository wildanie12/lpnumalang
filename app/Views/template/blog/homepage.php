<?php $this->extend('template/guest'); ?>

<?php $this->section('content'); ?>
<div class="container margin-top-guest">
	<div class="row">
		<div class="col-lg-8">
			<?php $this->renderSection('content')?>
		</div> <!-- end content -->

		<!--   WIDGET -->
		<div class="col-lg-4 mt-4 mt-lg-0">
			<?php $this->renderSection('widget') ?>
		</div> <!-- end widget -->
	</div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('jsContent') ?>
<?php $this->renderSection('jsContent') ?>
<?php $this->endSection(); ?>