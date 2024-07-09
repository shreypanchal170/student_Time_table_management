<!-- Icon Cards-->
<div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-primary o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-file"></i>
				</div>
				<div class="mr-5">Class Time Table</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="<?php classttlink(); ?>">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-warning o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-book"></i>
				</div>
				<div class="mr-5">Exam Time Table</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="<?php examttlink(); ?>">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-success o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-clock-o"></i>
				</div>
				<div class="mr-5">Personal Time Table</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="personal_time_table_view.php">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-danger o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fa fa-fw fa-user"></i>
				</div>
				<div class="mr-5">Personal Details</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="student_details_view.php">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fa fa-angle-right"></i>
				</span>
			</a>
		</div>
	</div>
</div>
<!--first row cards-->
<!--Classes today-->
<div class="card mb-12">
	<div class="card-header">
		<i class="fa fa-table"></i> <strong>Classes Today: <?php echo date('D-d-M-Y'); ?></strong>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Unit Code</th>
						<th>Starts</th>
						<th>Ends</th>
						<th>Venue</th>
					</tr>
				</thead>
				<tbody>
					<?php getclassestoday();?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!--Notices-->
<div class="mb-0 mt-4">
	<i class="fa fa-newspaper-o"></i> News Feed</div>
	<hr class="mt-2">
</div>

</div>
<!-- Example Notifications Card-->
<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-bell-o"></i> <strong>Recent Notices</strong></div>
		<div class="list-group list-group-flush small">
			<?php  getnotices(); ?>
			
				<div class="text-center" id="pagination_controls">
					<?php /*display pagination controls on page*/ echo $paginationCtrls;?>
				</div>
			
			</div>
		</div>

		<div class="card mb-12">
			<div class="card-header">
				<i class="fa fa-table"></i> <strong>My tasks Today: <?php echo date('D'); ?></strong>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Activity</th>
								<th>Starts</th>
								<th>Ends</th>
							</tr>
						</thead>
						<tbody>
							<?php getmytasks(); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="mb-0 mt-4">
			<i class="fa fa-newspaper-o"></i> Exam Schedule</div>
			<hr class="mt-2">
		</div>
		<div class="card mb-12">
			<div class="card-header">
				<i class="fa fa-table"></i> <strong>Exams Today: <?php echo date('D-d-M-Y'); ?></strong>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Unit Code</th>
								<th>Starts</th>
								<th>Ends</th>
								<th>Venue</th>
							</tr>
						</thead>
						<tbody>
							<?php getexams();?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /.classes-->
	<!-- /.content-wrapper-->
