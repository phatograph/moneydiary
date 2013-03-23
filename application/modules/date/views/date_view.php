<div data-role="page">
    <div data-role="header">
        <a rel="external" href="<?php echo base_url(); ?>timeline/findweek/<?php echo $date ?>" data-icon="arrow-l">Timeline</a>
        <h1><?php echo date('D j, M Y', strtotime($date)) ?></h1>
    </div>
    <div data-role="content">
        <ul data-role="listview">
            <?php if(sizeof($expenses) <= 0) { ?>
                <li>
                    <h2 style="text-align: center; font-size: 12px;">No expense for this day :)</h2>
                </li>
            <?php } else { ?>
            <?php foreach ($expenses as $key => $expense) { ?>
                <li>
                    <a rel="external" href="<?php echo base_url(); ?>date/edit/<?php echo $expense['id'] ?>">
                        <h2 style="margin: 0;"><?php echo $expense['Category']['name'] ?></h2>
                        <p style="margin: 0.3em 0 0.6em;"><?php echo date('G:i', strtotime($expense['datetime'])) ?></p>
                        <div class="ui-li-count" style="color: <?php echo ($expense['amount'] < 0 ? 'red' : 'green'); ?>">
                            <?php echo $expense['amount']; ?>
                        </div>
                    </a>
                </li>
            <?php } } ?>
        </ul>
    </div>
    <div data-role="content">
        <a rel="external" href="<?php echo base_url() ?>date/add/<?php echo $date ?>" data-role="button" data-transition="slide" data-theme="b">Add New Expense</a>
    </div>
    <div data-role="footer">
        &nbsp;
    </div>
</div>