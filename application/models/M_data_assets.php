<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_assets extends CI_Model
{

    var $table = 'tb_assets'; //nama tabel dari database
    var $column_order = array(null, 'kode_assets', 'merk', 'qty_id', 'serial_number', 'id_pt', 'lokasi', 'idle', 'user', 'kondisi', 'status_unit'); //field yang ada di table user
    var $column_search = array('kode_assets', 'merk', 'qty_id', 'serial_number', 'id_pt', 'lokasi', 'idle', 'user', 'kondisi', 'status_unit'); //field yang diizin untuk pencarian 
    var $order = array('id_assets' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function data_assets()
    {
        $this->db->select('*');
        $this->db->from('tb_assets');
        $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
        $this->db->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
        $this->db->order_by('id_assets', 'DESC');
        return $this->db->get()->result_array();
    }

    public function data_assets_filter($data_filter)
    {
        // table
        $this->db->select('*');
        $this->db->from('tb_assets');
        $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
        $this->db->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');

        if ($data_filter['pilih_pt'] != 'Y') {
            $this->db->where('tb_assets.id_pt', $data_filter['pilih_pt']);
        }
        if ($data_filter['pilih_category'] != 'Y') {
            $this->db->where('qty_id', $data_filter['pilih_category']);
        }
        if ($data_filter['pilih_kondisi'] != 'Y') {
            $this->db->where('kondisi', $data_filter['pilih_kondisi']);
        }
        if ($data_filter['cari_lokasi'] != NULL) {
            $this->db->like('lokasi', $data_filter['cari_lokasi'], 'both');
        }
        if ($data_filter['cb_idle'] != NULL) {
            $this->db->where('idle', $data_filter['cb_idle']);
        }
        if ($data_filter['status_unit'] != 'Y') {
            $this->db->where('status_unit', $data_filter['status_unit']);
        }
        $this->db->order_by('id_assets', 'DESC');
        return $this->db->get()->result_array();
    }
}

/* End of file M_data_assets.php */
