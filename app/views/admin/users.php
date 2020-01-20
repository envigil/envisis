<?php require_once APPROOT . '/views/include/admin-header.php'; ?>



<?php require_once APPROOT . '/views/include/admin-sidebar.php'; ?>



<div class="page-wrapper">

    <div class="container-fluid">
        <div style="padding: 14px 10px; " class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Admin Profile </h4>
            </div>
        </div>



        <form method="POST" action=<?php echo URLROOT . "Admin/users"  ?> class="ui form">
            <div class="ui fields">
                <div class="ui four wide field">
                    <input class="ui input" name="users_name" placeholder="Group User Name">
                    <input class="ui input" name="all_mem" placeholder="Allowed Number of Members">
                    <button class="ui button"> Add page</button>
                </div>
            </div>
        </form>




    </div>
</div>




<?php require_once APPROOT . '/views/include/admin-footer.php'; ?>