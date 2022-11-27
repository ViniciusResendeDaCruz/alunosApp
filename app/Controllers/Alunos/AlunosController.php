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
    /**
     * Retorna a tela de gerenciamento de alunos
     *
     * @return String [HTML]
     */
    public function alunos(): String
    {
        return view('alunos/home.php');
    }
    /**
     * Monta e retorna a tabela de alunos
     *
     * @return String [JSON]
     */
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
            $alunos = $this->alunosModel->groupBy('nome')->findAll(); //busca alunos no banco de dados já ordenados pelo nome
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

    /**
     * Monta e retorna o modal para edição de aluno
     *
     * @param int $id [id do aluno a ser alterado]
     * @return String [JSON]
     */
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
    /**
     * Edita os dados do aluno no banco de dados
     *
     * @param integer $id [id do aluno a ser alterado]
     * @return String [JSON]
     */
    public function editarAluno(int $alunoId): String
    {
        if (!$this->request->isAJAX()) { //Se não for uma requisição AJAX
            return json_encode([
                'status' => false,
                'resposta' => "Metodo não permitido!"
            ]);
        }
        //Se for uma requisição AJAX
        try {
            helper('upload');
            $fotoPerfil = $this->request->getFile('fotoPerfil');
            $dadosAluno = $this->request->getPost();
            if ($fotoPerfil->isValid()) { //Se houve envio de arquivo
                if ($fotoPerfil->getMimeType() != 'image/jpeg' or $fotoPerfil->hasMoved()) { //Verifi tipo de arquivo
                    return json_encode(['status' => false, 'resposta' => 'Arquivo Inválido']);
                }
                $fotoPerfil->move('fotosDePerfil',$alunoId.'.jpg',true);
            }
            $this->alunosModel->update($alunoId, $dadosAluno); //Realiza alteração no banco de dados
            return json_encode([
                'status' => true,
                'resposta' => 'Usuário Alterado com Sucesso!'
            ]);
        } catch (Exception $e) {
            return json_encode([
                'status' => false,
                'resposta' => $e
            ]); //retorna falha
        }
    }

    /**
     * Cadastra um novo aluno no banco de dados
     *
     * @return String [JSON]
     */
    public function cadastrarAluno() : String
    {
        if (!$this->request->isAJAX()) { //Se não for uma requisição AJAX
            return json_encode([
                'status' => false,
                'resposta' => "Metodo não permitido!"
            ]);
        }
        //Se for uma requisição AJAX
        helper('upload');
        $fotoPerfil = $this->request->getFile('fotoPerfil');
        $dadosAluno = $this->request->getPost();

        $alunoId = $this->alunosModel->insert($dadosAluno); //realiza inserção no banco de dados
        if ($fotoPerfil->isValid()) { //Se houve envio de arquivo
            if ($fotoPerfil->getMimeType() != 'image/jpeg' or $fotoPerfil->hasMoved()) { //Verifi tipo de arquivo
                return json_encode(['status' => false, 'resposta' => 'Arquivo Inválido']);
            }
            $fotoPerfil->move('fotosDePerfil',$alunoId.'.jpg',true);
        }
        try {
            return json_encode([
                'status' => true,
                'resposta' => 'Usuário Cadastrado com Sucesso!'
            ]);
        } catch (Exception $e) {
            return json_encode([
                'status' => false,
                'resposta' => $e
            ]); //retorna falha
        }
    }

    /**
     * Remove um aluno do banco de dados
     *
     * @param int $id [id do aluno a ser removido]
     * @return String [JSON]
     */
    public function removerAluno(int $id) : String
    {
        try {
            $this->alunosModel->delete($id);
            return json_encode([
                'status'=>true,
                'resposta'=>"Usuário removido com sucesso!"
            ]);
        } catch (Exception $e) {
            return json_encode([
                'status'=>false,
                'resposta'=>$e->getMessage()
            ]);
        }
    }
}
