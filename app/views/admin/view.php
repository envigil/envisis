    <?php require_once APPROOT . '/views/include/admin-header.php'; ?>



    <?php require_once APPROOT . '/views/include/admin-sidebar.php'; ?>



    <div class="page-wrapper">

        <div class="container-fluid">
            <div style="padding: 14px 10px; " class="row page-titles">

                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Admin Profile</h4>
                </div>
            </div>




            <div class="ui segment trans-back-border ">

                <!--------- Search Bar  ----------->


                <div class="  trans-back ui right floated segment">
                    <div class=" tr-box ui icon input">
                        <input class="en-table" type="text" placeholder="Search...">
                        <i class="en-table circular search link icon"></i>
                    </div>
                </div>
                <!--------- End Of Search Bar  ----------->
                <table class="en-table  ui striped  table">
                    <thead>
                        <tr>
                            <th style="width: 70%;" class=" en-thead ">
                                <div class="ui  checkbox">
                                    <input class="en-click-list-pages" type="checkbox" name="newsletter">
                                    <label style="font-size: 16px; color:#1E2129 !important" class="">Name </label>
                                </div>
                            </th>
                            <th style="color:#1E2129 !important" class="en-thead">Publisher</th>
                            <th style="color:#1E2129 !important" class="en-thead">Date</th>
                            <th style="color:#1E2129 !important" class="en-thead">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data["pageData"] as $pageInfo) : ?>
                            <tr class="tr-box ">
                                <td class=" en-page-name en-row">
                                    <div class="ui  checkbox">
                                        <input class="en-list-pages" type="checkbox" name="newsletter">
                                        <label class=""><?php echo $pageInfo->page_name; ?></label>
                                    </div>
                                </td>
                                <td class="en-row">zkhj</td>
                                <td class="en-row"><?php echo date("Y-m-d",  strtotime("$pageInfo->page_date"));   ?></td>
                                <td class="en-row">
                                    <i class="tab-tools ui eye icon"></i>
                                    <i class="tab-tools ui edit icon"></i>
                                    <i class="tab-tools ui trash icon"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot class="">
                        <tr style="font-size: 15px;">
                            <th class=" active en-tfoot">
                                <div class="ui  checkbox">
                                    <input class="en-click-list-pages" type="checkbox" name="newsletter">
                                    <label style="color:#1E2129 !important; font-size: 16px;" class="">Name </label>
                                </div>
                            </th>
                            <th style="color:#1E2129 !important" class=" en-tfoot">zkhj</th>
                            <th style="color:#1E2129 !important  " class="en-tfoot">zkhj</th>
                            <th style="color:#1E2129 !important" class="en-tfoot">Tools</th>

                        </tr>
                    </tfoot>

                </table>
            </div>





        </div>
    </div>




    <?php require_once APPROOT . '/views/include/admin-footer.php'; ?>