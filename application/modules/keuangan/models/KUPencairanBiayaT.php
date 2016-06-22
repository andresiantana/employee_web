<?php
$obj = &get_instance();
$obj->load->model('PencairanBiayaT');
defined('BASEPATH') OR exit('No direct script access allowed');

class KUPencairanBiayaT extends PencairanBiayaT {
	public function tampilData($nama_pegawai = null , $kode_pencairan = null, $tanggal_awal = null ,$tanggal_akhir = null){
		$this->db->select('*');
		$this->db->from('pencairan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pencairan_biaya.id_pegawai');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = pencairan_biaya.id_pengajuan_biaya');
		if($nama_pegawai != ''){
			$this->db->like('pegawai.nama_lengkap', $nama_pegawai);
		}
		if($kode_pencairan != ''){
			$this->db->like('pencairan_biaya.kode_pencairan', $kode_pencairan);
		}
		if($tanggal_awal != ''){
			$this->db->where('pencairan_biaya.tanggal_pencairan', $tanggal_awal);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tampilDataTransaksi($id){
		$this->db->select('*');
		$this->db->from('pencairan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pencairan_biaya.id_pegawai');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = pencairan_biaya.id_pengajuan_biaya');
		// $this->db->join('kategori_biaya','kategori_biaya.id_kategori_biaya = pengajuan_biaya.id_kategori_biaya');
		$this->db->where('pencairan_biaya.id_pencairan_biaya', $id);
		$query = $this->db->get();
		return $query;
	}

	public function tampilLaporanPengeluaran($num, $offset, $nip = null, $nama = null, $kode_pengeluaran = null, $tanggal_awal = null ,$tanggal_akhir = null){
		$this->db->select('*');
		if($nip != ''){
			$this->db->like('pegawai.nip', $nip);
		}
		if($nama != ''){
			$this->db->like('pegawai.nama_lengkap', $nama);
		}
		if($kode_pengeluaran != ''){
			$this->db->like('pencairan_biaya.kode_pencairan', $kode_pengeluaran);
		}
		if($tanggal_awal != ''){
			$this->db->where("pencairan_biaya.tanggal_pencairan BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."'");
		}

		$this->db->join('pegawai', 'pegawai.id_pegawai = pencairan_biaya.id_pegawai');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = pencairan_biaya.id_pengajuan_biaya');
		
		$query = $this->db->get('pencairan_biaya',$num,$offset);
		return $query;
	}

	public function tampilLaporanPendanaanBeasiswa($num, $offset, $nip = null, $nama = null, $kode_pengeluaran = null, $tanggal_awal = null ,$tanggal_akhir = null){
		$this->db->select('*');
		if($nip != ''){
			$this->db->like('pegawai.nip', $nip);
		}
		if($nama != ''){
			$this->db->like('pegawai.nama_lengkap', $nama);
		}
		if($kode_pengeluaran != ''){
			$this->db->like('pencairan_biaya.kode_pencairan', $kode_pengeluaran);
		}
		if($tanggal_awal != ''){
			$this->db->where("pencairan_biaya.tanggal_pencairan BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."'");
		}
		if(isset($_GET['pages'])){
			if(!empty($_GET['pages']) && $_GET['pages'] == 'pegawai'){
				$this->db->where('pegawai.id_user',$this->session->userdata('id_user'));
			}
		}
		$this->db->join('pegawai', 'pegawai.id_pegawai = pencairan_biaya.id_pegawai');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = pencairan_biaya.id_pengajuan_biaya');
		
		$query = $this->db->get('pencairan_biaya',$num,$offset);
		return $query;
	}
}

/* End of file KUPencairanBiayaT.php */
/* Location: ./application/modules/keuangan/models/KUPencairanBiayaT.php */