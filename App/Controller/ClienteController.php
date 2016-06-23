<?php
namespace App\Controller;
use App\Model\Cliente;
use App\Model\Estado;

/**
 * Controller para Clientes
 * 
 * @author Felippe
 */
class ClienteController extends BaseController implements ICrudController
{    
    /**
     * Action inicial
     */
    public function index()
    {
        $cliente = new Cliente;

        $clientes = $cliente->all($this->pageNum, $this->pageSize);
        $this->template->show('cliente', 'index', [
            'clientes'=> $clientes,
            'numElements' => $cliente->getTotalCount(),
            'pageSize' => $this->pageSize,
            'pageNum' => $this->pageNum,
        ]);
    }
    
    /**
     * Cria um novo cliente
     */
    public function create()
    {
        $cliente = new Cliente;
        
        try
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if($cliente->fill($_POST))
                {
                    $cliente->save();
                    return $this->redirect('cliente', 'index', 'Cliente cadastrado com sucesso.');                    
                }
            }
        }
        catch (\Exception $e)
        {
            $cliente->toView();
            $this->template->setErro('Ocorreu um erro ao cadastrar o cliente: '.$e->getMessage());
        }
        
        $this->template->show('cliente', 'create', [
            'action' => 'create',
            'cliente'=> $cliente,
            'estados' => (new Estado())->all()
        ]);
    }

    /**
     * Exibe os dados do cliente
     * @param int $id
     */
    public function read($id)
    {
        $cliente = new Cliente();
        $cliente->get($id);

        $contratos = (new \App\Model\Contrato())->getContratosPorCliente($id);
        
        $this->template->show('cliente', 'read', [
            'cliente' => $cliente,
            'contratos' => $contratos
        ]);
    }

    /**
     * Edita um cliente
     * @param int $id
     */
    public function update($id)
    {
        $cliente = new Cliente();
        $cliente->get($id);

        try
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if($cliente->fill($_POST))
                {
                    $cliente->save();
                    return $this->redirect('cliente', 'index', 'Cliente atualizado com sucesso.');
                }
            }
        }
        catch (\Exception $e)
        {
            $cliente->toView();
            $this->template->setErro('Ocorreu um erro ao atualizar o cliente: '.$e->getMessage());
        }
        
        $this->template->show('cliente', 'update', [
            'action' => 'update/id/'.$id,
            'cliente'=> $cliente,
            'estados' => (new Estado())->all()
        ]);
    }
    
    /**
     * Remove os dados do cliente
     * @param int $id
     */
    public function delete($id)
    {
        $cliente = (new Cliente())->get($id);

        if(empty($cliente->id))
        {
            $this->redirect('cliente', 'index','Cliente não encontrado');
        }
        else
        {
            try
            {
                $cliente->delete();
                return $this->redirect('cliente', 'index','Cliente removido com sucesso');
            }
            catch (\Exception $e)
            {
                return $this->redirect('cliente', 'index','Ocorreu um erro ao remover o cliente: '.$e->getMessage());
            }
        }

    }
}
