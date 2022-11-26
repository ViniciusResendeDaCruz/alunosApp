<!-- A tabela será carregada no lado cliente por se tratar de uma aplicação básica. 
* Caso a aplicação fosse maior, com mais registros no banco de dados, a melhor estratégia seria o lado do servidor -->
<table class="table datatable-basic table-striped table-hover table-bordered" id="alunosTabela">
	<thead>
		<tr>
			<th></th>
			<th>Nome</th>
			<th>Endereço</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($alunos as $aluno) : ?>
			<tr>
				<td class="text-center p-0 m-0"> <img class="w-48px h-48px rounded-pill" src="<?php echo file_exists('fotosDePerfil\\' . $aluno->id . '.jpg') ? base_url('fotosDePerfil/' . $aluno->id . '.jpg') : base_url('assets/images/avatar.jpg') ?>"></td>
				<td><?php echo $aluno->nome ?></td>
				<td><?php echo $aluno->endereco ?></td>
				<td class="text-center p-0" style="color: var(--body-color);"><button class="btn btn-light" onclick="alunosApp.editarAlunoModal(<?php echo $aluno->id ?>)"><i class="ph-pencil"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th class="text-center"><a href="#" onclick="" title="Novo Usuário" class="btn btn-light"><i class="ph-plus-circle"></i></a></th>
		</tr>
	</tfoot>
</table>