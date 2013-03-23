<div data-role="page">
    <div data-role="header">
        <h1>Money Diary</h1>
    </div>
    <div data-role="content">
        <ul data-role="listview">
            <li data-role="list-divider" style="text-align: center;">Sign In to Money Diary</li>
        </ul>
        <?php echo form_open(base_url() . 'authen/signin'); ?>
        <div data-role="fieldcontain">
            <label for="username"><strong>Username</strong></label>
            <?php echo form_input('username', '', 'id="username"') ?>
            <?php echo form_error('username', '<p style="color: red; font-weight: bold;">', '</p>'); ?>
        </div>
        <div data-role="fieldcontain">
            <label for="password"><strong>Password</strong></label>
            <?php echo form_password('password', '', 'id="password"') ?>
            <?php echo form_error('password', '<p style="color: red; font-weight: bold;">', '</p>'); ?>
        </div>
        <div data-role="fieldcontain">
            <?php echo form_submit('submit', 'Sign In', 'data-theme="b"'); ?>
            <a rel="external" href="<?php echo base_url(); ?>authen/register" data-role="button" data-theme="a">Register</a>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div data-role="footer">
        &nbsp;
    </div>
</div>