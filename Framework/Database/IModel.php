<?php
namespace Framework\Database;

/**
 * Interface para model
 * @author Felippe
 */
interface IModel {
    
    public function getTable();
    public function getFields();
}
