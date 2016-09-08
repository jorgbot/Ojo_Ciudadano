<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class galleryimage_model extends CI_Model
{
    public function create($gallery, $order, $status, $image, $alt)
    {
        $query = $this->db->query('INSERT INTO `webapp_galleryimage`( `order`, `status`, `gallery`,`alt`, `image`) VALUES ('.$this->db->escape($order).','.$this->db->escape($status).','.$this->db->escape($gallery).','.$this->db->escape($alt).','.$this->db->escape($image).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_galleryimage` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleGalleryImage($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_galleryimage` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $gallery, $order, $status, $image, $alt)
    {
        //$data=array("gallery" => $gallery,"order" => $order,"status" => $status,"image" => $image,"alt" => $alt);
//$this->db->where( "id", $id );
//$query=$this->db->update( "webapp_galleryimage", $data );
//return 1;
$query = $this->db->query('UPDATE `webapp_galleryimage`
 SET `order` = '.$this->db->escape($order).', `status` = '.$this->db->escape($status).',`gallery` = '.$this->db->escape($gallery).',`image` = '.$this->db->escape($image).',`alt` = '.$this->db->escape($alt).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_galleryimage` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }

    public function clearGalleryImage1($id)
    {
        $query = $this->db->query("UPDATE `webapp_galleryimage` SET `image` = '' WHERE id = (".$this->db->escape($id).')');

        return $query;
    }
     public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_galleryimage` WHERE `id` IN ($selected)");
        return $query;
    }
}
