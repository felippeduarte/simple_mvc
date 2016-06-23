<?php
namespace App\Controller;

/**
 * Interface para funções de CRUD
 *
 * @author Felippe
 */
interface ICrudController {

    /**
     * Cadastro de novo elemento
     */
    public function create();
    
    /**
     * Lê os dados do elemento
     * @param int $id
     */
    public function read($id);
    
    /**
     * Atualiza o elemento
     */
    public function update($id);
    
    /**
     * Remove o elemento
     * @param int $id
     */
    public function delete($id);
}