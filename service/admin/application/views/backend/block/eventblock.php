<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editEvents') {
    echo 'active';
} ?>" href="<?php echo site_url('site/editEvents?id=').$before1; ?>">Event Details</a></li>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewEventVideo' || $this->uri->segment(2) == 'createEventVideo' || $this->uri->segment(2) == 'editEventVideo') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewEventVideo?id=').$before2; ?>">Event Video</a></li>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewEventImages' || $this->uri->segment(2) == 'editEventImages'  || $this->uri->segment(2) == 'createEventImages') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewEventImages?id=').$before3; ?>">Event Images</a></li>
        </ul>
    </div>
</section>
