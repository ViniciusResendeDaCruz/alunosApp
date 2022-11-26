var alunosApp = (function () {
	var params = {
		tabelaAlunos: null,
	};
	var selectors = {
		alunosTabelaContainer:              "#alunosTabelaContainer",
        alunosTabela:                       "#alunosTabela",
		editarAlunoModal:                   "#editarAlunoModal",
		editarAlunoModalContainer:          "#editarAlunoModalContainer",
		editarAlunoForm:                    "#editarAlunoForm",
        cadastrarAlunoModal:                "#cadastrarAlunoModal",
        cadastrarAlunoForm:                 "#cadastrarAlunoForm",
        cadastrarAlunoFormNome:             "#novoAlunoNome"
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
				if (data.status) {
                    if (params.tabelaAlunos) {
                        $(selectors.tabelaAlunos).destroy();
                    }
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
                responsive:true,
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
            $(selectors.cadastrarAlunoModal).on('shown.bs.modal', function(){
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
                dataType:'json',
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				data: formData,
			}).done(function (data) {
                console.log(data.status);
				if (data.status) {
					$.notify(data.resposta, "success");
                    $(selectors.editarAlunoModal).modal('hide')
                    loader.tabelaAlunos();
				} else {
					$.notify(data.resposta, "error");
				}
			});
			return false;
		},
        cadastrarAlunoModal: function () {
            $(selectors.cadastrarAlunoModal).modal('show');
            
            
        },
        cadastrarAluno: function () {
            const formData = new FormData($(selectors.cadastrarAlunoForm)[0]);
			$.ajax({
				type: "POST",
				url: `${baseUrl}/alunos/cadastrar-aluno`,
                dataType:'json',
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				data: formData,
			}).done(function (data) {
                console.log(data.status);
				if (data.status) {
					$.notify(data.resposta, "success");
                    $(selectors.cadastrarAlunoModal).modal('hide')
                    $(selectors.cadastrarAlunoForm).trigger("reset");
                    loader.tabelaAlunos();
				} else {
					$.notify(data.resposta, "error");
				}
			});
			return false;
        }
	};
})();

$(function () {
	alunosApp.init();
});
