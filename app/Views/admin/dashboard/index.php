<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<!------------------------------------------------->
<!-------   Filter / Penyaringan data      -------->
<!------------------------------------------------->
<div class="container-fluid bg-primary mt-0 pt-4 pb-5">
	<div class="row">
		<div class="col-sm-3">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h5 class="card-title text-uppercase text-muted mb-0">Total Mitra</h5>
							<h2 class="font-weight-bold mb-0"><?=$jumlah_mitra?></h2>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape rounded-circle bg-gradient-primary">
								<i class="fas fa-store text-white"></i>
							</div>
						</div>
					</div>
					<p class="mt-0 mb-0 text-sm">
						<?php 
							$color = "";
							$icon = "";
							if ($jumlah_mitra_seminggu > 0) {
								$color = 'success';
								$icon = "fa-arrow-up";
							}
							else {
								$color = 'warning';
								$icon = "fa-minus-square";
							}
						?>
						<span class="text-<?=$color?> mr-2">
							<i class="fas <?=$icon?> mr-1"></i>
							+<?=$jumlah_mitra_seminggu?> Data 
						</span>
						Minggu ini
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h5 class="card-title text-uppercase text-muted mb-0">Jumlah Artikel</h5>
							<h2 class="font-weight-bold mb-0"><?=$jumlah_artikel?></h2>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape rounded-circle bg-gradient-danger">
								<i class="fas fa-list-alt text-white"></i>
							</div>
						</div>
					</div>
					<p class="mt-0 mb-0 text-sm">
						<?php 
							$color = "";
							$icon = "";
							if ($jumlah_artikel_seminggu > 0) {
								$color = 'success';
								$icon = "fa-arrow-up";
							}
							else {
								$color = 'warning';
								$icon = "fa-minus-square";
							}
						?>
						<span class="text-<?=$color?> mr-2">
							<i class="fas <?=$icon?> mr-1"></i>
							+<?=$jumlah_artikel_seminggu?> Data 
						</span>
						Minggu ini
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h5 class="card-title text-uppercase text-muted mb-0">Daerah Mitra</h5>
							<h2 class="font-weight-bold mb-0"><?=$jumlah_kecamatan?></h2>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape rounded-circle bg-gradient-info">
								<i class="fas fa-city text-white"></i>
							</div>
						</div>
					</div>
					<p class="mt-0 mb-0 text-sm">
						Kecamatan
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h5 class="card-title text-uppercase text-muted mb-0">Admin</h5>
							<h2 class="font-weight-bold mb-0"><?=$jumlah_admin?></h2>
						</div>
						<div class="col-auto">
							<div class="icon icon-shape rounded-circle bg-gradient-default">
								<i class="fas fa-users-cog text-white"></i>
							</div>
						</div>
					</div>
					<p class="mt-0 mb-0 text-sm">
						Orang
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid mt--5">
	<div class="row">
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header" style="line-height: 16px">
					<div class="row">
						<div class="col-sm">
							<span class="card-title mb-0 font-weight-bold">Penayangan</span><br/>
							<span class="text-muted text-xs font-italic">Total penayangan artikel dalam periode tertentu</span>
						</div>
						<div class="col-sm">
							<div class="form-group mb-0">
								<div class="input-group input-group-sm input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
									</div>	
									<select id="chart-penayangan-periode" class="form-control">
										<option value="seminggu">Seminggu Terakhir</option>
										<option value="sebulan">Sebulan Terkahir</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<canvas id="chart-penayangan"></canvas>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col">
					<div class="card card-stats">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="text-muted mb-1 card-title text-uppercase">Penayangan Hari ini</h5>
									<h2 class="font-weight-bold"><?=$view_sehari?></h2>
									<p class="mb-0 mt-1 text-sm">
										<?php 
											$selisih = $view_sehari - $view_kemarin;
											if ($selisih > 0) {
												$icon = "fa-arrow-up";
												$color = "success";
												$selisih = "+" . $selisih;
											}
											else if ($selisih < 0) {
												$icon = "fa-arrow-down";
												$color = "danger";
											}
											else {
												$icon = "fa-minus-square";
												$color = "default";
												$selisih = 'sama';
											}
										?>
										<span class="text-<?=$color?> mr-2">
											<i class="fas <?=$icon?>"></i>
											<?=$selisih?> 
										</span>
										Dibandingkan kemarin
									</p>
								</div>
								<div class="col-auto d-flex align-items-center">
									<div class="icon icon-shape bg-gradient-success rounded-circle">
										<i class="fas fa-eye text-white"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="card card-stats">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="text-muted mb-1 card-title text-uppercase">Penayangan Kemarin</h5>
									<h2 class="font-weight-bold mb-0"><?=$view_kemarin?></h2>
									<p class="mb-0 mt-0 text-sm">
										Penayangan
									</p>
								</div>
								<div class="col-auto d-flex align-items-center">
									<div class="icon icon-shape bg-gradient-success rounded-circle">
										<i class="fas fa-eye text-white"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="card card-stats">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="text-muted mb-1 card-title text-uppercase">Penayangan Bulan ini</h5>
									<h2 class="font-weight-bold mb-0"><?=$view_sebulan?></h2>
									<p class="mb-0 mt-0 text-sm">
										Penayangan
									</p>
								</div>
								<div class="col-auto d-flex align-items-center">
									<div class="icon icon-shape bg-gradient-success rounded-circle">
										<i class="fas fa-eye text-white"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-5">
			<div class="card">
				<div class="card-header" style="line-height: 12px;">
					<h4 class="mb-0 font-weight-bold">Browser</h4>
					<span class="text-muted text-xs font-italic">Seberapa banyak pembaca berdasarkan browser yang dipakai</span>
				</div>
				<div class="card-body">
					<canvas id="chart-browser"></canvas>
				</div>
			</div>
		</div>
		<div class="col-sm">
			<div class="card">
				<div class="card-header" style="line-height: 12px;">
					<h4 class="mb-0 font-weight-bold">Sumber Lalu lintas Kunjungan</h4>
					<span class="text-muted text-xs font-italic">Penayangan berdasarkan perujuk asal pembaca </span>
				</div>
				<div class="card-body">
					<canvas id="chart-kunjungan"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('jsContent') ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var chartPenayanganCtx = document.getElementById("chart-penayangan").getContext("2d")
		var chartPenayangan = new Chart(chartPenayanganCtx, {
			type: 'line',
			data: {
				labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu","Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu","Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu"],
				datasets: [{
					label: ["Penayangan"],
					data: [235, 200, 240, 251, 245, 255, 261,235, 200, 240, 251, 245, 255, 261,235, 200, 240, 251, 245, 255, 261],
					borderColor: "#099543",
					lineTension: 0.3,
				}]
			},
			options: {
				interaction: {
					mode: 'nearest',
					intersect: false,
					axis: 'x'
				},
				elements: {
					point: {
						radius: 3,
						backgroundColor: '#099543'
					}
				},
				scales: {
					yAxis: {
						beginAtZero: true,
						ticks: {
							color: 'green',
							font: {
								weight: 'bold',
								size: 13,
							},
						},
						grid: {
							borderColor: 'green',
							borderWidth: 2,
							borderDash: [4]
						}
					},
					xAxis: {
						grid: {
							borderColor: 'green',
							borderWidth: 2,
							display: false
						}
					},
				},
				plugins: {
					legend: {
						display: false
					},
					title: {
						text: 'Judul',
					},
					tooltip: {
						callbacks: {
							label: (object, index) => {
								return " " + object.raw + " Penayangan"
							},
						},
						displayColors: false,
						backgroundColor: "white",
						titleColor: 'black',
						bodyColor: 'black',
						borderColor: '#979797',
						borderWidth: 1
					}
				},
			}
		})

		var paramPenayangan = {
			periode: 'seminggu'
		};
		function refreshChartPenayangan() {
			$.ajax({
				url: '<?=site_url('admin/dashboard/ajax_penayangan')?>',
				type: 'GET',
				dataType: 'json',
				data: paramPenayangan,
			})
			.done(function(data) {
				chartPenayangan.data.labels = data.labels
				chartPenayangan.data.datasets[0].data = data.data
				chartPenayangan.update()
			});
		}
		$("#chart-penayangan-periode").change(function(e) {
			paramPenayangan.periode = $(this).val()
			refreshChartPenayangan();
		});
		refreshChartPenayangan();

		var randomColor = function(alpha) {
			var r = Math.floor(Math.random() * 255)
			var g = Math.floor(Math.random() * 255)
			var b = Math.floor(Math.random() * 255)
			return "rgba(" + r + "," + g + "," + b + ", " + alpha + ")"
		}
		var colorKunjungan = [];
		for (i = 0; i < 3; i++) {
			colorKunjungan.push(randomColor(0.7))
		}
		var chartKunjunganCtx = document.getElementById("chart-kunjungan").getContext("2d")
		var chartKunjungan = new Chart(chartKunjunganCtx, {
			type: 'bar',
			data: {
				labels: ["www.google.com", "www.facebook.com", "nu.or.id"],
				datasets: [{
					label: 'Penayangan',
					data: [1013, 512, 120],
					backgroundColor: colorKunjungan
				}]
			},
			options: {
				indexAxis: 'y',
				scales: {
					yAxis: {
						grid: {
							borderColor: "green",
							borderWidth: 2,
						},
						ticks: {
							color: "black",
							font: {
								weight: 'bold'
							}
						}
					},
					xAxis: {
						grid: {
							borderColor: "green",
							borderWidth: 2,
						}
					}
				},
				plugins: {
					legend: {
						display: false
					}
				}
			}
		})
		function refreshChartKunjungan() {
			$.ajax({
				url: '<?=site_url('admin/dashboard/ajax_referer')?>',
				type: 'GET',
				dataType: 'json',
			})
			.done(function(data) {
				chartKunjungan.data.labels = data.labels;
				chartKunjungan.data.datasets[0].data = data.data;
				chartKunjungan.update()
			});
		}
		refreshChartKunjungan()

		var colorBrowser = [];
		for (i = 0; i < 5; i++) {
			colorBrowser.push(randomColor(1))
		}
		var chartBrowserCtx = document.getElementById("chart-browser")
		var chartBrowser = new Chart(chartBrowserCtx, {
			type: 'doughnut',
			data: {
				labels: ["Chrome", "Firefox", "Safari", "Chrome Android", "Samsung Browser"],
				datasets: [{
					label: "Penayangan",
					data: [1100, 800, 300, 250, 100],
					backgroundColor: colorBrowser ,
				}]
			},
			plugins: [ChartDataLabels],
			options: {
				plugins: {
					legend: {
						display: true
					},
					datalabels: {
						backgroundColor: colorBrowser,
						borderRadius: 16,
						borderColor: 'white',
						borderWidth: 2,
						padding: 4,
						offset: 12,
						font: {
							weight: 'bold',
						},
						color: 'white',
						anchor: 'end',
					},
				}
			}
		})
		function refreshChartBrowser() {
			$.ajax({
				url: '<?=site_url('admin/dashboard/ajax_browser')?>',
				type: 'GET',
				dataType: 'json',
			})
			.done(function(data) {
				chartBrowser.data.labels = data.labels;
				chartBrowser.data.datasets[0].data = data.data;
				chartBrowser.update()
			});
		}
		refreshChartBrowser()
	})
</script>
<?php $this->endSection(); ?>