var alunosApp = (function () {
	var params = {
		tabelaAlunos: null,
		idAlunoARemover: null,
	};
	var selectors = {
		alunosTabelaContainer: "#alunosTabelaContainer",
		alunosTabela: "#alunosTabela",
		editarAlunoModal: "#editarAlunoModal",
		editarAlunoModalContainer: "#editarAlunoModalContainer",
		editarAlunoForm: "#editarAlunoForm",
		cadastrarAlunoModal: "#cadastrarAlunoModal",
		cadastrarAlunoForm: "#cadastrarAlunoForm",
		cadastrarAlunoFormNome: "#novoAlunoNome",
		removerAlunoModalNome: "#removerAlunoModalNome",
		removerAlunoModal: "#removerAlunoModal",
		visualizarAlunoModalContainer: "#visualizarAlunoModalContainer",
		visualizarAlunoModal: "#visualizarAlunoModal",
	};
	var loader = {
		editarAlunoModal: function (id) {
			$.ajax({
				type: "GET",
				url: `${baseUrl}/alunos/editar-aluno-modal/${id}`,
				dataType: "json",
			}).done(function (data) {
				if (data.status) {
					$(selectors.editarAlunoModalContainer).html(data.resposta);
					$(selectors.editarAlunoModal).modal("show");
				} else {
					$.notify(data.resposta, "error");
					 
				}
			});
		},
		tabelaAlunos: function () {
			//cria a tabela de alunos por ajax
			params.tabelaAlunos = $(selectors.alunosTabela).dataTable({
				// processing: true,
				serverSide: true,
				ajax: {
					url: `${baseUrl}/alunos/alunos-tabela`,
					type: "GET",
					dataType: "json",



				},
				columns: [

					{data: null, defaultContent:'' , orderable: false, searchable: false},
					{data: 'nome'},
					{data: 'endereco'},
					{data: null, defaultContent:'', orderable: false, searchable: false},
				],
				columnDefs: [
					{
						targets: 0, // foto do aluno
						className: "text-center",
						render: function (data, type, row, meta) {
							return row.fotoPerfil != '0' ?  // se tiver foto de perfil, mostra a foto
							`<img src="${baseUrl}/fotosDePerfil/${row.id}.jpg?${row.fotoPerfil}" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">` 
							: // se não tiver foto de perfil, mostra a foto padrão
							`<img src="${baseUrl}/assets/images/avatar.jpg" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">`;
						
						}
					},
					{
						targets: 3, // ações da tabela 
						className: "text-center",
						render: function (data, type, row, meta) {
							return `
								<td class="text-center p-0" style="width: 150px;">
									<button class="btn btn-icon pe-1" onclick="alunosApp.visualizarAlunoModal(${row.id})"><i class="ph-eye"></i></button>
									<button class="btn btn-icon px-1" onclick="alunosApp.editarAlunoModal(${row.id})"><i class="ph-pencil"></i></button>
									<button class="btn btn-icon hover-red ps-1" onclick="alunosApp.removerAlunoModal(${row.id},'${row.nome}')"><i class="ph-x"></i></button>
								</td>
							`;
						}
					}
				],

			});
			// $(selectors.alunosTabelaContainer).html(data);
			return;
			
			$.ajax({
				type: "GET",
				url: `${baseUrl}/alunos/alunos-tabela`,
				// dataType: "json",
				cache:false
			}).done(function (data) {
				$(selectors.alunosTabelaContainer).html(data);
				return;
				$(selectors.alunosTabela).dataTable();
				if (data.status) {
					if (params.tabelaAlunos) {
						$(selectors.tabelaAlunos).destroy();
					}
					$(selectors.alunosTabelaContainer).html(data.resposta);
				} else {
					$.notify(data.resposta, "error");
				}
			});
		},
		visualizarAlunoModal: function (id) {
			$.ajax({
				type: "GET",
				url: `${baseUrl}/alunos/visualizar-aluno-modal/${id}`,
				dataType: "json",
			}).done(function (data) {
				if (data.status) {
					$(selectors.visualizarAlunoModalContainer).html(data.resposta)
					$(selectors.visualizarAlunoModal).modal("show");
				} else {
					$.notify(data.resposta, "error");
				}
			});
		},
	};

	return {
		init: function () {
			$.extend($.fn.dataTable.defaults, {
				autoWidth: false,
				responsive: true,
				order: [],
				columnDefs: [ {
					targets  : 'no-sort',
					orderable: false,
				}],
				
				language: {
					// url:`${baseUrl}/assets/plugins/datatables/pt-br.json`,
					info: "Mostrando de _START_ até _END_ de _TOTAL_ alunos",
					infoFiltered: "(Filtrados de _MAX_ alunos)",
					zeroRecords: "Nenhum aluno encontrado",
					search: '<span class="me-3">Filtrar:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
					searchPlaceholder: "Buscar alunos...",
					lengthMenu: '<span class="me-3">Mostrar:</span> _MENU_',
					paginate: {
						first: "Primeiro",
						last: "Ultimo",
						next: document.dir == "rtl" ? "&larr;" : "&rarr;",
						previous: document.dir == "rtl" ? "&rarr;" : "&larr;",
					},
				},
			});
			$(selectors.cadastrarAlunoModal).on("shown.bs.modal", function () {
				$(this).find(selectors.cadastrarAlunoFormNome).focus();
			});
			loader.tabelaAlunos();
		},
		editarAlunoModal: function (id) {
			loader.editarAlunoModal(id);
		},
		editarAluno: function (id) {
			const formData = new FormData($(selectors.editarAlunoForm)[0]);
			$.ajax({
				type: "POST",
				url: `${baseUrl}/alunos/editar-aluno/${id}`,
				dataType: "json",
				processData: false,
				contentType: false,
				cache: false,
				// async: false,
				data: formData,
			}).done(function (data) {
				if (data.status) {
					$.notify(data.resposta, "success");
					$(selectors.editarAlunoModal).modal("hide");
					// console.log($(selectors.alunosTabela).DataTable());
					// recarregar a tabela
					$(selectors.alunosTabela).DataTable().ajax.reload();
				} else {
					$.notify(data.resposta, "error");
				}
			});
			return false;
		},
		cadastrarAlunoModal: function () {
			$(selectors.cadastrarAlunoModal).modal("show");
		},
		cadastrarAluno: function () {
			const formData = new FormData($(selectors.cadastrarAlunoForm)[0]);
			$.ajax({
				type: "POST",
				url: `${baseUrl}/alunos/cadastrar-aluno`,
				dataType: "json",
				processData: false,
				contentType: false,
				cache: false,
				// async: false,
				data: formData,
			}).done(function (data) {
				if (data.status) {
					$.notify(data.resposta, "success");
					$(selectors.cadastrarAlunoModal).modal("hide");
					$(selectors.cadastrarAlunoForm).trigger("reset");
					//recarrega a tabela de alunos
					$(selectors.alunosTabela).DataTable().ajax.reload();
					
				} else {
					$.notify(data.resposta, "error");
				}
			});
			return false;
		},
		removerAlunoModal: function (id, nome) {
			params.idAlunoARemover = id;
			$(selectors.removerAlunoModalNome).text(nome);
			$(selectors.removerAlunoModal).modal("show");
		},
		removerAluno: function () {
			if (!params.idAlunoARemover) {
				$.notify(
					"Algo deu errado, recarregue a página e tente novamente!",
					"error"
				);
				return;
			}
			$.ajax({
				type: "POST",
				url: `${baseUrl}/alunos/remover-aluno/${params.idAlunoARemover}`,
				dataType: "json",
			}).done(function (data) {
				if (data.status) {
					$.notify(data.resposta, "success");
					$(selectors.removerAlunoModal).modal("hide");
					//recarrega a tabela de alunos
					$(selectors.alunosTabela).DataTable().ajax.reload();
				} else {
					$.notify(data.resposta, "error");
				}
				params.idAlunoARemover = null;
			});
		},
		visualizarAlunoModal: function (id) {
			loader.visualizarAlunoModal(id);
		},
		removerFotoDePerfilAluno: function (id) {
			$.ajax({
				type: "POST",
				url: `${baseUrl}/alunos/remover-foto-de-perfil-aluno/${id}`,
				dataType: "json",
			}).done(function (data) {
				if (data.status) {
					$(selectors.editarAlunoModal).modal('hide')
					loader.editarAlunoModal(id);
					//recarrega a tabela de alunos
					$(selectors.alunosTabela).DataTable().ajax.reload();
					$.notify(data.resposta, "success");
				} else {
					$.notify(data.resposta, "error");
				}
			});
		}
	};
})();

$(function () {
	alunosApp.init();
});
