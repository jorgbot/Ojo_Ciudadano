<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class videogallery_model extends CI_Model
{
    public function create($order, $status, $name, $json, $subtitle)
    {
        $query = $this->db->query('INSERT INTO `webapp_videogallery`(`status`, `name`, `json`, `order`, `subtitle`) VALUES ('.$this->db->escape($status).','.$this->db->escape($name).','.$this->db->escape($json).','.$this->db->escape($order).','.$this->db->escape($subtitle).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_videogallery` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleVideoGallery($id)
    {
        $query = $this->db->query('SELECT `id`, `order`, `status`, `name`, `json` FROM `webapp_videogallery` WHERE `status`=1 AND `id`=('.$this->db->escape($id).')')->row();
        $query->videos = $this->db->query('SELECT `id`, `order`, `status`, `name`, `json` FROM `webapp_videogallery` WHERE `status`=1 AND `id`=('.$this->db->escape($id).')')->result();

        return $query;
    }
    public function edit($id, $order, $status, $name, $json, $timestamp, $subtitle)
    {
        $query = $this->db->query('UPDATE `webapp_videogallery`
 SET `status` = '.$this->db->escape($status).', `name` = '.$this->db->escape($name).', `json` = '.$this->db->escape($json).',`order` = '.$this->db->escape($order).',`timestamp` = '.$this->db->escape($timestamp).',`subtitle` = '.$this->db->escape($subtitle).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_videogallery` WHERE `id`=('.$this->db->escape($id).')');
        $query = $this->db->query('DELETE FROM `webapp_videogalleryvideo` WHERE `videogallery`=('.$this->db->escape($id).')');

        return $query;
    }
     public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_videogallery` WHERE `id` IN ($selected)");
        $query = $this->db->query("DELETE FROM `webapp_videogalleryvideo` WHERE `videogallery` IN ($selected)");
        return $query;
    }
}
