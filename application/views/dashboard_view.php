<!-- MAIN CONTENT -->
<div class="main-content">
	<div class="container-fluid">
		<!-- OVERVIEW -->
		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">Overview</h3>
				<p class="panel-subtitle">Periode: <?php echo date('Y');?></p>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<div class="metric">
							<span class="icon"><i class="fa fa-envelope-open"></i></span>
							<p>
								<span class="number"><?php echo count($surat_masuk_periode);?></span>
								<span class="title">Surat Masuk</span>
							</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="metric">
							<span class="icon"><i class="fa fa-envelope"></i></span>
							<p>
								<span class="number"><?php echo count($surat_keluar_periode);?></span>
								<span class="title">Surat Keluar</span>
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h1 class="heading">Surat Masuk</h1>
						<div id="headline-chart1" class="ct-chart"></div>
					</div>
					<div class="col-md-6">
						<h1 class="heading">Surat Keluar</h1>
						<div id="headline-chart2" class="ct-chart"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- END OVERVIEW -->
	</div>
</div>
<!-- END MAIN CONTENT -->