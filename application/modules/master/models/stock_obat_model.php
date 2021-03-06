<?php
/**
 * Description of Class stock_obat_model
 *
 * @author R.Firmansyah <black.cappuccino@yahoo.com>
 */
class Stock_Obat_Model extends CI_Model {
    protected $table_def = "stock_obat";
    protected $join_table1 = "master_obat";
    
    public function __construct() {
        parent::__construct();
    }
	
    public function getById($id) {
        $this->db->where('stock_obat_id', $id);
        $query = $this->db->get($this->table_def);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
	
    public function getAll($limit = 10, $offset = 0, $orders = array(), $where = array(), $like = array()) {
        $data = array();
        $this->db->start_cache();
        
        $this->db->select('
                stock_obat.stock_obat_id,
                master_obat.master_obat_nama,
                stock_obat.stock_obat_min,
                stock_obat.stock_obat_active
                ');
        $this->db->join($this->join_table1, 'master_obat.master_obat_id = stock_obat.master_obat_id','left');
        $this->db->where('stock_obat.stock_obat_active', "1"); 
        if (count($where) > 0) {
            $this->db->where($where);
        }
        if (count($like) > 0) {
            $this->db->like($like);
        }
        $this->db->stop_cache();

        $data['total_rows'] = $this->db->count_all_results($this->table_def);

        if (count($orders) > 0)
            foreach ($orders as $order => $direction)
                    $this->db->order_by($order, $direction);

        if ($limit == 0) {
            $data['data'] = $this->db->get($this->table_def)->result();
        }
        else {
            $data['data'] = $this->db->get($this->table_def, $limit, $offset)->result();
        }

        $this->db->flush_cache();

        return $data;
    }

    public function create($stock_obat) {
	$data = $this->_toArray($stock_obat);
        $this->db->insert($this->table_def, $data);
        return $this->db->insert_id();
    }
    
    public function update($stock_obat) {
	$data = $this->_toArray($stock_obat);
        $this->db->where('stock_obat_id', $stock_obat->stock_obat_id);
        $this->db->update($this->table_def, $data);
    }
    
    public function delete($id) {
        $this->db->where('stock_obat_id', $id);
        $this->db->delete($this->table_def); 
    }
    
    private function _toArray($stock_obat) {
        $data = array(
            'master_obat_id' => $stock_obat->master_obat_id,
            'stock_obat_min' => $stock_obat->stock_obat_min,
            'stock_obat_active' => $stock_obat->stock_obat_active
        );
        return $data;
    }
}

?>
