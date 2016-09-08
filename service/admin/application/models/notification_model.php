<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class notification_model extends CI_Model
{  
    public function create($linktype, $event, $video, $gallery, $article, $status, $blog, $link, $content, $image)
    {
        $query = $this->db->query('INSERT INTO `webapp_notification`(`status`, `event`, `video`, `link`, `image`,`linktype`,`blog`,`article`,`gallery`,`content`) VALUES ('.$this->db->escape($status).','.$this->db->escape($event).','.$this->db->escape($video).','.$this->db->escape($link).','.$this->db->escape($image).','.$this->db->escape($linktype).','.$this->db->escape($blog).','.$this->db->escape($article).','.$this->db->escape($gallery).','.$this->db->escape($content).')');
        $id = $this->db->insert_id();

        $this->RestApi_model->sendNotificationAndroid($content, '', $image, $icon);
        $this->RestApi_model->sendNotificationIos($content);

        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_notification` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleNotification($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_notification` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function edit($id, $linktype, $event, $video, $gallery, $article, $status, $blog, $link, $content, $image, $timestamp)
    {
        $query = $this->db->query('UPDATE `webapp_notification`
 SET `status` = '.$this->db->escape($status).', `event` = '.$this->db->escape($event).', `video` = '.$this->db->escape($video).',`image` = '.$this->db->escape($image).',`linktype` = '.$this->db->escape($linktype).',`link` = '.$this->db->escape($link).',`blog` = '.$this->db->escape($blog).',`article` = '.$this->db->escape($article).',`gallery` = '.$this->db->escape($gallery).',`content` = '.$this->db->escape($content).',`timestamp` = '.$this->db->escape($timestamp).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_notification` WHERE `id`=('.$this->db->escape($id).')');
        $query = $this->db->query('DELETE FROM `webapp_notificationuser` WHERE `notification`=('.$this->db->escape($id).')');

        return $query;
    }
    public function changeStatusOfExternalLink()
    {
        $data = array('status' => 1);
        $this->db->where('id', 17);
        $query = $this->db->update('linktype', $data);

        $data = array('status' => 1);
        $this->db->where('id', 18);
        $query = $this->db->update('linktype', $data);
    }
    public function clearNotificationImage($id)
    {
        $query = $this->db->query("UPDATE `webapp_notification` SET `image` = '' WHERE id = (".$this->db->escape($id).')');

        return $query;
    }
      public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_notification` WHERE `id` IN ($selected)");
        return $query;
    }
}
