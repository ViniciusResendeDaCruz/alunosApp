<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Alunos\AlunosModel;

class Home extends BaseController
{
    private $alunosModel;

    public function __construct()
    {
        $this->alunosModel = new AlunosModel();
    }
    public function index()
    {
        return view('home', [
            'qtdAlunos' => $this->alunosModel->getQtdAlunos()
        ]);
    }
}
