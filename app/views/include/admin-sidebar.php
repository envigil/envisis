<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="ui left-sidebar">
    <div class="ui segment  logo-side d-flex no-block nav-text-box align-items-center">
        <span class="ui com_name left floated "></span>
        <span><img style="padding-right: 15px; width:50px !important; " class="ui tiny right floated image" src="  <?php echo URLROOT . "/en-admin/images/envisisgreen.png" ?>   " alt="elegant admin template"></span>

    </div>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">


                <?php foreach ($data["links"]["sidebar"] as $links) : ?>
                    <?php foreach ($links as $sideLinks => $moreLinks) : ?>

                        <li class="clicker">

                            <div class="dropmenu hide">
                                <div class="caretIcon">
                                    <i class=" caret left icon"></i>
                                </div>
                                <?php foreach ($moreLinks["submenu"] as $sublinks) : ?>
                                    <div class=" sub-drop-menu item menu">
                                        <a href="<?php echo $sublinks["link"] ?>" class="item"> <?php echo  $sublinks["name"]; ?> </a>
                                    </div>

                                <?php endforeach; ?>
                            </div>

                            <a class="waves-effect sidebar-icons waves-dark" href="<?php echo  $moreLinks["link"] ?>" aria-expanded="false">
                                <i class=" en-icon-align icon <?php echo $moreLinks["icon"] ?>"></i>
                                <span class="en-icon-align en-text-align hide-menu">
                                    <?php echo  $moreLinks["title"];
                                    ?></span>

                            </a>
                        </li>
                    <?php endforeach; ?>


                <?php endforeach; ?>

                <li>

                    <a class="waves-effect sidebar-icons waves-dark  " aria-expanded="false">
                        <i class="expandicon ToggleExpand en-icon-align icon expand"></i>
                        <span class="  hide-menu"></span>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->