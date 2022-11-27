<?php echo $this->extend('common/layout'); ?>


<?php echo $this->section('content'); ?>

<div class="text-center container">
	Home
	<div class="row">
		<div class="col-4">
			<div class="card text-center">
				<div class="card-body">

					<!-- Progress counter -->
					<div class="svg-center" id="hours-available-progress">
						<div class="position-relative"><svg width="76" height="76">
								<g transform="translate(38,38)">
									<path class="d3-progress-background" d="M0,38A38,38 0 1,1 0,-38A38,38 0 1,1 0,38M0,36A36,36 0 1,0 0,-36A36,36 0 1,0 0,36Z" style="fill: rgb(240, 98, 146); opacity: 0.2;"></path>
									<path class="d3-progress-foreground" filter="url(#blur)" d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.38342799370878,16.179613079472677L-32.57377388877674,15.328054496342538A36,36 0 1,0 2.204364238465236e-15,-36Z" style="fill: rgb(240, 98, 146); stroke: rgb(240, 98, 146);"></path>
									<path class="d3-progress-front" d="M2.326828918379971e-15,-38A38,38 0 1,1 -34.38342799370878,16.179613079472677L-32.57377388877674,15.328054496342538A36,36 0 1,0 2.204364238465236e-15,-36Z" style="fill: rgb(240, 98, 146); fill-opacity: 1;"></path>
								</g>
							</svg><i class="ph-check text-pink counter-icon"></i></div>
						<h4 class="pt-1 mt-2 mb-0 fs-2"><?php echo $qtdAlunos ?></h4>
						<div class="fs-5">Alunos Cadastrados</div>
						<div class="fs-sm text-muted mb-3"></div>
					</div>
					<!-- /progress counter -->


					<!--  -->

				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->endSection(); ?>