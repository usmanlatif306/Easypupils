<!--title-->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-chart-timeline title_icon"></i> <?php echo get_phrase('syllabus'); ?>
                    <a href="<?php echo site_url('superadmin/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>
                    <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/syllabus/create'); ?>', '<?php echo get_phrase('create_syllabus'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_syllabus'); ?></button>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-1 mb-1"></div>
                    <div class="col-md-4 mb-1">
                        <select name="class" id="class_id" class="form-control select2" data-toggle="select2" onchange="classWiseSection(this.value)" required>
                            <option value=""><?php echo get_phrase('choose_a_class'); ?></option>
                            <?php
                            $classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array();
                            foreach ($classes as $class) : ?>
                                <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-1">
                        <select name="section" id="section_id" class="form-control select2" data-toggle="select2" required>
                            <option value=""><?php echo get_phrase('choose_section'); ?></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-secondary" onclick="filter_syllabus()"><?php echo get_phrase('submit'); ?></button>
                    </div>
                </div>
                <div class="syllabus_content">
                    <?php include 'list.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('document').ready(function() {
        initSelect2(['#class_id', '#section_id']);
    });

    function classWiseSection(classId) {
        $.ajax({
            url: "<?php echo route('section/list/'); ?>" + classId,
            success: function(response) {
                $('#section_id').html(response);
            }
        });
    }

    function filter_syllabus() {
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        if (class_id != "" && section_id != "") {
            showAllSyllabuses();
        } else {
            toastr.error('<?php echo get_phrase('please_select_a_class_and_section'); ?>');
        }
    }

    var showAllSyllabuses = function() {
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        if (class_id != "" && section_id != "") {
            $.ajax({
                url: '<?php echo route('syllabus/list/') ?>' + class_id + '/' + section_id,
                success: function(response) {
                    $('.syllabus_content').html(response);
                    initDataTable('basic-datatable');
                }
            });
        }
    }
</script>