<?php
$dates = $container['dates'];
$student_and_status = $container['student_and_status'];
?>
<div class="row mt-3">
	<div class="col-md-1 mb-1"></div>
	<div class="col-md-4 mb-1">
		<select name="class_id" id="class_id" class="form-control select2" data-toggle="select2">
			<option value=""><?php echo get_phrase('select_a_class'); ?></option>
			<?php foreach ($classes as $class): ?>
				<option value="<?php echo $class['id']; ?>" <?php if ($container['filtered_class_id'] == $class['id']):?>selected<?php endif; ?>><?php echo $class['name']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="col-md-4 mb-1">
		<select name="date" id="date" class="form-control select2" data-toggle="select2" required>
			<option value=""><?php echo get_phrase('select_a_date'); ?></option>
			<?php foreach ($dates as $date): ?>
				<option value="<?php echo $date; ?>" <?php if ($container['filtered_date'] == $date):?>selected<?php endif; ?>><?php echo $date; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="col-md-2">
		<button class="btn btn-block btn-secondary" onclick="filterPreview()" ><?php echo get_phrase('filter'); ?></button>
	</div>
</div>
<?php if (count($student_and_status) > 0): ?>
	<div class="row mt-3">
		<?php foreach ($student_and_status as $info):
			$student_details = $this->user_model->get_student_details_by_id('student', $info['student_id']); ?>
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title mb-0"><?php echo $info['name']; ?>
							<img src="<?php echo $this->user_model->get_user_image($student_details['user_id']); ?>" class="rounded-circle avatar-sm" style="float: right;" alt="">
						</h5>
						<div id="" class="collapse pt-1 show">
							<p>
								<strong><?php echo get_phrase('status'); ?> : </strong> <?php if ($info['status'] == 1): ?> <span class="badge badge-success-lighten"><?php echo get_phrase('present'); ?></span> <?php else: ?> <span class="badge badge-danger-lighten"><?php echo get_phrase('absent'); ?></span> <?php endif; ?>
									<br>
									<strong><?php echo get_phrase('class'); ?> :</strong> <?php echo $student_details['class_name']; ?><br>
									<strong><?php echo get_phrase('section'); ?> :</strong> <?php echo $student_details['section_name']; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-2">
				<button class="btn btn-block btn-danger" onclick="location.reload()"><?php echo get_phrase('discard'); ?></button>
			</div>
			<div class="col-md-2">
				<button class="btn btn-block btn-primary" onclick="importBiometricAttendance()"><?php echo get_phrase('import_attendance'); ?></button>
			</div>
		</div>
	<?php else: ?>
		<?php include APPPATH.'views/backend/empty.php'; ?>
	<?php endif; ?>


	<script type="text/javascript">
	initSelect2(['#class_id', '#date']);
	</script>
