<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

	public function get_pegawai()
	{
		return $this->db->join('jabatan','jabatan.id_jabatan = user.id_jabatan')
						->where('jabatan.nama_jabatan !=','Kepala Sekolah')
						->get('user')
						->result();
	}

	public function get_jabatan()
	{
		return $this->db->where('nama_jabatan !=','Kepala Sekolah')
						->get('jabatan')
						->result();
	}

	public function add_pegawai()
	{
		$object = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'fullname' => $this->input->post('fullname'),
			'id_jabatan' => $this->input->post('id_jabatan')
		);
		$this->db->insert('user', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_pegawai_by_id($id_user)
	{
		return $this->db->where('id_user',$id_user)
						->get('user')
						->row();
	}

	public function update_pegawai()
	{
		if ($this->input->post('id_jabatan_edit') == NULL) {
			$jabatan = $this->db->where('id_user',$this->input->post('id_user_edit'))->get('user')->row();
			$object = array(
				'username' => $this->input->post('username_edit'),
				'password' => $this->input->post('password_edit'),
				'fullname' => $this->input->post('fullname_edit'),
				'id_jabatan' => $jabatan->id_jabatan
			);
		} else {
			$object = array(
				'username' => $this->input->post('username_edit'),
				'password' => $this->input->post('password_edit'),
				'fullname' => $this->input->post('fullname_edit'),
				'id_jabatan' => $this->input->post('id_jabatan_edit')
			);
		}
		$this->db->where('id_user',$this->input->post('id_user_edit'))
				 ->update('user', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_pegawai($id_user)
	{
		$this->db->where('id_user',$id_user)
				 ->delete('user');

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file pegawai_model.php */
/* Location: ./application/models/pegawai_model.php */