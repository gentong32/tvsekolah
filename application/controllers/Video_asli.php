<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_video');
		$this->load->helper('video');
		if (!$this->session->userdata('loggedIn') || $this->session->userdata('tukang_kontribusi') > 2) {
			redirect('/');
		}

		$this->load->helper(array('Form', 'Cookie'));
	}

	public function index()
	{
		$data = array('title' => 'Daftar Video',
			'isi' => 'v_video');

		$data['statusvideo'] = 'semua';

		if ($this->is_connected())
			$data['nyambung'] = true;
		else
			$data['nyambung'] = false;

		$id_user = $this->session->userdata('id_user');
		if ($this->session->userdata('a01')) {
			$data['dafvideo'] = $this->M_video->getVideoAll();
			$data['statusvideo'] = 'admin';
		} else if ($this->session->userdata('a02') || $this->session->userdata('a03')) {
			$data['dafvideo'] = $this->M_video->getVideoUser($id_user);
		}
		$this->load->view('layout/wrapper', $data);
	}

	public function is_connected($sCheckHost = 'www.google.com')
	{
		return (bool)@fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
	}

	public function vervideo()
	{
		if ($this->session->userdata('a01') || $this->session->userdata('a02')) {
			$data = array('title' => 'Daftar Video',
				'isi' => 'v_video');
			if ($this->session->userdata('tukang_verifikasi') == 1)
				$data['dafvideo'] = $this->M_video->getVideoVer1($this->session->userdata('npsn'));
			else if ($this->session->userdata('tukang_verifikasi') == 2)
				$data['dafvideo'] = $this->M_video->getVideoAllLain();
			else if ($this->session->userdata('a01'))
				$data['dafvideo'] = $this->M_video->getVideoAll();

			$data['statusvideo'] = 'verifikasi';
			$this->load->view('layout/wrapper', $data);
		}
	}

	public function tambah()
	{
		$data = array('title' => 'Tambahkan Video',
			'isi' => 'v_video_tambah');
		$data['addedit'] = "add";
		$data['dafjenjang'] = $this->M_video->getAllJenjang();
		$data['dafkategori'] = $this->M_video->getAllKategori();
		$data['datavideo'] = Array('status_verifikasi' => 0);
		$data['idvideo'] = 0;
        $data['namafile'] = "";
		//	if ($judul!=null)
		//		$data['judulvideo'] = $judul;
		$this->load->view('layout/wrapper', $data);
	}

    public function tambahmp4()
    {
        $data = array('title' => 'Tambahkan Video',
            'isi' => 'v_video_tambahmp4');
        $data['addedit'] = "add";
        $data['dafjenjang'] = $this->M_video->getAllJenjang();
        $data['dafkategori'] = $this->M_video->getAllKategori();
        $data['datavideo'] = Array('status_verifikasi' => 0);
        $data['idvideo'] = 0;
        $data['namafile'] = "";
        //	if ($judul!=null)
        //		$data['judulvideo'] = $judul;
        $this->load->view('layout/wrapper', $data);
    }

	public function edit($id_video)
	{
		$data = array('title' => 'Edit Video',
			'isi' => 'v_video_tambah');

		$data['addedit'] = "edit";
		$data['dafjenjang'] = $this->M_video->getAllJenjang();
		$data['dafkategori'] = $this->M_video->getAllKategori();
		$data['datavideo'] = $this->M_video->getVideo($id_video);
		$data['dafkelas'] = $this->M_video->dafKelas($data['datavideo']['id_jenjang']);
		$data['dafmapel'] = $this->M_video->dafMapel($data['datavideo']['id_jenjang']);
		
		$data['idvideo'] = $id_video;

        $data['jenisvideo']="mp4";
		if ($data['datavideo']['link_video']!="")
		{
			//$idyoutube=substr($data['datavideo']['link_video'],32,11);
			//$data['infodurasi'] = $this->getVideoInfo($idyoutube);
            $data['jenisvideo']="yt";
		}

		$data['dafkd1'] = $this->M_video->dafKD($data['datavideo']['id_kelas'], $data['datavideo']['id_mapel'], $data['datavideo']['id_ki1']);
		$data['dafkd2'] = $this->M_video->dafKD($data['datavideo']['id_kelas'], $data['datavideo']['id_mapel'], $data['datavideo']['id_ki2']);
		$this->load->view('layout/wrapper', $data);
	}

	public function getVideoInfo($vidkey)
	{
		$apikey = "AIzaSyCytrDv72V-mQmXwIteXq50hZdK_EgmoFU";
		$dur = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails,snippet&id=$vidkey&key=$apikey");
		$VidDuration = json_decode($dur, true);
		foreach ($VidDuration['items'] as $vidTime) {
			$VidDuration = $vidTime['contentDetails']['duration'];
//			$channel = $vidTime['snippet']['channelId'];
//			//$dur = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails,snippet&id=$vidkey&key=$apikey");
//			//$datayt = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=snippet,contentDetails,statistics&mine=true&access_token=smohLqUHcpdkt9RKauZ8zOJNieyIQjxw");
//			//$daty = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&mine=true&key=AIzaSyCytrDv72V-mQmXwIteXq50hZdK_EgmoFU");
//			$daty = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=id%2Csnippet%2Cstatistics%2CcontentDetails%2CtopicDetails&id=".$channel."&key=AIzaSyCytrDv72V-mQmXwIteXq50hZdK_EgmoFU");
//			echo $channel.'<br>';
//			echo $daty;
//			die();
			preg_match_all('/(\d+)/', $VidDuration, $parts);
			$hours = intval(floor($parts[0][0] / 60));
			$minutes = intval($parts[0][0] % 60);
			$seconds = intval($parts[0][1]);
			if ($hours < 10) {
				$hours = "0" . $hours;
			}
			if ($minutes < 10) {
				$minutes = "0" . $minutes;
			}
			if ($seconds < 10) {
				$seconds = "0" . $seconds;
			}

			//$totalSec = $hours + $minutes + $seconds;
			$totalSec = $hours . ':' . $minutes . ':' . $seconds;
			echo $totalSec;
			return $totalSec;
		}


	}


	public function hapus($id_video)
	{
		$this->M_video->delsafevideo($id_video);
		redirect('/video', '_self');
	}

	public function daftarkelas()
	{
		$idjenjang = $_GET['idjenjang'];
		$isi = $this->M_video->dafKelas($idjenjang);
		echo json_encode($isi);
	}

	public function daftarmapel()
	{
		$idjenjang = $_GET['idjenjang'];
		$isi = $this->M_video->dafMapel($idjenjang);
		echo json_encode($isi);
	}

	public function ambilkd()
	{
		$idkelas = $_GET['idkelas'];
		$idmapel = $_GET['idmapel'];
		$idki = $_GET['idki'];

//		$idkelas = 9;
//		$idmapel = 5;
//		$idki = 3;

		$isi = $this->M_video->dafKD($idkelas, $idmapel, $idki);
		echo json_encode($isi);
	}

	public function addkd()
	{
		$idkelas = $_POST['idkelas'];
		$idmapel = $_POST['idmapel'];
		$idki = $_POST['idki'];
		$kade = $_POST['tekskd'];

		$data['id_kelas'] = $idkelas;
		$data['id_mapel'] = $idmapel;
		$data['id_ki'] = $idki;
		$data['nama_kd'] = $kade;

		$this->load->model('M_seting');
		$this->M_seting->addkd($data);

		$this->load->model('M_video');
		$isi = $this->M_video->dafKD($idkelas, $idmapel, $idki);

		echo json_encode($isi);

	}

	public function addkat()
	{
		$kate = $_POST['tekskate'];
		$data['nama_kategori'] = $kate;

		$this->load->model('M_seting');
		$this->M_seting->addkate($data);

		$this->load->model('M_video');
		$isi = $this->M_video->getAllKategori();

		echo json_encode($isi);

	}

	public function editkd()
	{
		$idkd = $_POST['idkade'];
		$tekskade = $_POST['tekskade'];
		$idkelas = $_POST['idkelas'];
		$idmapel = $_POST['idmapel'];
		$idki = $_POST['idki'];

		$data['nama_kd'] = $tekskade;

		$this->load->model('M_seting');
		$this->M_seting->editkd($data, $idkd);

		$this->load->model('M_video');
		$isi = $this->M_video->dafKD($idkelas, $idmapel, $idki);

		echo json_encode($isi);

	}

	public function editkat()
	{
		$idkate = $_POST['idkate'];
		$tekskate = $_POST['tekskate'];


		$data['nama_kategori'] = $tekskate;

		$this->load->model('M_seting');
		$this->M_seting->editkate($data, $idkate);

		$this->load->model('M_video');
		$isi = $this->M_video->getAllKategori();

		echo json_encode($isi);

	}

	public function ambilkategori()
	{
		$this->load->model('M_video');
		$isi = $this->M_video->getAllKategori();
		echo json_encode($isi);
	}


	public function addvideo()
	{

		if ($this->input->post('ijudul') == null) {
			redirect('video');
		}

		$data['id_jenis'] = $this->input->post('ijenis');
		$data['id_jenjang'] = $this->input->post('ijenjang');
		$data['id_kelas'] = $this->input->post('ikelas');
		$data['id_mapel'] = $this->input->post('imapel');
		$data['id_ki1'] = $this->input->post('iki1');
		$data['id_ki2'] = $this->input->post('iki2');
		$data['id_kd1_1'] = $this->input->post('ikd1_1');
		$data['id_kd1_2'] = $this->input->post('ikd1_2');
		$data['id_kd1_3'] = $this->input->post('ikd1_3');
		$data['id_kd2_1'] = $this->input->post('ikd2_1');
		$data['id_kd2_2'] = $this->input->post('ikd2_2');
		$data['id_kd2_3'] = $this->input->post('ikd2_3');
		$data['id_kategori'] = $this->input->post('ikategori');
		$data['topik'] = $this->input->post('itopik');
		$data['judul'] = $this->input->post('ijudul');
		$data['deskripsi'] = $this->input->post('ideskripsi');
		$data['keyword'] = $this->input->post('ikeyword');
		$data['link_video'] = $this->input->post('ilink');
		$data['durasi'] = $this->input->post('idurjam') . ':' . $this->input->post('idurmenit') . ':' . $this->input->post('idurdetik');
		$statusverifikasi = $this->input->post('status_ver');

		if ($this->input->post('addedit') == "add") {
			$data['id_user'] = $this->session->userdata('id_user');
			if ($data['link_video'] != "") {
				$data['durasi'] = $this->input->post('ytube_duration');
				$data['thumbnail'] = $this->input->post('ytube_thumbnail');
				$data['id_youtube'] = $this->input->post('idyoutube');
			}
			$data['kode_video'] = base_convert(microtime(false), 10, 36);
		} else {
			//$data['kode_video'] = base_convert($this->input->post('created'),10,16);
		}

		if ($this->input->post('filevideo') != "" || $this->session->userdata('tukang_kontribusi') == 2) {
			$data['status_verifikasi'] = 4;
		} else if ($statusverifikasi == 1) {
			$data['status_verifikasi'] = 0;
		} else if ($statusverifikasi == 3) {
			$data['status_verifikasi'] = 2;
		}

		if ($data['id_jenis'] == 1) {
			$data['id_kategori'] = 0;
		} else {
			$data['id_jenjang'] = 0;
			$data['id_kelas'] = 0;
			$data['id_mapel'] = 0;
			$data['id_ki1'] = 0;
			$data['id_ki2'] = 0;
			$data['id_kd1_1'] = 0;
			$data['id_kd1_2'] = 0;
			$data['id_kd1_3'] = 0;
			$data['id_kd2_1'] = 0;
			$data['id_kd2_2'] = 0;
			$data['id_kd2_3'] = 0;
		}

		if ($this->input->post('addedit') == "add") {
			$idbaru = $this->M_video->addVideo($data);
			redirect('video');
			//redirect('video/edit/'.$idbaru);
		} else {
			$this->M_video->editVideo($data, $this->input->post('id_video'));
			redirect('video');
		}
	}

    public function addvideomp4()
    {

        if ($this->input->post('ijudul') == null) {
            redirect('video');
        }

        $data['id_jenis'] = $this->input->post('ijenis');
        $data['id_jenjang'] = $this->input->post('ijenjang');
        $data['id_kelas'] = $this->input->post('ikelas');
        $data['id_mapel'] = $this->input->post('imapel');
        $data['id_ki1'] = $this->input->post('iki1');
        $data['id_ki2'] = $this->input->post('iki2');
        $data['id_kd1_1'] = $this->input->post('ikd1_1');
        $data['id_kd1_2'] = $this->input->post('ikd1_2');
        $data['id_kd1_3'] = $this->input->post('ikd1_3');
        $data['id_kd2_1'] = $this->input->post('ikd2_1');
        $data['id_kd2_2'] = $this->input->post('ikd2_2');
        $data['id_kd2_3'] = $this->input->post('ikd2_3');
        $data['id_kategori'] = $this->input->post('ikategori');
        $data['topik'] = $this->input->post('itopik');
        $data['judul'] = $this->input->post('ijudul');
        $data['deskripsi'] = $this->input->post('ideskripsi');
        $data['keyword'] = $this->input->post('ikeyword');
        $statusverifikasi = $this->input->post('status_ver');


//        if ($this->input->post('filevideo') != "" || $this->session->userdata('tukang_kontribusi') == 2) {
//            $data['status_verifikasi'] = 4;
//        } else if ($statusverifikasi == 1) {
//            $data['status_verifikasi'] = 0;
//        } else if ($statusverifikasi == 3) {
//            $data['status_verifikasi'] = 2;
//        }

        if ($data['id_jenis'] == 1) {
            $data['id_kategori'] = 0;
        } else {
            $data['id_jenjang'] = 0;
            $data['id_kelas'] = 0;
            $data['id_mapel'] = 0;
            $data['id_ki1'] = 0;
            $data['id_ki2'] = 0;
            $data['id_kd1_1'] = 0;
            $data['id_kd1_2'] = 0;
            $data['id_kd1_3'] = 0;
            $data['id_kd2_1'] = 0;
            $data['id_kd2_2'] = 0;
            $data['id_kd2_3'] = 0;
        }

        if ($this->input->post('addedit') == "add") {
            $idbaru = $this->M_video->addVideo($data);
            $this->upload_mp4_intern($idbaru);
            //redirect('video/edit/'.$idbaru);
        } else {
            $this->M_video->editVideo($data, $this->input->post('id_video'));
            redirect('video');
        }
    }

//    public function tesprivat()
//    {
//        $this->upload_mp4_intern(5);
//    }

	public function verifikasi($id_video)
	{
		$data = array('title' => 'Verifikasi Video',
			'isi' => 'v_video_verifikasi');

		$datav['id_video'] = $id_video;
		$datav['id_verifikator'] = $this->session->userdata('id_user');
		$datav['no_verifikator'] = $this->session->userdata('tukang_verifikasi');

		$data['datavideo'] = $this->M_video->getVideoKomplit($id_video);
		$data['dafpernyataan'] = $this->M_video->getAllPernyataan($datav['no_verifikator']);
		$data['dafpenilaian'] = $this->M_video->getPenilaian($id_video, $datav);

		if ($datav['no_verifikator'] == 1) {
			if ($this->session->userdata('npsn') != $data['datavideo']['npsn'])
				redirect('video');
		}
		// else if ($datav['no_verifikator']==2)
		// {

		// }

		$this->load->view('layout/wrapper', $data);

	}

	public function simpanverifikasi()
	{
		//echo $this->session->userdata('tukang_verifikasi');
		$verifikator = $this->session->userdata('tukang_verifikasi');
		$id_video = $this->input->post('id_video');
		$total_isian = $this->input->post('total_isian');
		$jml_diisi = $this->input->post('jml_diisi');
		$lulusgak = $this->input->post('lulusgak');
		// echo 'Total:'.$total_isian;
		// echo '<br>Diisi:'.$jml_diisi;
		//echo $lulusgak 
		//die();
		/////////////// GANTI LULUS DENGAN INPUTAN LULUSGAK, BUKAN LENGKAP ATAU TIDAKNYA///////////////////////////////////////////////////
		if ($verifikator == 1)
			$status_verifikasi = 0 + $lulusgak;
		else
			$status_verifikasi = 2 + $lulusgak;

		//echo "Total isian:".$total_isian.'-'.'Diisi:'.$jml_diisi;	die();

		if ($verifikator >= 1) {
			if ($verifikator == 1) {
				$data1['totalnilai1'] = $this->input->post('totalnilai');
				$data1['catatan1'] = $this->input->post('icatatan');
			} else {
				$data1['totalnilai2'] = $this->input->post('totalnilai');
				$data1['catatan2'] = $this->input->post('icatatan');
			}
			$data1['status_verifikasi'] = $status_verifikasi;

			$data2['id_video'] = $id_video;
			$data2['totalnilai'] = $this->input->post('totalnilai');
			$data2['no_verifikator'] = $verifikator;
			$data2['id_verifikator'] = $this->session->userdata('id_user');
			$data2['status_verifikasi'] = $status_verifikasi;

			////////// MENUNGGU SYARAT STATUS VERIFIKASI YG BENAR

			if ($id_video == null) {
				//echo "cek_3";	die();
				redirect('video/vervideo');
			} else {
				//echo "cek_4";	die();
				$data3['id_video'] = $id_video;
				$data3['id_verifikator'] = $this->session->userdata('id_user');
				$data3['no_verifikator'] = $verifikator;

				for ($c = 1; $c <= $total_isian; $c++) {
					$data3['penilaian' . $c] = $this->input->post('inilai' . $c);
					//echo $data3['penilaian'.$c];
				}

				$this->M_video->updatenilai($data1, $id_video);
				$this->M_video->addlogvideo($data2);
				$this->M_video->simpanverifikasi($data3, $id_video);
				redirect('video/vervideo');
			}
		} else {
			echo "cek5";
			die();
			redirect('video');
		}
	}

	public function file_view($idx = null)
	{
//    	echo "VER".$this->session->userdata('tukang_verifikasi');
//		echo "KON".$this->session->userdata('tukang_kontribusi');
//		die();

		if ($this->session->userdata('tukang_verifikasi') == 2 || $this->session->userdata('tukang_kontribusi') == 1 ||
			$this->session->userdata('tukang_kontribusi') == 2) {
								
			$data = array('title' => 'Upload Video',
				'isi' => 'v_video_upload');
			$data ['error'] = ' ';
			$data ['thumbs'] = false;
			$data ['idx'] = 0;
			if ($idx != null) {
				$data ['thumbs'] = true;
				$data ['idx'] = $idx;
			}
						
			$this->load->view('layout/wrapper', $data);
		} else {
			redirect('video');
		}

	}

    public function upload_mp4($idx = null)
    {
//    	echo "VER".$this->session->userdata('tukang_verifikasi');
//		echo "KON".$this->session->userdata('tukang_kontribusi');
//		die();

        if ($this->session->userdata('tukang_verifikasi') == 2 || $this->session->userdata('tukang_kontribusi') == 1 ||
            $this->session->userdata('tukang_kontribusi') == 2) {

            $data = array('title' => 'Upload Video',
                'isi' => 'v_video_upload');
            $data ['error'] = ' ';
            $data ['thumbs'] = false;
            $data ['idx'] = 0;
            if ($idx != null) {
                $data ['thumbs'] = true;
                $data ['idx'] = $idx;
            }

            $this->load->view('layout/wrapper', $data);
        } else {
            redirect('video');
        }
    }

    private function upload_mp4_intern($idbaru)
    {
//    	echo "VER".$this->session->userdata('tukang_verifikasi');
//		echo "KON".$this->session->userdata('tukang_kontribusi');
//		die();

        if ($this->session->userdata('tukang_verifikasi') == 2 || $this->session->userdata('tukang_kontribusi') == 1 ||
            $this->session->userdata('tukang_kontribusi') == 2) {

            $data = array('title' => 'Upload Video',
                'isi' => 'v_video_upload');
            $data['id_vid_baru'] = $idbaru;

            $this->load->view('layout/wrapper', $data);
        } else {
            redirect('video');
        }
    }

	public function do_upload($idx = null)
	{
		$path1 = "vod/";
		$allow = "mp4";
		if ($idx != null) {
			$path1 = "thumbs/";
			$allow = "jpg|png";
		}
		
		$config = array(
			'upload_path' => "uploads/" . $path1,
			'allowed_types' => $allow,
			'overwrite' => TRUE,
			'max_size' => "204800000"
			//'max_height' => "768",
			//'max_width' => "1024"
		);
		
		$this->load->library('upload', $config);
		if ($this->upload->do_upload()) {
			
			$dataupload = array('upload_data' => $this->upload->data());

			$namafile1 = $dataupload['upload_data']['file_name'];
			$namafile = preg_replace('/[^A-Za-z0-9.\-]/', '', $namafile1);
			$namafile = preg_replace('/-+/', '-', $namafile);
			$ext = pathinfo($namafile);

			$alamat = $config['upload_path'];

			if ($idx == null) {

				date_default_timezone_set('Asia/Jakarta');
				$now = new DateTime();
				$date = $now->format('Y-m-d_H-i');
				$namafilebaru = $ext['filename'] . $date . '.' . $ext['extension'];

				rename($alamat . $namafile1, $alamat . $namafilebaru);

				$data['id_user'] = $this->session->userdata('id_user');
				$data['file_video'] = $namafilebaru;
				$data['kode_video'] = base_convert(microtime(false), 10, 36);
				$idvideo = $this->M_video->addVideo($data);
			} else {
				$datavideo = $this->M_video->getVideo($idx);

				if ($datavideo['file_video'] != "") {
					$namafilevideo = $datavideo['file_video'];
					$namafilebaru = substr($namafilevideo, 0, strlen($namafilevideo) - 4) . '.' . $ext['extension'];
				} else if ($datavideo['link_video'] != "") {
					$namafilevideo = $datavideo['link_video'];
					$namafilebaru = substr($namafilevideo, -11) . '.' . $ext['extension'];
				}

				// echo $namafile1.'---'.$namafilebaru;
				// die();

				$this->M_video->updateThumbs($idx, $namafilebaru);

				rename($alamat . $namafile1, $alamat . $namafilebaru);
				$idvideo = $datavideo['id_video'];
			}
			redirect('video/edit/' . $idvideo);

			//$this->tambah($dataupload['upload_data']['file_name']);
		} else {
			
			$error = array('error' => $this->upload->display_errors(), 'thumbs' => true, 'idx'=>$idx);
			$this->load->view('v_video_upload', $error);
		}
	}
	
	public function do_uploadcanvas()
	{
		$namafile = $this->input->post('filevideo');
		$idvideo = $this->input->post('idvideo');		
		
		file_put_contents('uploads/thumbs/'.$namafile, base64_decode(str_replace('data:image/png;base64,','',$this->input->post('canvasimage'))));
		
		//$data = array('thumbnail' => $namafile);

		$this->M_video->updateThumbs($idvideo, $namafile);
		
		//echo "OK";
		
		//echo str_replace('data:image/octet-stream;base64,','',$this->input->post('canvasimage'));
	}
	
}
