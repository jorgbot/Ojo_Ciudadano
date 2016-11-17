<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class blog_model extends CI_Model
{
    public function create($name, $blog_id, $isactive, $image_id)
    {
        $query = $this->db->query('INSERT INTO `webapp_municipios`( `name`, `blog_id`, `isactive`, `image_id`) VALUES ('.$this->db->escape($name).','.$this->db->escape($blog_id).','.$this->db->escape($isactive).','.$this->db->escape($image_id).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_municipios` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleMunicipio($id)
    {
        $query = $this->db->query('SELECT `id`, `name`, `blog_id`, `isactive`,`image_id` FROM `webapp_municipios` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $name, $blog_id, $isactive, $image_id)
    {
        $query = $this->db->query('UPDATE `webapp_municipios`
        SET `name` = '.$this->db->escape($name).', `blog_id` = '.$this->db->escape($blog_id).',`isactive` = '.$this->db->escape($isactive).',`image_id` = '.$this->db->escape($image_id).' WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_municipios` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
    public function getImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_blog` WHERE `id`=('.$this->db->escape($blog_id).')')->row();

        return $query;
    }
    
    public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_municipios` WHERE `id` IN ($selected)");
        return $query;
    }
}
