 <div id="editarAlunoModal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editar <?php echo explode(' ', $aluno->nome)[0] ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<?php echo form_open_multipart('editarAluno',['id'=>'editarAlunoForm','onsubmit'=>'return alunosApp.editarAluno('.$aluno->id.')']) ?>
			<!-- <form action="POST" action="editar-aluno" enctype="multipart/form-data" id="editarAlunoForm"> -->
				<div class="modal-body">
					<div class="mb-3">
						<div class="row">
							<div class="col-sm-12">
								<label class="form-label">Nome</label>
								<input type="text" value="<?php echo $aluno->nome ?>" class="form-control" name="nome" required>
							</div>
						</div>
					</div>

					<div class="mb-3">
						<div class="row">
							<div class="col-sm-12">
								<label class="form-label">Endereco</label>
								<input type="text" value="<?php echo $aluno->endereco ?>" class="form-control" name="endereco" required>
								
							</div>
						</div>
					</div>
					<div class="mb-3">
						<div class="row">
							<div class="col-sm-12">
								<label for="foto_perfil">Foto de perfil</label>
								<input type="file" class="form-control" accept="image/*" name="fotoPerfil" id="fotoPerfil">
								<small class="mt-0">*Prefira imagens de proporção 3x4</small>
							</div>
						</div>
					</div>

					<div class="mb-3 text-center">
						<div>
							<img src="<?php echo file_exists('fotosDePerfil/' . $aluno->id . '.jpg') ? base_url('fotosDePerfil/' . $aluno->id . '.jpg') : base_url('assets/images/avatar.jpg') ?>" alt="" class="rounded w-50 text-center">
						</div>
						<?php if(file_exists('fotosDePerfil/' . $aluno->id . '.jpg')): ?>
							<small><button type="button" onclick="alunosApp.removerFotoDePerfilAluno(<?php echo $aluno->id ?>)" class="btn btn-link text-light">Remover imagem de perfil</button></small>
						<?php endif ?>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Editar Aluno</button>
				</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>