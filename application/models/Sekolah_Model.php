<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah_Model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function getDataKelas()
	{
		$this->db->select("id,nama");
		$query = $this->db->get('kelas');
		return $query->result();
	}

	public function insertKelas()
	{
		$object = array(
			'nama' => $this->input->post('nama'), 
		);
		$this->db->insert('kelas', $object);
	}

	public function getKelas($id)
	{
		$this->db->where('id', $id);	
		$query = $this->db->get('kelas',1);
		return $query->result();
	}

	public function updateById($id)
	{
		$data = array('nama' => $this->input->post('nama'));
		$this->db->where('id', $id);
		$this->db->update('kelas', $data);
	}

	public function deleteKelas($id)
	{
		$this->db->delete('kelas', array('id' => $id));
	}

	public function getDataSiswa()
	{
		$this->db->select("id,nama,DATE_FORMAT(tanggal_lahir,'%d-%m-%Y') as tanggal_lahir, foto, fk_kelas");
		$query = $this->db->get('siswa');
		return $query->result();
	}

	public function getSiswabyKelas($idKategori)
	{
		$this->db->select("kelas.id as idkelas, kelas.nama as nama, siswa.id as idsiswa, siswa.nama as namasiswa, siswa.tanggal_lahir, siswa.foto");
		$this->db->where('fk_kelas', $idKategori);	
		$this->db->join('kelas', 'siswa.fk_kelas = kelas.id', 'right');	
		$query = $this->db->get('siswa');
		return $query->result();
	}

	public function getKelasId($id)
	{
		$this->db->where('id', $id);
		$query=$this->db->get('kelas');
		return $query->result();
	}

	public function deleteSiswa($id)
	{
		$this->db->delete('siswa', array('id' => $id));
	}

	public function insertSiswa()
	{
		$object = array(
			'nama' => $this->input->post('namasiswa'), 
			'tanggal_lahir'=>$this->input->post('tanggal_lahir'), 
			'foto' => $this->upload->data('file_name'),
			'fk_kelas'=>$this->input->post('kategori')
			
		);
		$this->db->insert('siswa', $object);
	}	

	public function getSiswaId($id)
	{
		$this->db->where('id', $id);	
		$query = $this->db->get('siswa',1);
		return $query->result();
	}

	public function updateSiswa($id)
	{
		$data = array('nama' => $this->input->post('nama'), 
			'tanggal_lahir' => $this->input->post('tanggal_beli'),
			'foto' => $this->upload->data('file_name'),
			'fk_kelas'=>$this->input->post('fk_kelas'));
		$this->db->where('id', $id);
		$this->db->update('siswa', $data);
	}
	public function updateSiswaTanpaFoto($id)
	{
		$data = array('nama' => $this->input->post('nama'), 
			'tanggal_lahir' => $this->input->post('tanggal_beli'),
			'fk_kelas'=>$this->input->post('fk_kelas'));
		$this->db->where('id', $id);
		$this->db->update('siswa', $data);
	}
}

/* End of file Barang_Model.php */
/* Location: ./application/models/Barang_Model.php */
?>