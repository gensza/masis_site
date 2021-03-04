<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataAssets extends CI_Controller
{
    public function __construct()
    {
        // menjalankan method ketika class Auth dijalankan
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('email')) {
            redirect('Users');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Assets';
        $data['filtered'] = 'no filter detected ..';
        $data['filtered2'] = 'no filter detected ..';

        $data['pt'] = $this->db->get('tb_pt')->result_array();
        $data['pt_add'] = $this->db->get('tb_pt')->result_array();

        if ($this->input->post('filter') == 0) {

            $data['category'] = $this->db->get('tb_qty_assets')->result_array();

            $this->db->select('*');
            $this->db->from('tb_assets');
            $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
            $this->db->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
            $this->db->order_by('id_assets', 'DESC');
            $data['assets']  = $this->db->get()->result_array();
        } else {

            $id = $this->input->post('filter');
            $data['filter'] = $this->db->get_where('tb_qty_assets', ['id_qty' => $id])->row_array();
            $data['filtered'] = $data['filter']['category'];
            $data['category'] = $this->db->get('tb_qty_assets')->result_array();

            $this->db->select('*');
            $this->db->from('tb_assets');
            $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
            $this->db->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
            $this->db->where('tb_assets.qty_id', $id);
            $this->db->order_by('id_assets', 'DESC');
            $data['assets']  = $this->db->get()->result_array();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/data_assets', $data);
        $this->load->view('templates/footer');
    }

    public function filterPt()
    {
        if ($this->input->post('filter') == 0) {
            redirect('DataAssets');
        }
        $data['title'] = 'Data Assets';
        $data['filtered'] = 'no filter detected ..';

        $data['pt'] = $this->db->get('tb_pt')->result_array();
        $data['pt_add'] = $this->db->get('tb_pt')->result_array();
        $data['category'] = $this->db->get('tb_qty_assets')->result_array();

        $id = $this->input->post('filter');
        $data['filter'] = $this->db->get_where('tb_pt', ['id_pt' => $id])->row_array();
        $data['filtered2'] = $data['filter']['alias'];

        $this->db->select('*');
        $this->db->from('tb_assets');
        $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
        $this->db->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
        $this->db->where('tb_assets.id_pt', $id);
        $this->db->order_by('id_assets', 'DESC');
        $data['assets']  = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/data_assets', $data);
        $this->load->view('templates/footer');
    }

    public function addAssets()
    {
        $this->form_validation->set_rules('kondisi', 'Kondisi', 'required|trim');
        $this->form_validation->set_rules('category', 'category', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $kd = '1234567890';
            $string = 'MSAL' . date("Ymd");
            for ($i = 0; $i < 3; $i++) {
                $pos = rand(0, strlen($kd) - 1);
                $string .= $pos;
            }
            $data = [
                'kode_assets' => $string,
                'merk' => htmlspecialchars($this->input->post('merk', true)),
                'serial_number' => htmlspecialchars($this->input->post('serial_number', true)),
                'id_pt' => $this->input->post('id_pt', true),
                'lokasi' => htmlspecialchars($this->input->post('lokasi', true)),
                'cpu' => htmlspecialchars($this->input->post('cpu', true)),
                'ram' => htmlspecialchars($this->input->post('ram', true)),
                'storage' => htmlspecialchars($this->input->post('storage', true)),
                'gpu' => htmlspecialchars($this->input->post('gpu', true)),
                'display' => htmlspecialchars($this->input->post('display', true)),
                'lain' => htmlspecialchars($this->input->post('lain', true)),
                'qty_id' => $this->input->post('category'),
                'tgl_pembelian' => $this->input->post('tgl_pembelian'),
                'kondisi' => $this->input->post('kondisi'),
                'user' => $this->input->post('user'),
                'status_kondisi' => $this->input->post('status_kondisi'),
                'idle' => $this->input->post('idle'),
                'fisik' => $this->input->post('fisik'),
                'ket_fisik' => $this->input->post('ket_fisik'),
                'status_unit' => 1
            ];
            $this->db->insert('tb_assets', $data);

            if ($data['kondisi'] == 1) {
                $this->db->set('qty', 'qty+1', FALSE);
                $this->db->set('tersedia', 'tersedia+1', FALSE);
                $this->db->where('id_qty', $data['qty_id']);
                $this->db->update('tb_qty_assets');
            } else {
                $this->db->set('qty', 'qty+1', FALSE);
                $this->db->where('id_qty', $data['qty_id']);
                $this->db->update('tb_qty_assets');
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New assets added!</div>');
            redirect('DataAssets');
        }
    }

    public function editAssets($id)
    {
        $data['pt'] = $this->db->get('tb_pt')->result_array();

        $data['title'] = 'Edit Assets';
        $data['category'] = $this->db->get('tb_qty_assets')->result_array();
        $this->db->select('*');
        $this->db->from('tb_assets');
        $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
        $this->db->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
        $this->db->where('id_assets', $id);
        $this->db->order_by('id_assets', 'DESC');
        $data['assets']  = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/edit_assets', $data);
        $this->load->view('templates/footer');
    }

    public function updateAssets()
    {
        $data = [
            'id_assets' => $this->input->post('id_assets'),
            'merk' => htmlspecialchars($this->input->post('merk', true)),
            'serial_number' => htmlspecialchars($this->input->post('serial_number', true)),
            'id_pt' => $this->input->post('id_pt', true),
            'lokasi' => htmlspecialchars($this->input->post('lokasi', true)),
            'cpu' => htmlspecialchars($this->input->post('cpu', true)),
            'ram' => htmlspecialchars($this->input->post('ram', true)),
            'storage' => htmlspecialchars($this->input->post('storage', true)),
            'gpu' => htmlspecialchars($this->input->post('gpu', true)),
            'display' => htmlspecialchars($this->input->post('display', true)),
            'lain' => htmlspecialchars($this->input->post('lain', true)),
            'qty_id' => $this->input->post('category'),
            'tgl_pembelian' => $this->input->post('tgl_pembelian'),
            'kondisi' => $this->input->post('kondisi'),
            'user' => $this->input->post('user'),
            'status_kondisi' => $this->input->post('status_kondisi'),
            'idle' => $this->input->post('idle'),
            'fisik' => $this->input->post('fisik'),
            'ket_fisik' => $this->input->post('ket_fisik')
        ];

        $cek = $this->db->get_where('tb_assets', ['id_assets' => $data['id_assets']])->row_array();
        if ($cek['kondisi'] == 1 and $data['kondisi'] == 0) {

            $this->db->set('tersedia', 'tersedia-1', FALSE);
            $this->db->where('id_qty', $data['qty_id']);
            $this->db->update('tb_qty_assets');
        } elseif ($cek['kondisi'] == 0 and $data['kondisi'] == 1) {

            $this->db->set('tersedia', 'tersedia+1', FALSE);
            $this->db->where('id_qty', $data['qty_id']);
            $this->db->update('tb_qty_assets');
        } else {
        }

        $this->db->set('merk', $data['merk']);
        $this->db->set('serial_number', $data['serial_number']);
        $this->db->set('id_pt', $data['id_pt']);
        $this->db->set('lokasi', $data['lokasi']);
        $this->db->set('cpu', $data['cpu']);
        $this->db->set('ram', $data['ram']);
        $this->db->set('storage', $data['storage']);
        $this->db->set('gpu', $data['gpu']);
        $this->db->set('display', $data['display']);
        $this->db->set('lain', $data['lain']);
        $this->db->set('qty_id', $data['qty_id']);
        $this->db->set('tgl_pembelian', $data['tgl_pembelian']);
        $this->db->set('kondisi', $data['kondisi']);
        $this->db->set('user', $data['user']);
        $this->db->set('status_kondisi', $data['status_kondisi']);
        $this->db->set('idle', $data['idle']);
        $this->db->set('fisik', $data['fisik']);
        $this->db->set('ket_fisik', $data['ket_fisik']);
        $this->db->where('id_assets', $data['id_assets']);
        $this->db->update('tb_assets');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Assets has been updated successfully!</div>');
        redirect('DataAssets');
    }

    public function deleteAssets($id, $id_qty)
    {
        $this->db->where('id_assets', $id);
        $this->db->delete('tb_assets');
        $this->db->set('qty', 'qty-1', FALSE);
        $this->db->set('tersedia', 'tersedia-1', FALSE);
        $this->db->where('id_qty', $id_qty);
        $this->db->update('tb_qty_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Assets has been deleted successfully!</div>');
        redirect('DataAssets');
    }

    public function qtyAssets()
    {
        $data['title'] = 'Qty Assets';
        $data['qty_assets'] = $this->db->get('tb_qty_assets')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/qty_assets', $data);
        $this->load->view('templates/footer');
    }

    public function addCategory()
    {
        $this->form_validation->set_rules('category', 'Category', 'required|trim|is_unique[tb_qty_assets.category]', [
            'is_unique' => 'This category has already exist!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->qtyAssets();
        } else {
            $data = [
                'category' => htmlspecialchars($this->input->post('category', true)),
                'qty' => 0,
                'tersedia' => 0
            ];
            $this->db->insert('tb_qty_assets', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New category added!</div>');
            redirect('DataAssets/qtyAssets');
        }
    }

    public function editCategory($id)
    {
        $data['title'] = 'Edit Category';
        $data['category'] = $this->db->get_where('tb_qty_assets', ['id_qty' => $id])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/edit_category', $data);
        $this->load->view('templates/footer');
    }

    public function updateCategory()
    {
        $this->db->set('category', $this->input->post('category'));
        $this->db->where('id_qty', $this->input->post('id'));
        $this->db->update('tb_qty_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">category has been updated successfully!</div>');
        $this->qtyAssets();
    }
}