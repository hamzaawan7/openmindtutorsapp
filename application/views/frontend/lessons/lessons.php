<main>
  <div class="container">
    <div class="forum">
      <div class="row">
        <div class="col-md-3"> 
          <!-- Sidebar
	======================================== -->
          <aside>
            <div class="menu-list margin-0-60">
				
              <ul>
                <li class="active-menu"><h5><a href="<?php echo ROUTE_LESSONS ?>" class="side-bar-active">Lessons</a></h5></li>
                <li><a href="<?php echo ROUTE_MESSAGES ?>">Messages <?php echo (count($common_data['message_count']) != 0)? "(".count($common_data['message_count']).")":""; ?></a></li>
                <li><a href="<?php echo ROUTE_PAYMENTS_HISTORY ?>">Payments</a></li>
				<li><a href="<?php echo ROUTE_TUTOR_LEVEL ?>">My Tutor Level</a></li>
              </ul>
            </div>
          </aside>
          <!-- sidebar end --> 
        </div>
        <div class="col-md-9 lessons-table"> 
			<?php if(!empty($taken_lessons) && !empty($given_lessons)){ ?>
			<div class="lessons-tab">
				<a href="javascript:void(0)" class="btn btn-sm btn-warning taken-lessons <?php echo ($common_data['user_data']['role'] == STUDENT)? "lesson-active":""; ?>" title="Detail">Lessons Taken</a>
				<a href="javascript:void(0)" class="btn btn-sm btn-warning given-lessons <?php echo ($common_data['user_data']['role'] == TUTOR)? "lesson-active":""; ?>" title="Detail">Lessons Given</a>
			</div>
			<?php } ?>
          <!-- Topics
======================================== -->
<?php // echo ($common_data['user_data']['role'] == TUTOR && empty($taken_lessons))? "style='display:none'":""; ?>
          <div class="lesson-tab-info" id="taken-lessons" <?php echo ($common_data['user_data']['role'] == TUTOR)? "style='display:none'":""; ?>>
			<div class="table-container">
						<?php if(!empty($taken_lessons)){ ?>
                        <div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-checkable dt-responsive dataTables_wrapper no-footer contacts-table-style dtr-inline collapsed nowrap" id="datatable_user">
						<thead>
							<tr role="row" class="heading">
								<th width="1%" style="display:none"></th>
								<th width="1%"> # </th>
								<th width="5%"> Lesson Code </th>
								<th width="10%"> Tutor Name </th>
								<th width="6%"> Subject </th>
								<th width="4%"> Date </th>
								<th width="2%"> Fee </th>
								<th width="6%"> Status </th>
								<th width="4%"> Action </th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1;
								foreach($taken_lessons as $lesson){
									if($lesson['is_active'] != DISABLED_STATUS_ID){?>
							<tr>
								<td style="display:none"></td>
								<td> <?php echo $count ?></td>
								<td> <?php echo $lesson['lesson_code'] ?> </td>
								<td> <?php echo ucwords($lesson['first_name'].' '.$lesson['last_name']) ?></td>
								<td> <?php echo $lesson['subject'] ?> </td>
								<td> <?php echo date('d/m/Y',$lesson['lesson_date']) ?> </td>
								<td> <?php echo CURRENCY_SYMBOL.$lesson['hourly_rate'] ?></td>
								<td> <?php $status = "";
									if($lesson['status'] == PENDING){
										$status = "Pending";
									} else if($lesson['status'] == CANCELED){
										$status = "Canceled";
									} else if($lesson['status'] == APPROVED){
										$status = "Approved";
									} else if($lesson['status'] == DISPUTED){
										$status = "Disputed";
									} else if($lesson['status'] == COMPLETED){
										$status = "Completed";
									} else if($lesson['status'] == INACTIVE_STATUS_ID){
										$status = "Payment Pending";
									} else if($lesson['status'] == PENDING_APPROVAL){
										$status = "Completion Approval required";
									}
									?>
								<?php echo $status ?></td>
								<td> <a href="<?php echo ROUTE_LESSON_DETAILS.'/'.$lesson['id'] ?>" class="btn btn-sm btn-warning" title="Detail">Details</a> </td>
							</tr>
								<?php $count++; }} ?>
						</tbody>
					</table>
                    </div>
						<?php } else { ?>
                <h6>No lessons yet!</h6>
						<?php } ?>
			</div>
		  </div>
          <div class="lesson-tab-info" id="given-lessons" <?php echo ($common_data['user_data']['role'] == STUDENT)? "style='display:none'":""; ?>>
			<div class="table-container">
						<?php if(!empty($given_lessons)){ ?>
                        <div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-checkable dt-responsive dataTables_wrapper no-footer contacts-table-style dtr-inline collapsed nowrap" id="datatable_user1">
						<thead>
							<tr role="row" class="heading">
								<th width="1%" style="display:none"></th>
								<th width="1%"> # </th>
								<th width="8%"> Lesson Code </th>
								<!--<th width="8%"> Student Name </th>-->
								<th width="6%"> Subject </th>
								<th width="4%"> Date </th>
								<th width="4%"> Fee </th>
								<th width="6%"> Status </th>
								<th width="10%"> Action </th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1;
								foreach($given_lessons as $lesson){?>
							<tr>
								<td style="display:none"></td>
								<td> <?php echo $count ?></td>
								<td> <?php echo $lesson['lesson_code'] ?> </td>
								<!--<td> <?php echo ucwords($lesson['first_name'].' '.$lesson['last_name']) ?></td>-->
								<td> <?php echo $lesson['subject'] ?> </td>
								<td> <?php echo date('d/m/Y',$lesson['lesson_date']) ?> </td>
								<td> <?php echo CURRENCY_SYMBOL ?><?php echo $lesson['hourly_rate']*count($lesson['students']) ?></td>
								<td> <?php $status = "";
									if($lesson['status'] == PENDING){
										$status = "Pending";
									} else if($lesson['status'] == CANCELED){
										$status = "Canceled";
									} else if($lesson['status'] == APPROVED){
										$status = "Approved";
									} else if($lesson['status'] == DISPUTED){
										$status = "Disputed";
									} else if($lesson['status'] == COMPLETED){
										$status = "Completed";
									} else if($lesson['status'] == INACTIVE_STATUS_ID){
										$status = "Payment Pending";
									} else if($lesson['status'] == PENDING_APPROVAL){
										$status = "Completion Approval required";
									}
									?>
								<?php echo $status ?></td>
								<td> <a href="<?php echo ROUTE_LESSON_DETAILS.'/'.$lesson['id'] ?>" class="btn btn-sm btn-warning" title="Detail">Details</a> </td>
							</tr>
						<?php $count++; } ?>
						</tbody>
					</table>
                    </div>
						<?php } else { ?>
                <h6>No lessons yet!</h6>
						<?php } ?>
			</div>
		  </div>
          <!-- posts end -->
			<!-- Pagination
======================================== -->
        <!--  <nav class="text-center">
            <ul class="pagination">
              <li> <a href="#" aria-label="Previous"> <span aria-hidden="true">«</span> </a> </li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li> <a href="#" aria-label="Next"> <span aria-hidden="true">»</span> </a> </li>
            </ul>
          </nav> -->
          <!-- pagination end --> 
          
        </div>
      </div>
    </div>
  </div>
</main>
<script>
	$(document).ready(function(){
		<?php if(!empty($given_lessons) && empty($taken_lessons)){ ?>
			$('#given-lessons').show();
			$('#taken-lessons').hide();
		<?php } ?>
		<?php if(!empty($taken_lessons) && empty($given_lessons)){ ?>
			$('#taken-lessons').show();
			$('#given-lessons').hide();
		<?php } ?>
	})
</script>