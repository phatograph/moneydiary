<div data-role="page">
    <div data-role="header">
        <a rel="external" href="<?php echo base_url(); ?>categories" data-icon="arrow-l" data-theme="a">Categories</a>
        <?php if($category['id'] == NULL) { ?>
            <h1>Add New Category</h1>
        <?php } else { ?>
            <h1>Edit Category</h1>
        <?php } ?>
    </div>
    <div data-role="content">
        <?php
            if($category['id'] == NULL) echo form_open(base_url() . 'categories/add_post');
            else echo form_open(base_url() . 'categories/edit_post/'.$category['id']);
        ?>
        <div data-role="fieldcontain">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $category['name'] ?>" />
            <?php echo form_error('name', '<span style="color: red; font-weight: bold;">', '</span>'); ?>
        </div>
        <div data-role="fieldcontain">
            <?php echo form_hidden('id', $category['id']) ?>
            <?php echo form_submit('submit', 'save', 'data-theme="b"'); ?>
            <a rel="external" href="<?php echo base_url(); ?>categories" data-role="button">Cancel</a>
        </div>
        <?php echo form_close(); ?>
    </div>
    <?php if($category['id'] != NULL) { ?>
    <div data-role="content">
        <a rel="external" href="<?php echo base_url(); ?>categories/delete_post/<?php echo $category['id'] ?>" data-role="button" data-theme="e">Delete this Category</a>
    </div>
    <?php } ?>
    <div data-role="footer">
        &nbsp;
    </div>
</div>