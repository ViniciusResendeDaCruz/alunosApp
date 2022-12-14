<!-- A tabela será carregada no lado cliente por se tratar de uma aplicação básica. 
* Caso a aplicação fosse maior, com mais registros no banco de dados, a melhor estratégia seria o lado do servidor -->
<table class="table datatable-basic table-striped table-hover table-bordered display no-wrap" id="alunosTabela">
	<thead>
		<tr>
			<th class="text-center no-sort">Foto</th>
			<th>Nome</th>
			<th>Endereço</th>
			<th class="text-center no-sort" >Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($alunos as $aluno) : ?>
			<tr>
				<td class="text-center p-1 no-sort"> <img class="w-48px h-48px rounded-pill img-pill-cover" src="<?php echo file_exists('fotosDePerfil/' . $aluno->id . '.jpg') ? base_url('fotosDePerfil/' . $aluno->id . '.jpg?'.filemtime('fotosDePerfil/' . $aluno->id . '.jpg')) : base_url('assets/images/avatar.jpg') ?>"></td>
				<td><?php echo $aluno->nome ?></td>
				<td><?php echo $aluno->endereco ?></td>
				<td class="text-center p-0" style="width: 150px;">
					<button class="btn btn-icon pe-1" onclick="alunosApp.visualizarAlunoModal(<?php echo $aluno->id ?>)"><i class="ph-eye"></i></button>
					<button class="btn btn-icon px-1" onclick="alunosApp.editarAlunoModal(<?php echo $aluno->id ?>)"><i class="ph-pencil"></i></button>
					<button class="btn btn-icon hover-red ps-1" onclick="alunosApp.removerAlunoModal(<?php echo $aluno->id . ',\'' . $aluno->nome . '\'' ?>)"><i class="ph-x"></i></button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th class="text-center"><a href="#" onclick="alunosApp.cadastrarAlunoModal()" title="Novo Usuário" class="btn btn-light"><i class="ph-plus-circle"></i></a></th>
		</tr>
	</tfoot>
</table>