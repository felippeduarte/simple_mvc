<?php

namespace Framework\Database;

/**
 * Classe para acesso ao banco de dados
 *
 * @author Felippe
 */
class Database {
    
    /**
     * Adapter
     * @var IDatabaseAdapter
     */
    protected $adapter;
    
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
            $dados = \Framework\Config::getDatabaseData();
            $adapter = self::setAdapter($dados);
            $instance = new Database($adapter);
        }

        return $instance;
    }
    /**
     * Construtor
     * @param \Framework\Database\IDatabaseAdapter $adapter
     */
    public function __construct(IDatabaseAdapter $adapter)
    {
        $this->adapter = $adapter;
    }
    
    /**
     * Retorna o adapter de acordo com as configruações do sistema
     * @param array $dados dados de getDatabaseConfig
     * @return \Framework\Database\Adapters\MysqlAdapter|boolean
     */
    private static function setAdapter($dados)
    {
        switch($dados['sgbd'])
        {
            case "MySQL":
                return new Adapters\MysqlAdapter($dados);
            default:
                throw new Exception("SGBD não suportado");
        }
    }
    
    /**
     * 
     * @return IDatabaseAdapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
    
}