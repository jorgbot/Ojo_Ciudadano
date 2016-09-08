<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class blogvideo_model extends CI_Model
{
    public function create($blog, $status, $order, $video)
    {
        $query = $this->db->query('INSERT INTO `webapp_blog`( `blog`, `status`, `order`, `video`) VALUES ('.$this->db->escape($blog).','.$this->db->escape($status).','.$this->db->escape($order).','.$this->db->escape($video).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_blogvideo` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleBlogVideo($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_blogvideo` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $blog, $status, $order, $video)
    {
        $query = $this->db->query('UPDATE `webapp_blogvideo`
 SET `blog` = '.$this->db->escape($blog).', `status` = '.$this->db->escape($status).',`order` = '.$this->db->escape($order).',`video` = '.$this->db->escape($video).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_blogvideo` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
}
