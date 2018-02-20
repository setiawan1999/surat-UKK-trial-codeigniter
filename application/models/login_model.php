<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function do_login()
	{
		$query = $this->db->where('username',$this->input->post('username'))
						  ->where('password',$this->input->post('password'))
						  ->join('jabatan','jabatan.id_jabatan = user.id_jabatan')
						  ->get('user');
		if ($query->num_rows() == 1) {
			$array = array(
				'logged_in' => TRUE,
				'username'	=> $this->input->post('username'),
				'id_user'	=> $query->row()->id_user,
				'id_jabatan'=> $query->row()->id_jabatan,
				'jabatan'	=> $query->row()->nama_jabatan,
			);
			
			$this->session->set_userdata( $array );

			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */