<?php
namespace Framework;
use App\Controller;

/**
 * Classe para implementar o padrão Front Controller
 * 
 * @author Felippe
 */
class FrontController {

    /**
     * Caminho físico do controller
     * @var string
     */
    private $path;
    
    /**
     * Objeto de template
     * @var Template
     */
    private $template;
    
    /**
     * Arquivo físico do controller
     * @var string
     */
    public $file;
    
    /**
     * Nome do controller
     * @var string
     */
    public $controller;
    
    /**
     * Nome da action
     * @var string
     */
    public $action; 

    /**
     * Parametros extras
     * @var array
     */
    public $params = array();
    
    /**
     * Construtor
     * @param \Framework\Template $template
     */
    public function __construct(Template $template)
    {
        $this->template = $template;
    }
    
    /**
     * Define o caminho físico do controller
     * @param string $path
     * @throws Exception
     */
    public function setPath($path)
    {
        if (is_dir($path) == false)
        {
            throw new \Exception('Caminho para controller invalido: `' . $path . '`');
        }

        $this->path = $path;
    }

    /**
     * Carrega o controller e a action
     */
    public function loadAction()
    {
        $this->getController();
        
        include $this->file;

        $class = "App\\Controller\\".$this->controller . 'Controller';
        $controller = new $class($this->template);

        $pageNum = isset($_GET['page'])&&($_GET['page'] == (int)$_GET['page']) ? (int)$_GET['page'] : 1;
        $controller->setPageNum($pageNum);

        //aciona a action, ou chama o index por padrão
        $action =  is_callable(array($controller, $this->action)) ?
             $this->action : 'index';

        //executa a action
        $controller->$action($this->params[0]);
    }

    /**
     * Pega o controller e action de acordo com url passada
     */
    private function getController()
    {
        $route = (empty($_GET['path'])) ? '' : $_GET['path'];

        if (empty($route))
        {
            $route = 'home';
        }
        
        //busca controller e action
        $params = explode('/', $route);
        $this->controller = (isset($params[0]) && !empty($params[0])) ?
                ucfirst($params[0]) : 'Home';

        $this->action = (isset($params[1]) && !empty($params[1])) ?
                $params[1] : 'index';

        for($i=3; $i<count($params); $i+=2)
        {
            if(isset($params[$i]) && !empty($params[$i]))
            {
                $this->params[] = $params[$i];
            }
        }
        
        if(empty($this->params)) {
            $this->params[0] = null;
        }
        
        $this->file = $this->path .'/'. $this->controller . 'Controller.php';
   }
}