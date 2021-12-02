<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_assets_maintenance extends CI_Model
{

      var $table = 'tb_assets'; //nama tabel dari database
      var $column_order = array(null, 'id_assets', 'kode_assets', 'merk', 'tb_qty_assets.category', 'qty_id', 'serial_number', 'tb_pt.alias', 'lokasi', 'idle', 'user', 'kondisi', 'status_unit', 'cpu', 'ram', 'storage', 'gpu', 'display', 'lain', 'merk', 'os', 'frek_maintenan', 'tgl_mulai_maintenan', 'tgl_jadwal_maintenan'); //field yang ada di table user
      var $column_search = array('id_assets', 'kode_assets', 'merk', 'tb_qty_assets.category', 'qty_id', 'serial_number', 'tb_pt.alias', 'lokasi', 'idle', 'user', 'kondisi', 'status_unit', 'cpu', 'ram', 'storage', 'gpu', 'display', 'lain', 'merk', 'os', 'frek_maintenan', 'tgl_mulai_maintenan', 'tgl_jadwal_maintenan'); //field yang diizin untuk pencarian 
      var $order = array('id_assets' => 'asc'); // default order 

      public function __construct()
      {
            parent::__construct();
            $this->load->database();
      }

      private function _get_datatables_query()
      {
            $data_filter = [
                  'pilih_pt' => $this->input->post('pilih_pt'),
                  'pilih_category' => $this->input->post('pilih_category'),
                  'pilih_kondisi' => $this->input->post('pilih_kondisi'),
                  'divisi' => $this->input->post('divisi'),
                  'cb_idle' => $this->input->post('cb_idle2'),
                  'status_unit' => $this->input->post('status_unit')
            ];

            $date_today = date('Y-m-d');

            $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
            $this->db_masis_pt->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');

            if ($data_filter['pilih_pt'] != 'Y') {
                  $this->db_masis_pt->where('tb_assets.id_pt', $data_filter['pilih_pt']);
            }
            if ($data_filter['pilih_category'] != 'Y') {
                  $this->db_masis_pt->where('tb_assets.qty_id', $data_filter['pilih_category']);
            }
            if ($data_filter['pilih_kondisi'] != 'Y') {
                  $this->db_masis_pt->where('kondisi', $data_filter['pilih_kondisi']);
            }
            if ($data_filter['divisi'] != 'Y') {
                  $this->db_masis_pt->where('id_divisi', $data_filter['divisi']);
            }
            if ($data_filter['cb_idle'] == 'on') {
                  $this->db_masis_pt->where('idle', $data_filter['cb_idle']);
            }
            if ($data_filter['status_unit'] != 'Y') {
                  $this->db_masis_pt->where('status_unit', $data_filter['status_unit']);
            }

            $this->db_masis_pt->where(['status_maintenan' => 0, 'tgl_jadwal_maintenan <=' => $date_today, 'tgl_jadwal_maintenan !=' => '1970-01-01']);
            $this->db_masis_pt->order_by('id_assets', 'DESC');
            $this->db_masis_pt->from($this->table);

            $i = 0;

            foreach ($this->column_search as $item) // looping awal
            {
                  if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
                  {

                        if ($i === 0) // looping awal
                        {
                              $this->db_masis_pt->group_start();
                              $this->db_masis_pt->like($item, $_POST['search']['value']);
                        } else {
                              $this->db_masis_pt->or_like($item, $_POST['search']['value']);
                        }

                        if (count($this->column_search) - 1 == $i)
                              $this->db_masis_pt->group_end();
                  }
                  $i++;
            }

            if (isset($_POST['order'])) {
                  $this->db_masis_pt->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                  $order = $this->order;
                  $this->db_masis_pt->order_by(key($order), $order[key($order)]);
            }
      }

      function get_datatables()
      {
            $this->_get_datatables_query();
            if ($_POST['length'] != -1)
                  $this->db_masis_pt->limit($_POST['length'], $_POST['start']);
            $query = $this->db_masis_pt->get();
            return $query->result();
      }

      function count_filtered()
      {
            $this->_get_datatables_query();
            $query = $this->db_masis_pt->get();
            return $query->num_rows();
      }

      public function count_all()
      {
            $this->db_masis_pt->from($this->table);
            return $this->db_masis_pt->count_all_results();
      }

      public function data_assets()
      {
            $this->db_masis_pt->select('*');
            $this->db_masis_pt->from('tb_assets');
            $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
            $this->db_masis_pt->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
            $this->db_masis_pt->order_by('id_assets', 'DESC');
            return $this->db_masis_pt->get()->result_array();
      }

      public function data_assets_filter($data_filter)
      {
            // table
            $this->db_masis_pt->select('*');
            $this->db_masis_pt->from('tb_assets');
            $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
            $this->db_masis_pt->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');

            if ($data_filter['pilih_pt'] != 'Y') {
                  $this->db_masis_pt->where('tb_assets.id_pt', $data_filter['pilih_pt']);
            }
            if ($data_filter['pilih_category'] != 'Y') {
                  $this->db_masis_pt->where('qty_id', $data_filter['pilih_category']);
            }
            if ($data_filter['pilih_kondisi'] != 'Y') {
                  $this->db_masis_pt->where('kondisi', $data_filter['pilih_kondisi']);
            }
            if ($data_filter['cari_lokasi'] != NULL) {
                  $this->db_masis_pt->like('lokasi', $data_filter['cari_lokasi'], 'both');
            }
            if ($data_filter['cb_idle'] != NULL) {
                  $this->db_masis_pt->where('idle', $data_filter['cb_idle']);
            }
            if ($data_filter['status_unit'] != 'Y') {
                  $this->db_masis_pt->where('status_unit', $data_filter['status_unit']);
            }
            $this->db_masis_pt->order_by('id_assets', 'DESC');
            return $this->db_masis_pt->get()->result_array();
      }

      public function get_divisi($id_pt)
      {
            $this->db_masis_pt->select('id_divisi, nama_divisi');
            $this->db_masis_pt->where('id_pt', $id_pt);
            $this->db_masis_pt->from('tb_divisi');
            return $this->db_masis_pt->get()->result_array();
      }
}

/* End of file M_data_assets.php */
