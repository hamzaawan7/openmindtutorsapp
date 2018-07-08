				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> <?php echo $page_data['page_name'] ?>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
									<h4>Page headings
									<a class="btn green pull-right" href="javascript:void(0)" onclick="addPageHeading(<?php echo $page_data['id'] ?>)"> Add Page Headings</a>
                                    </h4>
									<div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user">
                                            <thead>
                                                <tr>
													<th style="display:none"></th>
                                                    <th>#</th>
													<th> Headings </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
										<?php if(!empty($page_headings)){
											$count = 1;
												foreach($page_headings as $page_heading){?>
                                                <tr class="odd gradeX">
													<td style="display:none"></td>
                                                    <td> <?php echo $count ?> </td>
													<td><?php echo $page_heading['heading'] ?></td>
                                                    <td>
														<div class="btn-group view_detail_lesson_request">
                                                            <a href="javascript:void(0)" onclick="deleteHeadings('<?php echo ASSET_IMAGES_BACKEND_DIR.'delete-img.png'  ?>',<?php echo $page_heading['id']?>,<?php echo DELETED_STATUS_ID ?>,'Delete this? Are you sure?',<?php echo $page_data['id'] ?>)" class="btn btn-xs green view_detail_btn"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a>
														</div>
                                                    </td>
                                                </tr>
										<?php $count++; }
										} ?>
                                            </tbody>
                                        </table>
                                    </div>
									<hr>
									<h4>Page FAQs
									<a class="btn green pull-right" href="javascript:void(0)" onclick="addFaqs()"> Add FAQs</a>
                                    </h4>
									<div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user1">
                                            <thead>
                                                <tr>
													<th style="display:none"></th>
                                                    <th>#</th>
													<th> Heading </th>
													<th> Question </th>
													<th> Answer </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
										<?php if(!empty($faq_content)){
											$count = 1;
												foreach($faq_content as $faq_cont){?>
                                                <tr class="odd gradeX">
													<td style="display:none"></td>
                                                    <td> <?php echo $count ?> </td>
													<td><?php echo $faq_cont['heading'] ?></td>
													<td><?php echo $faq_cont['question'] ?></td>
													<td><?php echo $faq_cont['answer'] ?></td>
                                                    <td>
														<div class="btn-group view_detail_lesson_request">
                                                            <a href="javascript:void(0)" onclick="deleteFaq('<?php echo ASSET_IMAGES_BACKEND_DIR.'delete-img.png'  ?>',<?php echo $faq_cont['id']?>,<?php echo DELETED_STATUS_ID ?>,'Delete this? Are you sure?',<?php echo $page_data['id'] ?>)" class="btn btn-xs green view_detail_btn"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a>
														</div>
                                                    </td>
                                                </tr>
										<?php $count++; }
										} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
				<select class="form-control" id="page_heading_select" style="display:none">
					<option value="0">-Select Heading-</option>
					<?php if(!empty($page_headings)){
							foreach($page_headings as $page_heading){?>
					<option value="<?php echo $page_heading['id'] ?>"><?php echo $page_heading['heading'] ?></option>
					<?php }
					} ?>
				</select>
