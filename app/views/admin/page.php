<?php require_once APPROOT . '/views/include/admin-header.php'; ?>



<?php require_once APPROOT . '/views/include/admin-sidebar.php'; ?>



<div class="page-wrapper">

    <div class="container-fluid">
        <div style="padding: 14px 10px; " class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Admin Profile <?php echo $data["page_type"] ?> </h4>
            </div>
        </div>



        <form method="POST" action=<?php echo URLROOT . "Admin/pager/create-new/" . $data["page_type"]  ?> class="ui form">
            <div class="ui fields">
                <div class="ui four wide field">
                    <input class="ui input" name="page_title" placeholder="page title">
                    <input class="ui input" name="page_name" placeholder="page name">
                    <input class="ui input" name="page_content" placeholder="page content">
                    <select name="parent_page">
                        <option value="0">No fucking parent</option>
                        <?php foreach ($data['parent_page'] as $parent) : ?>
                            <option value="<?php echo $parent->page_ID ?>"><?php echo $parent->page_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input class="ui input" checked type="radio" value="visible" name="page_status">
                    <input class="ui input" type="radio" value="private" name="page_status">
                    <?php
                    if ($data["page_type"] == $this->AVAILPAGES["PORTALS"]) :
                    ?>
                        <select name="page_users">
                            <option>student</option>
                            <option>lecturer</option>
                        </select>
                        <select name="page_login">
                            <option>student-login</option>
                            <option>lecturer-login</option>
                        </select>
                    <?php
                    elseif ($data["page_type"] == $this->AVAILPAGES["BLOG"]) :
                    ?>
                    <?php
                    elseif ($data["page_type"]  == $this->AVAILPAGES["LOGINS"]) :
                    ?>
                        <select name="page_portal">
                            <option>student portal</option>
                            <option>admin portal</option>
                        </select>
                    <?php
                    endif;
                    ?>
                    <button class="ui button"> Add page</button>
                </div>
            </div>
        </form>




    </div>
</div>




<?php require_once APPROOT . '/views/include/admin-footer.php'; ?>