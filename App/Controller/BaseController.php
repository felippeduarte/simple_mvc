<?php
namespace App\Controller;
use Framework\Template;

/**
 * Classe base para controllers
 * 
 * @author Felippe
 */
abstract class BaseController
{
    /**
     * Numero da pagina
     * @var int
     */
    protected $pageNum = 1;

    /**
     * Numero de registros por pagina
     * @var int
     */
    protected $pageSize = 10;

    /**
     * Objeto template
     * @var Template
     */
    protected $template;
    
    /**
     * Construtor
     * @param Template $template
     */
    public function __construct(Template $template)
    {
        $this->template = $template;
    }
    
    /**
     * Controllers precisam ter um metodo index
     */
    abstract function index();
    
    /**
     * Redireciona para outra action
     * @param string $controller
     * @param string $action
     * @param string $error
     */
    public function redirect($controller, $action, $error = null)
    {
        $this->template->setErro($error);
        
        header("Location: /".$controller."/".$action);
    }

    /**
     * Define o número da página
     * @param int $num
     */
    public function setPageNum($num)
    {
        $this->pageNum = $num;
    }
}