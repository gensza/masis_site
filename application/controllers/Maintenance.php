<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance extends CI_Controller
{

      public function __construct()
      {
            // menjalankan method ketika class Auth dijalankan
            parent::__construct();

            $this->load->model('M_data_assets_maintenance');

            if (!$this->session->userdata('username')) {
                  redirect('Auth');
            }

            date_default_timezone_set('Asia/Jakarta');
      }

      public function index()
      {
            $data['title'] = 'Data Assets';

            $sess_user = $this->session->userdata('id_pt');
            $data['pt_report'] = $this->db->get_where('tb_pt', ['id_pt' => $sess_user])->result_array();
            $data['pt_filter'] = $this->db->get_where('tb_pt', ['id_pt' => $sess_user])->result_array();

            $data['category'] = $this->db->get('tb_qty_assets')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/maintenance/maintenance.php', $data);
            $this->load->view('templates/footer');
      }

      function get_data_assets_maintenance()
      {
            $list = $this->M_data_assets_maintenance->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                  $frek = $field->frek_maintenan . ' Hari';

                  $maintenance = '<span class="badge-danger"><b> Not&nbsp;Maintained! </b></span>';

                  $aksi = '<a id="detail_aset" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-detail-aset" data-cpu="' . $field->cpu . '" data-ram="' . $field->ram . '" data-storage="' . $field->storage . '" data-gpu="' . $field->gpu . '" data-display="' . $field->display . '" data-lain="' . $field->lain . '" data-merk="' . $field->merk . '" data-os="' . $field->os . '" data-id_assets="' . $field->id_assets . '"><i class="mdi mdi-eye" style="color: white;"></i></a>';

                  $no++;
                  $row = array();
                  $row[] = $no;
                  $row[] = $field->kode_assets;
                  $row[] = $field->merk;
                  $row[] = $field->category;
                  $row[] = $field->serial_number;
                  $row[] = $field->alias;
                  $row[] = $field->lokasi;
                  $row[] = $field->user;
                  $row[] = $frek;
                  $row[] = date("d-m-Y", strtotime($field->tgl_mulai_maintenan));
                  $row[] = date("d-m-Y", strtotime($field->tgl_jadwal_maintenan));
                  $row[] = $maintenance;
                  $row[] = $aksi;

                  $data[] = $row;
            }

            $output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->M_data_assets_maintenance->count_all(),
                  "recordsFiltered" => $this->M_data_assets_maintenance->count_filtered(),
                  "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
      }

      public function select_get_divisi_maintenance()
      {
            $id_pt = $this->input->post('id_pt');
            $data = $this->M_data_assets_maintenance->get_divisi($id_pt);
            echo json_encode($data);
      }
}

/* End of file Maintenance.php */
