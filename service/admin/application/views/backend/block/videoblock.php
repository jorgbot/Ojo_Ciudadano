<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editVideoGallery') {
    echo 'active';
} ?>" href="<?php echo site_url('site/editVideoGallery?id=').$before1; ?>">Video Details</a></li>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewVideoGalleryVideo' || $this->uri->segment(2) == 'editVideoGalleryVideo' || $this->uri->segment(2) == 'createVideoGalleryVideo') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewVideoGalleryVideo?id=').$before2; ?>">Video Gallery Details</a></li>
        </ul>
    </div>
</section>
