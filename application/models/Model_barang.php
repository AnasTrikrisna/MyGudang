<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_barang extends CI_Model
{
    private $_table = "barang";

    public $id_barang;
    public $name;
    public $jumlah;
    public $image = "default.jpg";

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'jumlah',
            'label' => 'jumlah',
            'rules' => 'numeric'],
            
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_barang" => $id])->row();
    }

    public function mtambahdata()
    {
        $post = $this->input->post();
        $this->id_barang = uniqid();
        $this->name = $post["name"];
		$this->jumlah = $post["jumlah"];
		$this->image = $this->_uploadImage();
        $this->db->insert($this->_table, $this);
    }

    public function mupdatedata()
    {
        $post = $this->input->post();
        $this->id_barang = $post["id"];
        $this->name = $post["name"];
		$this->jumlah = $post["jumlah"];
		
		
		if (!empty($_FILES["image"]["name"])) {
            $this->image = $this->_uploadImage();
        } else {
            $this->image = $post["old_image"];
		}

        $this->db->update($this->_table, $this, array('id_barang' => $post['id']));
    }

    public function mhapusdata($id)
    {
		$this->_deleteImage($id);
        return $this->db->delete($this->_table, array("id_barang" => $id));
	}
	
	private function _uploadImage()
	{
		$config['upload_path']          = './upload/product/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = $this->product_id;
		$config['overwrite']			= true;
		$config['max_size']             = 1024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image')) {
			return $this->upload->data("file_name");
		}
		
		return "default.jpg";
	}

	private function _deleteImage($id)
	{
		$product = $this->getById($id);
		if ($product->image != "default.jpg") {
			$filename = explode(".", $product->image)[0];
			return array_map('unlink', glob(FCPATH."upload/product/$filename.*"));
		}
	}
}