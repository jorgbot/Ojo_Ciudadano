<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class videogalleryvideo_model extends CI_Model
{
    public function create($order, $status, $videogallery, $url, $alt)
    {
        $query = $this->db->query('INSERT INTO `webapp_videogalleryvideo`(`status`, `url`, `videogallery`, `order`, `alt`) VALUES ('.$this->db->escape($status).','.$this->db->escape($url).','.$this->db->escape($videogallery).','.$this->db->escape($order).','.$this->db->escape($alt).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_videogalleryvideo` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleVideoGalleryVideo($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_videogalleryvideo` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $order, $status, $videogallery, $url, $alt)
    {
        $query = $this->db->query('UPDATE `webapp_videogalleryvideo`
 SET `status` = '.$this->db->escape($status).', `videogallery` = '.$this->db->escape($videogallery).', `url` = '.$this->db->escape($url).',`order` = '.$this->db->escape($order).',`alt` = '.$this->db->escape($alt).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_videogalleryvideo` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
     public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_videogalleryvideo` WHERE `id` IN ($selected)");
        return $query;
    }
}
