<div data-role="page">
    <div data-role="header">
        <a rel="external" href="<?php echo base_url(); ?>" data-icon="arrow-l" data-theme="a">Dashboard</a>
        <h2>Timeline</h2>
    </div>
    <div data-role="content">
        <ul data-role="listview">
            <?php foreach ($timeline as $key => $t) { ?>
                <li>
                    <a rel="external" href="<?php echo base_url(); ?>date/view/<?php echo $t['date'] ?>">
                        <img src="<?php echo base_url() ?>images/button-<?php echo $t['dateimg']; ?>.png" alt="dateimg" class="ui-li-icon" />
                        <h2 style="margin: 0;"><strong><?php echo date('j F', strtotime($t['date'])); ?></strong></h2>
                        <p style="margin: 0.3em 0 0.6em;"><?php echo date('l', strtotime($t['date'])); ?></p>
                        <?php $style = ""; ($t['amount'] < 0 ? $style = "color: red;" : $style = "color: green;"); ?>
                        <div class="ui-li-count" style="<?php echo $style; ?>"><?php echo $t['amount']; ?></div>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!--
    <div data-role="content">
        <a href="#timeline/week/<?php echo $page + 1 ?>" data-role="button" data-theme="b">View Older</a>
    </div>
    -->
    <div data-role="navbar">
        <ul>
            <?php if($page - 1 >= 0) { ?>
            <li class="ui-block-a"><a rel="external" href="<?php echo base_url(); ?>timeline/week/<?php echo $page - 1 ?>" data-theme="a" data-transition="slidedown">Next Week</a></li>
            <?php } else { ?>
            <li class="ui-block-a"><a rel="external" href="<?php echo base_url(); ?>timeline" data-theme="a">&nbsp;</a></li>
            <?php } ?>
            <li class="ui-block-b"><a rel="external" href="<?php echo base_url(); ?>timeline/week/<?php echo $page + 1 ?>" data-theme="b" data-transition="slideup">Previous Week</a></li>
        </ul>
    </div>
</div>