<div data-role="page">
    <div data-role="header">
        <a rel="external" href="<?php echo base_url(); ?>" data-icon="arrow-l" data-theme="a">Back</a>
        <h1>Money Diary</h1>
    </div>
    <div data-role="content">
        <ul data-role="listview">
            <li data-role="list-divider" style="text-align: center;">Register new Account</li>
        </ul>
        <?php echo form_open(base_url() . 'authen/register_post'); ?>
        <div data-role="fieldcontain">
            <label for="username"><strong>Username</strong></label>
            <?php echo form_input('username', $this->form_validation->set_value('username'), 'id="username"') ?>
            <?php echo form_error('username', '<p style="color: red; font-weight: bold;">', '</p>'); ?>
        </div>
        <div data-role="fieldcontain">
            <label for="email"><strong>Email</strong></label>
            <input type="email" name="email" id="email" value="<?php echo $this->form_validation->set_value('email'); ?>" />
            <?php echo form_error('email', '<p style="color: red; font-weight: bold;">', '</p>'); ?>
        </div>
        <div data-role="fieldcontain">
            <label for="password"><strong>Password</strong> <span style="font-size:11px; font-weight: normal; padding-left: 5px;">(a-z and A-Z and numbers only, 6 chars min)</span></label>
            <?php echo form_password('password', '', 'id="password"') ?>
            <?php echo form_error('password', '<p style="color: red; font-weight: bold;">', '</p>'); ?>
        </div>
        <div data-role="fieldcontain">
            <label for="cpassword"><strong>Confirm Password</strong></label>
            <?php echo form_password('cpassword', '', 'id="cpassword"') ?>
            <?php echo form_error('cpassword', '<p style="color: red; font-weight: bold;">', '</p>'); ?>
        </div>
        <div data-role="fieldcontain">
            <?php echo form_submit('submit', 'Register', 'data-theme="b"'); ?>
            <a rel="external" href="<?php echo base_url(); ?>" data-role="button" data-theme="a">Cancel</a>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div data-role="footer">
        &nbsp;
    </div>
</div>