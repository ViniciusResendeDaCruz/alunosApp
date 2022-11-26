var alunosApp = (function () {
	var params = {
		year: $("#year").val(),
		companyCode: $("#companyCode").val(),
		mainFlow: null,
		mainItem: null,
	};
	var selectors = {
		alunosTabelaContainer: "#alunosTabelaContainer",
		alunosTabela: "#alunosTabela",
		editarAlunoModal: "#editarAlunoModal",
		editarAlunoModalContainer: "#editarAlunoModalContainer",
		editarAlunoForm: "#editarAlunoForm",
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
			$.ajax({
				type: "GET",
				url: `${baseUrl}/alunos/alunos-tabela`,
				dataType: "json",
			}).done(function (data) {
				console.log(data.status);
				if (data.status) {
					$(selectors.alunosTabelaContainer).html(data.resposta);

					$(selectors.alunosTabela).dataTable();
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
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				data: formData,
			}).done(function (data) {
                $(selectors.alunosTabelaContainer).html(data.resposta);
				if (data.status) {
					$.notify('data.resposta', "success");
				} else {
					$.notify('data.resposta', "error");
				}
			});
			return false;
		},
	};
})();
$(document).ready(function () {
	alunosApp.init();
});
