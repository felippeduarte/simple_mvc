<?php
namespace App\Controller;
use App\Model\Contrato;
use App\Model\Cliente;

/**
 * Controller para Contratos
 * 
 * @author Felippe
 */
class ContratoController extends BaseController implements ICrudController
{    
    /**
     * Action inicial
     */
    public function index()
    {
        $contrato = new Contrato;

        $contratos = $contrato->all($this->pageNum, $this->pageSize);
        $this->template->show('contrato', 'index', [
            'contratos'=> $contratos,
            'numElements' => $contrato->getTotalCount(),
            'pageSize' => $this->pageSize,
            'pageNum' => $this->pageNum,
        ]);
    }
    
    /**
     * Cria um novo contrato
     */
    public function create()
    {
        $contrato = new Contrato;
        
        try
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if($contrato->fill($_POST))
                {
                    $contrato->save();
                    return $this->redirect('contrato', 'index', 'Contrato cadastrado com sucesso.');                    
                }
            }
        }
        catch (\Exception $e)
        {
            $contrato->toView();
            $this->template->setErro('Ocorreu um erro ao cadastrar o contrato: '.$e->getMessage());
        }
        
        $this->template->show('contrato', 'create', [
            'action' => 'create',
            'contrato'=> $contrato,
            'clientes' => (new Cliente())->all()
        ]);
    }

    /**
     * Exibe os dados do contrato
     * @param int $id
     */
    public function read($id)
    {
        $contrato = new Contrato();
        $contrato->get($id);

        $contratos = (new \App\Model\Contrato())->getContratosPorCliente($id);
        
        $this->template->show('contrato', 'read', [
            'contrato' => $contrato,
            'contratos' => $contratos
        ]);
    }

    /**
     * Edita um contrato
     * @param int $id
     */
    public function update($id)
    {
        $contrato = new Contrato();
        $contrato->get($id);

        try
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if($contrato->fill($_POST))
                {
                    $contrato->save();
                    return $this->redirect('contrato', 'index', 'Contrato atualizado com sucesso.');
                }
            }
        }
        catch (\Exception $e)
        {
            $contrato->toView();
            $this->template->setErro('Ocorreu um erro ao atualizar o contrato: '.$e->getMessage());
        }
        
        $this->template->show('contrato', 'update', [
            'action' => 'update/id/'.$id,
            'contrato'=> $contrato,
            'clientes' => (new Cliente())->all()
        ]);
    }
    
    /**
     * Remove os dados do contrato
     * @param int $id
     */
    public function delete($id)
    {
        $contrato = (new Contrato())->get($id);

        if(empty($contrato->id))
        {
            $this->redirect('contrato', 'index','Contrato não encontrado');
        }
        else
        {
            try
            {
                $contrato->delete();
                return $this->redirect('contrato', 'index','Contrato removido com sucesso');
            }
            catch (\Exception $e)
            {
                return $this->redirect('contrato', 'index','Ocorreu um erro ao remover o contrato: '.$e->getMessage());
            }
        }

    }
}
