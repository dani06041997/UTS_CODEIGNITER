<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function index($id)
	{
		$this->load->model('sekolah_model');
		$data["kelas_list"] = $this->sekolah_model->getKelasId($id);
		$this->load->view('kelas_view',$data);	
	}

	public function lihat()
	{
		$this->load->model('sekolah_model');
		$data["kelas_list"] = $this->sekolah_model->getDataKelas();
		$this->load->view('kelas_view',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('sekolah_model');
		if($this->form_validation->run()==FALSE){
			$this->load->view('kelas_create_view');
		}else{
			$this->sekolah_model->insertKelas();
			$data["kelas_list"] = $this->sekolah_model->getDataKelas();	
			$this->load->view('kelas_view', $data);
		}
	}

	public function update($id)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('sekolah_model');
		$data['kelas']=$this->sekolah_model->getKelas($id);
		if($this->form_validation->run()==FALSE){
			$this->load->view('kelas_edit_view',$data);
		}else{
			$this->sekolah_model->updateById($id);
			$data["kelas_list"] = $this->sekolah_model->getDataKelas();	
			$this->load->view('kelas_view', $data);
		}
	}
	public function delete($id)
	{
		$this->load->model('sekolah_model');
		$this->sekolah_model->deleteKelas($id);
		$data["kelas_list"] = $this->sekolah_model->getDataKelas();	
		$this->load->view('kelas_view', $data);
	}
}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */
?>