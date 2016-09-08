<section class="panel">
    <div class="panel-body">
        <ul class="nav nav-stacked">
            <li><a class="<?php if ($this->uri->segment(2) == 'edituser') {
    echo 'active';
} ?>" href="<?php echo site_url('site/edituser?id=').$before->id; ?>">User Details</a></li>
            <li><a class="<?php if ($this->uri->segment(2) == 'editAddress') {
    echo 'active';
} ?>" href="<?php echo site_url('site/editAddress?id=').$before->id; ?>">Address</a></li>
            <li><a class="<?php if ($this->uri->segment(2) == 'viewuserinterestevents') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewuserinterestevents?id=').$before->id; ?>">User Interest Events</a></li>
        </ul>
    </div>
</section>
