<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Menu extends CI_Controller
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
    public function checkAccess($access)
    {
        $accesslevel = $this->session->userdata('accesslevel');
        if (!in_array($accesslevel, $access)) {
            redirect(base_url().'index.php/site?alerterror=You do not have access to this page. ', 'refresh');
        }
    }
    public function index()
    {
        //$access = array("1","2");
        $access = array('1','2');
        $this->checkAccess($access);
        $data[ 'page' ] = 'dashboard';
        $data[ 'title' ] = 'Welcome';
        $this->load->view('template', $data);
    }

    //Menu
    public function createMenu()
    {
        $access = array('1');
        $this->checkAccess($access);
        $data['accesslevel'] = $this->user_model->getaccesslevels();
        $data['parentmenu'] = $this->menu_model->getMenu();
        $data[ 'page' ] = 'createMenu';
        $data[ 'title' ] = 'Create menu';
        $this->load->view('template', $data);
    }
    public function createMenuSubmit()
    {
        $access = array('1');
        $this->checkAccess($access);
        $this->form_validation->set_rules('name', 'name', 'trim');
        $this->form_validation->set_rules('description', 'description', 'trim');
        $this->form_validation->set_rules('keyword', 'keyword', 'trim|');
        $this->form_validation->set_rules('url', 'URL', 'trim');
        $this->form_validation->set_rules('linktype', 'Link Type', 'trim');
        $this->form_validation->set_rules('parentmenu', 'parent', 'trim');
        $this->form_validation->set_rules('order', 'order', 'trim');
        $this->form_validation->set_rules('isactive', 'Active', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['accesslevel'] = $this->user_model->getaccesslevels();
            $data['parentmenu'] = $this->menu_model->getMenu();
            $data['page'] = 'createMenu';
            $data['title'] = 'Create New menu';
            $this->load->view('template', $data);
        } else {
            $description = $this->input->post('description');
            $name = $this->input->post('name');
            $keyword = $this->input->post('keyword');
            $url = $this->input->post('url');
            $linktype = $this->input->post('linktype');
            $parentmenu = $this->input->post('parentmenu');
            $order = $this->input->post('order');
            $isactive = $this->input->post('isactive');
            $menuaccess = $this->input->post('menuaccess');
            $icon = $this->input->post('icon');
            if ($this->menu_model->create($name, $description, $keyword, $url, $linktype, $parentmenu, $menuaccess, $isactive, $order, $icon) == 0) {
                $data['alerterror'] = 'New menu could not be created.';
            } else {
                $data['alertsuccess'] = 'menu created Successfully.';
            }

            $data['table'] = $this->menu_model->viewMenu();
            $data['redirect'] = 'menu/viewMenu';
            //$data['other']="template=$template";
            $this->load->view('redirect', $data);
            /*$data['page']='viewMenu';
            $data['title']='View menus';
            $this->load->view('template',$data);*/
        }
    }
    public function viewMenu()
    {
        $access = array('1');
        $this->checkAccess($access);
        $data['table'] = $this->menu_model->viewMenu();
        $data['page'] = 'viewMenu';
        $data['title'] = 'View menus';
        $this->load->view('template', $data);
    }
    public function editMenu()
    {
        $access = array('1');
        $this->checkAccess($access);
        $data['accesslevel'] = $this->user_model->getaccesslevels();
        $data['parentmenu'] = $this->menu_model->getMenu();
        $data['before'] = $this->menu_model->beforeedit($this->input->get('id'));
        $data['page'] = 'editMenu';
        $data['title'] = 'Edit menu';
        $this->load->view('template', $data);
    }
    public function editMenuSubmit()
    {
        $access = array('1');
        $this->checkAccess($access);
        $this->form_validation->set_rules('name', 'name', 'trim');
        $this->form_validation->set_rules('description', 'description', 'trim');
        $this->form_validation->set_rules('keyword', 'keyword', 'trim|');
        $this->form_validation->set_rules('url', 'URL', 'trim');
        $this->form_validation->set_rules('linktype', 'Link Type', 'trim');
        $this->form_validation->set_rules('parent', 'parent', 'trim');
        $this->form_validation->set_rules('order', 'order', 'trim');
        $this->form_validation->set_rules('isactive', 'Active', 'trim');
        if ($this->form_validation->run() == false) {
            $data['alerterror'] = validation_errors();
            $data['accesslevel'] = $this->user_model->getaccesslevels();
            $data['parentmenu'] = $this->menu_model->getMenu();
            $data['before'] = $this->menu_model->beforeedit($this->input->post('id'));
            $data['page'] = 'editMenu';
            $data['title'] = 'Edit menu';
            $this->load->view('template', $data);
        } else {
            $id = $this->input->post('id');
            $description = $this->input->post('description');
            $name = $this->input->post('name');
            $keyword = $this->input->post('keyword');
            $url = $this->input->post('url');
            $linktype = $this->input->post('linktype');
            $parentmenu = $this->input->post('parentmenu');
            $order = $this->input->post('order');
            $isactive = $this->input->post('isactive');
            $menuaccess = $this->input->post('menuaccess');
            $icon = $this->input->post('icon');
            if ($this->menu_model->edit($id, $name, $description, $keyword, $url, $linktype, $parentmenu, $menuaccess, $isactive, $order, $icon) == 0) {
                $data['alerterror'] = 'menu Editing was unsuccesful';
            } else {
                $data['alertsuccess'] = 'menu edited Successfully.';
            }
            $data['table'] = $this->menu_model->viewMenu();
            $data['redirect'] = 'menu/viewMenu';
            //$data['other']="template=$template";
            $this->load->view('redirect', $data);
        }
    }
    public function deleteMenu()
    {
        $access = array('1');
        $this->checkAccess($access);
        $this->menu_model->deleteMenu($this->input->get('id'));
        $data['table'] = $this->menu_model->viewMenu();
        $data['alertsuccess'] = 'menu Deleted Successfully';
        $data['page'] = 'viewMenu';
        $data['title'] = 'View menus';
        $this->load->view('template', $data);
    }
}
