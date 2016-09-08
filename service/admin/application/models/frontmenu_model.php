<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class frontmenu_model extends CI_Model
{
    public function create($order, $parent, $status, $name, $json, $image, $linktype, $icon, $event, $blog, $video, $article, $gallery, $typeid)
    {
        $query = $this->db->query('INSERT INTO `webapp_frontmenu`(`status`, `event`, `video`, `order`, `parent`,`name`,`json`,`image`,`linktype`,`icon`,`blog`,`article`,`gallery`,`typeid`) VALUES ('.$this->db->escape($status).','.$this->db->escape($event).','.$this->db->escape($video).','.$this->db->escape($order).','.$this->db->escape($parent).','.$this->db->escape($name).','.$this->db->escape($json).','.$this->db->escape($image).','.$this->db->escape($linktype).','.$this->db->escape($icon).','.$this->db->escape($blog).','.$this->db->escape($article).','.$this->db->escape($gallery).','.$this->db->escape($typeid).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_frontmenu` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleFrontMenu($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_frontmenu` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $order, $parent, $status, $name, $json, $image, $linktype, $icon, $event, $blog, $video, $article, $gallery, $typeid)
    {
        $query = $this->db->query('UPDATE `webapp_frontmenu`
 SET `status` = '.$this->db->escape($status).', `event` = '.$this->db->escape($event).', `video` = '.$this->db->escape($video).',`order` = '.$this->db->escape($order).',`parent` = '.$this->db->escape($parent).',`name` = '.$this->db->escape($name).',`json` = '.$this->db->escape($json).',`image` = '.$this->db->escape($image).',`linktype` = '.$this->db->escape($linktype).',`icon` = '.$this->db->escape($icon).',`blog` = '.$this->db->escape($blog).',`article` = '.$this->db->escape($article).',`gallery` = '.$this->db->escape($gallery).',`typeid` = '.$this->db->escape($typeid).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_frontmenu` WHERE `id`=('.$this->db->escape($id).')');

        return $query;
    }
    public function changeStatusOfExternalLink()
    {
        $data = array('status' => 0);
        $this->db->where('id', 17);
        $query = $this->db->update('linktype', $data);

        $data = array('status' => 0);
        $this->db->where('id', 18);
        $query = $this->db->update('linktype', $data);
    }
      public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_frontmenu` WHERE `id` IN ($selected)");
        return $query;
    }
}
