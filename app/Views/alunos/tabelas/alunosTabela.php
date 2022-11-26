<!-- A tabela será carregada no lado cliente por se tratar de uma aplicação básica. 
* Caso a aplicação fosse maior, com mais registros no banco de dados, a melhor estratégia seria o lado do servidor -->
<table class="table datatable-basic table-striped table-hover table-bordered" id="alunosTabela">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Endereço</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($alunos as $aluno): ?>
		<tr>
			<td><?php echo $aluno->nome ?></td>
			<td><?php echo $aluno->endereco ?></td>
			<td class="text-center" style="color: var(--body-color);"><button class="btn btn-link" onclick="alunosApp.editarAlunoModal(<?php echo $aluno->id ?>)"><i class="ph-pencil"></i></button></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>