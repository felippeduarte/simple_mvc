<?php
namespace App\Controller;
use App\Model\Cidade;

/**
 * Controller Cidades
 * 
 * @author Felippe
 */
class CidadeController extends BaseController
{
    public function index()
    {
        
    }

    /**
     * Ajax para buscar as cidades por Estado
     * @param int $estado_id
     * @return array
     */
    public function ajaxGetCidadesPorEstado($estado_id)
    {
        $cidade = new Cidade;
        $estados = $cidade->getCidadesPorEstado($estado_id);
        
        echo json_encode($estados);
    }
}
