<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class data_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_barang");
        $this->load->library('form_validation');
        $this->load->model("Model_user");
		if($this->Model_user->NotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["data_barang"] = $this->Model_barang->getAll();
        $this->load->view("admin/barang/list", $data);
    }

    public function tambahdata()
    {
        $product = $this->Model_barang;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->mtambahdata();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/data_barang'));
        }

        $this->load->view("admin/barang/form_tambah");
    }

    public function editdata($id = null)
    {
        if (!isset($id)) redirect('admin/data_barang');
       
        $product = $this->Model_barang;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->mupdatedata();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/data_barang'));
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("admin/barang/form_edit", $data);
    }

    public function hapusdata($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Model_barang->mhapusdata($id)) {
            redirect(site_url('admin/data_barang'));
        }
    }
}