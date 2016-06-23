<?php
namespace App\Model;

/**
 * Model Cliente
 *
 * @author Felippe
 */
class Cliente extends BaseModel {
    
    protected $table = 'cliente';
    
    protected $fields = ['id','nome','cpf','telefone','dataNascimento','cidade_id'];
    
    protected $validations = [
        'id' => 'id',
        'nome' => 'notnull',
        'cpf' => 'cpf',
        'telefone' => 'telefone',
        'dataNascimento' => 'date',
        'cidade_id' => 'int'
    ];

    /**
     * Instancia do Model Cidade
     * @var Cidade
     */
    protected $cidade;
    
    public function toDB() {
        //faz tratamento de dados
        $this->telefone = filter_var($this->telefone, FILTER_SANITIZE_NUMBER_INT);
        $dataNascimento = \DateTime::createFromFormat('d/m/Y', $this->dataNascimento);
        
        if($dataNascimento)
        {
            $this->dataNascimento = $dataNascimento->format('Y-m-d');
        }
        else
        {
            throw new \Exception("Data de nascimento inválida");
        }
    }
    
    public function toView() {
        $dataNascimento = \DateTime::createFromFormat('Y-m-d', $this->dataNascimento);
        
        if($dataNascimento)
        {
            $this->dataNascimento = $dataNascimento->format('d/m/Y');
        }
    }
    
    /**
     * Pega a cidade do cliente
     */
    public function getCidade()
    {
        if((!$this->cidade instanceof Cidade) || $this->cidade->id != $this->cidade_id)
        {
            $this->cidade = (new Cidade)->get($this->cidade_id);
        }

        return $this->cidade;
    }

    /**
     * Remove o cliente
     * @return boolean
     * @throws \Exception
     */
    public function delete()
    {
        //não podem haver contratos vinculados
        $contrato = (new \App\Model\Contrato())->getContratosPorCliente($this->id);
        if(!empty($contrato))
        {
            throw new \Exception("Não é possível remover um cliente com contratos vinculados");
        }

        return parent::delete();
    }
}
