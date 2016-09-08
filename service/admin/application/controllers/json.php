<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Json extends CI_Controller
{
    public function getAllArticles()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_articles`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_articles`.`status`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Status';
        $elements[1]->alias = 'status';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_articles`.`title`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Title';
        $elements[2]->alias = 'title';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_articles`.`json`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Json';
        $elements[3]->alias = 'json';

        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_articles`.`content`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Content';
        $elements[4]->alias = 'content';

        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_articles`.`image`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'image';
        $elements[5]->alias = 'image';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_articles`', 'WHERE `webapp_articles`.`status`=1');
        $this->load->view('json', $data);
    }
    public function getSingleArticles()
    {
        $id = $this->input->get_post('id');
        $data['message'] = $this->articles_model->getSingleArticles($id);
        $this->load->view('json', $data);
    }
    public function getAllFrontmenu()
    {
        $data['message'] = $this->RestApi_model->getAllFrontmenu();
        $this->load->view('json', $data);
    }
    public function getAllGallery()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_gallery`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_gallery`.`order`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Order';
        $elements[1]->alias = 'order';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_gallery`.`status`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Status';
        $elements[2]->alias = 'status';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_gallery`.`name`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Name';
        $elements[3]->alias = 'name';

        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_gallery`.`json`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Json';
        $elements[4]->alias = 'json';

        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_gallery`.`image`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'image';
        $elements[5]->alias = 'image';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'order';
            $orderorder = 'ASC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_gallery`', 'WHERE `webapp_gallery`.`status`=1');
        $this->load->view('json', $data);
    }
    public function getSingleGallery()
    {
        $id = $this->input->get_post('id');
        $data['message'] = $this->gallery_model->getSingleGallery($id);
        $this->load->view('json', $data);
    }
    public function getAllGalleryImage()
    {
        $id = $this->input->get_post('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_galleryimage`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_galleryimage`.`gallery`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Gallery';
        $elements[1]->alias = 'gallery';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_galleryimage`.`order`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Order';
        $elements[2]->alias = 'order';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_galleryimage`.`status`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Status';
        $elements[3]->alias = 'status';

        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_galleryimage`.`image`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Image';
        $elements[4]->alias = 'src';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'order';
            $orderorder = 'ASC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_galleryimage`', "WHERE `webapp_galleryimage`.`status`=1 AND `webapp_galleryimage`.`gallery`='$id'");
        $this->load->view('json', $data);
    }
    public function getAllVideoGallery()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_videogallery`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_videogallery`.`order`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Order';
        $elements[1]->alias = 'order';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_videogallery`.`status`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Status';
        $elements[2]->alias = 'status';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_videogallery`.`name`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Name';
        $elements[3]->alias = 'name';

        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_videogallery`.`json`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Json';
        $elements[4]->alias = 'json';

        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_videogallery`.`subtitle`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'subtitle';
        $elements[5]->alias = 'subtitle';

        $elements[6] = new stdClass();
        $elements[6]->field = 'GROUP_CONCAT(`webapp_videogalleryvideo`.`url`)';
        $elements[6]->sort = '1';
        $elements[6]->header = 'url';
        $elements[6]->alias = 'url';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'order';
            $orderorder = 'ASC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_videogallery` LEFT OUTER JOIN `webapp_videogalleryvideo` ON `webapp_videogalleryvideo`.`videogallery`=`webapp_videogallery`.`id`', 'WHERE `webapp_videogallery`.`status`=1', 'GROUP BY `webapp_videogallery`.`id`');
        $this->load->view('json', $data);
    }
    public function getSingleVideoGallery()
    {
        $id = $this->input->get_post('id');
        $data['message'] = $this->videogallery_model->getSingleVideoGallery($id);
        $this->load->view('json', $data);
    }
    public function getAllVideoGalleryVideo()
    {
        $id = $this->input->get_post('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_videogalleryvideo`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_videogalleryvideo`.`order`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Order';
        $elements[1]->alias = 'order';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_videogalleryvideo`.`status`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Status';
        $elements[2]->alias = 'status';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_videogalleryvideo`.`videogallery`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Video Gallery';
        $elements[3]->alias = 'videogallery';

        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_videogalleryvideo`.`url`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Url';
        $elements[4]->alias = 'url';

        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_videogallery`.`id`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'ID';
        $elements[5]->alias = 'id';

        $elements[6] = new stdClass();
        $elements[6]->field = '`webapp_videogallery`.`order`';
        $elements[6]->sort = '1';
        $elements[6]->header = 'Order';
        $elements[6]->alias = 'ordervideo';

        $elements[7] = new stdClass();
        $elements[7]->field = '`webapp_videogallery`.`status`';
        $elements[7]->sort = '1';
        $elements[7]->header = 'Status';
        $elements[7]->alias = 'status';

        $elements[8] = new stdClass();
        $elements[8]->field = '`webapp_videogallery`.`name`';
        $elements[8]->sort = '1';
        $elements[8]->header = 'Name';
        $elements[8]->alias = 'name';

        $elements[9] = new stdClass();
        $elements[9]->field = '`webapp_videogallery`.`json`';
        $elements[9]->sort = '1';
        $elements[9]->header = 'Json';
        $elements[9]->alias = 'json';

        $elements[10] = new stdClass();
        $elements[10]->field = '`webapp_videogalleryvideo`.`alt`';
        $elements[10]->sort = '1';
        $elements[10]->header = 'alt';
        $elements[10]->alias = 'alt';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'order';
            $orderorder = 'ASC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_videogalleryvideo` LEFT OUTER JOIN `webapp_videogallery` ON `webapp_videogallery`.`id`=`webapp_videogalleryvideo`.`videogallery`', "WHERE `webapp_videogallery`.`status`=1 AND `webapp_videogalleryvideo`.`status`=1 AND `webapp_videogalleryvideo`.`videogallery`='$id'");
        $this->load->view('json', $data);
    }
    public function getAllEvents()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_events`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_events`.`status`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Status';
        $elements[1]->alias = 'status';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_events`.`title`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Title';
        $elements[2]->alias = 'title';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_events`.`timestamp`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Timestamp';
        $elements[3]->alias = 'timestamp';

        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_events`.`content`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Content';
        $elements[4]->alias = 'content';

        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_events`.`image`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'image';
        $elements[5]->alias = 'image';

        $elements[6] = new stdClass();
        $elements[6]->field = '`webapp_events`.`startdate`';
        $elements[6]->sort = '1';
        $elements[6]->header = 'startdate';
        $elements[6]->alias = 'startdate';

        $elements[7] = new stdClass();
        $elements[7]->field = '`webapp_events`.`starttime`';
        $elements[7]->sort = '1';
        $elements[7]->header = 'starttime';
        $elements[7]->alias = 'starttime';

        $elements[8] = new stdClass();
        $elements[8]->field = '`webapp_events`.`venue`';
        $elements[8]->sort = '1';
        $elements[8]->header = 'venue';
        $elements[8]->alias = 'venue';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'DESC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_events`', 'WHERE `webapp_events`.`status`=1');
        $this->load->view('json', $data);
    }
    public function getSingleEvents()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->events_model->getSingleEvents($id);
        }
        $this->load->view('json', $data);
    }

    public function createEnquiry()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $email = $data['email'];
        $user = $data['user'];
        $content = $data['content'];
        $title = $data['title'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->RestApi_model->createEnquiry($name, $email, $user, $content, $title);
        }
        $this->load->view('json', $data);
    }
    public function signUp()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $dob = $data['dob'];
        $os = $data['os'];
        $token = $data['token'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->RestApi_model->signUp($username, $email, $password, $dob, $os, $token);
        }
        $this->load->view('json', $data);
    }
    public function signIn()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $password = $data['password'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->RestApi_model->signIn($username, $password);
        }
        $this->load->view('json', $data);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        $data['message'] = true;
        $this->load->view('json', $data);
    }
    public function getAllUserNotification()
    {
        $id = $this->input->get('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_notification`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_notification`.`video`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Video';
        $elements[1]->alias = 'video';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_notification`.`event`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'event';
        $elements[2]->alias = 'event';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_notification`.`gallery`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Gallery';
        $elements[3]->alias = 'gallery';

        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_notification`.`article`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'article';
        $elements[4]->alias = 'article';

        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_notification`.`blog`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'blog';
        $elements[5]->alias = 'blog';

        $elements[6] = new stdClass();
        $elements[6]->field = '`webapp_notification`.`status`';
        $elements[6]->sort = '1';
        $elements[6]->header = 'Status';
        $elements[6]->alias = 'status';

        $elements[7] = new stdClass();
        $elements[7]->field = '`webapp_notification`.`link`';
        $elements[7]->sort = '1';
        $elements[7]->header = 'Link';
        $elements[7]->alias = 'link';

        $elements[8] = new stdClass();
        $elements[8]->field = '`webapp_notification`.`image`';
        $elements[8]->sort = '1';
        $elements[8]->header = 'Image';
        $elements[8]->alias = 'image';

        $elements[9] = new stdClass();
        $elements[9]->field = '`webapp_notification`.`timestamp`';
        $elements[9]->sort = '1';
        $elements[9]->header = 'Timestamp';
        $elements[9]->alias = 'timestamp';

        $elements[10] = new stdClass();
        $elements[10]->field = '`webapp_notification`.`content`';
        $elements[10]->sort = '1';
        $elements[10]->header = 'Content';
        $elements[10]->alias = 'content';

        $elements[11] = new stdClass();
        $elements[11]->field = '`webapp_notificationuser`.`id`';
        $elements[11]->sort = '1';
        $elements[11]->header = 'notificationuserid';
        $elements[11]->alias = 'notificationuserid';

        $elements[12] = new stdClass();
        $elements[12]->field = '`webapp_notificationuser`.`notification`';
        $elements[12]->sort = '1';
        $elements[12]->header = 'Notificationid';
        $elements[12]->alias = 'notificationid';

        $elements[13] = new stdClass();
        $elements[13]->field = '`webapp_notificationuser`.`user`';
        $elements[13]->sort = '1';
        $elements[13]->header = 'User';
        $elements[13]->alias = 'user';

        $elements[14] = new stdClass();
        $elements[14]->field = '`webapp_notificationuser`.`timestamp`';
        $elements[14]->sort = '1';
        $elements[14]->header = 'Timestampuser';
        $elements[14]->alias = 'timestampuser';

        $elements[15] = new stdClass();
        $elements[15]->field = '`webapp_notificationuser`.`timestamp_receive`';
        $elements[15]->sort = '1';
        $elements[15]->header = 'Timestamp Received';
        $elements[15]->alias = 'timestamp_receive';

        $elements[16] = new stdClass();
        $elements[16]->field = '`webapp_notification`.`linktype`';
        $elements[16]->sort = '1';
        $elements[16]->header = 'linktype';
        $elements[16]->alias = 'linktype';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'timestampuser';
            $orderorder = 'DESC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_notification` LEFT OUTER JOIN `webapp_notificationuser` ON `webapp_notificationuser`.`notification`=`webapp_notification`.`id`', "WHERE `webapp_notificationuser`.`user`='$id'");
        $this->load->view('json', $data);
    }
    public function getSingleNotification()
    {
        $id = $this->input->get_post('id');
        $data['message'] = $this->notification_model->getSingleNotification($id);
        $this->load->view('json', $data);
    }
    public function getAllNotificationUser()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_notificationuser`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements = array();
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_notificationuser`.`notification`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Notification';
        $elements[1]->alias = 'notification';

        $elements = array();
        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_notificationuser`.`user`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'User';
        $elements[2]->alias = 'user';

        $elements = array();
        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_notificationuser`.`timestamp`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Timestamp';
        $elements[3]->alias = 'timestamp';

        $elements = array();
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_notificationuser`.`timestamp_receive`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Timestamp Received';
        $elements[4]->alias = 'timestamp_receive';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_notificationuser`');
        $this->load->view('json', $data);
    }
    public function getSingleNotificationUser()
    {
        $id = $this->input->get_post('id');
        $data['message'] = $this->notificationuser_model->getSingleNotificationUser($id);
        $this->load->view('json', $data);
    }
    public function getAllBlog()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_blog`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_blog`.`content`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Content';
        $elements[1]->alias = 'content';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_blog`.`title`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Title';
        $elements[2]->alias = 'title';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_blog`.`json`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Json';
        $elements[3]->alias = 'json';

        $elements[5] = new stdClass();
        $elements[5]->field = 'date(`webapp_blog`.`timestamp`)';
        $elements[5]->sort = '1';
        $elements[5]->header = 'timestamp';
        $elements[5]->alias = 'timestamp';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'DESC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_blog`');
        $this->load->view('json', $data);
    }
    public function getSingleBlog()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->blog_model->getSingleBlog($id);
        }
        $this->load->view('json', $data);
    }
    public function authenticate()
    {
        $data['message'] = $this->user_model->authenticate();
        $this->load->view('json', $data);
    }
    public function getAllSliders()
    {
        $data['message'] = $this->RestApi_model->getAllSliders();
        $this->load->view('json', $data);
    }
    public function getAppConfig()
    {
        $data['message'] = $this->RestApi_model->getAppConfig();
        $this->load->view('json', $data);
    }
    public function profileSubmit()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $dob = $data['dob'];
        $contact = $data['contact'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->RestApi_model->profileSubmit($id, $name, $email, $password, $dob, $contact);
        }
        $this->load->view('json', $data);
    }
    public function editProfile()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $dob = $data['dob'];
        $contact = $data['contact'];
        $location = $data['location'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->RestApi_model->editProfile($id, $name, $email, $dob, $contact, $location);
        }
        $this->load->view('json', $data);
    }

    public function searchElementold()
    {
        $searchElement = $this->input->get('searchElement');
        $data['articletitle'] = $this->RestApi_model->searchArticleTitle($searchElement);
        $data['eventtitle'] = $this->RestApi_model->searchEventTitle($searchElement);
        $data['blogtitle'] = $this->RestApi_model->searchBlogTitle($searchElement);
        $data['galleryname'] = $this->RestApi_model->searchGalleryName($searchElement);
        $data['videogalleryname'] = $this->RestApi_model->searchVideoGalleryName($searchElement);
        $data['message'] = array_merge($data['articletitle'], $data['eventtitle'], $data['blogtitle'], $data['galleryname'],           $data['videogalleryname']);
        $this->load->view('json', $data);
    }
    public function searchElement()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $searchElement = $data['searchElement'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->RestApi_model->searchElement($searchElement);
        }
        $this->load->view('json', $data);
    }
    public function profileImageUpload()
    {
        $user = $this->input->get_post('id');
        $date = new DateTime();
        $imageName = 'image:'.rand(0, 100000).''.$date->getTimestamp().'.jpg';
        if (move_uploaded_file($_FILES['file']['tmp_name'], './uploads/'.$imageName)) {
            $this->RestApi_model->updateProfileImage($imageName, $user);
            $data['message'] = $imageName;
            $this->load->view('json', $data);
        } else {
            $data['message'] = 'false';
            $this->load->view('json', $data);
        }
    }
    public function coverImageUpload()
    {
        $user = $this->input->get_post('id');
        $date = new DateTime();
        $imageName = 'image:'.rand(0, 100000).''.$date->getTimestamp().'.jpg';
        if (move_uploaded_file($_FILES['file']['tmp_name'], './uploads/'.$imageName)) {
            $this->RestApi_model->updateCoverImage($imageName, $user);
            $data['message'] = $imageName;
            $this->load->view('json', $data);
        } else {
            $data['message'] = 'false';
            $this->load->view('json', $data);
        }
    }
    public function getSingleUserDetail()
    {
        $id = $this->input->get('id');
        $data['message'] = $this->RestApi_model->getSingleUserDetail($id);
        $this->load->view('json', $data);
    }
    public function getHomeContent()
    {
        $data['message'] = $this->RestApi_model->getHomeContent();
        $this->load->view('json', $data);
    }
    public function setNotificationToken()
    {
        $os = $this->input->get('os');
        $token = $this->input->get('token');
        $data['message'] = $this->RestApi_model->setNotificationToken($os, $token);
        $this->load->view('json', $data);
    }
    public function changeSetting()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $id = $data['id'];
        $event = $data['eventnotification'];
        $photo = $data['photonotification'];
        $video = $data['videonotification'];
        $blog = $data['blognotification'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->RestApi_model->changeSetting($id, $event, $photo, $video, $blog);
        }
        $this->load->view('json', $data);
    }
    public function forgotPassword()
    {
        $email = $this->input->get_post('email');
        $userid = $this->user_model->getIdByEmail($email);
        $this->load->helper('string');
        $randompassword = random_string('alnum', 8);
        $data['message'] = $this->user_model->forgotPasswordSubmit($randompassword, $userid);
        if ($userid == '') {
            $data['message'] = 'Not A Valid Email.';
            $this->load->view('json', $data);
        } else {
            $this->load->library('email');
            $this->email->from('vigwohlig@gmail.com', 'Business App');
            $this->email->to($email);
            $this->email->subject('Welcome to Business App');

            $message = "<html>

      <body>
    <div style='text-align:center;   width: 50%; margin: 0 auto;'>
        <h4 style='font-size:1.5em;padding-bottom: 5px;color: #e82a96;'>Business App</h4>
        <p style='font-size: 1em;padding-bottom: 10px;'>Your password is:</p>
        <p style='font-size: 1em;padding-bottom: 10px;'>$randompassword</p>
    </div>
    <div style='text-align:center;position: relative;'>
        <p style=' position: absolute; top: 8%;left: 50%; transform: translatex(-50%); font-size: 1em;margin: 0; letter-spacing:2px; font-weight: bold;'>
            Thank You
        </p>
    </div>
</body>

</html>";
            $this->email->message($message);
            $this->email->send();
//        $data["message"] = $this->email->print_debugger();
        $data['message'] = true;
            $this->load->view('json', $data);
        }
    }
    public function changePassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $oldpassword = $data['oldpassword'];
        $newpassword = $data['newpassword'];
        $confirmpassword = $data['confirmpassword'];
        if (empty($data)) {
            $data['message'] = 0;
        } else {
            $data['message'] = $this->RestApi_model->changePassword($id, $oldpassword, $newpassword, $confirmpassword);
        }
        $this->load->view('json', $data);
    }

    // NOTIFICATIONS API

    public function getAllNotification()
    {
        $eventnotification = $this->input->get_post('event');
        $photonotification = $this->input->get_post('photo');
        $videonotification = $this->input->get_post('video');
        $blognotification = $this->input->get_post('blog');
        if ($eventnotification == 'false') {
            $where .= ' `webapp_notification`.`linktype` NOT IN (3,4) AND';
        }
        if ($photonotification == 'false') {
            $where .= ' `webapp_notification`.`linktype` NOT IN (5,6) AND';
        }
        if ($videonotification == 'false') {
            $where .= ' `webapp_notification`.`linktype` NOT IN (7,8) AND';
        }
        if ($blognotification == 'false') {
            $where .= ' `webapp_notification`.`linktype` NOT IN (9,10) AND';
        }
        $where = " WHERE $where 1 ";
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_notification`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';

        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_notification`.`video`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Video';
        $elements[1]->alias = 'video';

        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_notification`.`event`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'event';
        $elements[2]->alias = 'event';

        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_notification`.`gallery`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Gallery';
        $elements[3]->alias = 'gallery';

        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_notification`.`article`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'article';
        $elements[4]->alias = 'article';

        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_notification`.`blog`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'blog';
        $elements[5]->alias = 'blog';

        $elements[6] = new stdClass();
        $elements[6]->field = '`webapp_notification`.`status`';
        $elements[6]->sort = '1';
        $elements[6]->header = 'Status';
        $elements[6]->alias = 'status';

        $elements[7] = new stdClass();
        $elements[7]->field = '`webapp_notification`.`link`';
        $elements[7]->sort = '1';
        $elements[7]->header = 'Link';
        $elements[7]->alias = 'link';

        $elements[8] = new stdClass();
        $elements[8]->field = '`webapp_notification`.`image`';
        $elements[8]->sort = '1';
        $elements[8]->header = 'Image';
        $elements[8]->alias = 'image';

        $elements[9] = new stdClass();
        $elements[9]->field = '`webapp_notification`.`timestamp`';
        $elements[9]->sort = '1';
        $elements[9]->header = 'Timestamp';
        $elements[9]->alias = 'timestamp';

        $elements[10] = new stdClass();
        $elements[10]->field = '`webapp_notification`.`content`';
        $elements[10]->sort = '1';
        $elements[10]->header = 'Content';
        $elements[10]->alias = 'content';

        $elements[11] = new stdClass();
        $elements[11]->field = '`webapp_notification`.`linktype`';
        $elements[11]->sort = '1';
        $elements[11]->header = 'linktype';
        $elements[11]->alias = 'linktype';

        $elements[12] = new stdClass();
        $elements[12]->field = '`linktype`.`link`';
        $elements[12]->sort = '1';
        $elements[12]->header = 'linktypelink';
        $elements[12]->alias = 'linktypelink';

        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
        }
        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'DESC';
        }
        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_notification` LEFT OUTER JOIN `linktype` ON `linktype`.`id`=`webapp_notification`.`linktype`', "$where AND `webapp_notification`.`status`=1");
        $this->load->view('json', $data);
    }

    public function sendNotification()
    {
        $title = $this->input->get_post('title');
        $message = $this->input->get_post('message');
        $image = $this->input->get_post('image');
        $icon = $this->input->get_post('icon');
        $this->RestApi_model->sendNotificationAndroid($title, $message, $image, $icon);
        $this->RestApi_model->sendNotificationIos($title);
    }
}
