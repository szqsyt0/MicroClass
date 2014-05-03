<?php

/**
 * Description of category
 *
 * @author syt
 */
class Category {
    private $category_id;
    private $parent_id;
    private $category_name;
    
    function get_category_id(){
        return $this->category_id;
    }
    
    function get_parent_id(){
        return $this->parent_id;
    }
    
    function get_category_name(){
        return $this->category_name;
    }
    
    function set_category_name($category_name){
        $this->category_name = $category_name;
    }
    
    function set_parent_id($parent_id){
        $this->parent_id = $parent_id;
    }
    
    function set_category_id($category_id){    
        $this->category_id = $category_id;
    }
}
