<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataAssets extends CI_Controller
{
    public function __construct()
    {
        // menjalankan method ketika class Auth dijalankan
        parent::__construct();
        $db_pt = check_db_pt();

        $this->db_masis_pt = $this->load->database('db_masis_' . $db_pt, TRUE);

        $this->load->library('form_validation');

        $this->load->model('M_data_assets');

        // FOR SSO
        // if (!$this->session->userdata('userlogin')) {
        //     redirect('http://mips.msalgroup.com/msal-login/');
        // }

        if (!$this->session->userdata('username')) {
            redirect('Auth');
        }

        date_default_timezone_set('Asia/Jakarta');

        require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
    }

    public function index()
    {
        $data['title'] = 'Data Assets';
        // $data['filtered'] = 'no filter detected ..';
        // $data['filtered2'] = 'no filter detected ..';

        // $data['pt'] = $this->db_masis_pt->get('tb_pt')->result_array();
        // $data['pt_add'] = $this->db_masis_pt->get('tb_pt')->result_array();
        $sess_user = $this->session->userdata('id_pt');
        $data['pt_report'] = $this->db_masis_pt->get_where('tb_pt', ['id_pt' => $sess_user])->result_array();
        $data['pt_filter'] = $this->db_masis_pt->get_where('tb_pt', ['id_pt' => $sess_user])->result_array();

        $data['category'] = $this->db_masis_pt->get('tb_qty_assets')->result_array();

        // if ($this->input->post('filter') == "filter") {
        //     $data_filter = [
        //         'pilih_pt' => $this->input->post('pilih_pt'),
        //         'pilih_category' => $this->input->post('pilih_category'),
        //         'pilih_kondisi' => $this->input->post('pilih_kondisi'),
        //         'cari_lokasi' => $this->input->post('cari_lokasi'),
        //         'cb_idle' => $this->input->post('cb_idle2'),
        //         'status_unit' => $this->input->post('status_unit')
        //     ];
        //     $data['assets'] = $this->M_data_assets->data_assets_filter($data_filter);
        // } else {
        //     $data['assets'] = $this->M_data_assets->data_assets();
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/data_assets/data_assets', $data);
        $this->load->view('templates/footer');
    }

    public function input_assets()
    {
        $data['title'] = 'Input Assets';

        $sess_user = $this->session->userdata('id_pt');
        $data['pt'] = $this->db_masis_pt->get_where('tb_pt', ['id_pt' => $sess_user])->result_array();
        $data['category'] = $this->db_masis_pt->get('tb_qty_assets')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/data_assets/input_assets', $data);
        $this->load->view('templates/footer');
    }

    public function select_get_divisi()
    {
        $id_pt = $this->input->post('id_pt');
        $data = $this->M_data_assets->get_divisi($id_pt);
        echo json_encode($data);
    }

    public function select_get_pt()
    {
        $data = $this->db_masis_pt->get('tb_pt')->result_array();

        echo json_encode($data);
    }

    // public function filterPt()
    // {
    //     if ($this->input->post('filter') == 0) {
    //         redirect('DataAssets');
    //     }
    //     $data['title'] = 'Data Assets';
    //     $data['filtered'] = 'no filter detected ..';

    //     $data['pt'] = $this->db_masis_pt->get('tb_pt')->result_array();
    //     $data['pt_add'] = $this->db_masis_pt->get('tb_pt')->result_array();
    //     $data['category'] = $this->db_masis_pt->get('tb_qty_assets')->result_array();

    //     $id = $this->input->post('filter');
    //     $data['filter'] = $this->db_masis_pt->get_where('tb_pt', ['id_pt' => $id])->row_array();
    //     $data['filtered2'] = $data['filter']['alias'];

    //     $this->db_masis_pt->select('*');
    //     $this->db_masis_pt->from('tb_assets');
    //     $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
    //     $this->db_masis_pt->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
    //     $this->db_masis_pt->where('tb_assets.id_pt', $id);
    //     $this->db_masis_pt->order_by('id_assets', 'DESC');
    //     $data['assets']  = $this->db_masis_pt->get()->result_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('admin/data_assets', $data);
    //     $this->load->view('templates/footer');
    // }

    public function addAssets()
    {
        $frek_maintenan = $this->input->post('frek_maintenan');
        $tgl_mulai_maintenan = $this->input->post('tgl_mulai_maintenan');
        $tgl_mulai_maintenan_sort = strtotime($this->input->post('tgl_mulai_maintenan'));

        $tgl_jadwal_maintenan = date('Y-m-d', $tgl_mulai_maintenan_sort + (60 * 60 * 24 * $frek_maintenan));

        $this->form_validation->set_rules('kondisi', 'Kondisi', 'required|trim');
        $this->form_validation->set_rules('category', 'category', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            // $kd = '1234567890';
            // $string = 'MSAL' . date("Ymd");
            // for ($i = 0; $i < 3; $i++) {
            //     $pos = rand(0, strlen($kd) - 1);
            //     $string .= $pos;
            // }
            $data = [
                'qty_id' => $this->input->post('category'),
                'kode_assets' => $this->input->post('kode_asset'),
                'type' => $this->input->post('type'),
                'serial_number' => $this->input->post('serial_number'),
                'satuan' => $this->input->post('satuan'),
                'id_pt' => $this->input->post('id_pt'),
                'id_divisi' => $this->input->post('divisi'),
                'user' => $this->input->post('user'),
                'lokasi' => $this->input->post('lokasi'),
                'no_po' => $this->input->post('no_po'),
                'merk' => $this->input->post('merk'),
                'cpu' => $this->input->post('cpu'),
                'os' => $this->input->post('os'),
                'storage' => $this->input->post('storage'),
                'ram' => $this->input->post('ram'),
                'gpu' => $this->input->post('gpu'),
                'display' => $this->input->post('display'),
                'lain' => $this->input->post('lain'),
                'merk_monitor' => $this->input->post('merk_monitor'),
                'sn_monitor' => $this->input->post('sn_monitor'),
                'merk_keyboard' => $this->input->post('merk_keyboard'),
                'sn_keyboard' => $this->input->post('sn_keyboard'),
                'merk_mouse' => $this->input->post('merk_mouse'),
                'sn_mouse' => $this->input->post('sn_mouse'),
                'tgl_pembelian' => $this->input->post('tgl_pembelian'),
                'kondisi' => $this->input->post('kondisi'),
                'no_ba' => $this->input->post('no_ba'),
                'harga' => $this->input->post('harga'),
                'status_kondisi' => $this->input->post('status_kondisi'),
                'fisik' => $this->input->post('fisik'),
                'idle' => $this->input->post('idle'),
                'frek_maintenan' => $frek_maintenan,
                'status_unit' => 1,
                'tgl_mulai_maintenan' => $tgl_mulai_maintenan,
                'tgl_jadwal_maintenan' => $tgl_jadwal_maintenan,
                'ket_fisik' => $this->input->post('ket_fisik'),
                'date_created' => date('Y-m-d H:i:s')
            ];
            $this->db_masis_pt->insert('tb_assets', $data);

            if ($data['kondisi'] == 1) {
                $this->db_masis_pt->set('qty', 'qty+1', FALSE);
                $this->db_masis_pt->set('tersedia', 'tersedia+1', FALSE);
                $this->db_masis_pt->where('id_qty', $data['qty_id']);
                $this->db_masis_pt->update('tb_qty_assets');
            } else {
                $this->db_masis_pt->set('qty', 'qty+1', FALSE);
                $this->db_masis_pt->where('id_qty', $data['qty_id']);
                $this->db_masis_pt->update('tb_qty_assets');
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New assets added!</div>');
            redirect('DataAssets');
        }
    }

    public function editAssets($id)
    {
        $data['pt'] = $this->db_masis_pt->get('tb_pt')->result_array();

        $data['title'] = 'Edit Assets';
        $data['category'] = $this->db_masis_pt->get('tb_qty_assets')->result_array();
        $this->db_masis_pt->select('*');
        $this->db_masis_pt->from('tb_assets');
        $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
        $this->db_masis_pt->where('id_assets', $id);
        $this->db_masis_pt->order_by('id_assets', 'DESC');
        $data['assets']  = $this->db_masis_pt->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/data_assets/edit_assets', $data);
        $this->load->view('templates/footer');
    }

    public function updateAssets()
    {
        $frek_maintenan = $this->input->post('frek_maintenan');
        $tgl_mulai_maintenan = $this->input->post('tgl_mulai_maintenan');
        $tgl_mulai_maintenan_sort = strtotime($this->input->post('tgl_mulai_maintenan'));

        $tgl_jadwal_maintenan = date('Y-m-d', $tgl_mulai_maintenan_sort + (60 * 60 * 24 * $frek_maintenan));

        $data = [
            'id_assets' => $this->input->post('id_assets'),
            'qty_id' => $this->input->post('category'),
            'kode_assets' => $this->input->post('kode_asset'),
            'type' => $this->input->post('type'),
            'serial_number' => $this->input->post('serial_number'),
            'satuan' => $this->input->post('satuan'),
            'id_pt' => $this->input->post('id_pt'),
            'id_divisi' => $this->input->post('divisi'),
            'user' => $this->input->post('user'),
            'lokasi' => $this->input->post('lokasi'),
            'no_po' => $this->input->post('no_po'),
            'merk' => $this->input->post('merk'),
            'cpu' => $this->input->post('cpu'),
            'os' => $this->input->post('os'),
            'storage' => $this->input->post('storage'),
            'ram' => $this->input->post('ram'),
            'gpu' => $this->input->post('gpu'),
            'display' => $this->input->post('display'),
            'lain' => $this->input->post('lain'),
            'merk_monitor' => $this->input->post('merk_monitor'),
            'sn_monitor' => $this->input->post('sn_monitor'),
            'merk_keyboard' => $this->input->post('merk_keyboard'),
            'sn_keyboard' => $this->input->post('sn_keyboard'),
            'merk_mouse' => $this->input->post('merk_mouse'),
            'sn_mouse' => $this->input->post('sn_mouse'),
            'tgl_pembelian' => $this->input->post('tgl_pembelian'),
            'kondisi' => $this->input->post('kondisi'),
            'no_ba' => $this->input->post('no_ba'),
            'harga' => $this->input->post('harga'),
            'status_kondisi' => $this->input->post('status_kondisi'),
            'fisik' => $this->input->post('fisik'),
            'idle' => $this->input->post('idle'),
            'frek_maintenan' => $frek_maintenan,
            'tgl_mulai_maintenan' => $tgl_mulai_maintenan,
            'tgl_jadwal_maintenan' => $tgl_jadwal_maintenan,
            'ket_fisik' => $this->input->post('ket_fisik'),
        ];

        $cek = $this->db_masis_pt->get_where('tb_assets', ['id_assets' => $data['id_assets']])->row_array();
        if ($cek['kondisi'] == 1 and $data['kondisi'] == 0) {

            $this->db_masis_pt->set('tersedia', 'tersedia-1', FALSE);
            $this->db_masis_pt->where('id_qty', $data['qty_id']);
            $this->db_masis_pt->update('tb_qty_assets');
        } elseif ($cek['kondisi'] == 0 and $data['kondisi'] == 1) {

            $this->db_masis_pt->set('tersedia', 'tersedia+1', FALSE);
            $this->db_masis_pt->where('id_qty', $data['qty_id']);
            $this->db_masis_pt->update('tb_qty_assets');
        } else {
        }

        $this->db_masis_pt->where('id_assets', $data['id_assets']);
        $this->db_masis_pt->update('tb_assets', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Assets has been updated successfully!</div>');
        redirect('DataAssets');
    }

    public function deleteAssets($id, $id_qty)
    {
        $this->db_masis_pt->where('id_assets', $id);
        $this->db_masis_pt->delete('tb_assets');
        $this->db_masis_pt->set('qty', 'qty-1', FALSE);
        $this->db_masis_pt->set('tersedia', 'tersedia-1', FALSE);
        $this->db_masis_pt->where('id_qty', $id_qty);
        $this->db_masis_pt->update('tb_qty_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Assets has been deleted successfully!</div>');
        redirect('DataAssets');
    }

    public function qtyAssets()
    {
        $data['title'] = 'Qty Assets';
        $data['qty_assets'] = $this->db_masis_pt->get('tb_qty_assets')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/category_assets/qty_assets', $data);
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
            $this->db_masis_pt->insert('tb_qty_assets', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New category added!</div>');
            redirect('DataAssets/qtyAssets');
        }
    }

    public function editCategory($id)
    {
        $data['title'] = 'Edit Category';
        $data['category'] = $this->db_masis_pt->get_where('tb_qty_assets', ['id_qty' => $id])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/category_assets/edit_category', $data);
        $this->load->view('templates/footer');
    }

    public function updateCategory()
    {
        $this->db_masis_pt->set('category', $this->input->post('category'));
        $this->db_masis_pt->where('id_qty', $this->input->post('id'));
        $this->db_masis_pt->update('tb_qty_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">category has been updated successfully!</div>');
        $this->qtyAssets();
    }

    public function reportDataAssets()
    {
        $dompdf = new Dompdf();

        $data['data_post'] = [
            'pilih_pt' => $this->input->post('pilih_pt'),
            'pilih_category' => $this->input->post('pilih_category'),
            'pilih_kondisi' => $this->input->post('pilih_kondisi'),
            'divisi' => $this->input->post('divisi'),
            'cb_idle' => $this->input->post('cb_idle'),
            'status_unit' => $this->input->post('status_unit')
        ];

        // ket
        $this->db_masis_pt->select('alias, category');
        $this->db_masis_pt->from('tb_assets');
        $this->db_masis_pt->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
        $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
        if ($data['data_post']['pilih_pt'] != 'Y') {
            $this->db_masis_pt->where('tb_assets.id_pt', $data['data_post']['pilih_pt']);
        } else {
        }
        if ($data['data_post']['pilih_category'] != 'Y') {
            $this->db_masis_pt->where('qty_id', $data['data_post']['pilih_category']);
        } else {
        }
        $data['data_assets_ket'] = $this->db_masis_pt->get()->row_array();

        // table
        $this->db_masis_pt->select('*');
        $this->db_masis_pt->from('tb_assets');
        $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
        $this->db_masis_pt->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');

        if ($data['data_post']['pilih_pt'] != 'Y') {
            $this->db_masis_pt->where('tb_assets.id_pt', $data['data_post']['pilih_pt']);
        }
        if ($data['data_post']['pilih_category'] != 'Y') {
            $this->db_masis_pt->where('qty_id', $data['data_post']['pilih_category']);
        }
        if ($data['data_post']['pilih_kondisi'] != 'Y') {
            $this->db_masis_pt->where('kondisi', $data['data_post']['pilih_kondisi']);
        }
        if ($data['data_post']['divisi'] != 'Y') {
            $this->db_masis_pt->where('id_divisi', $data['data_post']['divisi']);
        }
        if ($data['data_post']['cb_idle'] == 'on') {
            $this->db_masis_pt->where('idle', $data['data_post']['cb_idle']);
        }
        if ($data['data_post']['status_unit'] != 'Y') {
            $this->db_masis_pt->where('status_unit', $data['data_post']['status_unit']);
        }
        $this->db_masis_pt->order_by('id_assets', 'DESC');
        $data['data_assets'] = $this->db_masis_pt->get()->result_array();

        //test
        $html = $this->load->view('admin/report_assets', $data, true);
        $dompdf->load_html($html);
        $dompdf->set_paper('Legal', 'Landscape');
        $dompdf->render();
        $dompdf->output();
        $dompdf->stream('Assets-report.pdf', array('Attachment' => false));
    }

    function get_data_assets()
    {
        $list = $this->M_data_assets->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            //idle
            if ($field->idle  == 'on') {
                $idle = 'Ya';
            } else {
                $idle = '';
            }

            //kondisi
            if ($field->kondisi == 1) {
                $kondisi = 'BAIK';
            } else {
                $kondisi = 'RUSAK';
            }

            //status
            if ($field->kondisi == 1 and $field->status_unit == 1) {
                $status = '<p style="color: green;"><b>Tersedia!</b></p>';
            } else if ($field->kondisi == 0) {
                $status = '<p style="color: red;"><b>Rusak</b></p>';
            } else {
                $status = '<p style="color: blue;"><b>Dipinjam</b></p>';
            }

            if ($field->status_unit == 1 and $field->kondisi == 1) {
                $aksi = '
                <a id="detail_aset" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-detail-aset" data-cpu="' . $field->cpu . '" data-ram="' . $field->ram . '" data-storage="' . $field->storage . '" data-gpu="' . $field->gpu . '" data-display="' . $field->display . '" data-lain="' . $field->lain . '"
                data-merk="' . $field->merk . '" data-os="' . $field->os . '" data-id_assets="' . $field->id_assets . '">
                <i class="mdi mdi-eye" style="color: white;"></i></a>
                <button class="btn btn-sm btn-warning mdi mdi-lead-pencil" onClick="edit_assets(' . $field->id_assets . ')"></button>
                <button class="btn btn-sm btn-danger mdi mdi-trash-can-outline" onClick="delete_assets(' . $field->id_assets . ',' . $field->qty_id . ')"></button>
                ';
            } else {
                $aksi = '
                <a id="detail_aset" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-detail-aset" data-cpu="' . $field->cpu . '" data-ram="' . $field->ram . '" data-storage="' . $field->storage . '" data-gpu="' . $field->gpu . '" data-display="' . $field->display . '" data-lain="' . $field->lain . '"
                data-merk="' . $field->merk . '" data-os="' . $field->os . '" data-id_assets="' . $field->id_assets . '">
                <i class="mdi mdi-eye" style="color: white;"></i></a>
                <button class="btn btn-sm btn-warning mdi mdi-lead-pencil" onClick="edit_assets(' . $field->id_assets . ')"></button>
                ';
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->kode_assets;
            $row[] = $field->merk;
            $row[] = $field->category;
            $row[] = $field->serial_number;
            $row[] = $field->alias;
            $row[] = $field->lokasi;
            $row[] = $idle;
            $row[] = $field->user;
            $row[] = $kondisi;
            $row[] = $status;
            $row[] = $aksi;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_data_assets->count_all(),
            "recordsFiltered" => $this->M_data_assets->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    // public function filterDataAssets()
    // {
    //     $data['title'] = 'Data Assets';

    //     $data['data_post'] = [
    //         'pilih_pt' => $this->input->post('pilih_pt'),
    //         'pilih_category' => $this->input->post('pilih_category'),
    //         'pilih_kondisi' => $this->input->post('pilih_kondisi'),
    //         'cari_lokasi' => $this->input->post('cari_lokasi'),
    //         'cb_idle' => $this->input->post('cb_idle2'),
    //         'status_unit' => $this->input->post('status_unit')
    //     ];

    //     // ket
    //     $this->db_masis_pt->select('alias, category');
    //     $this->db_masis_pt->from('tb_assets');
    //     $this->db_masis_pt->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');
    //     $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
    //     if ($data['data_post']['pilih_pt'] != 'Y') {
    //         $this->db_masis_pt->where('tb_assets.id_pt', $data['data_post']['pilih_pt']);
    //     } else {
    //     }
    //     if ($data['data_post']['pilih_category'] != 'Y') {
    //         $this->db_masis_pt->where('qty_id', $data['data_post']['pilih_category']);
    //     } else {
    //     }
    //     $data['data_assets_ket'] = $this->db_masis_pt->get()->row_array();

    //     // table
    //     $this->db_masis_pt->select('*');
    //     $this->db_masis_pt->from('tb_assets');
    //     $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id', 'left');
    //     $this->db_masis_pt->join('tb_pt', 'tb_pt.id_pt = tb_assets.id_pt', 'left');

    //     if ($data['data_post']['pilih_pt'] != 'Y') {
    //         $this->db_masis_pt->where('tb_assets.id_pt', $data['data_post']['pilih_pt']);
    //     } else {
    //     }
    //     if ($data['data_post']['pilih_category'] != 'Y') {
    //         $this->db_masis_pt->where('qty_id', $data['data_post']['pilih_category']);
    //     } else {
    //     }
    //     if ($data['data_post']['pilih_kondisi'] != 'Y') {
    //         $this->db_masis_pt->where('kondisi', $data['data_post']['pilih_kondisi']);
    //     } else {
    //     }
    //     if ($data['data_post']['cari_lokasi'] != NULL) {
    //         $this->db_masis_pt->like('lokasi', $data['data_post']['cari_lokasi'], 'both');
    //     } else {
    //     }
    //     if ($data['data_post']['cb_idle'] != NULL) {
    //         $this->db_masis_pt->where('idle', $data['data_post']['cb_idle']);
    //     } else {
    //     }
    //     if ($data['data_post']['status_unit'] != 'Y') {
    //         $this->db_masis_pt->where('status_unit', $data['data_post']['status_unit']);
    //     } else {
    //     }
    //     $this->db_masis_pt->order_by('id_assets', 'DESC');
    //     $data['assets'] = $this->db_masis_pt->get()->result_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('admin/data_assets', $data);
    //     $this->load->view('templates/footer');
    // }
}
