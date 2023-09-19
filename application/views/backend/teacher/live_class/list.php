<?php
$live_classes = $this->live_class_model->get_all_live_class_by_teacher();
if ($live_classes->num_rows() > 0) : ?>
	<table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
		<thead>
			<tr style="background-color: #313a46; color: #ababab;">
				<th><?php echo get_phrase('schedule'); ?></th>
				<th><?php echo get_phrase('class'); ?></th>
				<th><?php echo get_phrase('subject'); ?></th>
				<th><?php echo get_phrase('meeting_info'); ?></th>
				<th><?php echo get_phrase('options'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($live_classes->result_array() as $live_class) : ?>
				<tr>
					<td>
						<small>
							<strong><?php echo get_phrase("date"); ?></strong> : <?php echo date('D, d-M-Y', $live_class['date']); ?><br>
							<strong><?php echo get_phrase("time"); ?></strong> : <?php echo date('h:i A', $live_class['time']); ?>
						</small>
					</td>
					<td><?php echo $this->db->get_where('classes', array('id' => $live_class['class_id']))->row('name'); ?></td>
					<td><?php echo $this->db->get_where('subjects', array('id' => $live_class['subject_id']))->row('name'); ?></td>
					<td>
						<small>
							<strong><?php echo get_phrase("meeting_id"); ?></strong> : <?php echo $live_class['zoom_meeting_id']; ?><br>
							<strong><?php echo get_phrase("meeting_password"); ?></strong> : <?php echo $live_class['zoom_meeting_password']; ?>
							<?php if ($live_class['attachment'] != "") : ?>
								<br><strong><?php echo get_phrase("attachment"); ?></strong> : <a href="<?php echo base_url('uploads/live_class/' . $live_class['attachment']); ?>" class="" download><strong><?php echo get_phrase("download"); ?></strong> </a>
							<?php endif; ?>
						</small>
					</td>
					<td class="text-center">
						<div class="btn-group">
							<a href="<?php echo site_url('addons/live_class/start/' . $live_class['id']); ?>" type="button" class="btn btn-primary"> <i class="mdi mdi-play-circle-outline"></i> <?php echo get_phrase('start_meeting'); ?></a>
							<button type="button" class="btn btn-sm text-white btn-primary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
							<div class="dropdown-menu dropdown-menu-right">
								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/live_class/mail/' . $live_class['id']) ?>', '<?php echo get_phrase('send_mail_to_class_student'); ?>');"><?php echo get_phrase('notify_parent'); ?></a>
								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/live_class/edit/' . $live_class['id']) ?>', '<?php echo get_phrase('update_live_class'); ?>');"><?php echo get_phrase('edit'); ?></a>
								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo site_url('addons/live_class/delete/' . $live_class['id']); ?>', showAllLiveClasses )"><?php echo get_phrase('delete'); ?></a>
							</div>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else : ?>
	<?php include APPPATH . 'views/backend/empty.php'; ?>
<?php endif; ?>