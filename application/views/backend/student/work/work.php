<!--title-->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-book-open-page-variant title_icon"></i> <?php echo get_phrase('my_work'); ?>
                    <a href="<?php echo site_url('student/dashboard'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle mx-1">Dashboard</a>

                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body work-upload mx-auto">
                <form action="<?php echo site_url('student/my_work_upload'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="file" name="work" class="form-control" required />
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function upload_file() {

    }
</script>