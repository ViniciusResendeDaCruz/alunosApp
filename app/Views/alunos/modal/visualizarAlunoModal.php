<div id="visualizarAlunoModal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo explode(' ', $aluno->nome)[0] ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			
			
			<div class="modal-body d-flex justify-content-center align-items-center">

						<div class="text-center">
							<div>
								<img  class="circle" src="<?php echo file_exists('fotosDePerfil/' . $aluno->id . '.jpg') ? base_url('fotosDePerfil/' . $aluno->id . '.jpg') : base_url('assets/images/avatar.jpg') ?>" alt="" >
							</div>
						</div>
						
			
						<div class="fs-2 m-3">
							<p><b>Nome:</b> <?php echo $aluno->nome ?></p>
							<hr>
							<p><b>Endereço:</b> <?php echo $aluno->endereco ?></p>
							<hr>
							<p><b>ID:</b> <?php echo $aluno->id ?></p>
						</div>
					
				</div>

				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Editar Aluno</button>
				</div> -->

		</div>
	</div>
</div>