<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class gallery_model extends CI_Model
{
    public function create($order, $status, $name, $json, $image)
    {
        $query = $this->db->query('INSERT INTO `webapp_gallery`( `order`, `status`, `name`,`json`, `image`) VALUES ('.$this->db->escape($order).','.$this->db->escape($status).','.$this->db->escape($name).','.$this->db->escape($json).','.$this->db->escape($image).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_gallery` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleGallery($id)
    {
        $query = $this->db->query('SELECT `id`, `order`, `status`, `name`, `json` FROM `webapp_gallery` WHERE `status`=1 AND `id`=('.$this->db->escape($id).')')->row();
        $query->images = $this->db->query('SELECT `id`, `gallery`, `order`, `status`, `image`, `alt` FROM `webapp_galleryimage` WHERE `gallery`=('.$this->db->escape($id).') AND `status`=1')->result();
//    array_push($row->images);
return $query;
    }
    public function edit($id, $order, $status, $name, $json, $timestamp, $image)
    {
        $query = $this->db->query('UPDATE `webapp_gallery`
 SET `order` = '.$this->db->escape($order).', `status` = '.$this->db->escape($status).',`name` = '.$this->db->escape($name).',`json` = '.$this->db->escape($json).',`timestamp` = '.$this->db->escape($timestamp).',`image` = '.$this->db->escape($image).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_gallery` WHERE `id`=('.$this->db->escape($id).')');
        $query = $this->db->query('DELETE FROM `webapp_galleryimage` WHERE `gallery`=('.$this->db->escape($id).')');

        return $query;
    }
    public function getImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_gallery` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function clearGalleryImage($id)
    {
        $query = $this->db->query("UPDATE `webapp_gallery` SET `image` = '' WHERE id = (".$this->db->escape($id).')');

        return $query;
    }
      public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_gallery` WHERE `id` IN ($selected)");
        $query = $this->db->query("DELETE FROM `webapp_galleryimage` WHERE `gallery` IN ($selected)");
        return $query;
    }
}
