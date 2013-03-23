<div data-role="page">
    <div data-role="header">
        <a rel="external" href="<?php echo base_url()."date/view/$date"; ?>" data-icon="arrow-l" data-theme="a"><?php echo $date ?></a>
        <?php if($expense['id'] == NULL) { ?>
            <h1>Add New Expense</h1>
        <?php } else { ?>
            <h1>Edit Expense</h1>
        <?php } ?>
    </div>
    <div data-role="content">
        <?php
            if($expense['id'] == NULL) echo form_open(base_url() . 'date/add_post');
            else echo form_open(base_url() . 'date/edit_post/'.$expense['id']);
        ?>
        <div data-role="fieldcontain">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" value="<?php echo $expense['amount'] ?>" />
            <?php echo form_error('amount', '<span style="color: red; font-weight: bold;">', '</span>'); ?>
        </div>
        <div data-role="fieldcontain">
            <label for="category" class="select">Category</label>
            <select name="category" id="category">
                <?php foreach ($categories as $key => $category) { ?>
                    <?php if($expense['id'] == NULL) { ?>
                        <option <?php if($expense['cat_id'] == $category['id']) echo 'selected="selected"' ?> value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    <?php } else { ?>
                        <option <?php if($expense['cat_id'] == $category['id']) echo 'selected="selected"' ?> value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div data-role="fieldcontain">
            <label for="hour" class="select">Hour</label>
            <select name="hour" id="hour">
                <?php for($i = 0; $i < 24 ; $i++) { ?>
                    <?php if($expense['id'] == NULL) { ?>
                        <option <?php if(date('G', now()) == $i) echo 'selected="selected"' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } else { ?>
                        <option <?php if(date('G', strtotime($expense['datetime'])) == $i) echo 'selected="selected"' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <label for="minute" class="select">Minute</label>
            <select name="minute" id="minute">
                <?php for($j = 0; $j < 60 ; $j++) { ?>
                    <?php if($expense['id'] == NULL) { ?>
                        <option <?php if(abs(date('i', now())) == $j) echo 'selected="selected"' ?> value="<?php echo $j ?>"><?php echo $j ?></option>
                    <?php } else { ?>
                        <option <?php if(abs(date('i', strtotime($expense['datetime']))) == $j) echo 'selected="selected"' ?> value="<?php echo $j ?>"><?php echo $j ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div data-role="fieldcontain">
            <?php echo form_hidden('date', $date) ?>
            <?php echo form_submit('submit', 'save', 'data-theme="b"'); ?>
            <a rel="external" href="<?php echo base_url(); ?>date/view/<?php echo $date ?>" data-role="button">Cancel</a>
        </div>
        <?php echo form_close(); ?>
    </div>
    <?php if($expense['id'] != NULL) { ?>
    <div data-role="content">
        <a rel="external" href="<?php echo base_url(); ?>date/delete_post/<?php echo $expense['id'] ?>" data-role="button" data-theme="e">Delete this Category</a>
    </div>
    <?php } ?>
    <div data-role="footer">
        &nbsp;
    </div>
</div>