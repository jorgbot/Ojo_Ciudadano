<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Site extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
    }

    public function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('logged_in');
        if ($is_logged_in !== 'true' || !isset($is_logged_in)) {
            redirect(base_url().'index.php/login', 'refresh');
        } //$is_logged_in !== 'true' || !isset( $is_logged_in )
    }

    public function getOrderingDone()
    {
        $orderby=$this->input->get("orderby");
        $ids=$this->input->get("ids");
        $ids=explode(",",$ids);
        $tablename=$this->input->get("tablename");
        $where=$this->input->get("where");
        if($where == "" || $where=="undefined")
        {
            $where=1;
        }
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $i=1;
        foreach($ids as $id)
        {
            //echo "UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = `$id` AND $where";
            $this->db->query("UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = '$id' AND $where");
            $i++;
            //echo "/n";
        }
        $data["message"]=true;
        $this->load->view("json",$data);
        
    }
    
    public function checkAccess($access)
    {
        $accesslevel = $this->session->userdata('accesslevel');
        if (!in_array($accesslevel, $access)) {
            redirect(base_url().'index.php/site?alerterror=You do not have access to this page. ', 'refresh');
        }
    }

    public function index()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'dashboard';
        $data['base_url'] = site_url('site/viewEnquiryJson');
        $data['usercount'] = $this->user_model->getUserCount();
        $data['enquirycount'] = $this->enquiry_model->total();
        $data['title'] = 'Dashboard';
        $this->load->view('template', $data);
    }

    public function createUser()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['accesslevel'] = $this->user_model->getAccessLevels();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['logintype'] = $this->user_model->getLogintypeDropDown();
        $data['eventnotification'] = $this->user_model->getEventNotificationDropDown();
        $data['photonotification'] = $this->user_model->getPhotoNotificationDropDown();
        $data['videonotification'] = $this->user_model->getVideoNotificationDropDown();
        $data['blognotification'] = $this->user_model->getBlogNotificationDropDown();

        //        $data['category']=$this->category_model->getcategorydropdown();

        $data['page'] = 'createuser';
        $data['activemenu'] = 'users';
        $data['title'] = 'Create User';
        $this->load->view('template', $data);
    }

    public function createUserSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[30]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('accessslevel', 'Accessslevel', 'trim');
        $this->form_validation->set_rules('status', 'status', 'trim|');
        $this->form_validation->set_rules('socialid', 'Socialid', 'trim');
        $this->form_validation->set_rules('logintype', 'logintype', 'trim');
        $this->form_validation->set_rules('json', 'json', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['accesslevel'] = $this->user_model->getAccessLevels();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['logintype'] = $this->user_model->getLogintypeDropDown();
            $data['eventnotification'] = $this->user_model->getEventNotificationDropDown();
            $data['photonotification'] = $this->user_model->getPhotoNotificationDropDown();
            $data['videonotification'] = $this->user_model->getVideoNotificationDropDown();
            $data['blognotification'] = $this->user_model->getBlogNotificationDropDown();
            $data['page'] = 'createuser';
            $data['title'] = 'Create User';
            $this->load->view('template', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $accesslevel = $this->input->post('accesslevel');
            $status = $this->input->post('status');
            $socialid = $this->input->post('socialid');
            $logintype = $this->input->post('logintype');
            $json = $this->input->post('json');
            $contact = $this->input->post('contact');
            $address = $this->input->post('address');
            $eventnotification = $this->input->post('eventnotification');
            $photonotification = $this->input->post('photonotification');
            $videonotification = $this->input->post('videonotification');
            $blognotification = $this->input->post('blognotification');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            // COVERIMAGE

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'coverimage';
            $coverimage = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $coverimage = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $coverimage = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($this->user_model->create($name, $email, $password, $accesslevel, $status, $socialid, $logintype, $image, $json, $contact, $address, $eventnotification, $photonotification, $videonotification, $blognotification, $coverimage) == 0) {
                $data['alerterror'] = 'New User Could Not Be Created.';
            } else {
                $data['alertsuccess'] = 'User Created Successfully.';
            }
            $data['redirect'] = 'site/viewUsers';
            $this->load->view('redirect', $data);
        }
    }

    public function viewUsers()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewusers';
        $data['base_url'] = site_url('site/viewUsersJson');
        $data['deleteselected'] = site_url('site/deleteSelectedUsers');
        $data['activemenu'] = 'users';
        $data['title'] = 'View Users';
        $this->load->view('template', $data);
    }

    public function deleteSelectedUsers()
    {
        $selected = $this->input->get('selected');
        $data['todelete']=$this->user_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }

    public function viewUsersJson()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`user`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`user`.`name`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Name';
        $elements[1]->alias = 'name';
        $elements[2] = new stdClass();
        $elements[2]->field = '`user`.`email`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Email';
        $elements[2]->alias = 'email';
        $elements[3] = new stdClass();
        $elements[3]->field = '`user`.`socialid`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'SocialId';
        $elements[3]->alias = 'socialid';
        $elements[4] = new stdClass();
        $elements[4]->field = '`user`.`logintype`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Login Type';
        $elements[4]->alias = 'logintype';
        $elements[5] = new stdClass();
        $elements[5]->field = '`user`.`json`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'Json';
        $elements[5]->alias = 'json';
        $elements[6] = new stdClass();
        $elements[6]->field = '`accesslevel`.`name`';
        $elements[6]->sort = '1';
        $elements[6]->header = 'Access Level';
        $elements[6]->alias = 'accesslevelname';
        $elements[7] = new stdClass();
        $elements[7]->field = '`statuses`.`name`';
        $elements[7]->sort = '1';
        $elements[7]->header = 'Status';
        $elements[7]->alias = 'status';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`');
        $this->load->view('json', $data);
    }

    public function editUser()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['accesslevel'] = $this->user_model->getAccessLevels();
        $data['logintype'] = $this->user_model->getLogintypeDropDown();
        $data['eventnotification'] = $this->user_model->getEventNotificationDropDown();
        $data['photonotification'] = $this->user_model->getPhotoNotificationDropDown();
        $data['videonotification'] = $this->user_model->getVideoNotificationDropDown();
        $data['blognotification'] = $this->user_model->getBlogNotificationDropDown();
        $data['before'] = $this->user_model->beforeEdit($this->input->get('id'));
        $data['page'] = 'edituser';
        $data['activemenu'] = 'users';
        $data['title'] = 'Edit User';
        $this->load->view('template', $data);
    }

    public function editUserSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[30]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|matches[password]');
        $this->form_validation->set_rules('accessslevel', 'Accessslevel', 'trim');
        $this->form_validation->set_rules('status', 'status', 'trim|');
        $this->form_validation->set_rules('socialid', 'Socialid', 'trim');
        $this->form_validation->set_rules('logintype', 'logintype', 'trim');
        $this->form_validation->set_rules('json', 'json', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['accesslevel'] = $this->user_model->getAccessLevels();
            $data['logintype'] = $this->user_model->getLogintypeDropDown();
            $data['eventnotification'] = $this->user_model->getEventNotificationDropDown();
            $data['photonotification'] = $this->user_model->getPhotoNotificationDropDown();
            $data['videonotification'] = $this->user_model->getVideoNotificationDropDown();
            $data['blognotification'] = $this->user_model->getBlogNotificationDropDown();
            $data['before'] = $this->user_model->beforeEdit($this->input->post('id'));
            $data['page'] = 'edituser';

            //			$data['page2']='block/userblock';

            $data['title'] = 'Edit User';
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $name = $this->input->get_post('name');
            $email = $this->input->get_post('email');
            $password = $this->input->get_post('password');
            $accesslevel = $this->input->get_post('accesslevel');
            $status = $this->input->get_post('status');
            $socialid = $this->input->get_post('socialid');
            $logintype = $this->input->get_post('logintype');
            $json = $this->input->get_post('json');
            $contact = $this->input->get_post('contact');
            $address = $this->input->post('address');
            $eventnotification = $this->input->post('eventnotification');
            $photonotification = $this->input->post('photonotification');
            $videonotification = $this->input->post('videonotification');
            $blognotification = $this->input->post('blognotification');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($image == '') {
                $image = $this->user_model->getUserImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            // COVERIMAGE

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'coverimage';
            $coverimage = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $coverimage = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $coverimage = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($coverimage == '') {
                $coverimage = $this->user_model->getCoverImageById($id);

                // print_r($coverimage);

                $coverimage = $coverimage->coverimage;
            }

            if ($this->user_model->edit($id, $name, $email, $password, $accesslevel, $status, $socialid, $logintype, $image, $json, $contact, $address, $eventnotification, $photonotification, $videonotification, $blognotification, $coverimage) == 0) {
                $data['alerterror'] = 'User Editing Was Unsuccesful';
            } else {
                $data['alertsuccess'] = 'User Edited Successfully.';
            }
            $data['redirect'] = 'site/viewUsers';

            // $data['other']="template=$template";

            $this->load->view('redirect', $data);
        }
    }

    public function deleteUser()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->user_model->deleteUser($this->input->get('id'));

        //		$data['table']=$this->user_model->viewUsers();

        $data['alertsuccess'] = 'User Deleted Successfully';
        $data['redirect'] = 'site/viewUsers';

        // $data['other']="template=$template";

        $this->load->view('redirect', $data);
    }

    public function changeUserStatus()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->user_model->changeStatus($this->input->get('id'));

        //		$data['table']=$this->user_model->viewUsers();

        $data['alertsuccess'] = 'Status Changed Successfully';
        $data['redirect'] = 'site/viewUsers';
        $data['other'] = "template=$template";
        $this->load->view('redirect', $data);
    }

    public function viewArticles()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewarticles';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['base_url'] = site_url('site/viewArticlesjson');
        $data['deleteselected'] = site_url('site/deleteSelectedArticles');
        $data['title'] = 'View Pages';
        $data['activemenu'] = 'pages';
        $this->load->view('template', $data);
    }
    
    public function deleteSelectedArticles(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->articles_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }
    public function viewArticlesjson()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_articles`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`statuses`.`name`';
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
        $elements[5]->field = "DATE_FORMAT(`webapp_articles`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
        $elements[5]->sort = '1';
        $elements[5]->header = 'Timestamp';
        $elements[5]->alias = 'timestamp';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_articles` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_articles`.`status`', 'WHERE `webapp_articles`.`id`<>1');
        $this->load->view('json', $data);
    }

    public function createArticles()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createarticles';
        $data['activemenu'] = 'pages';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Create Page';
        $this->load->view('template', $data);
    }

    public function createArticlesSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createarticles';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Create Page';
            $this->load->view('template', $data);
        } else {
            $status = $this->input->get_post('status');
            $title = $this->input->get_post('title');
            $json = $this->input->get_post('json');
            $content = $this->input->get_post('content');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }

            if ($this->articles_model->create($status, $title, $json, $content, $image) == 0) {
                $data['alerterror'] = 'New Page Could Not Be Created.';
            } else {
                $data['alertsuccess'] = 'Page Created Successfully.';
            }
            $data['redirect'] = 'site/viewArticles';
            $this->load->view('redirect', $data);
        }
    }

    public function home()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editarticles';
        $data['activemenu'] = 'home';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Edit Home';
        $data['before'] = $this->articles_model->beforeEdit(1);
        $this->load->view('template', $data);
    }

    public function editArticles()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editarticles';
        $data['activemenu'] = 'pages';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Edit Page';
        $data['before'] = $this->articles_model->beforeEdit($this->input->get('id'));
        $this->load->view('template', $data);
    }

    public function editArticlessubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editarticles';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Edit Page';
            $data['before'] = $this->articles_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $status = $this->input->get_post('status');
            $title = $this->input->get_post('title');
            $json = $this->input->get_post('json');
            $content = $this->input->get_post('content');
            $timestamp = $this->input->get_post('timestamp');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }

            if ($image == '') {
                $image = $this->articles_model->getImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->articles_model->edit($id, $status, $title, $json, $content, $timestamp, $image) == 0) {
                $data['alerterror'] = 'New Page Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Page Updated Successfully.';
            }
            if ($id != 1) {
                $data['redirect'] = 'site/viewArticles';
                $this->load->view('redirect', $data);
            } else {
                $data['redirect'] = 'site/home?id=1';
                $this->load->view('redirect2', $data);
            }
        }
    }

    public function deleteArticles()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->articles_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewArticles';
        $this->load->view('redirect', $data);
    }

    public function viewFrontmenu()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewfrontmenu';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['base_url'] = site_url('site/viewFrontmenuJson');
        $data['deleteselected'] = site_url('site/deleteSelectedFrontmenu');
        $data['title'] = 'View Navigation';
        $data['activemenu'] = 'navigations';
        $this->load->view('template', $data);
    }
          public function deleteSelectedFrontmenu(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->frontmenu_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }
    
    public function viewFrontmenu2()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewFrontmenu2';
        $data['base_url'] = site_url('site/viewFrontmenuJson');
        $data["tablename"] = 'webapp_frontmenu';
        $data["orderfield"] = 'order';
        
        $data['activemenu'] = 'navigations';
        $this->load->view('template', $data);
    }

    public function viewFrontmenuJson()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_frontmenu`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_frontmenu`.`order`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Order';
        $elements[1]->alias = 'order';
        $elements[2] = new stdClass();
        $elements[2]->field = '`tab1`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Parent';
        $elements[2]->alias = 'parent';
        $elements[3] = new stdClass();
        $elements[3]->field = '`statuses`.`name`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Status';
        $elements[3]->alias = 'status';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_frontmenu`.`name`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Name';
        $elements[4]->alias = 'name';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_frontmenu`.`json`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'Json';
        $elements[5]->alias = 'json';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 10;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_frontmenu` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_frontmenu`.`status` LEFT OUTER JOIN `webapp_frontmenu` as `tab1` ON `webapp_frontmenu`.`parent`=`tab1`.`id`');
        $this->load->view('json', $data);
    }

    public function createFrontMenu()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createfrontmenu';
        $data['activemenu'] = 'navigations';
        $this->frontmenu_model->changeStatusOfExternalLink();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['parent'] = $this->user_model->getFrontMenuDropDown();
        $data['linktype'] = $this->user_model->getLinkTypeDropDown();
        $data['event'] = $this->user_model->getEventsDropDown();
        $data['blog'] = $this->user_model->getBlogDropDown();
        $data['video'] = $this->user_model->getVideoGalleryDropDown();
        $data['article'] = $this->user_model->getArticleDropDown();
        $data['gallery'] = $this->user_model->getGalleryDropDown();
        $data['icon'] = $this->user_model->getLinkDropDown();
        $data['title'] = 'Create Navigation';
        $this->load->view('template', $data);
    }

    public function createFrontMenusubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('parent', 'Parent', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createfrontmenu';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['parent'] = $this->user_model->getFrontMenuDropDown();
            $data['event'] = $this->user_model->getEventsDropDown();
            $data['blog'] = $this->user_model->getBlogDropDown();
            $data['video'] = $this->user_model->getVideoDropDown();
            $data['article'] = $this->user_model->getArticleDropDown();
            $data['gallery'] = $this->user_model->getGalleryDropDown();
            $data['icon'] = $this->user_model->getLinkDropDown();
            $data['title'] = 'Create Navigation';
            $this->load->view('template', $data);
        } else {
            $order = $this->input->get_post('order');
            $parent = $this->input->get_post('parent');
            $status = $this->input->get_post('status');
            $name = $this->input->get_post('name');
            $json = $this->input->get_post('json');
            $linktype = $this->input->get_post('linktype');
            $icon = $this->input->get_post('icon');
            $event = $this->input->get_post('event');
            $blog = $this->input->get_post('blog');
            $video = $this->input->get_post('video');
            $article = $this->input->get_post('article');
            $gallery = $this->input->get_post('gallery');
            $typeid = $this->input->get_post('typeid');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }

            if ($this->frontmenu_model->create($order, $parent, $status, $name, $json, $image, $linktype, $icon, $event, $blog, $video, $article, $gallery, $typeid) == 0) {
                $data['alerterror'] = 'New Navigation could not be created.';
            } else {
                $data['alertsuccess'] = 'Navigation created Successfully.';
            }
            $data['redirect'] = 'site/viewFrontmenu';
            $this->load->view('redirect', $data);
        }
    }

    public function editFrontMenu()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editfrontmenu';
        $data['activemenu'] = 'navigations';
        $this->frontmenu_model->changeStatusOfExternalLink();
        $data['parent'] = $this->user_model->getFrontMenuDropDown();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['linktype'] = $this->user_model->getLinkTypeDropDown();
        $data['event'] = $this->user_model->getEventsDropDown();
        $data['blog'] = $this->user_model->getBlogDropDown();
        $data['video'] = $this->user_model->getVideoDropDown();
        $data['article'] = $this->user_model->getArticleDropDown();
        $data['gallery'] = $this->user_model->getGalleryDropDown();
        $data['icon'] = $this->user_model->getLinkDropDown();
        $data['title'] = 'Edit Navigation';
        $data['before'] = $this->frontmenu_model->beforeEdit($this->input->get('id'));
        $this->load->view('template', $data);
    }

    public function editFrontMenuSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('parent', 'Parent', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['page'] = 'editfrontmenu';
            $data['parent'] = $this->user_model->getFrontMenuDropDown();
            $data['event'] = $this->user_model->getEventsDropDown();
            $data['blog'] = $this->user_model->getBlogDropDown();
            $data['video'] = $this->user_model->getVideoDropDown();
            $data['article'] = $this->user_model->getArticleDropDown();
            $data['gallery'] = $this->user_model->getGalleryDropDown();
            $data['icon'] = $this->user_model->getLinkDropDown();
            $data['title'] = 'Edit Navigation';
            $data['before'] = $this->frontmenu_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $order = $this->input->get_post('order');
            $parent = $this->input->get_post('parent');
            $status = $this->input->get_post('status');
            $name = $this->input->get_post('name');
            $json = $this->input->get_post('json');
            $linktype = $this->input->get_post('linktype');
            $icon = $this->input->get_post('icon');
            $event = $this->input->get_post('event');
            $blog = $this->input->get_post('blog');
            $video = $this->input->get_post('video');
            $article = $this->input->get_post('article');
            $gallery = $this->input->get_post('gallery');
            $typeid = $this->input->get_post('typeid');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }

            if ($image == '') {
                $image = $this->gallery_model->getImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->frontmenu_model->edit($id, $order, $parent, $status, $name, $json, $image, $linktype, $icon, $event, $blog, $video, $article, $gallery, $typeid) == 0) {
                $data['alerterror'] = 'New Navigation Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Navigation Updated Successfully.';
            }
            $data['redirect'] = 'site/viewFrontmenu';
            $this->load->view('redirect', $data);
        }
    }

    public function deleteFrontMenu()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->frontmenu_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewFrontmenu';
        $this->load->view('redirect', $data);
    }

    public function viewGallery()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewgallery';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['base_url'] = site_url('site/viewGalleryJson');
        $data['deleteselected'] = site_url('site/deleteSelectedGallery');
        $data["tablename"] = 'webapp_gallery';
        $data["orderfield"] = 'order';
        $data['title'] = 'View Image Gallery';
        $data['activemenu'] = 'image gallery';
        $this->load->view('template', $data);
    }
    
    
    public function deleteSelectedGallery(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->gallery_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }

    public function viewGalleryJson()
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
        $elements[2]->field = '`statuses`.`name`';
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
        $elements[5]->field = "DATE_FORMAT(`webapp_gallery`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
        $elements[5]->sort = '1';
        $elements[5]->header = 'Timestamp';
        $elements[5]->alias = 'timestamp';  
        $elements[6] = new stdClass();
        $elements[6]->field = "`webapp_gallery`.`image`";
        $elements[6]->sort = '1';
        $elements[6]->header = 'image';
        $elements[6]->alias = 'image';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_gallery` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_gallery`.`status`');
        $this->load->view('json', $data);
    }

    public function createGallery()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'creategallery';
        $data['activemenu'] = 'image gallery';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Create Image Gallery';
        $this->load->view('template', $data);
    }

    public function createGallerySubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['page'] = 'creategallery';
            $data['title'] = 'Create Image Gallery';
            $this->load->view('template', $data);
        } else {
            $order = $this->input->get_post('order');
            $status = $this->input->get_post('status');
            $name = $this->input->get_post('name');
            $json = $this->input->get_post('json');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                if ($this->gallery_model->create($order, $status, $name, $json, $image) == 0) {
                    $data['alerterror'] = 'New Image Gallery could not be created.';
                } else {
                    $data['alertsuccess'] = 'Image Gallery created Successfully.';
                }
               
                $data['redirect'] = 'site/viewGallery';
                $this->load->view('redirect', $data);
            }
            else{
                $data['alerterror'] = 'Image Upload is Mandatory!';
                $data['redirect'] = 'site/createGallerySubmit';
                $this->load->view('redirect', $data);
            }

            
        }
    }

    public function editGallery()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editgallery';
        $data['activemenu'] = 'image gallery';
        $data['page2'] = 'block/galleryblock';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['title'] = 'Edit Image Gallery';
        $data['before'] = $this->gallery_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editGallerySubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editgallery';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Edit Image Gallery';
            $data['before'] = $this->gallery_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $order = $this->input->get_post('order');
            $status = $this->input->get_post('status');
            $name = $this->input->get_post('name');
            $json = $this->input->get_post('json');
            $timestamp = $this->input->get_post('timestamp');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }

            if ($image == '') {
                $image = $this->gallery_model->getImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->gallery_model->edit($id, $order, $status, $name, $json, $timestamp, $image) == 0) {
                $data['alerterror'] = 'New Image Gallery Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Image Gallery Updated Successfully.';
            }
            $data['redirect'] = 'site/viewGallery';
            $this->load->view('redirect', $data);
        }
    }

    public function deleteGallery()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->gallery_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewGallery';
        $this->load->view('redirect', $data);
    }

    public function viewGalleryImage()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewgalleryimage';
        $data['activemenu'] = 'image gallery';
        $data['page2'] = 'block/galleryblock';
         $data["tablename"] = 'webapp_galleryimage';
        $data["orderfield"] = 'order';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['gallery'] = $this->user_model->getGalleryDropDown();
        $data['base_url'] = site_url('site/viewGalleryImageJson?id='.$this->input->get('id'));
        $data['deleteselected'] = site_url('site/deleteSelectedGalleryImage');
        $data['title'] = 'View Image Gallery';
        $this->load->view('templatewith2', $data);
    }

    
    public function deleteSelectedGalleryImage(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->galleryimage_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }
    
    public function viewGalleryImageJson()
    {
        $id = $this->input->get('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_galleryimage`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_gallery`.`name`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Gallery';
        $elements[1]->alias = 'gallery';
        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_galleryimage`.`order`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Order';
        $elements[2]->alias = 'order';
        $elements[3] = new stdClass();
        $elements[3]->field = '`statuses`.`name`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Status';
        $elements[3]->alias = 'status';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_galleryimage`.`image`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Image';
        $elements[4]->alias = 'image';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_galleryimage`.`gallery`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'galleryid';
        $elements[5]->alias = 'galleryid';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_galleryimage` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_galleryimage`.`status` LEFT OUTER JOIN `webapp_gallery` ON `webapp_gallery`.`id`=`webapp_galleryimage`.`gallery`', "WHERE `webapp_galleryimage`.`gallery`='$id'");
        $this->load->view('json', $data);
    }

    public function createGalleryImage()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'creategalleryimage';
        $data['activemenu'] = 'image gallery';
        $data['page2'] = 'block/galleryblock';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['gallery'] = $this->user_model->getGalleryDropDown();
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['title'] = 'Create Image Gallery';
        $this->load->view('templatewith2', $data);
    }

    public function createGalleryImageSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('gallery', 'Gallery', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $data['gallery'] = $this->user_model->getGalleryDropDown();
        $this->form_validation->set_rules('image', 'Image', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'creategalleryimage';
            $data['gallery'] = $this->user_model->getGalleryDropDown();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Create Image Gallery';
            $this->load->view('template', $data);
        } else {
            $gallery = $this->input->get_post('gallery');
            $order = $this->input->get_post('order');
            $status = $this->input->get_post('status');
            $alt = $this->input->get_post('alt');

            // $image=$this->input->get_post("image");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
                if ($this->galleryimage_model->create($gallery, $order, $status, $image, $alt) == 0) {
                $data['alerterror'] = 'New Image Gallery Image could not be created.';
            } else {
                $data['alertsuccess'] = 'Image Gallery Image created Successfully.';
            }
            $data['redirect'] = 'site/viewGalleryImage?id='.$gallery;
            $this->load->view('redirect2', $data);
            }
            else{
            $data['alerterror'] = 'Image Upload is Mandatory.';
            $data['redirect'] = 'site/createGalleryImage?id='.$gallery;
            $this->load->view('redirect2', $data);
            }

            
        }
    }

    public function editGalleryImage()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editgalleryimage';
        $data['page2'] = 'block/galleryblock';
        $data['activemenu'] = 'image gallery';
        $data['status'] = $this->user_model->getStatusDropDown();
        $getgallery = $this->galleryimage_model->beforeEdit($this->input->get('gallery'));
        $getid = $this->galleryimage_model->beforeEdit($this->input->get('id'));
        $data['before1'] = $this->input->get('galleryid');
        $data['before2'] = $this->input->get('galleryid');
        $data['gallery'] = $this->user_model->getGalleryDropDown();
        $data['title'] = 'Edit Image Gallery';
        $data['before'] = $this->galleryimage_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editGalleryImagesubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('gallery', 'Gallery', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('image', 'Image', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editgalleryimage';
            $data['gallery'] = $this->user_model->getGalleryDropDown();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Edit Image Gallery';
            $data['before'] = $this->galleryimage_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $gallery = $this->input->get_post('gallery');
            $order = $this->input->get_post('order');
            $status = $this->input->get_post('status');
            $alt = $this->input->get_post('alt');

            // $image=$this->input->get_post("image");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($image == '') {
                $image = $this->user_model->getGalleryImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->galleryimage_model->edit($id, $gallery, $order, $status, $image, $alt) == 0) {
                $data['alerterror'] = 'New Image Gallery Image Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Image Gallery Image Updated Successfully.';
            }
            $data['redirect'] = 'site/viewGalleryImage?id='.$gallery;
            $this->load->view('redirect2', $data);
        }
    }

    public function deleteGalleryImage()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->galleryimage_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewGalleryImage?id='.$this->input->get('galleryid');
        $this->load->view('redirect2', $data);
    }

    public function viewVideoGallery()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewvideogallery';
        $data['base_url'] = site_url('site/viewVideoGalleryJson');
        $data["tablename"] = 'webapp_videogallery';
        $data["orderfield"] = 'order';
        $data['deleteselected'] = site_url('site/deleteSelectedVideoGallery');
        $data['title'] = 'View Video Gallery';
        $data['activemenu'] = 'video gallery';
        $this->load->view('template', $data);
    }
    
    public function deleteSelectedVideoGallery(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->videogallery_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }

    public function viewVideoGalleryJson()
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
        $elements[2]->field = '`statuses`.`name`';
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
        $elements[5]->field = "DATE_FORMAT(`webapp_videogallery`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
        $elements[5]->sort = '1';
        $elements[5]->header = 'Timestamp';
        $elements[5]->alias = 'timestamp';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_videogallery` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_videogallery`.`status`');
        $this->load->view('json', $data);
    }

    public function createVideoGallery()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createvideogallery';
        $data['activemenu'] = 'video gallery';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
        $data['title'] = 'Create Video Gallery';
        $this->load->view('template', $data);
    }

    public function createVideoGallerySubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createvideogallery';
            $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Create Video Gallery';
            $this->load->view('template', $data);
        } else {
            $order = $this->input->get_post('order');
            $status = $this->input->get_post('status');
            $name = $this->input->get_post('name');
            $json = $this->input->get_post('json');
            $subtitle = $this->input->get_post('subtitle');
            if ($this->videogallery_model->create($order, $status, $name, $json, $subtitle) == 0) {
                $data['alerterror'] = 'New Video Gallery could not be created.';
            } else {
                $data['alertsuccess'] = 'Video Gallery created Successfully.';
            }
            $data['redirect'] = 'site/viewVideoGallery';
            $this->load->view('redirect', $data);
        }
    }

    public function editVideoGallery()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editvideogallery';
        $data['activemenu'] = 'video gallery';
        $data['page2'] = 'block/videoblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Edit Video Gallery';
        $data['before'] = $this->videogallery_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editVideoGallerySubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['page'] = 'editvideogallery';
            $data['title'] = 'Edit Video Gallery';
            $data['before'] = $this->videogallery_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $order = $this->input->get_post('order');
            $status = $this->input->get_post('status');
            $name = $this->input->get_post('name');
            $json = $this->input->get_post('json');
            $timestamp = $this->input->get_post('timestamp');
            $subtitle = $this->input->get_post('subtitle');
            if ($this->videogallery_model->edit($id, $order, $status, $name, $json, $timestamp, $subtitle) == 0) {
                $data['alerterror'] = 'New Video Gallery Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Video Gallery Updated Successfully.';
            }
            $data['redirect'] = 'site/viewVideoGallery';
            $this->load->view('redirect', $data);
        }
    }

    public function deleteVideoGallery()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->videogallery_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewVideoGallery';
        $this->load->view('redirect', $data);
    }

    public function viewVideoGalleryVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewvideogalleryvideo';
        $data['activemenu'] = 'video gallery';
        $data['page2'] = 'block/videoblock';
          $data["tablename"] = 'webapp_videogalleryvideo';
        $data["orderfield"] = 'order';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['base_url'] = site_url('site/viewVideoGalleryVideoJson?id=').$this->input->get('id');
        $data['deleteselected'] = site_url('site/deleteSelectedVideoGalleryVideo');
        $data['title'] = 'View Video Gallery Video';
        $this->load->view('templatewith2', $data);
    }
    
    public function deleteSelectedVideoGalleryVideo(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->videogalleryvideo_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }
    
    public function viewVideoGalleryVideoJson()
    {
        $id = $this->input->get('id');
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
        $elements[2]->field = '`statuses`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Status';
        $elements[2]->alias = 'status';
        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_videogallery`.`name`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Video Gallery';
        $elements[3]->alias = 'videogallery';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_videogalleryvideo`.`url`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Url';
        $elements[4]->alias = 'url';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_videogalleryvideo`.`videogallery`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'videoid';
        $elements[5]->alias = 'videoid';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_videogalleryvideo` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_videogalleryvideo`.`status` LEFT OUTER JOIN `webapp_videogallery` ON `webapp_videogallery`.`id`=`webapp_videogalleryvideo`.`videogallery`', "WHERE `webapp_videogalleryvideo`.`videogallery`='$id'");
        $this->load->view('json', $data);
    }

    public function createVideoGalleryVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createvideogalleryvideo';
        $data['activemenu'] = 'video gallery';
        $data['page2'] = 'block/videoblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
        $data['title'] = 'Create Video Gallery Video';
        $this->load->view('templatewith2', $data);
    }

    public function createVideoGalleryVideoSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('videogallery', 'Video Gallery', 'trim');
        $this->form_validation->set_rules('url', 'Url', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createvideogalleryvideo';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
            $data['title'] = 'Create Video Gallery Video';
            $this->load->view('template', $data);
        } else {
            $order = $this->input->get_post('order');
            $status = $this->input->get_post('status');
            $videogallery = $this->input->get_post('videogallery');
            $url = $this->input->get_post('url');
            $alt = $this->input->get_post('alt');
            if ($this->videogalleryvideo_model->create($order, $status, $videogallery, $url, $alt) == 0) {
                $data['alerterror'] = 'New Video Gallery Video Could Not Be created.';
            } else {
                $data['alertsuccess'] = 'Video Gallery Video created Successfully.';
            }
            $data['redirect'] = 'site/viewVideoGalleryVideo?id='.$videogallery;
            $this->load->view('redirect2', $data);
        }
    }

    public function editVideoGalleryVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editvideogalleryvideo';
        $data['activemenu'] = 'video gallery';
        $data['page2'] = 'block/videoblock';
        $data['before1'] = $this->input->get('videoid');
        $data['before2'] = $this->input->get('videoid');
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
        $data['title'] = 'Edit Video Gallery Video';
        $data['before'] = $this->videogalleryvideo_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editVideoGalleryVideoSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('videogallery', 'Video Gallery', 'trim');
        $this->form_validation->set_rules('url', 'Url', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
            $data['page'] = 'editvideogalleryvideo';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Edit Video Gallery Video';
            $data['before'] = $this->videogalleryvideo_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $order = $this->input->get_post('order');
            $status = $this->input->get_post('status');
            $videogallery = $this->input->get_post('videogallery');
            $url = $this->input->get_post('url');
            $alt = $this->input->get_post('alt');
            if ($this->videogalleryvideo_model->edit($id, $order, $status, $videogallery, $url, $alt) == 0) {
                $data['alerterror'] = 'New Video Gallery Video Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Video Gallery Video Updated Successfully.';
            }
            $data['redirect'] = 'site/viewVideoGalleryVideo?id='.$videogallery;
            $this->load->view('redirect2', $data);
        }
    }

    public function deleteVideoGalleryVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->videogalleryvideo_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewVideoGalleryVideo?id='.$this->input->get('videoid');
        $this->load->view('redirect2', $data);
    }

    public function viewEvents()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewevents';
        $data['activemenu'] = 'events';
        $data['base_url'] = site_url('site/viewEventsJson');
         $data['deleteselected'] = site_url('site/deleteSelectedEvents');
        $data['title'] = 'View Events';
        $this->load->view('template', $data);
    }
    
    public function deleteSelectedEvents(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->events_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }

    public function viewEventsJson()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_events`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`statuses`.`name`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Status';
        $elements[1]->alias = 'status';
        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_events`.`title`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Title';
        $elements[2]->alias = 'title';
        $elements[3] = new stdClass();
        $elements[3]->field = "DATE_FORMAT(`webapp_events`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
        $elements[3]->sort = '1';
        $elements[3]->header = 'Timestamp';
        $elements[3]->alias = 'timestamp';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_events`.`content`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Content';
        $elements[4]->alias = 'content';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'DESC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_events` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_events`.`status`');
        $this->load->view('json', $data);
    }

    public function createEvents()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createevents';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['activemenu'] = 'events';
        $data['title'] = 'Create Event';
        $this->load->view('template', $data);
    }

    public function createEventsSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('timestamp', 'Timestamp', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createevents';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Create Event';
            $this->load->view('template', $data);
        } else {
            $status = $this->input->get_post('status');
            $title = $this->input->get_post('title');
            $timestamp = $this->input->get_post('timestamp');
            $content = $this->input->get_post('content');
            $venue = $this->input->get_post('venue');

            // $image=$this->input->get_post("image");

            $startdate = $this->input->get_post('startdate');
            $starttime = $this->input->get_post('starttime');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                if ($this->events_model->create($status, $title, $timestamp, $content, $venue, $image, $startdate, $starttime) == 0) {
                $data['alerterror'] = 'New Event could not be created.';
            } else {
                $data['alertsuccess'] = 'Event created Successfully.';
            }
            $data['redirect'] = 'site/viewEvents';
            $this->load->view('redirect', $data);
            }
            else{
            $data['alerterror'] = 'Image upload is mandatory!';
            $data['redirect'] = 'site/createEventsSubmit';
            $this->load->view('redirect', $data);
            }

            
        }
    }

    public function editEvents()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editevents';
        $data['activemenu'] = 'events';
        $data['page2'] = 'block/eventblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['title'] = 'Edit Event';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['before'] = $this->events_model->beforeEdit($this->input->get('id'));
        $data['exp'] = explode(':', $data['before']->starttime);
        $this->load->view('templatewith2', $data);
    }

    public function editEventsSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('timestamp', 'Timestamp', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['page'] = 'editevents';
            $data['title'] = 'Edit Event';
            $data['before'] = $this->events_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $status = $this->input->get_post('status');
            $title = $this->input->get_post('title');
            $timestamp = $this->input->get_post('timestamp');
            $content = $this->input->get_post('content');
            $venue = $this->input->get_post('venue');

            // $image=$this->input->get_post("image");

            $startdate = $this->input->get_post('startdate');
            $starttime = $this->input->get_post('starttime');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }

            if ($image == '') {
                $image = $this->events_model->getImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->events_model->edit($id, $status, $title, $timestamp, $content, $venue, $image, $startdate, $starttime) == 0) {
                $data['alerterror'] = 'New Event Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Event Updated Successfully.';
            }
            $data['redirect'] = 'site/viewEvents';
            $this->load->view('redirect', $data);
        }
    }

    public function deleteEvents()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->events_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewEvents';
        $this->load->view('redirect', $data);
    }

    public function viewEventVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'vieweventvideo';
        $data['activemenu'] = 'events';
        $data['page2'] = 'block/eventblock';
        $data["tablename"] = 'webapp_eventvideo';
        $data["orderfield"] = 'order';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['base_url'] = site_url('site/viewEventVideoJson?id=').$this->input->get('id');
        $data['deleteselected'] = site_url('site/deleteSelectedEventsVideo');
        $data['title'] = 'View Event Videos';
        $this->load->view('templatewith2', $data);
    }

    
    public function deleteSelectedEventsVideo(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->eventvideo_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }
    
    public function viewEventVideoJson()
    {
        $id = $this->input->get('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_eventvideo`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_events`.`title`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'event';
        $elements[1]->alias = 'event';
        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_videogallery`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Video Gallery';
        $elements[2]->alias = 'videogallery';
        $elements[3] = new stdClass();
        $elements[3]->field = '`statuses`.`name`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Status';
        $elements[3]->alias = 'status';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_eventvideo`.`order`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Order';
        $elements[4]->alias = 'order';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_eventvideo`.`event`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'eventid';
        $elements[5]->alias = 'eventid';
        $elements[6] = new stdClass();
        $elements[6]->field = '`webapp_eventvideo`.`url`';
        $elements[6]->sort = '1';
        $elements[6]->header = 'Url';
        $elements[6]->alias = 'url';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_eventvideo` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_eventvideo`.`status` LEFT OUTER JOIN `webapp_videogallery` ON `webapp_videogallery`.`id`=`webapp_eventvideo`.`videogallery` LEFT OUTER JOIN `webapp_events` ON `webapp_events`.`id`=`webapp_eventvideo`.`event`', "WHERE `webapp_eventvideo`.`event`='$id'");
        $this->load->view('json', $data);
    }

    public function createEventVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createeventvideo';
        $data['activemenu'] = 'events';
        $data['page2'] = 'block/eventblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['event'] = $this->user_model->getEventsDropDown();
        $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
        $data['title'] = 'Create Event Video';
        $this->load->view('templatewith2', $data);
    }

    public function createEventVideoSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('event', 'event', 'trim');
        $this->form_validation->set_rules('videogallery', 'Video Gallery', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createeventvideo';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
            $data['event'] = $this->user_model->getEventsDropDown();
            $data['title'] = 'Create Event Video';
            $this->load->view('template', $data);
        } else {
            $event = $this->input->get_post('event');
            $videogallery = $this->input->get_post('videogallery');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');
            $url = $this->input->get_post('url');
            if ($this->eventvideo_model->create($event, $videogallery, $status, $order, $url) == 0) {
                $data['alerterror'] = 'New Event Video could not be created.';
            } else {
                $data['alertsuccess'] = 'Event Video created Successfully.';
            }
            $data['redirect'] = 'site/viewEventVideo?id='.$event;
            $this->load->view('redirect2', $data);
        }
    }

    public function editEventVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editeventvideo';
        $data['activemenu'] = 'events';
        $data['page2'] = 'block/eventblock';
        $data['before1'] = $this->input->get('eventid');
        $data['before2'] = $this->input->get('eventid');
        $data['before3'] = $this->input->get('eventid');
        $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
        $data['event'] = $this->user_model->getEventsDropDown();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Edit Event Video';
        $data['before'] = $this->eventvideo_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editEventVideoSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('event', 'event', 'trim');
        $this->form_validation->set_rules('videogallery', 'Video Gallery', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editeventvideo';
            $data['videogallery'] = $this->user_model->getVideoGalleryDropDown();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['event'] = $this->user_model->getEventsDropDown();
            $data['title'] = 'Edit Event Video';
            $data['before'] = $this->eventvideo_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $event = $this->input->get_post('event');
            $videogallery = $this->input->get_post('videogallery');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');
            $url = $this->input->get_post('url');
            if ($this->eventvideo_model->edit($id, $event, $videogallery, $status, $order, $url) == 0) {
                $data['alerterror'] = 'New Event Video Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Event Video Updated Successfully.';
            }
            $data['redirect'] = 'site/viewEventVideo?id='.$event;
            $this->load->view('redirect2', $data);
        }
    }

    public function deleteEventVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->eventvideo_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewEventVideo?id='.$this->input->get('eventid');
        $this->load->view('redirect2', $data);
    }

    public function viewEventImages()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'vieweventimages';
        $data['activemenu'] = 'events';
        $data['page2'] = 'block/eventblock';
        $data["tablename"] = 'webapp_eventimages';
        $data["orderfield"] = 'order';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['base_url'] = site_url('site/viewEventImagesJson?id=').$this->input->get('id');
        $data['deleteselected'] = site_url('site/deleteSelectedEventsImages');
        $data['title'] = 'View Event Images';
        $this->load->view('templatewith2', $data);
    }
    public function deleteSelectedEventsImages(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->eventimages_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }
    public function viewEventImagesJson()
    {
        $id = $this->input->get('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_eventimages`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_events`.`title`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'event';
        $elements[1]->alias = 'event';
        $elements[2] = new stdClass();
        $elements[2]->field = '`statuses`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Status';
        $elements[2]->alias = 'status';
        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_eventimages`.`order`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Order';
        $elements[3]->alias = 'order';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_eventimages`.`image`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Image';
        $elements[4]->alias = 'image';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_eventimages`.`event`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'eventid';
        $elements[5]->alias = 'eventid';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_eventimages` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_eventimages`.`status` LEFT OUTER JOIN `webapp_events` ON `webapp_events`.`id`=`webapp_eventimages`.`event`', "WHERE `webapp_eventimages`.`event`='$id'");
        $this->load->view('json', $data);
    }

    public function createEventImages()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createeventimages';
        $data['activemenu'] = 'events';
        $data['page2'] = 'block/eventblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['event'] = $this->user_model->getEventsDropDown();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Create Event Image';
        $this->load->view('templatewith2', $data);
    }

    public function createEventImagesSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('event', 'event', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('image', 'Image', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['page'] = 'createeventimages';
            $data['event'] = $this->user_model->getEventsDropDown();
            $data['title'] = 'Create Event Image';
            $this->load->view('template', $data);
        } else {
            $event = $this->input->get_post('event');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');

            // $image=$this->input->get_post("image");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;
                     if ($this->eventimages_model->create($event, $status, $order, $image) == 0) {
                    $data['alerterror'] = 'New Event Images could not be created.';
                    } else {
                        $data['alertsuccess'] = 'Event Image created Successfully.';
                    }
                    $data['redirect'] = 'site/viewEventImages?id='.$event;
                    $this->load->view('redirect2', $data);
                    // return false;
                }
            }
            else{
                $data['alerterror'] = 'Images Field is Mandatory!';
                $data['redirect'] = 'site/createEventImagesSubmit?id='.$event;
                $this->load->view('redirect2', $data);
            }

           
        }
    }

    public function editEventImages()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editeventimages';
        $data['activemenu'] = 'events';
        $data['page2'] = 'block/eventblock';
        $data['before1'] = $this->input->get('eventid');
        $data['before2'] = $this->input->get('eventid');
        $data['before3'] = $this->input->get('eventid');
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['event'] = $this->user_model->getEventsDropDown();
        $data['title'] = 'Edit Event Image';
        $data['before'] = $this->eventimages_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editEventImagesSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('event', 'event', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('image', 'Image', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editeventimages';
            $data['event'] = $this->user_model->getEventsDropDown();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Edit Event Image';
            $data['before'] = $this->eventimages_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $event = $this->input->get_post('event');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');

            // $image=$this->input->get_post("image");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($image == '') {
                $image = $this->user_model->getEventImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->eventimages_model->edit($id, $event, $status, $order, $image) == 0) {
                $data['alerterror'] = 'New Event Image Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'Event Images Updated Successfully.';
            }
            $data['redirect'] = 'site/viewEventImages?id='.$event;
            $this->load->view('redirect2', $data);
        }
    }

    public function deleteEventImages()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->eventimages_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewEventImages?id='.$this->input->get('eventid');
        $this->load->view('redirect2', $data);
    }

    public function viewEnquiry()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewenquiry';
        $data['base_url'] = site_url('site/viewEnquiryJson');
        $data['title'] = 'View Enquiry';
        $data['activemenu'] = 'enquiries';
        $this->load->view('template', $data);
    }

    public function viewEnquiryJson()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_enquiry`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`user`.`name`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'User';
        $elements[1]->alias = 'user';
        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_enquiry`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Name';
        $elements[2]->alias = 'name';
        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_enquiry`.`email`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Email';
        $elements[3]->alias = 'email';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_enquiry`.`title`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Title';
        $elements[4]->alias = 'title';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_enquiry`.`timestamp`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'Timestamp';
        $elements[5]->alias = 'timestamp';
        $elements[6] = new stdClass();
        $elements[6]->field = '`webapp_enquiry`.`content`';
        $elements[6]->sort = '1';
        $elements[6]->header = 'Content';
        $elements[6]->alias = 'content';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'DESC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_enquiry` LEFT OUTER JOIN `user` ON `user`.`id`=`webapp_enquiry`.`user`');
        $this->load->view('json', $data);
    }

    public function createEnquiry()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createenquiry';
        $data['activemenu'] = 'enquiries';
        $data['user'] = $this->user_model->getUserDropDown();
        $data['title'] = 'Create Enquiry';
        $this->load->view('template', $data);
    }

    public function createEnquirySubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('user', 'User', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('timestamp', 'Timestamp', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['user'] = $this->user_model->getUserDropDown();
            $data['page'] = 'createenquiry';
            $data['title'] = 'Create Enquiry';
            $this->load->view('template', $data);
        } else {
            $user = $this->input->get_post('user');
            $name = $this->input->get_post('name');
            $email = $this->input->get_post('email');
            $title = $this->input->get_post('title');
            $timestamp = $this->input->get_post('timestamp');
            $content = $this->input->get_post('content');
            if ($this->enquiry_model->create($user, $name, $email, $title, $timestamp, $content) == 0) {
                $data['alerterror'] = 'New enquiry could not be created.';
            } else {
                $data['alertsuccess'] = 'enquiry created Successfully.';
            }
            $data['redirect'] = 'site/viewEnquiry';
            $this->load->view('redirect', $data);
        }
    }

    public function editEnquiry()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editenquiry';
        $data['activemenu'] = 'enquiries';
        $data['user'] = $this->user_model->getUserDropDown();
        $data['title'] = 'Edit Enquiry';
        $data['before'] = $this->enquiry_model->beforeEdit($this->input->get('id'));
        $this->load->view('template', $data);
    }

    public function editEnquirySubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('user', 'User', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('timestamp', 'Timestamp', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editenquiry';
            $data['user'] = $this->user_model->getUserDropDown();
            $data['title'] = 'Edit Enquiry';
            $data['before'] = $this->enquiry_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $user = $this->input->get_post('user');
            $name = $this->input->get_post('name');
            $email = $this->input->get_post('email');
            $title = $this->input->get_post('title');
            $timestamp = $this->input->get_post('timestamp');
            $content = $this->input->get_post('content');
            if ($this->enquiry_model->edit($id, $user, $name, $email, $title, $timestamp, $content) == 0) {
                $data['alerterror'] = 'New enquiry Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'enquiry Updated Successfully.';
            }
            $data['redirect'] = 'site/viewEnquiry';
            $this->load->view('redirect', $data);
        }
    }

    public function deleteEnquiry()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->enquiry_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewEnquiry';
        $this->load->view('redirect', $data);
    }

    public function viewNotification()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewnotification';
        $data['deleteselected'] = site_url('site/deleteSelectedNotification');
        $data['base_url'] = site_url('site/viewNotificationJson');
        $data['title'] = 'View Notifications';
        $data['activemenu'] = 'notifications';
        $this->load->view('template', $data);
    }
      public function deleteSelectedNotification(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->notification_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }

    public function viewNotificationJson()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_notification`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`statuses`.`name`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Status';
        $elements[1]->alias = 'status';
        $elements[2] = new stdClass();
        $elements[2]->field = '`webapp_notification`.`image`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Image';
        $elements[2]->alias = 'image';
        $elements[3] = new stdClass();
        $elements[3]->field = "DATE_FORMAT(`webapp_notification`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
        $elements[3]->sort = '1';
        $elements[3]->header = 'Timestamp';
        $elements[3]->alias = 'timestamp';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'DESC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_notification` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_notification`.`status`');
        $this->load->view('json', $data);
    }

    public function createNotification()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createnotification';
        $data['activemenu'] = 'notifications';
        $this->notification_model->changeStatusOfExternalLink();
        $data['linktype'] = $this->user_model->getLinkTypeDropDown();
        $data['showdropdown'] = 18;
        $data['event'] = $this->user_model->getEventsDropDown();
        $data['blog'] = $this->user_model->getBlogDropDown();
        $data['video'] = $this->user_model->getVideoGalleryDropDown();
        $data['article'] = $this->user_model->getArticleDropDown();
        $data['gallery'] = $this->user_model->getGalleryDropDown();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Create Notification';
        $this->load->view('template', $data);
    }

    public function createNotificationSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $linktype = $this->input->get_post('linktype');
        $event = $this->input->get_post('event');
        $video = $this->input->get_post('video');
        $gallery = $this->input->get_post('gallery');
        $article = $this->input->get_post('article');
        $status = $this->input->get_post('status');
        $blog = $this->input->get_post('blog');
        $link = $this->input->get_post('link');
        $content = $this->input->get_post('content');

        // $image=$this->input->get_post("image");

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        $filename = 'image';
        $image = '';
        if ($this->upload->do_upload($filename)) {
            $uploaddata = $this->upload->data();
            $image = $uploaddata['file_name'];
            $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
            $config_r['maintain_ratio'] = true;
            $config_t['create_thumb'] = false; ///add this
            $config_r['width'] = 800;
            $config_r['height'] = 800;
            $config_r['quality'] = 100;

            // end of configs

            $this->load->library('image_lib', $config_r);
            $this->image_lib->initialize($config_r);
            if (!$this->image_lib->resize()) {
                $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                // return false;
            } else {

                // print_r($this->image_lib->dest_image);
                // dest_image

                $image = $this->image_lib->dest_image;

                // return false;
            }
        }

        if ($this->notification_model->create($linktype, $event, $video, $gallery, $article, $status, $blog, $link, $content, $image) == 0) {
            $data['alerterror'] = 'New notification could not be created.';
        } else {
            $data['alertsuccess'] = 'notification created Successfully.';
        }
        $data['redirect'] = 'site/viewNotification';
        $this->load->view('redirect', $data);
    }

    public function editNotification()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editnotification';

        // $data["page2"]="block/notificationblock";

        $this->notification_model->changeStatusOfExternalLink();
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['linktype'] = $this->user_model->getLinkTypeDropDown();
        $data['event'] = $this->user_model->getEventsDropDown();
        $data['blog'] = $this->user_model->getBlogDropDown();
        $data['video'] = $this->user_model->getVideoGalleryDropDown();
        $data['article'] = $this->user_model->getArticleDropDown();
        $data['gallery'] = $this->user_model->getGalleryDropDown();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Edit Notification';
        $data['activemenu'] = 'notifications';
        $data['before'] = $this->notification_model->beforeEdit($this->input->get('id'));
        $this->load->view('template', $data);
    }

    public function editNotificationSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('videogallery', 'Video Gallery', 'trim');
        $this->form_validation->set_rules('event', 'event', 'trim');
        $this->form_validation->set_rules('videogalleryvideo', 'Video Gallery Video', 'trim');
        $this->form_validation->set_rules('galleryimage', 'Gallery Image', 'trim');
        $this->form_validation->set_rules('article', 'article', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('link', 'Link', 'trim');
        $this->form_validation->set_rules('image', 'Image', 'trim');
        $this->form_validation->set_rules('timestamp', 'Timestamp', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editnotification';
            $data['linktype'] = $this->user_model->getLinkTypeDropDown();
            $data['event'] = $this->user_model->getEventsDropDown();
            $data['blog'] = $this->user_model->getBlogDropDown();
            $data['video'] = $this->user_model->getVideoGalleryDropDown();
            $data['article'] = $this->user_model->getArticleDropDown();
            $data['gallery'] = $this->user_model->getGalleryDropDown();
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Edit Notification';
            $data['before'] = $this->notification_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $linktype = $this->input->get_post('linktype');
            $event = $this->input->get_post('event');
            $video = $this->input->get_post('video');
            $gallery = $this->input->get_post('gallery');
            $article = $this->input->get_post('article');
            $status = $this->input->get_post('status');
            $blog = $this->input->get_post('blog');
            $link = $this->input->get_post('link');
            $content = $this->input->get_post('content');
            $timestamp = $this->input->get_post('timestamp');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($image == '') {
                $image = $this->user_model->getNotificationImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->notification_model->edit($id, $linktype, $event, $video, $gallery, $article, $status, $blog, $link, $content, $image, $timestamp) == 0) {
                $data['alerterror'] = 'New notification Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'notification Updated Successfully.';
            }
            $data['redirect'] = 'site/viewNotification';
            $this->load->view('redirect', $data);
        }
    }

    public function deleteNotification()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->notification_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewNotification';
        $this->load->view('redirect', $data);
    }

    public function viewNotificationUser()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewnotificationuser';
        $data['page2'] = 'block/notificationblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['notification'] = $this->user_model->getNotificationDropDown();
        $data['base_url'] = site_url('site/viewNotificationUserJson?id=').$this->input->get('id');
        $data['title'] = 'View Notification Users';
        $this->load->view('templatewith2', $data);
    }

    public function viewNotificationUserJson()
    {
        $id = $this->input->get('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_notificationuser`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_notification`.`content`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Notification';
        $elements[1]->alias = 'notification';
        $elements[2] = new stdClass();
        $elements[2]->field = '`user`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'User';
        $elements[2]->alias = 'user';
        $elements[3] = new stdClass();
        $elements[3]->field = "DATE_FORMAT(`webapp_notificationuser`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
        $elements[3]->sort = '1';
        $elements[3]->header = 'Timestamp';
        $elements[3]->alias = 'timestamp';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_notificationuser`.`timestamp_receive`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Timestamp Received';
        $elements[4]->alias = 'timestamp_receive';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_notificationuser`.`notification`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'notificationid';
        $elements[5]->alias = 'notificationid';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_notificationuser` LEFT OUTER JOIN `webapp_notification` ON `webapp_notification`.`id`=`webapp_notificationuser`.`notification` LEFT OUTER JOIN `user` ON `user`.`id`=`webapp_notificationuser`.`user`', "WHERE `webapp_notificationuser`.`notification`='$id'");
        $this->load->view('json', $data);
    }

    public function createNotificationUser()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createnotificationuser';
        $data['page2'] = 'block/notificationblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['notification'] = $this->user_model->getNotificationDropDown();
        $data['title'] = 'Create Notification User';
        $data['notification'] = $this->user_model->getNotificationDropDown();
        $data['user'] = $this->user_model->getUserDropDown();
        $this->load->view('templatewith2', $data);
    }

    public function createNotificationUserSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('notification', 'Notification', 'trim');
        $this->form_validation->set_rules('user', 'User', 'trim');
        $this->form_validation->set_rules('timestamp', 'Timestamp', 'trim');
        $this->form_validation->set_rules('timestamp_receive', 'Timestamp Received', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['notification'] = $this->user_model->getNotificationDropDown();
            $data['page'] = 'createnotificationuser';
            $data['notification'] = $this->user_model->getNotificationDropDown();
            $data['user'] = $this->user_model->getUserDropDown();
            $data['title'] = 'Create Notification User';
            $this->load->view('template', $data);
        } else {
            $notification = $this->input->get_post('notification');
            $user = $this->input->get_post('user');
            $timestamp = $this->input->get_post('timestamp');
            $timestamp_receive = $this->input->get_post('timestamp_receive');
            if ($this->notificationuser_model->create($notification, $user, $timestamp, $timestamp_receive) == 0) {
                $data['alerterror'] = 'New Notificationuser could not be created.';
            } else {
                $data['alertsuccess'] = 'Notificationuser created Successfully.';
            }
            $data['redirect'] = 'site/viewNotificationUser?id='.$notification;
            $this->load->view('redirect2', $data);
        }
    }

    public function editNotificationUser()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editnotificationuser';
        $data['page2'] = 'block/notificationblock';
        $data['before1'] = $this->input->get('notificationid');
        $data['before2'] = $this->input->get('notificationid');
        $data['notification'] = $this->user_model->getNotificationDropDown();
        $data['notification'] = $this->user_model->getNotificationDropDown();
        $data['user'] = $this->user_model->getUserDropDown();
        $data['title'] = 'Edit Notification User';
        $data['before'] = $this->notificationuser_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editNotificationUserSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('notification', 'Notification', 'trim');
        $this->form_validation->set_rules('user', 'User', 'trim');
        $this->form_validation->set_rules('timestamp', 'Timestamp', 'trim');
        $this->form_validation->set_rules('timestamp_receive', 'Timestamp Received', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['notification'] = $this->user_model->getNotificationDropDown();
            $data['notification'] = $this->user_model->getNotificationDropDown();
            $data['user'] = $this->user_model->getUserDropDown();
            $data['page'] = 'editnotificationuser';
            $data['title'] = 'Edit Notification User';
            $data['before'] = $this->notificationuser_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $notification = $this->input->get_post('notification');
            $user = $this->input->get_post('user');
            $timestamp = $this->input->get_post('timestamp');
            $timestamp_receive = $this->input->get_post('timestamp_receive');
            if ($this->notificationuser_model->edit($id, $notification, $user, $timestamp, $timestamp_receive) == 0) {
                $data['alerterror'] = 'New notificationuser Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'notificationuser Updated Successfully.';
            }
            $data['redirect'] = 'site/viewNotificationUser?id='.$notification;
            $this->load->view('redirect2', $data);
        }
    }

    public function deleteNotificationUser()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->notificationuser_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewNotificationUser?id='.$this->input->get('notificationid');
        $this->load->view('redirect2', $data);
    }

    public function viewBlog()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewblog';
        $data['activemenu'] = 'blog';
        $data['base_url'] = site_url('site/viewBlogJson');
         $data['deleteselected'] = site_url('site/deleteSelectedBlog');
        $data['title'] = 'View Blog';
        $this->load->view('template', $data);
    }
    
    public function deleteSelectedBlog(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->blog_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }
    public function viewBlogJson()
    {
        //$this->chintantable->createelement( '`webapp_blog`.`id`', '1', 'ID','id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_blog`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_blog`.`content`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'content';
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
        $elements[4] = new stdClass();
        $elements[4]->field = "DATE_FORMAT(`webapp_blog`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
        $elements[4]->sort = '1';
        $elements[4]->header = 'Timestamp';
        $elements[4]->alias = 'timestamp';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'DESC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_blog`');
        $this->load->view('json', $data);
    }

    public function createBlog()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createblog';
        $data['activemenu'] = 'blogs';
        $data['title'] = 'Create Blog';
        $this->load->view('template', $data);
    }

    public function createBlogSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createblog';
            $data['title'] = 'Create Blog';
            $this->load->view('template', $data);
        } else {
            $title = $this->input->get_post('title');
            $json = $this->input->get_post('json');
            $content = $this->input->get_post('content');
            $url = $this->input->get_post('url');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($this->blog_model->create($title, $json, $content, $url, $image) == 0) {
                $data['alerterror'] = 'New blog could not be created.';
            } else {
                $data['alertsuccess'] = 'blog created Successfully.';
            }
            $data['redirect'] = 'site/viewBlog';
            $this->load->view('redirect', $data);
        }
    }

    public function editBlog()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editblog';
        $data['activemenu'] = 'blogs';

        // $data["page2"]="block/blogblock";

        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['title'] = 'Edit Blog';
        $data['before'] = $this->blog_model->beforeEdit($this->input->get('id'));
        $this->load->view('template', $data);
    }

    public function editBlogSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('json', 'Json', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editblog';
            $data['title'] = 'Edit Blog';
            $data['before'] = $this->blog_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $title = $this->input->get_post('title');
            $json = $this->input->get_post('json');
            $content = $this->input->get_post('content');
            $timestamp = $this->input->get_post('timestamp');
            $url = $this->input->get_post('url');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($image == '') {
                $image = $this->blog_model->getImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->blog_model->edit($id, $title, $json, $content, $timestamp, $url, $image) == 0) {
                $data['alerterror'] = 'New blog Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'blog Updated Successfully.';
            }
            $data['redirect'] = 'site/viewBlog';
            $this->load->view('redirect', $data);
        }
    }

    public function deleteBlog()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->blog_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewBlog';
        $this->load->view('redirect', $data);
    }

    public function viewBlogVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewblogvideo';
        $data['page2'] = 'block/blogblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['base_url'] = site_url('site/viewBlogVideoJson?id=').$this->input->get('id');
        $data['title'] = 'View Blog Videos';
        $this->load->view('templatewith2', $data);
    }

    public function viewBlogVideoJson()
    {
        $id = $this->input->get('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_blogvideo`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_blog`.`title`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Blog';
        $elements[1]->alias = 'blog';
        $elements[2] = new stdClass();
        $elements[2]->field = '`statuses`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Status';
        $elements[2]->alias = 'status';
        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_blogvideo`.`order`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Order';
        $elements[3]->alias = 'order';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_blogvideo`.`video`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Video';
        $elements[4]->alias = 'video';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_blogvideo`.`blog`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'blogid';
        $elements[5]->alias = 'blogid';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_blogvideo` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_blogvideo`.`status` LEFT OUTER JOIN `webapp_blog` ON `webapp_blog`.`id`=`webapp_blogvideo`.`blog`', "WHERE `webapp_blogvideo`.`blog`='$id'");
        $this->load->view('json', $data);
    }

    public function createBlogVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createblogvideo';
        $data['page2'] = 'block/blogblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['blog'] = $this->user_model->getBlogDropDown();
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Create Blog Video';
        $this->load->view('templatewith2', $data);
    }

    public function createBlogVideoSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('blog', 'Blog', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('video', 'Video', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['blog'] = $this->user_model->getBlogDropDown();
            $data['page'] = 'createblogvideo';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Create Blog Video';
            $this->load->view('template', $data);
        } else {
            $blog = $this->input->get_post('blog');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');
            $video = $this->input->get_post('video');
            if ($this->blogvideo_model->create($blog, $status, $order, $video) == 0) {
                $data['alerterror'] = 'New blogvideo could not be created.';
            } else {
                $data['alertsuccess'] = 'blogvideo created Successfully.';
            }
            $data['redirect'] = 'site/viewBlogVideo?id='.$blog;
            $this->load->view('redirect', $data);
        }
    }

    public function editBlogVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editblogvideo';
        $data['page2'] = 'block/blogblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['blog'] = $this->user_model->getBlogDropDown();
        $data['title'] = 'Edit Blog Video';
        $data['before'] = $this->blogvideo_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editBlogVideoSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('blog', 'Blog', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('video', 'Video', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editblogvideo';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['blog'] = $this->user_model->getBlogDropDown();
            $data['title'] = 'Edit Blog Video';
            $data['before'] = $this->blogvideo_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $blog = $this->input->get_post('blog');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');
            $video = $this->input->get_post('video');
            if ($this->blogvideo_model->edit($id, $blog, $status, $order, $video) == 0) {
                $data['alerterror'] = 'New blogvideo Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'blogvideo Updated Successfully.';
            }
            $data['redirect'] = 'site/viewBlogVideo?id='.$blog;
            $this->load->view('redirect2', $data);
        }
    }

    public function deleteBlogVideo()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->blogvideo_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewBlogVideo?id='.$this->input->get('blogid');
        $this->load->view('redirect2', $data);
    }

    public function viewBlogImages()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewblogimages';
        $data['page2'] = 'block/blogblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['base_url'] = site_url('site/viewBlogImagesJson?id=').$this->input->get('id');
        $data['title'] = 'View Blog Images';
        $this->load->view('templatewith2', $data);
    }

    public function viewBlogImagesJson()
    {
        $id = $this->input->get('id');
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`webapp_blogimages`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`webapp_blog`.`title`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Blog';
        $elements[1]->alias = 'blog';
        $elements[2] = new stdClass();
        $elements[2]->field = '`statuses`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Status';
        $elements[2]->alias = 'status';
        $elements[3] = new stdClass();
        $elements[3]->field = '`webapp_blogimages`.`order`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Order';
        $elements[3]->alias = 'order';
        $elements[4] = new stdClass();
        $elements[4]->field = '`webapp_blogimages`.`image`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Image';
        $elements[4]->alias = 'image';
        $elements[5] = new stdClass();
        $elements[5]->field = '`webapp_blogimages`.`blog`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'blogid';
        $elements[5]->alias = 'blogid';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `webapp_blogimages` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`webapp_blogimages`.`status` LEFT OUTER JOIN `webapp_blog` ON `webapp_blog`.`id`=`webapp_blogimages`.`blog`', "WHERE `webapp_blogimages`.`blog`='$id'");
        $this->load->view('json', $data);
    }

    public function createBlogImages()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createblogimages';
        $data['page2'] = 'block/blogblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['blog'] = $this->user_model->getBlogDropDown();
        $data['title'] = 'Create Blog Image';
        $this->load->view('templatewith2', $data);
    }

    public function createBlogImagesSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('blog', 'ID', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('image', 'Image', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createblogimages';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['blog'] = $this->user_model->getBlogDropDown();
            $data['title'] = 'Create Blog Image';
            $this->load->view('template', $data);
        } else {
            $blog = $this->input->get_post('blog');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');

            // $image=$this->input->get_post("image");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($this->blogimages_model->create($blog, $status, $order, $image) == 0) {
                $data['alerterror'] = 'New blogimages could not be created.';
            } else {
                $data['alertsuccess'] = 'blogimages created Successfully.';
            }
            $data['redirect'] = 'site/viewBlogImages?id='.$blog;
            $this->load->view('redirect2', $data);
        }
    }

    public function editBlogImages()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editblogimages';
        $data['page2'] = 'block/blogblock';
        $data['before1'] = $this->input->get('id');
        $data['before2'] = $this->input->get('id');
        $data['before3'] = $this->input->get('id');
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['blog'] = $this->user_model->getBlogDropDown();
        $data['title'] = 'Edit Blog Image';
        $data['before'] = $this->blogimages_model->beforeEdit($this->input->get('id'));
        $this->load->view('templatewith2', $data);
    }

    public function editBlogImagesSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('blog', 'ID', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('image', 'Image', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editblogimages';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['blog'] = $this->user_model->getBlogDropDown();
            $data['title'] = 'Edit Blog Image';
            $data['before'] = $this->blogimages_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $blog = $this->input->get_post('blog');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');

            // $image=$this->input->get_post("image");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $image = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($image == '') {
                $image = $this->user_model->getBlogImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->blogimages_model->edit($id, $blog, $status, $order, $image) == 0) {
                $data['alerterror'] = 'New blogimages Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'blogimages Updated Successfully.';
            }
            $data['redirect'] = 'site/viewBlogImages?id='.$blog;
            $this->load->view('redirect2', $data);
        }
    }

    public function deleteBlogImages()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->blogimages_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewBlogImages?id='.$this->input->get('blogid');
        $this->load->view('redirect2', $data);
    }

    // slider

    public function viewSlider()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewslider';
        $data['base_url'] = site_url('site/viewSliderJson');
        $data['deleteselected'] = site_url('site/deleteSelectedSliders');
        $data["tablename"] = 'slider';
        $data["orderfield"] = 'order';
        $data['title'] = 'View Sliders';
        $data['activemenu'] = 'home slides';
        $this->load->view('template', $data);
    }
    public function deleteSelectedSliders(){
        $selected = $this->input->get('selected');
        $data['todelete']=$this->slider_model->multipleDelete($selected);
        $data['message'] = 'true';
        $this->load->view('json', $data);
    }

    public function viewSliderJson()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`slider`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[1] = new stdClass();
        $elements[1]->field = '`slider`.`alt`';
        $elements[1]->sort = '1';
        $elements[1]->header = 'Alt';
        $elements[1]->alias = 'alt';
        $elements[2] = new stdClass();
        $elements[2]->field = '`statuses`.`name`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Status';
        $elements[2]->alias = 'status';
        $elements[3] = new stdClass();
        $elements[3]->field = '`slider`.`order`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'Order';
        $elements[3]->alias = 'order';
        $elements[4] = new stdClass();
        $elements[4]->field = '`slider`.`image`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'Image';
        $elements[4]->alias = 'image';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `slider` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`slider`.`status`');
        $this->load->view('json', $data);
    }

    public function createSlider()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createslider';
        $data['activemenu'] = 'home slides';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Create Slider';
        $this->load->view('template', $data);
    }

    public function createSliderSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('blog', 'ID', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
    
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createslider';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Create Slider';
            $this->load->view('template', $data);
        } else {
            $alt = $this->input->get_post('alt');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');

            // $image=$this->input->get_post("image");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                
                
                if ($this->slider_model->create($alt, $status, $order, $image) == 0) {
                    $data['alerterror'] = 'New slider could not be created.';
                } else {
                    $data['alertsuccess'] = 'slider created Successfully.';
                }
                $data['redirect'] = 'site/viewSlider';
                $this->load->view('redirect', $data);
            }
            else
            {
                $data['alerterror'] ='Image Upload is Mandatory!';
                 $data['redirect'] = 'site/createSliderSubmit';
                $this->load->view('redirect', $data);
            }

            
        }
    }

    public function editSlider()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'editslider';
        $data['activemenu'] = 'home slides';
        $data['status'] = $this->user_model->getStatusDropDown();
        $data['title'] = 'Edit Slider';
        $data['before'] = $this->slider_model->beforeEdit($this->input->get('id'));
        $this->load->view('template', $data);
    }

    public function editSliderSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('id', 'ID', 'trim');
        $this->form_validation->set_rules('blog', 'ID', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim');
        $this->form_validation->set_rules('image', 'Image', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'editslider';
            $data['status'] = $this->user_model->getStatusDropDown();
            $data['title'] = 'Edit slider';
            $data['before'] = $this->slider_model->beforeEdit($this->input->get('id'));
            $this->load->view('template', $data);
        } else {
            $id = $this->input->get_post('id');
            $alt = $this->input->get_post('alt');
            $status = $this->input->get_post('status');
            $order = $this->input->get_post('order');

            // $image=$this->input->get_post("image");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            }

            if ($image == '') {
                $image = $this->slider_model->getImageById($id);

                // print_r($image);

                $image = $image->image;
            }

            if ($this->slider_model->edit($id, $alt, $status, $order, $image) == 0) {
                $data['alerterror'] = 'New slider Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'slider Updated Successfully.';
            }
            $data['redirect'] = 'site/viewSlider';
            $this->load->view('redirect', $data);
        }
    }

    public function deleteSlider()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->slider_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewSlider';
        $this->load->view('redirect', $data);
    }

    // CONFIG CRUDE STARTS

    public function viewConfig()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'viewconfig';
        $data['base_url'] = site_url('site/viewConfigJson');
        $data['title'] = 'View Config';
        $data['activemenu'] = 'config';
        $this->load->view('template', $data);
    }

    public function viewConfigJson()
    {
        $elements = array();
        $elements[0] = new stdClass();
        $elements[0]->field = '`config`.`id`';
        $elements[0]->sort = '1';
        $elements[0]->header = 'ID';
        $elements[0]->alias = 'id';
        $elements[2]->field = '`config`.`title`';
        $elements[2]->sort = '1';
        $elements[2]->header = 'Title';
        $elements[2]->alias = 'title';
        $elements[3] = new stdClass();
        $elements[3]->field = '`config`.`text`';
        $elements[3]->sort = '1';
        $elements[3]->header = 'text';
        $elements[3]->alias = 'text';
        $elements[4] = new stdClass();
        $elements[4]->field = '`config`.`type`';
        $elements[4]->sort = '1';
        $elements[4]->header = 'type';
        $elements[4]->alias = 'type';
        $elements[5] = new stdClass();
        $elements[5]->field = '`config`.`content`';
        $elements[5]->sort = '1';
        $elements[5]->header = 'Description';
        $elements[5]->alias = 'content';
        $search = $this->input->get_post('search');
        $pageno = $this->input->get_post('pageno');
        $orderby = $this->input->get_post('orderby');
        $orderorder = $this->input->get_post('orderorder');
        $maxrow = $this->input->get_post('maxrow');
        if ($maxrow == '') {
            $maxrow = 20;
        }

        if ($orderby == '') {
            $orderby = 'id';
            $orderorder = 'ASC';
        }

        $data['message'] = $this->chintantable->query($pageno, $maxrow, $orderby, $orderorder, $search, $elements, 'FROM `config`');
        $this->load->view('json', $data);
    }

    public function createConfig()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'createconfig';
        $data['type'] = $this->user_model->getTypeDropDown();
        $data['title'] = 'Create Config';
        $this->load->view('template', $data);
    }

    public function createConfigSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('title', 'Title', 'trim');
        $this->form_validation->set_rules('timestamp', 'Timestamp', 'trim');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['page'] = 'createconfig';
            $data['type'] = $this->user_model->getTypeDropDown();
            $data['title'] = 'Create Config';
            $this->load->view('template', $data);
        } else {
            $text = $this->input->get_post('text');
            $title = $this->input->get_post('title');
            $type = $this->input->get_post('type');
            $content = $this->input->get_post('content');
            if ($this->config_model->create($title, $content, $text, $type) == 0) {
                $data['alerterror'] = 'New config could not be created.';
            } else {
                $data['alertsuccess'] = 'config created Successfully.';
            }
            $data['redirect'] = 'site/viewConfig';
            $this->load->view('redirect', $data);
        }
    }

    public function editConfig()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $id = $this->input->get('id');
        $type = $id;

        //    $type=$this->config_model->getEditPage($id);

        switch ($type) {
        case 1:
            {
                $data['page'] = 'editconfigtext';
                $data['title'] = 'Edit Config';
            }

            break;

        case 2:
            {
                $data['page'] = 'editconfigimage';
                $data['title'] = 'Edit Config Image';
            }

            break;

        case 3:
            {
                $data['page'] = 'dropdown';
                $data['title'] = 'Drop Down';
            }

            break;

        case 4:
            {
                $data['page'] = 'login';
                $data['title'] = 'Login';
            }

            break;

        case 5:
            {
                $data['page'] = 'blog';
                $data['title'] = 'Blog';
            }

            break;

        case 6:
            {
                $data['page'] = 'gallery';
                $data['title'] = 'Gallery';
            }

            break;

        case 7:
            {
                $data['page'] = 'videogallery';
                $data['title'] = 'Video Gallery';
            }

            break;

        case 8:
            {
                $data['page'] = 'configevents';
                $data['title'] = 'Config Events';
            }

            break;

        case 9:
            {
                $data['page'] = 'logo';
                $data['title'] = 'Logo';
            }

            break;

        case 10:
            {
                $data['page'] = 'backgroundimage';
                $data['title'] = 'Background Image';
            }

            break;

        case 11:
            {
                $data['page'] = 'banner';
                $data['title'] = 'Banner';
            }

            break;

        case 12:
            {
                $data['page'] = 'socialfeeds';
                $data['title'] = 'Social Feeds';
            }

            break;

        case 13:
            {
                $data['page'] = 'editconfig';
                $data['title'] = 'Notification';
            }

            break;

        case 14:
            {
                $data['page'] = 'editconfigtext';
                $data['title'] = 'Color';
            }

            break;

        case 15:
            {
                $data['page'] = 'editconfigtext';
                $data['title'] = 'Meta Keyword';
            }

            break;

        case 16:
            {
                $data['page'] = 'editconfigtext';
                $data['title'] = 'Meta Decription';
            }

            break;
        }

        $data['type'] = $this->user_model->getTypeDropDown();
        $data['activemenu'] = 'config';
        $data['before'] = $this->config_model->beforeEdit($this->input->get('id'));
        $this->load->view('templateconfig', $data);
    }

    public function editConfigSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $id = $this->input->get_post('id');
        $text = $this->input->get_post('text');
        $title = $this->input->get_post('title');
        $type = $this->input->get_post('type');
        $content = $this->input->get_post('content');
        $description = $this->input->get_post('description');
        $newtext = json_decode($text);
        // update hauth
        
        $urlforcontrollertest = $_SERVER['SCRIPT_FILENAME'];
        $urlforcontrollertest = substr($urlforcontrollertest, 0, -9);
        $urlcontrollertest = $urlforcontrollertest.'application/config/hybridauthlib.php';
        for ($i = 0; $i < sizeOf($newtext); ++$i) {
            $comp = $newtext[$i]->name;
            switch ($comp) {
            case 'Google':
                {
                    $controllerfile = read_file($urlcontrollertest);
                    $mnutext = explode('//google', $controllerfile);
                    $googletext = "'Google' => array (
				'enabled' => true,
				'keys'    => array ( 'id' => '".$newtext[$i]->appid."', 'secret' => '".$newtext[$i]->secret."' )
			),";
                    $googletext = $mnutext[0]."//google\n".$googletext.'//google'.$mnutext[2];
                    if (write_file($urlforcontrollertest.'application/config/hybridauthlib.php', $googletext)) {
                    }
                }

                break;

            case 'Facebook':
                {
                    $controllerfile = read_file($urlcontrollertest);
                    $mnutext = explode('//facebook', $controllerfile);
                    $googletext = "'Facebook' => array (
				'enabled' => true,
				'keys'    => array ( 'id' => '".$newtext[$i]->appid."', 'secret' => '".$newtext[$i]->secret."' ),
                'scope'   => 'email, user_about_me, user_birthday, user_hometown, user_website,publish_actions'
			),";
                    $googletext = $mnutext[0]."//facebook\n".$googletext."\n//facebook".$mnutext[2];
                    if (write_file($urlforcontrollertest.'application/config/hybridauthlib.php', $googletext)) {
                    }
                }

                break;

            case 'twitter':
                {
                    $controllerfile = read_file($urlcontrollertest);
                    $mnutext = explode('//twitter', $controllerfile);
                    $googletext = "'Twitter' => array (
				'enabled' => true,
				'keys'    => array ( 'key' => '".$newtext[$i]->appid."', 'secret' =>'".$newtext[$i]->secret."' )
			),";
                    $googletext = $mnutext[0]."//twitter\n".$googletext."\n//twitter".$mnutext[2];
                    if (write_file($urlforcontrollertest.'application/config/hybridauthlib.php', $googletext)) {
                    }
                }

                break;

            case 'instagram':
                {
                    $controllerfile = read_file($urlcontrollertest);
                    $mnutext = explode('//instagram', $controllerfile);
                    $googletext = "'Instagram' => array (
				'enabled' => true,
				'keys'    => array ( 'id' => '".$newtext[$i]->appid."', 'secret' => '".$newtext[$i]->secret."' )
			),";
                    $googletext = $mnutext[0]."//instagram\n".$googletext."\n//instagram".$mnutext[2];
                    if (write_file($urlforcontrollertest.'application/config/hybridauthlib.php', $googletext)) {
                    }
                }

                break;

            default:
                {
                }
            }
        }
        if($id=="13")
        {
            $preimage = $this->config_model->getpemById();
            $config['upload_path'] = './config/';
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $filename = 'image';
            $image = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
            } else {
                $image = $preimage;
                if ($this->config_model->edit($id, $title, $content, $text, $image, $type, $description) == 0) {
                    $data['alerterror'] = 'New config Could Not Be Updated.';
                } else {
                    $data['alertsuccess'] = 'config Updated Successfully.';
                }
                $data['redirect'] = 'site/viewConfig';
                $this->load->view('redirect', $data);
            }
        }
       
            if ($this->config_model->edit($id, $title, $content, $text, $image, $type, $description) == 0) {
                $data['alerterror'] = 'New config Could Not Be Updated.';
            } else {
                $data['alertsuccess'] = 'config Updated Successfully.';
            }
            $data['redirect'] = 'site/viewConfig';
            $this->load->view('redirect', $data);
        
    }

    public function deleteConfig()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $this->config_model->delete($this->input->get('id'));
        $data['redirect'] = 'site/viewConfig';
        $this->load->view('redirect', $data);
    }

    // CONFIG CRUDE END
    // HOME

    public function editHome()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $data['page'] = 'edithome';
        $data['title'] = 'Edit Home';
        $data['before'] = $this->slider_model->beforeEditHome('1');
        $this->load->view('template', $data);
    }

    public function editHomeSubmit()
    {
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $id = $this->input->get_post('id');
        $content = $this->input->get_post('content');
        if ($this->slider_model->editHome($id, $content) == 0) {
            $data['alerterror'] = 'New home Could Not Be Updated.';
        } else {
            $data['alertsuccess'] = 'home Updated Successfully.';
        }
        $data['redirect'] = 'site/editHome';
        $this->load->view('redirect2', $data);
    }

    // CLEAR IMAGE

    public function clearGalleryImage()
    {
        $id = $this->input->get_post('id');
        $this->gallery_model->clearGalleryImage($id);
    }

    public function clearGalleryImage1()
    {
        $id = $this->input->get_post('id');
        $this->galleryimage_model->clearGalleryImage1($id);
    }

    public function clearUserImage()
    {
        $id = $this->input->get_post('id');
        $this->user_model->clearUserImage($id);
    }

    public function clearCoverImage()
    {
        $id = $this->input->get_post('id');
        $this->user_model->clearCoverImage($id);
    }

    public function clearEventImage()
    {
        $id = $this->input->get_post('id');
        $this->events_model->clearEventImage($id);
    }

    public function clearArticleImage()
    {
        $id = $this->input->get_post('id');
        $this->articles_model->clearArticleImage($id);
    }

    public function clearEventImage1()
    {
        $id = $this->input->get_post('id');
        $this->eventimages_model->clearEventImage1($id);
    }

    public function clearSliderImage()
    {
        $id = $this->input->get_post('id');
        $this->slider_model->clearSliderImage($id);
    }

    public function clearNotificationImage()
    {
        $id = $this->input->get_post('id');
        $this->notification_model->clearNotificationImage($id);
    }

    public function clearBlogImage()
    {
        $id = $this->input->get_post('id');
        $this->blog_model->clearBlogImage($id);
    }
}
