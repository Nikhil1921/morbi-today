<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Advertisement_model extends CI_Model 
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public $table = "advertisements a";  
    public $select_column = ['a.id', 'a.name', 'a.link', 'a.image'];
    public $search_column = ['a.name', 'a.link', 'a.image'];
    public $order_column = [null, 'a.name', 'a.link', null, null, null];
    public $order = ['a.id' => 'DESC'];

    public function make_query()
    {  
        $this->db->select($this->select_column) 
            ->from($this->table)
            ->where(['a.is_deleted' => 0]);

        $i = 0;

        foreach ($this->search_column as $item) 
        {
            if($_POST['search']['value']) 
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->search_column) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}