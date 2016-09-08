<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'editBlog') {
    echo 'active';
} ?>"  href="<?php echo site_url('site/editBlog?id=').$before1; ?>">Blog Details</a></li>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewBlogVideo') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewBlogVideo?id=').$before2; ?>">Blog Video</a></li>
            <li><a class="waves-effect waves-light <?php if ($this->uri->segment(2) == 'viewBlogImages') {
    echo 'active';
} ?>" href="<?php echo site_url('site/viewBlogImages?id=').$before3; ?>">Blog Images</a></li>
        </ul>
    </div>
</section>
