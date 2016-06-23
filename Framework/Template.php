<?php
namespace Framework;

/**
 * Classe para template do sistema
 * 
 * @author Felippe
 */
class Template
{
    /**
     * Singleton
     * 
     * @staticvar Database $instance
     * @return \static
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new Template();
        }

        return $instance;
    }
    
    /**
     * Construtor
     */
    protected function __construct()
    {
    }
    
    /**
     * Carrega a view
     * @param string $controller
     * @param string $viewname
     * @param array  $vars
     * @return boolean
     * @throws \Exception
     */
    public function show($controller, $viewname, $vars = [])
    {
        $viewsPath = dirname(__FILE__) . '/../App/View/';
        
        $layout = $viewsPath .'layout.php';
        $viewPath =  $viewsPath . strtolower($controller) . '/' . $viewname . '.php';

        if (!file_exists($viewPath) || !file_exists($layout))
        {
            throw new \Exception('View ou layout não encontrado.');
        }
        
        foreach($vars as $key => $value)
        {
            $$key = $value;
        }
        
        $erro = $this->getErro();
        
        include ($layout);
    }
    
    public function setErro($msg)
    {
        unset($_SESSION['erro']);
        $_SESSION['erro'] = $msg;
    }
    
    public function getErro()
    {
        $erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : '';
        unset($_SESSION['erro']);
        
        return $erro;
    }
}