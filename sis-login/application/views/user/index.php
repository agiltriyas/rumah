<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Profile</h3>
				</div>
				<div class="card-body">
					<div class="card mb-3" style="max-width: 540px;">
						<div class="row no-gutters">
							<div class="col-md-4">
								<img src="<?= base_url('asets/img/profile/') . $sesdata['image']; ?>" class="card-img" alt="...">
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<h5 class="card-title"><?= $sesdata['nama']; ?></h5>
									<p class="card-text"><small class="text-muted">Member Since : <?= date("d-m-Y", $sesdata['date_created']) ?></small></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->