<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class eventvideo_model extends CI_Model
{
    public function create($event, $videogallery, $status, $order, $url)
    {
        $query = $this->db->query('INSERT INTO `webapp_eventvideo`(`status`, `event`, `videogallery`, `order`, `url`) VALUES ('.$this->db->escape($status).','.$this->db->escape($event).','.$this->db->escape($videogallery).','.$this->db->escape($order).','.$this->db->escape($url).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_eventvideo` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleEventVideo($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_eventvideo` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $event, $videogallery, $status, $order, $url)
    {
        $query = $this->db->query('UPDATE `webapp_eventvideo`
 SET `status` = '.$this->db->escape($status).', `event` = '.$this->db->escape($event).', `videogallery` = '.$this->db->escape($videogallery).',`order` = '.$this->db->escape($order).',`url` = '.$this->db->escape($url).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_eventvideo` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
      public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_eventvideo` WHERE `id` IN ($selected)");
        return $query;
    }
}
