<?php


class DefaultController {
    
    public function findAll($table) {
        $db = new lib\DBTable($table);
        return $db->findAll();
    }
    
    public function find($table , $id) {
        $db = new lib\DBTable($table);
        return $db->find($id);
    }
    
    public function update($table , array $data) {
        $db = new lib\DBTable($table);
        return $db->update($data);
    }
    
    public function remove($table , $id) {
     $db = new lib\DBTable($table);
     return $db->remove($id);
    }
    
    public function paginate($table,$offset, $limit, $order, $attr) {
        $db = new lib\DBTable($table);
        return $db->paginate($offset, $limit, $order, $attr);
    }
    
    public function insert($table,$data) {
        $db = new lib\DBTable($table);
        return $db->insert($data);
    }
}