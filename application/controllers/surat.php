<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_model','surat');
		$this->load->model('pegawai_model','pegawai');
		$this->load->model('disposisi_model','disposisi');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == 'Sekretaris' || $this->session->userdata('jabatan') == 'Kepala Sekolah') {
				$data['notif'] = $this->disposisi->get_notif();
				$data['main_view'] = 'dashboard_view';
				$data['menu'] = 'dashboard';
				$data['surat_masuk_periode'] = $this->surat->get_surat_masuk_periode();
				$data['surat_keluar_periode'] = $this->surat->get_surat_keluar_periode();
				$this->load->view('template', $data);
			} else {
				redirect('surat/disposisi_masuk');
			}
		} else {
			redirect('login');
		}
	}

	//Pegawai
	public function pegawai()
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == 'Kepala Sekolah') {
				$data['notif'] = $this->disposisi->get_notif();
				$data['main_view'] = 'admin/pegawai_view';
				$data['menu'] = 'pegawai';
				$data['pegawai'] = $this->pegawai->get_pegawai();
				$data['jabatan'] = $this->pegawai->get_jabatan();
				$this->load->view('template', $data);
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function add_pegawai()
	{
		if ($this->pegawai->add_pegawai() == TRUE) {
			$this->session->set_flashdata('notifs', 'Tambah Pegawai Berhasil');
			redirect('surat/pegawai');
		} else {
			$this->session->set_flashdata('notifg', 'Tambah Pegawai Gagal');
			redirect('surat/pegawai');
		}
	}

	public function get_pegawai_by_id($id_user)
	{
		$query = $this->pegawai->get_pegawai_by_id($id_user);
		echo json_encode($query);
	}

	public function edit_pegawai()
	{
		if ($this->pegawai->update_pegawai() == TRUE) {
			$this->session->set_flashdata('notifs', 'Update Pegawai Berhasil');
			redirect('surat/pegawai');
		} else {
			$this->session->set_flashdata('notifg', 'Update Pegawai Gagal');
			redirect('surat/pegawai');
		}
	}

	public function delete_pegawai($id_user)
	{
		if ($this->pegawai->delete_pegawai($id_user) == TRUE) {
			$this->session->set_flashdata('notifs', 'Delete Pegawai Berhasil');
			redirect('surat/pegawai');
		} else {
			$this->session->set_flashdata('notifg', 'Delete Pegawai Gagal');
			redirect('surat/pegawai');
		}
	}

	//Surat Masuk
	public function surat_masuk()
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == 'Sekretaris' || $this->session->userdata('jabatan') == 'Kepala Sekolah') {
				$data['notif'] = $this->disposisi->get_notif();
				$data['main_view'] = 'surat/surat_masuk_view';
				$data['menu'] = 'surat_masuk';
				$data['surat'] = $this->surat->get_surat_masuk();
				$this->load->view('template', $data);
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function add_surat_masuk()
	{
		$config['upload_path'] = './assets/img/surat/';
		$config['allowed_types'] = 'pdf|zip|rar|png|jpg';
		$config['max_size']  = '1000000';
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('file_upload')){
			if ($this->surat->add_surat_masuk($this->upload->data()) == TRUE) {
				$this->session->set_flashdata('notifs', 'Add Mail Success');
				redirect('surat/surat_masuk');
				// print_r('berhasil');
				// die();
			} else {
				$this->session->set_flashdata('notifg', 'Add Mail Failed');
				redirect('surat/surat_masuk');
				// print_r('gagal');
				// die();
			}
		} else {
			$this->session->set_flashdata('notifg', $this->upload->display_errors());
			redirect('surat/surat_masuk');
			// print_r($this->upload->display_errors());
			// die();
		}
	}

	public function get_surat_masuk_by_id($id_surat)
	{
		$query = $this->surat->get_surat_masuk_by_id($id_surat);
		echo json_encode($query);
	}

	public function accept_surat($id_mail)
	{
		if ($this->surat->accept_surat($id_mail) == TRUE) {
			$this->session->set_flashdata('notifs', 'Mail Success to Accept');
			redirect('surat/surat_masuk');
		}else{
			$this->session->set_flashdata('notifg', 'Mail Failed to Accept');
			redirect('surat/surat_masuk');
		}
	}

	public function accept_surat_disposisi($id_mail)
	{
		if ($this->surat->accept_surat($id_mail) == TRUE) {
			if ($this->disposisi->done_disposisi($id_mail) == TRUE) {
				$this->session->set_flashdata('notifs', 'Mail Success to Accept');
				redirect('surat/disposisi_masuk');
			} else {
				$this->session->set_flashdata('notifg', 'Mail Failed to Accept');
				redirect('surat/disposisi_masuk');
			}
		}else{
			$this->session->set_flashdata('notifg', 'Mail Failed to Accept');
			redirect('surat/disposisi_masuk');
		}
	}

	public function reject_surat($id_mail)
	{
		if ($this->surat->reject_surat($id_mail) == TRUE) {
			$this->session->set_flashdata('notifs', 'Mail Success to reject');
			redirect('surat/surat_masuk');
		}else{
			$this->session->set_flashdata('notifg', 'Mail Failed to reject');
			redirect('surat/surat_masuk');
		}
	}

	public function reject_surat_disposisi($id_mail)
	{
		if ($this->surat->reject_surat($id_mail) == TRUE) {
			if ($this->disposisi->done_disposisi($id_mail) == TRUE) {
				$this->session->set_flashdata('notifs', 'Mail Success to reject');
				redirect('surat/disposisi_masuk');
			} else {
				$this->session->set_flashdata('notifg', 'Mail Failed to reject');
				redirect('surat/disposisi_masuk');
			}
		}else{
			$this->session->set_flashdata('notifg', 'Mail Failed to reject');
			redirect('surat/disposisi_masuk');
		}
	}

	public function delete_surat_masuk($id_mail)
	{
		if ($this->surat->delete_surat_masuk($id_mail) == TRUE) {
			$this->session->set_flashdata('notifs', 'Mail Success to Delete');
			redirect('surat/surat_masuk');
		}else{
			$this->session->set_flashdata('notifg', 'Mail Failed to Delete');
			redirect('surat/surat_masuk');
		}
	}

	public function edit_surat_masuk()
	{
		$config['upload_path'] = './assets/img/surat/';
		$config['allowed_types'] = 'pdf|zip|rar|png|jpg';
		$config['max_size']  = '1000000';
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('file_upload_edit')){
			if ($this->surat->update_surat_masuk($this->upload->data()) == TRUE) {
				$this->session->set_flashdata('notifs', 'Update Success');
				redirect('surat/surat_masuk');
			} else {
				$this->session->set_flashdata('notifg', 'Update Failed');
				redirect('surat/surat_masuk');
			}
		} else {
			$file = array(
				'file_name' => $this->db->where('id_mail',$this->input->post('id_mail_edit'))->get('mail')->row()->file_upload
			);
			if ($this->surat->update_surat_masuk($file) == TRUE) {
				$this->session->set_flashdata('notifs', 'Update Success');
				redirect('surat/surat_masuk');
			} else {
				$this->session->set_flashdata('notifg', 'Update Failed');
				redirect('surat/surat_masuk');
			}
		}
	}

	//Surat Keluar
	public function surat_keluar($value='')
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == 'Sekretaris' || $this->session->userdata('jabatan') == 'Kepala Sekolah') {
				$data['notif'] = $this->disposisi->get_notif();
				$data['main_view'] = 'surat/surat_keluar_view';
				$data['menu'] = 'surat_keluar';
				$data['surat'] = $this->surat->get_surat_keluar();
				$this->load->view('template', $data);
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function add_surat_keluar()
	{
		$config['upload_path'] = './assets/img/surat/';
		$config['allowed_types'] = 'pdf|zip|rar|png|jpg';
		$config['max_size']  = '1000000';
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('file_upload')){
			if ($this->surat->add_surat_keluar($this->upload->data()) == TRUE) {
				$this->session->set_flashdata('notifs', 'Add Mail Success');
				redirect('surat/surat_keluar');
				// print_r('berhasil');
				// die();
			} else {
				$this->session->set_flashdata('notifg', 'Add Mail Failed');
				redirect('surat/surat_keluar');
				// print_r('gagal');
				// die();
			}
		} else {
			$this->session->set_flashdata('notifg', $this->upload->display_errors());
			redirect('surat/surat_keluar');
			// print_r($this->upload->display_errors());
			// die();
		}
	}

	public function get_surat_keluar_by_id($id_surat)
	{
		$query = $this->surat->get_surat_keluar_by_id($id_surat);
		echo json_encode($query);
	}

	public function edit_surat_keluar()
	{
		$config['upload_path'] = './assets/img/surat/';
		$config['allowed_types'] = 'pdf|zip|rar|png|jpg';
		$config['max_size']  = '1000000';
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('file_upload_edit')){
			if ($this->surat->update_surat_keluar($this->upload->data()) == TRUE) {
				$this->session->set_flashdata('notifs', 'Update Success');
				redirect('surat/surat_keluar');
			} else {
				$this->session->set_flashdata('notifg', 'Update Failed');
				redirect('surat/surat_keluar');
			}
		} else {
			$file = array(
				'file_name' => $this->db->where('id_mail',$this->input->post('id_mail_edit'))->get('mail')->row()->file_upload
			);
			if ($this->surat->update_surat_keluar($file) == TRUE) {
				$this->session->set_flashdata('notifs', 'Update Success');
				redirect('surat/surat_keluar');
			} else {
				$this->session->set_flashdata('notifg', 'Update Failed');
				redirect('surat/surat_keluar');
			}
		}
	}

	public function delete_surat_keluar($id_mail)
	{
		if ($this->surat->delete_surat_keluar($id_mail) == TRUE) {
			$this->session->set_flashdata('notifs', 'Mail Success to Delete');
			redirect('surat/surat_keluar');
		}else{
			$this->session->set_flashdata('notifg', 'Mail Failed to Delete');
			redirect('surat/surat_keluar');
		}
	}

	//Disposisi
	public function disposisi_keluar($id_mail)
	{
		$data['notif'] = $this->disposisi->get_notif();
		$data['main_view'] = 'disposisi/disposisi_keluar_view';
		$data['menu'] = 'disposisi_keluar';
		$data['disposisi'] = $this->disposisi->get_disposisi_keluar();
		$data['surat'] = $this->surat->get_surat_masuk_by_id($id_mail);
		$data['jabatan'] = $this->disposisi->get_jabatan();
		$this->load->view('template', $data);
	}

	public function disposisi_masuk()
	{
		$data['notif'] = $this->disposisi->get_notif();
		$data['main_view'] = 'disposisi/disposisi_masuk_view';
		$data['menu'] = 'disposisi_masuk';
		$data['disposisi'] = $this->disposisi->get_disposisi_masuk();
		$data['jabatan'] = $this->disposisi->get_jabatan();
		$this->load->view('template', $data);
	}

	public function get_pegawai_by_id_jabatan($id_jabatan)
	{
		$query = $this->disposisi->get_pegawai_by_id_jabatan($id_jabatan);
		echo json_encode($query);
	}

	public function add_disposisi($id_mail)
	{
		if ($this->disposisi->add_disposisi($id_mail) == TRUE) {
			$this->session->set_flashdata('notifs', 'Disposition Success');
			redirect('surat/disposisi_keluar/'.$id_mail);
		} else {
			$this->session->set_flashdata('notifg', 'Disposition Failed');
			redirect('surat/disposisi_keluar/'.$id_mail);
		}
	}

	public function delete_disposition_keluar($id_mail)
	{
		if ($this->disposisi->delete_disposisi_keluar($id_mail) == TRUE) {
			$this->session->set_flashdata('notifs', 'Delete Disposition Success');
			redirect('surat/disposisi_keluar/'.$id_mail);
		} else {
			$this->session->set_flashdata('notifg', 'Delete Disposition Failed');
			redirect('surat/disposisi_keluar/'.$id_mail);
		}
	}

	public function delete_disposition_masuk($id_mail)
	{
		if ($this->disposisi->delete_disposisi_masuk($id_mail) == TRUE) {
			$this->session->set_flashdata('notifs', 'Delete Disposition Success');
			redirect('surat/disposisi_masuk');
		} else {
			$this->session->set_flashdata('notifg', 'Delete Disposition Failed');
			redirect('surat/disposisi_masuk');
		}
	}

	public function done_notif($id_disposition)
	{
		if ($this->disposisi->done_notif($id_disposition) == TRUE) {
			redirect('surat/disposisi_masuk');
		} else {
			redirect('surat');
		}
	}
}

/* End of file surat.php */
/* Location: ./application/controllers/surat.php */