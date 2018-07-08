<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            Admins
            <a class="btn green pull-right" href="<?php echo BACKEND_ADMIN_CREATE; ?>">Create Admin</a>
        </h1>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table"
                               id="datatable_user">
                            <thead>
                            <tr>
                                <th width="1%" style="display:none"></th>
                                <th>#</th>
                                <th> Name</th>
                                <th> Email</th>
                                <th> Status</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($users)) {
                                $count = 1;
                                foreach ($users as $admin) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td style="display:none"></td>
                                        <td><?php echo $count ?></td>
                                        <td>
                                            <?php echo ucwords($admin['first_name'] . ' ' . $admin['last_name']) ?>
                                        </td>
                                        <td>
                                            <a href="mailto:<?php echo $admin['email'] ?>"> <?php echo $admin['email'] ?> </a>
                                        </td>
                                        <td>
                                            <?php $status = "";
                                            if ($admin['is_active'] == APPROVAL_STATUS_ID) {
                                                $status = '<span class="label label-sm label-warning">Pending</span>';
                                            }
                                            if ($admin['is_active'] == INACTIVE_STATUS_ID) {
                                                $status = '<span class="label label-sm label-danger">Suspended</span>';
                                            }
                                            if ($admin['is_active'] == ACTIVE_STATUS_ID) {
                                                $status = '<span class="label label-sm label-success">Approved</span>';
                                            }
                                            if ($admin['is_active'] == DISABLED_STATUS_ID) {
                                                $status = '<span class="label label-sm label-danger">Disabled</span>';
                                            }
                                            ?>
                                            <?php echo $status ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="javascript:;"
                                                           onclick="changeAdminStatus('<?php echo ASSET_IMAGES_BACKEND_DIR . '/tick-img.png' ?>',<?php echo $admin['id'] ?>,<?php echo ACTIVE_STATUS_ID ?>,'Are you sure you want to approve the user?')">
                                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                            Approve </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;"
                                                           onclick="changeAdminStatus('<?php echo ASSET_IMAGES_BACKEND_DIR . '/suspend-img.png' ?>',<?php echo $admin['id'] ?>,<?php echo INACTIVE_STATUS_ID ?>,'Are you sure you want to suspend the user?')">
                                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                                            Suspend </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;"
                                                           onclick="changeAdminStatus('<?php echo ASSET_IMAGES_BACKEND_DIR . '/delete-img.png' ?>',<?php echo $admin['id'] ?>,<?php echo DELETED_STATUS_ID ?>,'Are you sure you want to delete the user?')">
                                                            <i class="fa fa-trash-o"></i> Delete </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $count++;
                                }
                            } ?>
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
