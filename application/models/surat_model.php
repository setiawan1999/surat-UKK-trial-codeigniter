<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_model extends CI_Model {
	public function accept_surat($id_mail)
	{
		$object = array(
			'status' => 'accepted'
		);
		$this->db->where('id_mail',$id_mail)
				 ->update('mail', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function reject_surat($id_mail)
	{
		$object = array(
			'status' => 'rejected'
		);
		$this->db->where('id_mail',$id_mail)
				 ->update('mail', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	//Surat Masuk
	public function update_surat_masuk($file)
	{
		$object = array(
			'incoming_at'	=> $this->input->post('incoming_at_edit'),
			'mail_code'		=> $this->input->post('mail_code_edit'),
			'mail_date'		=> $this->input->post('mail_date_edit'),
			'mail_from'		=> $this->input->post('mail_from_edit'),
			'mail_subject'	=> $this->input->post('mail_subject_edit'),
			'file_upload'	=> $file['file_name'],
			'id_user'		=> $this->session->userdata('id_user')
		);
		$this->db->where('id_mail',$this->input->post('id_mail_edit'))
				 ->update('mail', $object);
		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function add_surat_masuk($file)
	{
		$object = array(
			'incoming_at'	=> $this->input->post('incoming_at'),
			'mail_code'		=> $this->input->post('mail_code'),
			'mail_date'		=> $this->input->post('mail_date'),
			'mail_from'		=> $this->input->post('mail_from'),
			'mail_to'		=> 'SMK TELKOM MALANG',
			'mail_subject'	=> $this->input->post('mail_subject'),
			'status'		=> 'pending',
			'file_upload'	=> $file['file_name'],
			'id_mail_type'	=> 1,
			'id_user'		=> $this->session->userdata('id_user')
		);
		$this->db->insert('mail', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_surat_masuk($id_mail)
	{
		$this->db->where('id_mail',$id_mail)
				 ->delete('mail');

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_surat_masuk()
	{
		return $this->db->join('mail_type','mail_type.id_mail_type = mail.id_mail_type')
						->where('mail_type.mail_type','masuk')
						->get('mail')
						->result();
	}

	public function get_surat_masuk_by_id($id_surat)
	{
		return $this->db->join('mail_type','mail_type.id_mail_type = mail.id_mail_type')
						->where('mail.id_mail',$id_surat)
						->where('mail_type.mail_type','masuk')
						->get('mail')
						->row();
	}

	public function get_surat_masuk_periode()
	{
		return $this->db->join('mail_type','mail_type.id_mail_type = mail.id_mail_type')
						->where('mail_type.mail_type','masuk')
						->like('mail.mail_date',date('Y').'-')
						->get('mail')
						->result();
	}

	//Surat Keluar
	public function update_surat_keluar($file)
	{
		$object = array(
			'incoming_at'	=> $this->input->post('incoming_at_edit'),
			'mail_code'		=> $this->input->post('mail_code_edit'),
			'mail_date'		=> $this->input->post('mail_date_edit'),
			'mail_to'		=> $this->input->post('mail_to_edit'),
			'mail_subject'	=> $this->input->post('mail_subject_edit'),
			'file_upload'	=> $file['file_name'],
			'id_user'		=> $this->session->userdata('id_user')
		);
		$this->db->where('id_mail',$this->input->post('id_mail_edit'))
				 ->update('mail', $object);
		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function add_surat_keluar($file)
	{
		$object = array(
			'incoming_at'	=> $this->input->post('incoming_at'),
			'mail_code'		=> $this->input->post('mail_code'),
			'mail_date'		=> $this->input->post('mail_date'),
			'mail_from'		=> 'SMK TELKOM MALANG',
			'mail_to'		=> $this->input->post('mail_to'),
			'mail_subject'	=> $this->input->post('mail_subject'),
			'status'		=> 'send',
			'file_upload'	=> $file['file_name'],
			'id_mail_type'	=> 2,
			'id_user'		=> $this->session->userdata('id_user')
		);
		$this->db->insert('mail', $object);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_surat_keluar_periode()
	{
		return $this->db->join('mail_type','mail_type.id_mail_type = mail.id_mail_type')
						->where('mail_type.mail_type','keluar')
						->like('mail.mail_date',date('Y').'-')
						->get('mail')
						->result();
	}

	public function get_surat_keluar()
	{
		return $this->db->join('mail_type','mail_type.id_mail_type = mail.id_mail_type')
						->where('mail_type.mail_type','keluar')
						->get('mail')
						->result();
	}

	public function get_surat_keluar_by_id($id_surat)
	{
		return $this->db->join('mail_type','mail_type.id_mail_type = mail.id_mail_type')
						->where('mail.id_mail',$id_surat)
						->where('mail_type.mail_type','keluar')
						->get('mail')
						->row();
	}

	public function delete_surat_keluar($id_mail)
	{
		$this->db->where('id_mail',$id_mail)
				 ->delete('mail');

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file surat_model.php */
/* Location: ./application/models/surat_model.php */