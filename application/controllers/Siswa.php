<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function index()
	{
		$this->load->model('sekolah_model');
		$data["siswa_list"] = $this->sekolah_model->getDataSiswa();
		$this->load->view('siswa_view', $data);
	}

	public function indexId($idKategori)
	{
		$this->load->model('sekolah_model');		
		$data["siswa_list"] = $this->sekolah_model->getBarangbyKategori($idKategori);
		$this->load->view('barangbykat', $data);
	}

	public function delete($id)
	{
		$this->load->model('sekolah_model');
		$this->sekolah_model->deleteSiswa($id);
		$data["siswa_list"] = $this->sekolah_model->getDataSiswa();	
		$this->load->view('siswa_view', $data);
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim');
		$this->load->model('sekolah_model');
		$data["kelas_list"] = $this->sekolah_model->getDataKelas();
		//$this->load->view('barang_create_view', $data);
		if($this->form_validation->run()==FALSE){

			$this->load->view('siswa_create_view',$data);

		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = 1000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('barang_create_view', $error);
			}
			else{
				$this->sekolah_model->insertSiswa();
				$data["siswa_list"] = $this->sekolah_model->getDataSiswa();	
				$this->load->view('siswa_view', $data);
			}
		}
	}

	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('sekolah_model');
		$data["kelas_list"] = $this->sekolah_model->getDataKelas();
		$data["siswa"] = $this->sekolah_model->getSiswaId($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('siswa_edit_view',$data);

		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = 1000000;
			$config['max_width']  = 10240;
			$config['max_height']  = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				// $error = array('error' => $this->upload->display_errors());
				// var_dump($error);
				$this->sekolah_model->updateSiswaTanpaFoto($id);
			$data["siswa_list"] = $this->sekolah_model->getDataSiswa();	
			$this->load->view('siswa_view', $data);
				//$this->load->view('barang_edit_view', $error);
			}
			else{
				$this->sekolah_model->updateSiswa($id);
			$data["siswa_list"] = $this->sekolah_model->getDataSiswa();	
			$this->load->view('siswa_view', $data);
			}
			
			//$this->load->view('edit_pegawai_sukses');

		}
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
?>