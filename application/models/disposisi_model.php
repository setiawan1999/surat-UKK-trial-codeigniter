<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi_model extends CI_Model {

	public function add_disposisi($id_mail)
	{
		$object = array(
			'disposition_at' => date('Y-m-d'),
			'description' => $this->input->post('description'),
			'notification' => 0,
			'id_mail' => $id_mail,
			'id_user_send' => $this->session->userdata('id_user'),
			'id_user_acc' => $this->input->post('disposition_to'),
			'status_disposition' => 'not done'
		);
		$this->db->insert('disposition', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_disposisi_keluar()
	{
		return $this->db->join('mail','mail.id_mail = disposition.id_mail')
						->join('user','user.id_user = disposition.id_user_acc')
						->join('jabatan','user.id_jabatan = jabatan.id_jabatan')
						->where('disposition.id_user_send',$this->session->userdata('id_user'))
						->get('disposition')
						->result();
	}

	public function get_disposisi_masuk()
	{
		return $this->db->join('mail','mail.id_mail = disposition.id_mail')
						->join('user','user.id_user = disposition.id_user_send')
						->join('jabatan','user.id_jabatan = jabatan.id_jabatan')
						->where('disposition.id_user_acc',$this->session->userdata('id_user'))
						->get('disposition')
						->result();
	}

	public function get_jabatan()
	{
		return $this->db->get('jabatan')
						->result();
	}

	public function get_pegawai_by_id_jabatan($id_jabatan)
	{
		return $this->db->where('id_jabatan',$id_jabatan)
						->get('user')
						->result();
	}

	public function delete_disposisi_keluar($id_mail)
	{
		$this->db->where('id_user_send',$this->session->userdata('id_user'))
				 ->where('id_mail',$id_mail)
				 ->delete('disposition');

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_disposisi_masuk($id_mail)
	{
		$this->db->where('id_user_acc',$this->session->userdata('id_user'))
				 ->where('id_mail',$id_mail)
				 ->delete('disposition');

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function done_disposisi($id_mail)
	{
		$object = array(
			'status_disposition' => 'done',
			'notification' => 1
		);

		$this->db->where('id_mail',$id_mail)
				 ->update('disposition', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_notif()
	{
		return $this->db->where('notification',0)
						->where('id_user_acc',$this->session->userdata('id_user'))
						->join('mail','disposition.id_mail = mail.id_mail')
						->get('disposition')
						->result();
	}

	public function done_notif($id_disposition)
	{
		$object = array(
			'notification' => 1
		);

		$this->db->where('id_disposition',$id_disposition)
				 ->update('disposition', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file disposisi_model.php */
/* Location: ./application/models/disposisi_model.php */