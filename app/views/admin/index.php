<?php require_once APPROOT . '/views/include/admin-header.php'; ?>


<form method="POST" action=<?php echo URLROOT . "Admin/page/create-new" ?> class="ui form">
    <div class="ui fields">
        <div class="ui four wide field">
            <input class="ui input" name="page_title" placeholder="page title">
            <input class="ui input" name="page_name" placeholder="page name">
            <input class="ui input" name="page_content" placeholder="page content">
            <select name="parent_page">
                <option value="0">No fucking parent</option>
                <?php foreach ($data['pages'] as $parent) : ?>
                    <option value="<?php echo $parent->page_ID ?>"><?php echo $parent->page_name ?></option>
                <?php endforeach; ?>
            </select>
            <input class="ui input" checked type="radio" value="visible" name="page_status">
            <input class="ui input" type="radio" value="private" name="page_status">
            <button class="ui button"> Add page</button>
        </div>
    </div>
</form>



<?php require_once APPROOT . '/views/include/admin-footer.php'; ?>