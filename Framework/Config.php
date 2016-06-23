<?php
namespace Framework;

/**
 * Manipulação dos arquivos de configuração do sistema
 *
 * @author Felippe
 */
class Config {
    
    /**
     * Coleta os dados de configuração para conexão com banco de dados
     * @return array
     * @throws Exception
     */
    public static function getDatabaseData()
    {
        $dados = parse_ini_file(dirname(__FILE__)."/../config/database.ini");
        
        $diff = array_diff(array_keys($dados), array('sgbd','user','password','host','database'));
        
        if(!empty($diff))
        {
            throw new \Exception('Arquivo de configuração de banco de dados incorreto');
        }
        
        return $dados;
    }
    
    
}
