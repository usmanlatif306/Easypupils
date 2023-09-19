<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-view-dashboard title_icon"></i> <?php echo get_phrase('dashboard'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end page title -->

<div class="row ">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat" id="student">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted font-weight-normal mt-0" title="Number of Student"> <i class="mdi mdi-account-group title_icon"></i> <?php echo get_phrase('Class Routine'); ?> <a href="<?php echo route('student'); ?>" style="color: #6c757d; display: none;" id="student_list"><i class="mdi mdi-export"></i></a></h5>
                                <h3 class="mt-3 mb-3">
                                    <?php
                                    $class_routines =  $this->db->get_where('routines', array('class_id' => '7'))->result_array();
                                    count($class_routines);
                                    $current_session_students = $this->user_model->get_session_wise_student();
                                    // echo $current_session_students->num_rows();
                                    echo $class_routines->num_rows();
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-nowrap"><?php echo get_phrase('total_number_class_routine'); ?></span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-lg-6">
                        <div class="card widget-flat" id="teacher">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted font-weight-normal mt-0" title="Slybus"> <i class="mdi mdi-account-group title_icon"></i><?php echo get_phrase('Slybus'); ?> <a href="<?php echo route('teacher'); ?>" style="color: #6c757d; display: none;" id="teacher_list"><i class="mdi mdi-export"></i></a></h5>
                                <h3 class="mt-3 mb-3">
                                    <?php
                                    $teachers = $this->user_model->get_teachers();
                                    echo $teachers->num_rows();
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-nowrap"><?php echo get_phrase('total_number_of_slybus'); ?></span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat" id="parent">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted font-weight-normal mt-0" title="Assignments"> <i class="mdi mdi-account-group title_icon"></i> <?php echo get_phrase('Assignments'); ?> <a href="<?php echo route('parent'); ?>" style="color: #6c757d; display: none;" id="parent_list"><i class="mdi mdi-export"></i></a></h5>
                                <h3 class="mt-3 mb-3">
                                    <?php
                                    $parents = $this->user_model->get_parents();
                                    echo $parents->num_rows();
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-nowrap"><?php echo get_phrase('total_number_of_assignments'); ?></span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted font-weight-normal mt-0" title="My Works"> <i class="mdi mdi-account-group title_icon"></i> <?php echo get_phrase('My Works'); ?></h5>
                                <h3 class="mt-3 mb-3">
                                    <?php
                                    $accountants = $this->user_model->get_accountants()->num_rows();
                                    $librarians = $this->user_model->get_librarians()->num_rows();
                                    echo $accountants + $librarians;

                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-nowrap"><?php echo get_phrase('total_number_of_my_works'); ?></span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <!-- advertisement -->
                    <div class="col-lg-12 mb-3">
                        <img src="https://i0.wp.com/digiday.com/wp-content/uploads/2018/01/business-strat.jpg?fit=1440%2C600&zoom=2&quality=100&strip=all&ssl=1" alt="advertisement" class="img-fluid advertisement-img">
                    </div> <!-- end col-->
                </div>
            </div> <!-- end col -->
            <div class="col-xl-4">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h4 class="header-title text-white mb-2"><?php echo get_phrase('todays_attendance'); ?></h4>
                        <div class="text-center">
                            <h3 class="font-weight-normal text-white mb-2">
                                <?php echo $this->crud_model->get_todays_attendance(); ?>
                            </h3>
                            <p class="text-light text-uppercase font-13 font-weight-bold"><?php echo $this->crud_model->get_todays_attendance(); ?> <?php echo get_phrase('students_are_attending_today'); ?></p>
                            <!-- <a href="<?php echo route('attendance'); ?>" class="btn btn-outline-light btn-sm mb-1"><?php echo get_phrase('go_to_attendance'); ?>
                                <i class="mdi mdi-arrow-right ml-1"></i>
                            </a> -->

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo get_phrase('recent_events'); ?><a href="<?php echo route('event_calendar'); ?>" style="color: #6c757d;"><i class="mdi mdi-export"></i></a></h4>
                        <?php include 'event.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col-->
</div>

<script>
    $(document).ready(function() {
        initDataTable("expense-datatable");
    });
</script>