<?php
namespace Framework\Database;

/**
 * Interface para adaptador de banco de dados
 *
 * @author Felippe
 */
interface IDatabaseAdapter {
    
    public function insert(IModel $object);
    public function findByID(IModel $object, $id);
    public function update(IModel $object);
    public function delete(IModel $object);
    public function getAll(IModel $object, $pageSize = null, $pageNum = null);
    public function rawQuery($sql);
}
