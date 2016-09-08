<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class eventimages_model extends CI_Model
{
    public function create($event, $status, $order, $image)
    {
        $query = $this->db->query('INSERT INTO `webapp_eventimages`( `event`, `status`, `order`, `image`) VALUES ('.$this->db->escape($event).','.$this->db->escape($status).','.$this->db->escape($order).','.$this->db->escape($image).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_eventimages` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleEventImages($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_eventimages` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $event, $status, $order, $image)
    {
        $query = $this->db->query('UPDATE `webapp_eventimages`
 SET `event` = '.$this->db->escape($event).', `status` = '.$this->db->escape($status).',`order` = '.$this->db->escape($order).',`image` = '.$this->db->escape($image).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_eventimages` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
    public function clearEventImage1($id)
    {
        $query = $this->db->query("UPDATE `webapp_eventimages`
             SET `image` = ''
             WHERE id = (".$this->db->escape($id).')');

        return $query;
    }
      public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_eventimages` WHERE `id` IN ($selected)");
        return $query;
    }
}
