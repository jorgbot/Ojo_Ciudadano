<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class events_model extends CI_Model
{
    public function create($status, $title, $timestamp, $content, $venue, $image, $startdate, $starttime)
    {
        $startdate = new DateTime($startdate);
        $startdate = $startdate->format('Y-m-d');
        $query = $this->db->query('INSERT INTO `webapp_events`(`status`, `title`, `venue`, `content`, `image`,`startdate`,`starttime`) VALUES ('.$this->db->escape($status).','.$this->db->escape($title).','.$this->db->escape($venue).','.$this->db->escape($content).','.$this->db->escape($image).','.$this->db->escape($startdate).','.$this->db->escape($starttime).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }
    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `webapp_events` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSingleEvents($id)
    {
        $query = $this->db->query('SELECT `id`, `status`, `title`, date(`timestamp`) as `timestamp`, `content`,`image`,`venue` FROM `webapp_events` WHERE `status`=1 AND `id`=('.$this->db->escape($id).')')->row();
        $query->eventimages = $this->db->query('SELECT `id`, `event`, `status`, `order`, `image` FROM `webapp_eventimages` WHERE `event`=('.$this->db->escape($id).')
AND `status`=1 ORDER BY `order` ASC')->result();
        $query->eventvideos = $this->db->query('SELECT `id`, `event`, `videogallery`, `status`, `order`,`url` FROM `webapp_eventvideo` WHERE `status`=1 AND `event`=('.$this->db->escape($id).') ORDER BY `order` ASC')->result();

        return $query;
    }
    public function edit($id, $status, $title, $timestamp, $content, $venue, $image, $startdate, $starttime)
    {
        $startdate = new DateTime($startdate);
        $startdate = $startdate->format('Y-m-d');
        $query = $this->db->query('UPDATE `webapp_events`
 SET `status` = '.$this->db->escape($status).', `title` = '.$this->db->escape($title).', `venue` = '.$this->db->escape($venue).',`content` = '.$this->db->escape($content).',`timestamp` = '.$this->db->escape($timestamp).',`image` = '.$this->db->escape($image).',`startdate` = '.$this->db->escape($startdate).',`starttime` = '.$this->db->escape($starttime).'
 WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }
    public function delete($id)
    {
        $query = $this->db->query('DELETE FROM `webapp_events` WHERE `id`=('.$this->db->escape($id).')');
        $query = $this->db->query('DELETE FROM `webapp_eventvideo` WHERE `event`=('.$this->db->escape($id).')');
        $query = $this->db->query('DELETE FROM `webapp_eventimages` WHERE `event`=('.$this->db->escape($id).')');

        return $query;
    }
    public function getImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_events` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function clearEventImage($id)
    {
        $query = $this->db->query("UPDATE `webapp_events` SET `image` = '' WHERE id = (".$this->db->escape($id).')');

        return $query;
    }
     public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `webapp_eventvideo` WHERE `event` IN ($selected)");
        $query = $this->db->query("DELETE FROM `webapp_eventimages` WHERE `event` IN ($selected)");
        $query = $this->db->query("DELETE FROM `webapp_events` WHERE `id` IN ($selected)");
        return $query;
    }
}
