<?php

$user_type = $this->session->userdata('user_type');
$user_id   = $this->session->userdata('user_id');
$logged_in_user_details = $this->user_model->get_user_details($user_id);
$user_name = $logged_in_user_details['name'];
// var_dump($user_id);
// exit(1);
$school_id = school_id();


?>
<!DOCTYPE html>
<html>

<head>
    <!-- all the meta tags -->
    <?php include 'metas.php'; ?>
    <!-- all the css files -->
    <?php include 'includes_top.php'; ?>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/61bc1ef0c82c976b71c1d995/1fn3dhnck';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</head>

<body data-layout="detached">
    <!-- HEADER -->
    <?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="wrapper">
            <!-- BEGIN CONTENT -->
            <!-- SIDEBAR -->
            <?php include 'navigation.php'; ?>

            <!-- PAGE CONTAINER-->
            <div class="content-page">
                <div class="content content-main">
                    <div class="loadings hidden"></div>
                    <!-- BEGIN PlACE PAGE CONTENT HERE -->
                    <?php
                    if (!isset($page_name)) {
                        $page_name = "index.php";
                    } else {
                        $page_name = $page_name . '.php';
                    }

                    if ($folder_name == 'academy') {
                        include $folder_name . '/' . $page_name;
                    } else {
                        include $user_type . '/' . $folder_name . '/' . $page_name;
                    }
                    if ($folder_name == 'shop') {
                        include $folder_name . '/' . $page_name;
                    }
                    ?>
                    <!-- END PLACE PAGE CONTENT HERE -->
                </div>
                <!-- Footer -->
                <?php include 'footer.php'; ?>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
    <!-- all the js files -->
    <?php include 'includes_bottom.php'; ?>
    <?php include 'notify.php'; ?>
    <?php include 'modal.php'; ?>
</body>

</html>