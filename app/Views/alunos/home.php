<?php echo $this->extend('common/layout'); ?>

<?php echo $this->section('head'); ?>
	<script src="<?php echo base_url('assets/plugins/datatables/datatables.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/plugins/notify/notify.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/alunos/alunos.js') ?>"></script>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<div id="editarAlunoModalContainer"></div>
<div class="card">
	<div class="card-header">
		<h4 class="mb-0">Alunos</h4>
	</div>

	<div class="card-body">
		<div id="alunosTabelaContainer"></div>
	</div>
</div>
<?php echo $this->endSection(); ?>