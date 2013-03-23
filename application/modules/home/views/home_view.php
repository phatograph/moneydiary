<div data-role="page">
    <div data-role="header">
        <h1>Money Diary</h1>
    </div>
    <div data-role="content">
        <ul data-role="listview" style="margin-bottom: 20px;">
            <li data-role="list-divider" style="text-align: center;">Welcome back <?php echo User_Current::user()->username ?>!</li>
        </ul>
        <ul data-role="listview" data-inset="true" data-theme="e">
            <li data-icon="plus"><a rel="external" style="display: block;" href="<?php echo base_url(); ?>date/add/<?php echo date('Y-m-d', time()); ?>">Add New Expense</a></li>
        </ul>
        <ul data-role="listview" data-inset="true" data-dividertheme="c">
            <li data-role="list-divider" style="text-align: center;">Reports</li>
            <li><a href="#timeline">Timeline View</a></li>
        </ul>
        <ul data-role="listview" data-inset="true" data-dividertheme="c">
            <li data-role="list-divider" style="text-align: center;">Options</li>
            <li data-icon="grid"><a href="#categories">Manage Categories</a></li>
            <!--<li data-icon="info"><a href="#timeline">Change Password</a></li>-->
        </ul>
    </div>
    <div data-role="footer" class="ui-bar" style="text-align: center;">
        <script type="text/javascript">
            function signout() {
                var x = window.confirm("Confirm Signing out ?")
                if(x) {
                    window.location = "<?php echo base_url(); ?>authen/signout";
                }
            }
        </script>
        <a onclick="javascript:signout(); return false;" data-icon="alert" rel="external" href="<?php echo base_url(); ?>" data-icon="delete" data-theme="a">Sign out</a>
    </div>
</div>