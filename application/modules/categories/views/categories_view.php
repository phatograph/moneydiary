<div data-role="page">
    <div data-role="header">
        <a rel="external" href="<?php echo base_url(); ?>" data-icon="arrow-l" data-theme="a">Dashboard</a>
        <h1>Categories</h1>
    </div>
    <div data-role="content">
        <?php if(User_Current::user()->id != 1) { ?>
        <ul data-role="listview" data-inset="true" data-dividertheme="c">
            <li data-role="list-divider" style="text-align: center;">Custom Categories</li>
            <?php foreach ($customCategories as $key => $cc) { ?>
                <li><a rel="external" style="display: block;" href="<?php echo base_url()."categories/edit/".$cc['id']; ?>"><?php echo $cc['name'] ?></a></li>
            <?php } ?>
            <li data-icon="plus"><a rel="external" style="display: block;" href="<?php echo base_url(); ?>categories/add">Add New Custom Category</a></li>
        </ul>
        <ul data-role="listview" data-inset="true" data-dividertheme="c">
            <li data-role="list-divider" style="text-align: center;">Default Categories</li>
            <?php foreach ($defaultCategories as $key => $dc) { ?>
                <li><a rel="external" style="display: block;" href="<?php echo base_url(); ?>categories"><?php echo $dc['name'] ?></a></li>
            <?php } ?>
        </ul>
        <?php } else { ?>
        <ul data-role="listview" data-inset="true" data-dividertheme="c">
            <li data-role="list-divider" style="text-align: center;">Default Categories</li>
            <?php foreach ($defaultCategories as $key => $dc) { ?>
                <li><a href="#timeline"><?php echo $dc['name'] ?></a></li>
            <?php } ?>
            <li data-icon="plus"><a rel="external" style="display: block;" href="<?php echo base_url(); ?>categories/add">Add New Default Category</a></li>
        </ul>
        <?php } ?>
    </div>
    <div data-role="footer" class="ui-bar" style="text-align: center;">
        &nbsp;
    </div>
</div>