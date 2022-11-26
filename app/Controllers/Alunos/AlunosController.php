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

    public function editarAluno(int $alunoId): String
    {
        helper('upload');
        $fotoPerfil = $this->request->getFile('fotoPerfil');
        $dadosAluno = $this->request->getPost();
        if ($fotoPerfil->isValid()) { //Se houve envio de arquivo
            if ($fotoPerfil->getMimeType() != 'image/jpeg' or $fotoPerfil->hasMoved()) { //Verifi tipo de arquivo
                return json_encode(['status' => false, 'resposta' => 'Arquivo Inválido']);
            }
            // $path = PUBLICPATH.'uploads/fotosDePerfil/'.$alunoId.'.jpg';
            // if (file_exists($path)) {//se o arquivo já existe(usuário ja tem foto de perfil)
            //     unlink($path); //deleta arquivo
            // }
            //$fotoPerfil->store('fotosDePerfil/', $alunoId.'.jpg'); //Salva a imagem na pasta uploads
            $fotoPerfil->move('fotosDePerfil',$alunoId.'.jpg',true);
        }
        $this->alunosModel->update($alunoId, $dadosAluno);
        try {
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
    public function cadastrarAluno(){
        helper('upload');
        $fotoPerfil = $this->request->getFile('fotoPerfil');
        try {
            $dadosAluno = $this->request->getPost();
            $alunoId = $this->alunosModel->insert($dadosAluno); //insere primeiro para receber o id do aluno
            if ($fotoPerfil->isValid()) { //Se houve envio de arquivo
                if ($fotoPerfil->getMimeType() != 'image/jpeg' or $fotoPerfil->hasMoved()) { //Verifi tipo de arquivo
                    return json_encode(['status' => false, 'resposta' => 'Arquivo Inválido']);
                }
                $fotoPerfil->store('fotosDePerfil/', $alunoId); //Salva a imagem na pasta uploads
            }
            $this->alunosModel->update($alunoId,['fotoPerfil'=>$fotoPerfil]);
            return json_encode([
                'status' => true,
                'resposta' => 'Usuário criado com Sucesso!'
            ]);
        } catch (Exception $e) {
            return json_encode([
                'status' => false,
                'resposta' => $e
            ]); //retorna falha
        }
    }
}
