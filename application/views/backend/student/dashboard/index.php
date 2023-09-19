<div class="row ">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quick Links</h5>
                        <div class="row">
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-file title_icon"></i>
                                <a href="<?php echo site_url('student/my_files'); ?>" class="d-block">My File</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-book-open title_icon "></i>
                                <a href="<?php echo site_url('student/work_upload'); ?>" class="d-block">Work Book</a>
                            </div>

                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-note-text title_icon"></i>
                                <a href="<?php echo site_url('addons/assignment/my_active_assignment'); ?>" class="d-block">Assignments</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-briefcase-check title_icon"></i>
                                <a href="<?php echo site_url('student/routine'); ?>" class="d-block">Class Routine</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-book-variant title_icon"></i>
                                <a href="<?php echo site_url('student/syllabus'); ?>" class="d-block">Syllabus</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-google-earth title_icon"></i>
                                <a href="<?php echo site_url('student/attendance'); ?>" class="d-block">Attendance</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-book-multiple title_icon"></i>
                                <a href="<?php echo site_url('student/subject'); ?>" class="d-block">Subject</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-earth title_icon"></i>
                                <a href="<?php echo site_url('addons/courses'); ?>" class="d-block">Online Course</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-note-outline title_icon"></i>
                                <a href="<?php echo site_url('student/mark'); ?>" class="d-block">Exam</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-timetable title_icon"></i>
                                <a href="<?php echo site_url('student/noticeboard'); ?>" class="d-block">Notice Board</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-library title_icon"></i>
                                <a href="<?php echo site_url('student/book'); ?>" class="d-block">Library</a>
                            </div>

                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-calendar title_icon"></i>
                                <a href="<?php echo site_url('student/event_calendar'); ?>" class="d-block">Event Calendar</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-clipboard title_icon"></i>
                                <a href="#" class="d-block">Accounting</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi dripicons-user title_icon"></i>
                                <a href="<?php echo site_url('student/teacher'); ?>" class="d-block">Resources</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-message-video title_icon"></i>
                                <a href="<?php echo site_url('addons/live_class'); ?>" class="d-block">Live Class</a>
                            </div>
                            <div class="col-4 p-0 mb-2 text-center">
                                <i class="mdi mdi-view-dashboard title_icon"></i>
                                <a href="<?php echo site_url('student/dashboard'); ?>" class="d-block">Dashboard</a>
                            </div>

                            <?php
                            $user_id = $this->session->userdata('user_id');
                            $messages =  $this->db->query('select * from messages where user_id="' . $user_id . '" or receiver_id="' . $user_id . '" ORDER BY created_at DESC')->result_array();
                            ?>
                            <div class="col-4 p-0 mb-2 text-center" style="position: relative;">
                                <i class="mdi mdi-message title_icon"></i>
                                <a href="<?php echo site_url('student/chat'); ?>" class="d-block">Chat</a>
                                <span class="message-count"><?php echo count($messages) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo get_phrase('recent_events'); ?><a href="<?php echo route('event_calendar'); ?>" style="color: #6c757d;"><i class="mdi mdi-export"></i></a></h4>
                        <?php include 'event.php'; ?>
                    </div>
                </div> -->
            </div> <!-- end col-->
            <div class="col-xl-8">
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
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat" id="student">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted font-weight-normal mt-0" title="Number of Student"> <i class="mdi mdi-account-group title_icon"></i> <?php echo get_phrase('Class Routine'); ?> <a href="<?php echo route('routine'); ?>" style="color: #6c757d;" id="student_list"><i class="mdi mdi-export"></i></a></h5>
                                <h3 class="mt-3 mb-3">
                                    <?php
                                    $class_routines =  $this->db->get_where('routines')->result_array();
                                    echo count($class_routines);
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
                                <h5 class="text-muted font-weight-normal mt-0" title="Slybus"> <i class="mdi mdi-account-group title_icon"></i><?php echo get_phrase('Slybus'); ?> <a href="<?php echo route('syllabus'); ?>" style="color: #6c757d;" id="teacher_list"><i class="mdi mdi-export"></i></a></h5>
                                <h3 class="mt-3 mb-3">
                                    <?php
                                    $slybuses =  $this->db->get_where('syllabuses')->result_array();
                                    echo count($slybuses);
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
                                <h5 class="text-muted font-weight-normal mt-0" title="Assignments"> <i class="mdi mdi-account-group title_icon"></i> <?php echo get_phrase('Assignments'); ?> <a href="<?php echo site_url('addons/assignment/my_active_assignment'); ?>" style="color: #6c757d;" id="parent_list"><i class="mdi mdi-export"></i></a></h5>
                                <h3 class="mt-3 mb-3">
                                    <?php
                                    $assignments =  $this->db->get_where('assignments')->result_array();
                                    echo count($assignments);
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
                                <h5 class="text-muted font-weight-normal mt-0" title="My Works"> <i class="mdi mdi-account-group title_icon"></i> <?php echo get_phrase('My Works'); ?><a href="<?php echo route('work_upload'); ?>" style="color: #6c757d;" id="parent_list"><i class="mdi mdi-export"></i></a></h5>
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
                    <div class="col-lg-6">
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
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title"><?php echo get_phrase('recent_events'); ?><a href="<?php echo route('event_calendar'); ?>" style="color: #6c757d;"><i class="mdi mdi-export"></i></a></h4>
                                <?php include 'event.php'; ?>
                            </div>
                        </div>
                    </div>
                    <!-- advertisement -->
                    <div class="col-lg-12 mb-3">
                        <img src="https://i0.wp.com/digiday.com/wp-content/uploads/2018/01/business-strat.jpg?fit=1440%2C600&zoom=2&quality=100&strip=all&ssl=1" alt="advertisement" class="img-fluid advertisement-img">
                    </div> <!-- end col-->
                </div>
            </div> <!-- end col -->

        </div>
    </div><!-- end col-->
</div>

<script>
    $(document).ready(function() {
        initDataTable("expense-datatable");
    });
</script>