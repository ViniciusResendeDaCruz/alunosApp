<?php

namespace App\Controllers\Alunos;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use App\Models\Alunos\AlunosModel;
use Exception;

/**
 * Classe que trata as requisições de e das views relacionados aos alunos
 */
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
        return view('alunos/home');
    }
    /**
     * Monta e retorna a tabela de alunos
     *
     * @return String [JSON]
     */
    public function alunosTabela()
    {
        if (!$this->request->isAJAX()) { //Se não for uma requisição AJAX
            return json_encode([
                'status' => false,
                'resposta' => "Metodo não permitido!"
            ]);
        }
        //Se for uma requisição AJAX
        try {
            $alunos = $this->alunosModel->select('id,nome,endereco,fotoPerfil')->where('deletedAt',null); //busca alunos no banco de dados já ordenados pelo nome e sem os deletados
            // dd($alunos->findAll());

            return DataTable::of($this->alunosModel)->toJson(true);
            
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
                if ($fotoPerfil->getMimeType() != 'image/jpeg' or $fotoPerfil->hasMoved()) { //Verifica tipo de arquivo
                    return json_encode(['status' => false, 'resposta' => 'Arquivo Inválido']);
                }
                $fotoPerfil->move('fotosDePerfil',$alunoId.'.jpg',true);
                $dadosAluno['fotoPerfil'] = filemtime('fotosDePerfil/' . $alunoId . '.jpg'); //Marca que o aluno tem foto de perfil e salva a data de modificação do arquivo
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
            if ($fotoPerfil->getMimeType() != 'image/jpeg' or $fotoPerfil->hasMoved()) { //Verifica tipo de arquivo
                return json_encode(['status' => false, 'resposta' => 'Arquivo Inválido']);
            }
            $fotoPerfil->move('fotosDePerfil',$alunoId.'.jpg',true);
            $this->alunosModel->update($alunoId, ['fotoPerfil' => filemtime('fotosDePerfil/' . $alunoId . '.jpg')]); //Marca que o aluno possui foto de perfil e atualiza a data de modificação 
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
        if (!$this->request->isAJAX()) { //Se não for uma requisição AJAX
            return json_encode([
                'status' => false,
                'resposta' => "Metodo não permitido!"
            ]);
        }
        //Se for uma requisição AJAX
        try {
            if (file_exists('fotosDePerfil/'.$id .'.jpg')) { //Se o aluno tiver foto de perfil
                unlink('fotosDePerfil/'.$id .'.jpg'); //Removo foto de perfil do sistema
            }
            $this->alunosModel->delete($id); //Realiza a remoção no banco de dados
            return json_encode([ 
                'status'=>true,
                'resposta'=>"Usuário removido com sucesso!"
            ]);//retorna sucesso
        } catch (Exception $e) {
            return json_encode([ 
                'status'=>false,
                'resposta'=>$e->getMessage()
            ]);//retorna falha
        }
    }
    /**
     * Retorna o modal de visualização de aluno
     *
     * @param int $id [id do aluno a ser visualizado]
     * @return String [JSON]
     */
    public function visualizarAlunoModal(int $id) : String
    {
        if (!$this->request->isAJAX()) { //Se não for uma requisição AJAX
            return json_encode([
                'status' => false,
                'resposta' => "Metodo não permitido!"
            ]);
        }
        //Se for uma requisição AJAX
        try {
            $aluno = $this->alunosModel->getAlunoById($id);
            return json_encode([
                'status'=>true,
                'resposta'=>view('alunos/modal/visualizarAlunoModal',['aluno'=>$aluno])
            ]);
        } catch (Exception $e) {
            return json_encode([
                'status'=>false,
                'resposta'=>$e->getMessage()
            ]);
        }
    }
    /**
     * Remove a foto de perfil de um aluno do sistema
     *
     * @param int $id [id do aluno a remover sua foto de perfil do sistema]
     * @return String [JSON]
     */
    public function removerFotoDePerfilAluno(int $id):String
    {
        try {
            unlink('fotosDePerfil/'.$id.'.jpg');
            $this->alunosModel->update($id,['fotoPerfil'=>null]); //Realiza alteração no banco de dados 
            return json_encode([
                'status'=>true,
                'resposta'=>'Foto de perfil removida com sucesso'
            ]);
        } catch (Exception $e) {
            return json_encode([
                'status'=>false,
                'resposta'=>$e->getMessage()
            ]);
        }
    }
}
