<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class E_paper_model extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "e_paper p";
	public $select_column = ['p.id', 'p.paper_date', 'c.cat_name'];
	public $search_column = ['p.paper_date', 'c.cat_name'];
    public $order_column = [null, 'p.paper_date', 'c.cat_name', null, null, null];
	public $order = ['p.id' => 'DESC'];

	public function make_query()  
	{  
        $this->db->select($this->select_column)	
            ->from($this->table)
            ->where(['c.is_deleted' => 0, 'p.is_deleted' => 0])
            ->join('paper_category c', 'c.id = p.cat_id');

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

    public function getepaper($date)
    {
        return $this->db->select(['p.id', 'c.cat_name', 'CONCAT("assets/blog/", c.image) image'])
                 ->from($this->table)
                 ->where(['c.is_deleted' => 0, 'p.is_deleted' => 0, 'p.paper_date' => $date])
                 ->join('paper_category c', 'c.id = p.cat_id')
                 ->get()
                 ->result_array();
    }
}