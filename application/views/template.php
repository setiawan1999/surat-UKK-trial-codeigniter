<!doctype html>
<html lang="en">
<head>
	<title>Dashboard | Klorofil - Free Bootstrap Dashboard Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.bootstrap.css">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html"><img src="<?php echo base_url();?>assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger"><?php echo count($notif);?></span>
							</a>
							<ul class="dropdown-menu notifications">
								<?php foreach($notif as $show):?>
									<li>
										<a href="<?php echo base_url();?>index.php/surat/done_notif/<?php echo $show->id_disposition;?>" class="notification-item">
											<span class="dot bg-success"></span><?php echo $show->mail_subject;?>|<?php echo $show->description;?>
										</a>	
									</li>
								<?php endforeach;?>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url();?>assets/img/user.png" class="img-circle" alt="Avatar"> <span><?php echo $this->session->userdata('username'); ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li><a href="<?php echo base_url('index.php');?>/login/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<?php if($this->session->userdata('jabatan') == 'Sekretaris' || $this->session->userdata('jabatan') == 'Kepala Sekolah'):?>
								<li>
									<a href="<?php echo base_url();?>index.php/surat" class="<?php if($menu == 'dashboard'):?>active<?php endif;?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
								</li>
							<?php if($this->session->userdata('jabatan') == 'Kepala Sekolah'):?>
								<li>
									<a href="<?php echo base_url();?>index.php/surat/pegawai" class="<?php if($menu == 'pegawai'):?>active<?php endif;?>"><i class="lnr lnr-user"></i> <span>Pegawai</span></a>
								</li>
							<?php endif;?>
								<li><a href="<?php echo base_url();?>index.php/surat/surat_masuk" class="<?php if($menu == 'surat_masuk'):?>active<?php endif;?>"><i class="lnr lnr-envelope"></i> <span>Surat Masuk</span></a></li>
								<li><a href="<?php echo base_url();?>index.php/surat/surat_keluar" class="<?php if($menu == 'surat_keluar'):?>active<?php endif;?>"><i class="lnr lnr-envelope"></i> <span>Surat Keluar</span></a></li>
								<?php if($this->session->userdata('jabatan') != 'Sekretaris'):?>
									<li><a href="<?php echo base_url();?>index.php/surat/disposisi_masuk" class="<?php if($menu == 'disposisi_masuk'):?>active<?php endif;?>"><i class="lnr lnr-home"></i> <span>Disposisi Masuk</span></a></li>
								<?php endif;?>
						<?php else:?>
							<li><a href="<?php echo base_url();?>index.php/surat" class="<?php if($menu == 'disposisi_masuk'):?>active<?php endif;?>"><i class="lnr lnr-home"></i> <span>Disposisi Masuk</span></a></li>
						<?php endif;?>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<?php $this->load->view($main_view);?>
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/scripts/dataTables.buttons.min"></script>
	<script src="<?php echo base_url();?>assets/scripts/jquery.dataTables"></script>
	<script src="<?php echo base_url();?>assets/scripts/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo base_url();?>assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="<?php echo base_url();?>assets/scripts/klorofil-common.js"></script>
	<script>
	<?php
		$surat_masuk_jan = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-01-')->get('mail')->result();
		$jsurat_masuk_jan = count($surat_masuk_jan);

		$surat_masuk_feb = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-02-')->get('mail')->result();
		$jsurat_masuk_feb = count($surat_masuk_feb);

		$surat_masuk_mar = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-03-')->get('mail')->result();
		$jsurat_masuk_mar = count($surat_masuk_mar);

		$surat_masuk_apr = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-04-')->get('mail')->result();
		$jsurat_masuk_apr = count($surat_masuk_apr);

		$surat_masuk_mei = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-05-')->get('mail')->result();
		$jsurat_masuk_mei = count($surat_masuk_mei);

		$surat_masuk_jun = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-06-')->get('mail')->result();
		$jsurat_masuk_jun = count($surat_masuk_jun);

		$surat_masuk_jul = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-07-')->get('mail')->result();
		$jsurat_masuk_jul = count($surat_masuk_jul);

		$surat_masuk_aug = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-08-')->get('mail')->result();
		$jsurat_masuk_aug = count($surat_masuk_aug);

		$surat_masuk_sep = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-09-')->get('mail')->result();
		$jsurat_masuk_sep = count($surat_masuk_sep);

		$surat_masuk_oct = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-10-')->get('mail')->result();
		$jsurat_masuk_oct = count($surat_masuk_oct);

		$surat_masuk_nov = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-11-')->get('mail')->result();
		$jsurat_masuk_nov = count($surat_masuk_nov);

		$surat_masuk_des = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','masuk')->like('mail.mail_date',date('Y').'-12-')->get('mail')->result();
		$jsurat_masuk_des = count($surat_masuk_des);

		// ---------------------------------------------------Surat Keluar---------------------------------------------------------

		$surat_keluar_jan = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-01-')->get('mail')->result();
		$jsurat_keluar_jan = count($surat_keluar_jan);

		$surat_keluar_feb = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-02-')->get('mail')->result();
		$jsurat_keluar_feb = count($surat_keluar_feb);

		$surat_keluar_mar = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-03-')->get('mail')->result();
		$jsurat_keluar_mar = count($surat_keluar_mar);

		$surat_keluar_apr = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-04-')->get('mail')->result();
		$jsurat_keluar_apr = count($surat_keluar_apr);

		$surat_keluar_mei = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-05-')->get('mail')->result();
		$jsurat_keluar_mei = count($surat_keluar_mei);

		$surat_keluar_jun = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-06-')->get('mail')->result();
		$jsurat_keluar_jun = count($surat_keluar_jun);

		$surat_keluar_jul = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-07-')->get('mail')->result();
		$jsurat_keluar_jul = count($surat_keluar_jul);

		$surat_keluar_aug = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-08-')->get('mail')->result();
		$jsurat_keluar_aug = count($surat_keluar_aug);

		$surat_keluar_sep = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-09-')->get('mail')->result();
		$jsurat_keluar_sep = count($surat_keluar_sep);

		$surat_keluar_oct = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-10-')->get('mail')->result();
		$jsurat_keluar_oct = count($surat_keluar_oct);

		$surat_keluar_nov = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-11-')->get('mail')->result();
		$jsurat_keluar_nov = count($surat_keluar_nov);

		$surat_keluar_des = $this->db->join('mail_type','mail.id_mail_type = mail_type.id_mail_type')->where('mail_type.mail_type','keluar')->like('mail.mail_date',date('Y').'-12-')->get('mail')->result();
		$jsurat_keluar_des = count($surat_keluar_des);
	?>
	$(function() {
		var data, options;

		// headline charts
		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug','Sept','Oct','Nov','Dec'],
			series: [
				[<?php echo $jsurat_masuk_jan.','.$jsurat_masuk_feb.','.$jsurat_masuk_mar.','.$jsurat_masuk_apr.','.$jsurat_masuk_mei.','.$jsurat_masuk_jun.','.$jsurat_masuk_jul.','.$jsurat_masuk_aug.','.$jsurat_masuk_sep.','.$jsurat_masuk_oct.','.$jsurat_masuk_nov.','.$jsurat_masuk_des;?>]
			]
		};

		options = {
			height: 300,
			showArea: true,
			showLine: false,
			showPoint: false,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart1', data, options);

		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug','Sept','Oct','Nov','Dec'],
			series: [
				[<?php echo $jsurat_keluar_jan.','.$jsurat_keluar_feb.','.$jsurat_keluar_mar.','.$jsurat_keluar_apr.','.$jsurat_keluar_mei.','.$jsurat_keluar_jun.','.$jsurat_keluar_jul.','.$jsurat_keluar_aug.','.$jsurat_keluar_sep.','.$jsurat_keluar_oct.','.$jsurat_keluar_nov.','.$jsurat_keluar_des;?>]
			]
		};

		options = {
			height: 300,
			showArea: true,
			showLine: false,
			showPoint: false,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart2', data, options);
		// real-time pie chart
		var sysLoad = $('#system-load').easyPieChart({
			size: 130,
			barColor: function(percent) {
				return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
			},
			trackColor: 'rgba(245, 245, 245, 0.8)',
			scaleColor: false,
			lineWidth: 5,
			lineCap: "square",
			animate: 800
		});

		var updateInterval = 3000; // in milliseconds

		setInterval(function() {
			var randomVal;
			randomVal = getRandomInt(0, 100);

			sysLoad.data('easyPieChart').update(randomVal);
			sysLoad.find('.percent').text(randomVal);
		}, updateInterval);

		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

	});
	</script>
</body>

</html>
