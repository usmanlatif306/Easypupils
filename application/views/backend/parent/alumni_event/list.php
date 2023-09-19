<div class="row">
	<div class="col-md-5">
		<div class="card">
			<div class="card-body">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="card">
			<div class="card-body">
				<?php $school_id = school_id(); ?>
				<?php $query = $this->db->get_where('alumni_events', array('school_id' => $school_id, 'session' => active_session())); ?>
				<?php if($query->num_rows() > 0): ?>
					<table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
						<thead>
							<tr style="background-color: #313a46; color: #ababab;">
								<th><?php echo get_phrase('event_photo'); ?></th>
								<th><?php echo get_phrase('event_title'); ?></th>
								<th><?php echo get_phrase('from'); ?></th>
								<th><?php echo get_phrase('to'); ?></th>
								<th><?php echo get_phrase('visibility'); ?></th>
								<th><?php echo get_phrase('options'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$alumni_events = $this->db->get_where('alumni_events', array('school_id' => $school_id, 'session' => active_session()))->result_array();
							foreach($alumni_events as $alumni_event){
								?>
								<tr>
									<td><img src="<?php echo $this->alumni_model->get_event_image($alumni_event['photo']); ?>" style="height: 60px; width: 60px;" alt="" class="rounded-circle img-thumbnail"></td>
									<td><?php echo $alumni_event['title']; ?></td>
									<td><?php echo date('D, d M Y', strtotime($alumni_event['starting_date'])); ?></td>
									<td><?php echo date('D, d M Y', strtotime($alumni_event['ending_date'])); ?></td>
									<td>
										<?php if ($alumni_event['visibility']): ?>
											<span class="badge badge-success"><?php echo get_phrase('visible'); ?></span>
										<?php else: ?>
											<span class="badge badge-danger"><?php echo get_phrase('not_visible'); ?></span>
										<?php endif; ?>
									</td>
									<td>
										<div class="dropdown text-center">
											<button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
											<div class="dropdown-menu dropdown-menu-right">
												<!-- item-->
												<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/alumni_event/edit/'.$alumni_event['id']); ?>', '<?php echo get_phrase('update_event'); ?>');"><?php echo get_phrase('edit'); ?></a>
												<!-- item-->
												<a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo site_url('addons/alumni/events/delete/'.$alumni_event['id']); ?>', showAllEvents)"><?php echo get_phrase('delete'); ?></a>
											</div>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php else: ?>
					<?php include APPPATH.'views/backend/empty.php'; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
