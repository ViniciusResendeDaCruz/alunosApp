<?php

namespace App\Models\Alunos;

use CodeIgniter\Model;
/**
 * Classe que faz interface com a tabela alunos do banco de dados
 */
class AlunosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'alunos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nome','endereco','fotoPerfil'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
    protected $deletedField  = 'deletedAt';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Retorna o aluno dado um id
     *
     * @param int $id [id do aluno]
     * @return object|null [aluno]
     */
    public function getAlunoById(int $id):object
    {
        return $this->where('id',$id)->first();
    }
    /**
     * Retorna a quantidade de alunos cadastrados no sistema
     *
     * @return int [quantidade de alunos]
     */
    public function getQtdAlunos() : int
    {
        return $this->select('COUNT(*) as qtd')->first()->qtd;
    }
}
