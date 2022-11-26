<?php

namespace App\Controllers\Alunos;

use App\Controllers\BaseController;
use App\Models\Alunos\AlunosModel;
use Exception;
use PHPUnit\Util\Json;

class AlunosController extends BaseController
{
    private $alunosModel;

    public function __construct()
    {
        $this->alunosModel = new AlunosModel();
    }

    public function alunos(): String
    {
        return view('alunos/home.php');
    }

    public function alunosTabela(): String
    {
        if (!$this->request->isAJAX()) { //Se não for uma requisição AJAX
            return json_encode([
                'status' => false,
                'resposta' => "Metodo não permitido!"
            ]);
        }
        //Se for uma requisição AJAX
        try {
            $alunos = $this->alunosModel->findAll(); //busca alunos no banco de dados
            return json_encode([
                'status' => true,
                'resposta' => view('alunos/tabelas/alunosTabela', ['alunos' => $alunos])
            ]); //retorna sucesso
        } catch (Exception $e) {
            return json_encode([
                'status' => false,
                'resposta' => $e->getMessage()
            ]); //retorna falha
        }
    }
    public function editarAlunoModal(int $id): String
    {
        if (!$this->request->isAJAX()) { //Se não for uma requisição AJAX
            return json_encode([
                'status' => false,
                'resposta' => "Metodo não permitido!"
            ]);
        }
        //Se for uma requisição AJAX
        try {
            $aluno = $this->alunosModel->getAlunoById($id); //busca alunos no banco de dados
            return json_encode([
                'status' => true,
                'resposta' => view('alunos/modal/editarAlunoModal', ['aluno' => $aluno])
            ]); //retorna sucesso
        } catch (Exception $e) {
            return json_encode([
                'status' => false,
                'resposta' => $e->getMessage()
            ]); //retorna falha
        }
    }

    public function editarAluno(int $id): String
    {
        helper('upload');
        $post = $this->request->getPost();
        $fotoPerfil = $this->request->getFile('fotoPerfil');
        if ($fotoPerfil->isValid()) {
            if ($fotoPerfil->getMimeType() != 'image/jpeg' or $fotoPerfil->hasMoved()) {
                return json_encode(['status' => false, 'resposta' => 'Arquivo Inválido']);
            }
            $path = WRITEPATH.'uploads/fotosDePerfil/'.$id.'.jpg';
            if (file_exists($path)) {
                unlink($path);
            }
            $fotoPerfil->store('fotosDePerfil', $id . '.jpg');
            return json_encode([
                'status'=>true,
                'resposta'=>'Usuário Alterado com Sucesso!'
            ]);
            try {
            } catch (Exception $e) {
                return json_encode([
                    'status' => false,
                    'resposta' => $e
                ]); //retorna falha
            }
            return '';
        }
        return "Nenhum arquivo enviado";
    }
}
