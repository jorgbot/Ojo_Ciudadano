<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class blogimages_model extends CI_Model
{
    public function create($blog, $status, $order, $image)
    {
        $query = $this->db->query('INSERT INTO `webapp_blog`( `blog`, `status`, `order`, `image`) VALUES ('.$this->db->escape($blog).','.$this->db->escape($status).','.$this->db->escape($order).','.$this->db->escape($image).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_blogimages` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleBlogImages($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_blogimages` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $blog, $status, $order, $image)
    {
        $query = $this->db->query('UPDATE `webapp_blogimages`
 SET `blog` = '.$this->db->escape($blog).', `status` = '.$this->db->escape($status).',`order` = '.$this->db->escape($order).',`image` = '.$this->db->escape($image).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_blogimages` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
}
