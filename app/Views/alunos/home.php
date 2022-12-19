<?php echo $this->extend('common/layout'); ?>

<?php echo $this->section('head'); ?>
<script src="<?php echo base_url('assets/plugins/datatables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/notify/notify.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/blockui/blockui.js') ?>"></script>

<script src="<?php echo base_url('assets/js/alunos/alunos.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/alunos.css') ?>">
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>

<!-- Modal cadastrar Aluno -->
<div id="cadastrarAlunoModal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Adicionar novo aluno</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<?php echo form_open_multipart('cadastrar-aluno', ['id' => 'cadastrarAlunoForm', 'onsubmit' => 'return alunosApp.cadastrarAluno()']) ?>
			<div class="modal-body">
				<div class="mb-3">
					<div class="row">
						<div class="col-sm-12">
							<label for="novoAlunoNome" class="form-label">Nome<span class="text-danger">*</span></label>
							<input type="text" placeholder="Insira o endereço" class="form-control" name="nome" id="novoAlunoNome" required>
						</div>
					</div>
				</div>

				<div class="mb-3">
					<div class="row">
						<div class="col-sm-12">
							<label for="novoAlunoEndereco" class="form-label">Endereco<span class="text-danger">*</span></label>
							<input type="text" placeholder="Insira o endereço" class="form-control" name="endereco" id="novoAlunoEndereco" required>

						</div>
					</div>
				</div>
				<div class="mb-3">
					<div class="row">
						<div class="col-sm-12">
							<label for="foto_perfil">Foto de perfil</label>
							<input type="file" class="form-control" accept="image/*" name="fotoPerfil" id="fotoPerfil" placeholder="Apenas arquivos .jpg">
							<small class="mt- text-grey ms-1">*Apenas arquivo .jpg</small>

						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Cadastrar Aluno</button>
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>
<!-- /Modal cadastrar Aluno -->

<!-- Modal remover Aluno -->
<div id="removerAlunoModal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Remover Aluno</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<div class="modal-body">
				Tem certeza que deseja remover o aluno <span id="removerAlunoModalNome" class="text-danger">Inválido</span>?
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancelar</button>
				<button type="button" onclick="alunosApp.removerAluno()" class="btn btn-primary">Remover Aluno</button>
			</div>

		</div>
	</div>
</div>
<!-- /Modal remover Aluno -->

<!-- Modal visualizar Aluno -->
<div id="visualizarAlunoModalContainer"></div>
<!-- /Modal visualizar Aluno -->

<!-- Modal editar Aluno -->
<div id="editarAlunoModalContainer"></div>
<!-- /Modal editar Aluno -->

<div class="card">
	<div class="card-header">
		<div class="d-flex justify-content-between align-items-center">
			<h4 class="mb-0">Gerenciar alunos</h4>
			<button href="#" onclick="alunosApp.cadastrarAlunoModal()" title="Novo Usuário" class="btn btn-light"><i class="ph-plus me-1"></i>Adicionar novo aluno</butt>
		</div>
	</div>

	<div class="card-body">
		<!-- Tabela de Aluno -->
		<div id="alunosTabelaContainer"></div>
		<table class="table datatable-basic table-striped table-hover table-bordered display no-wrap" id="alunosTabela">
			<thead>
				<tr>
					<th class="text-center no-sort">Foto</th>
					<th>Nome</th>
					<th>Endereço</th>
					<th class="text-center no-sort">Ações</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		<!-- /Tabela de Aluno -->
	</div>
</div>
<?php echo $this->endSection(); ?>