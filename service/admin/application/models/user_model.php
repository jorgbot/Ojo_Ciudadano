<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class user_model extends CI_Model
{
    protected $id, $username, $password;
    public function validate($username, $password)
    {

        // OLD
        $password = md5($password);
        $query = "SELECT `user`.`id`,`user`.`name` as `name`,`email`,`user`.`accesslevel`,`accesslevel`.`name` as `access` FROM `user`
		INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id`
		WHERE `email` LIKE '$username' AND `password` LIKE '$password' AND `status`=1 AND `accesslevel` IN (1,2) ";
        $row = $this->db->query($query);
        if ($row->num_rows() > 0) {
            $row = $row->row();
            $this->id = $row->id;
            $this->name = $row->name;
            $this->email = $row->email;
            $newdata = array(
                'id' => $this->id,
                'email' => $this->email,
                'name' => $this->name,
                'accesslevel' => $row->accesslevel,
                'logged_in' => 'true',
            );
            $this->session->set_userdata($newdata);

            return true;
        } else {
            return false;
        }

        //NEW
        //        $search = '20% raise';
//$sql = "SELECT id FROM table WHERE column LIKE '%".$this->db->escape_like_str($search)."%'";

         $password = md5($password);
        $query = "SELECT `user`.`id`,`user`.`name` as `name`,`email`,`user`.`accesslevel`,`accesslevel`.`name` as `access` FROM `user`
		INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id`
		WHERE `email` LIKE '%".$this->db->escape_like_str($username)."%' AND `password` LIKE '%".$this->db->escape_like_str($password)."%' AND `status`=1 AND `accesslevel` IN (1,2) ";
        $row = $this->db->query($query);
        if ($row->num_rows() > 0) {
            $row = $row->row();
            $this->id = $row->id;
            $this->name = $row->name;
            $this->email = $row->email;
            $newdata = array(
                'id' => $this->id,
                'email' => $this->email,
                'name' => $this->name,
                'accesslevel' => $row->accesslevel,
                'logged_in' => 'true',
            );
            $this->session->set_userdata($newdata);

            return true;
        } else {
            return false;
        }
    }

    public function create($name, $email, $password, $accesslevel, $status, $socialid, $logintype, $image, $json, $contact, $address, $eventnotification, $photonotification, $videonotification, $blognotification, $coverimage)
    {
        if ($eventnotification == '') {
            $eventnotification = 'false';
        } else {
            $eventnotification = 'true';
        }

        if ($photonotification == '') {
            $photonotification = 'false';
        } else {
            $photonotification = 'true';
        }

        if ($videonotification == '') {
            $videonotification = 'false';
        } else {
            $videonotification = 'true';
        }

        if ($blognotification == '') {
            $blognotification = 'false';
        } else {
            $blognotification = 'true';
        }
        $password = md5($password);
        $query = $this->db->query('INSERT INTO `user`(`name`, `email`, `password`, `accesslevel`, `status`,`socialid`,`json`,`image`,`logintype`,`contact`,`address`,`eventnotification`,`photonotification`,`videonotification`,`blognotification`,`coverimage`) VALUES ('.$this->db->escape($name).','.$this->db->escape($email).','.$this->db->escape($password).','.$this->db->escape($accesslevel).','.$this->db->escape($status).','.$this->db->escape($socialid).','.$this->db->escape($json).','.$this->db->escape($image).','.$this->db->escape($logintype).','.$this->db->escape($contact).','.$this->db->escape($address).','.$this->db->escape($eventnotification).','.$this->db->escape($photonotification).','.$this->db->escape($videonotification).','.$this->db->escape($blognotification).','.$this->db->escape($coverimage).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  $id;
        }
    }

    public function beforeEdit($id)
    {
        $query = $this->db->query('SELECT * FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }

    public function edit($id, $name, $email, $password, $accesslevel, $status, $socialid, $logintype, $image, $json, $contact, $address, $eventnotification, $photonotification, $videonotification, $blognotification, $coverimage)
    {
        if ($eventnotification == '') {
            $eventnotification = 'false';
        } else {
            $eventnotification = 'true';
        }

        if ($photonotification == '') {
            $photonotification = 'false';
        } else {
            $photonotification = 'true';
        }

        if ($videonotification == '') {
            $videonotification = 'false';
        } else {
            $videonotification = 'true';
        }

        if ($blognotification == '') {
            $blognotification = 'false';
        } else {
            $blognotification = 'true';
        }
//        $data = array(
//            'name' => $name,
//            'email' => $email,
//            'accesslevel' => $accesslevel,
//            'status' => $status,
//            'socialid' => $socialid,
//            'image' => $image,
//            'json' => $json,
//            'logintype' => $logintype,
//            'contact' => $contact,
//            'address' => $address,
//            'eventnotification' => $eventnotification,
//            'photonotification' => $photonotification,
//            'videonotification' => $videonotification,
//            'blognotification' => $blognotification,
//            'coverimage' => $coverimage
//
//        );
        if ($password != '') {
            $password = md5($password);
        }
        $query = $this->db->query('UPDATE `user`
     SET `status` = '.$this->db->escape($status).', `name` = '.$this->db->escape($name).', `email` = '.$this->db->escape($email).',`accesslevel` = '.$this->db->escape($accesslevel).',`socialid` = '.$this->db->escape($socialid).',`logintype` = '.$this->db->escape($logintype).',`json` = '.$this->db->escape($json).',`image` = '.$this->db->escape($image).',`contact` = '.$this->db->escape($contact).',`address` = '.$this->db->escape($address).',`eventnotification` = '.$this->db->escape($eventnotification).',`photonotification` = '.$this->db->escape($photonotification).',`videonotification` = '.$this->db->escape($videonotification).',`blognotification` = '.$this->db->escape($blognotification).',`coverimage` = '.$this->db->escape($coverimage).',`password` = '.$this->db->escape($password).'
     WHERE id = ('.$this->db->escape($id).')');

        return 1;
    }

    public function getUserImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getCoverImageById($id)
    {
        $query = $this->db->query('SELECT `coverimage` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getSliderImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `slider` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getGalleryImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_galleryimage` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getBlogImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_blogimages` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getEventImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_eventimages` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function getNotificationImageById($id)
    {
        $query = $this->db->query('SELECT `image` FROM `webapp_notification` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    }
    public function deleteUser($id)
    {
        $query = $this->db->query('DELETE FROM `user` WHERE `id`=('.$this->db->escape($id).')');
    }
    public function changePassword($id, $password)
    {
        $password = md5($password);
        $query = $this->db->query('UPDATE `user`
 SET `password` = '.$this->db->escape($password).'
 WHERE id = ('.$this->db->escape($id).')');
        if (!$query) {
            return 0;
        } else {
            return 1;
        }
    }

    public function getUserDropDown()
    {
        $query = $this->db->query('SELECT * FROM `user`  ORDER BY `id` ASC')->result();
        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }
    public function getArticlesDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_articles`  ORDER BY `id` ASC')->result();
        foreach ($query as $row) {
            $return[$row->id] = $row->title;
        }

        return $return;
    }
    public function getBlogDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_blog`  ORDER BY `id` ASC')->result();

        $return[''] = 'Choose Blog Article';
        foreach ($query as $row) {
            $return[$row->id] = $row->title;
        }

        return $return;
    }
    public function getNotificationDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_notification`  ORDER BY `id` ASC')->result();

        foreach ($query as $row) {
            $return[$row->id] = $row->content;
        }

        return $return;
    }

    public function getAccessLevels()
    {
        $return = array();
        $query = $this->db->query('SELECT * FROM `accesslevel` ORDER BY `id` ASC')->result();
        $accesslevel = $this->session->userdata('accesslevel');
        foreach ($query as $row) {
            if ($accesslevel == 1) {
                $return[$row->id] = $row->name;
            } elseif ($accesslevel == 2) {
                if ($row->id > $accesslevel) {
                    $return[$row->id] = $row->name;
                }
            } elseif ($accesslevel == 3) {
                if ($row->id > $accesslevel) {
                    $return[$row->id] = $row->name;
                }
            } elseif ($accesslevel == 4) {
                if ($row->id == $accesslevel) {
                    $return[$row->id] = $row->name;
                }
            }
        }

        return $return;
    }
    public function getStatusDropDown()
    {
        $query = $this->db->query('SELECT * FROM `statuses`  ORDER BY `id` ASC')->result();
        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }
    //     public function getBlogDropDown()
    //{
    //	$query=$this->db->query("SELECT * FROM `webapp_blog`  ORDER BY `id` ASC")->result();
    //		$return=array(
    //            "" => "Blog"
    //		);
    //		foreach($query as $row)
    //		{
    //			$return[$row->id]=$row->title;
    //		}
    //
    //		return $return;
    //}
    public function getVideoDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_videogallery`  ORDER BY `id` ASC')->result();

        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }
    public function getArticleDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_articles` WHERE `id` <> 1 AND `status` = 1 ORDER BY `id` ASC')->result();
        $return[''] = 'Choose Page';
        foreach ($query as $row) {
            $return[$row->id] = $row->title;
        }

        return $return;
    }
    public function getGalleryDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_gallery`  ORDER BY `id` ASC')->result();
        $return[''] = 'Choose Image Gallery';
        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }
    public function getUserCount()
    {
        $query = $this->db->query('SELECT COUNT(*) as `usercount` FROM `user`')->row();
        $usercount = $query->usercount;

        return $usercount;
    }

    public function getLinkTypeDropDown()
    {
        $query = $this->db->query('SELECT * FROM `linktype` WHERE `status`=1  ORDER BY `id` ASC')->result();

        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }
    //     public function getGalleryDropDown()
    //	{
    //		$query=$this->db->query("SELECT * FROM `webapp_gallery`  ORDER BY `id` ASC")->result();
    //		$return=array(
    //		"" => "Select"
    //		);
    //		foreach($query as $row)
    //		{
    //			$return[$row->id]=$row->name;
    //		}
    //
    //		return $return;
    //	}
    public function getEventsDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_events`  ORDER BY `id` ASC')->result();

        $return[''] = 'Choose Event';
        foreach ($query as $row) {
            $return[$row->id] = $row->title;
        }

        return $return;
    }
    public function getVideoGalleryDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_videogallery`  ORDER BY `id` ASC')->result();

        $return[''] = 'Choose Video Gallery';
        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }
    public function getFrontMenuDropDown()
    {
        $query = $this->db->query('SELECT * FROM `webapp_frontmenu`  ORDER BY `id` ASC')->result();

        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }
    public function getTypeDropDown()
    {
        $return = array(
            '1' => 'Text',
            '2' => 'File',
            '3' => 'Drop down',
        );

        return $return;
    }
    public function getEventNotificationDropDown()
    {
        $return = array(
            '' => 'Eventnotification',
            'false' => 'No',
            'true' => 'Yes',
        );

        return $return;
    }
    public function getPhotoNotificationDropDown()
    {
        $return = array(
            '' => 'Photonotification',
            'false' => 'No',
            'true' => 'Yes',
        );

        return $return;
    }
    public function getLinkDropDown()
    {
        $return = array(
            'ln-home' => 'ln-home',
            'ln-home2' => 'ln-home2',
            'ln-home3' => 'ln-home3',
            'ln-home4' => 'ln-home4',
            'ln-home5' => 'ln-home5',
            'ln-home6' => 'ln-home6',
            'ln-pencil' => 'ln-pencil',
            'ln-pencil2' => 'ln-pencil2',
            'ln-edit' => 'ln-edit',
            'ln-edit2' => 'ln-edit2',
            'ln-feather' => 'ln-feather',
            'ln-feather2' => 'ln-feather2',
            'ln-pen' => 'ln-pen',
            'ln-brush' => 'ln-brush',
            'ln-paintbrush' => 'ln-paintbrush',
            'ln-paint-roller' => 'ln-paint-roller',
            'ln-eye-dropper' => 'ln-eye-dropper',
            'ln-magic' => 'ln-magic',
            'ln-design' => 'ln-design',
            'ln-magnet' => 'ln-magnet',
            'ln-aim' => 'ln-aim',
            'ln-gun' => 'ln-gun',
            'ln-droplet' => 'ln-droplet',
            'ln-droplet2' => 'ln-droplet2',
            'ln-fire' => 'ln-fire',
            'ln-lighter' => 'ln-lighter',
            'ln-knife' => 'ln-knife',
            'ln-toilet-paper' => 'ln-toilet-paper',
            'ln-umbrella' => 'ln-umbrella',
            'ln-sun-small' => 'ln-sun-small',
            'ln-sun' => 'ln-sun',
            'ln-moon' => 'ln-moon',
            'ln-cloud' => 'ln-cloud',
            'ln-cloud-upload' => 'ln-cloud-upload',
            'ln-cloud-download' => 'ln-cloud-download',
            'ln-cloud-rain' => 'ln-cloud-rain',
            'ln-cloud-snow' => 'ln-cloud-snow',
            'ln-cloud-fog' => 'ln-cloud-fog',
            'ln-cloud-lightning' => 'ln-cloud-lightning',
            'ln-cloud-sync' => 'ln-cloud-sync',
            'ln-cloud-lock' => 'ln-cloud-lock',
            'ln-cloud-gear' => 'ln-cloud-gear',
            'ln-cloud-database' => 'ln-cloud-database',
            'ln-database' => 'ln-database',
            'ln-shield' => 'ln-shield',
            'ln-lock' => 'ln-lock',
            'ln-unlock' => 'ln-unlock',
            'ln-key' => 'ln-key',
            'ln-key-hole' => 'ln-key-hole',
            'ln-gear' => 'ln-gear',
            'ln-gear2' => 'ln-gear2',
            'ln-wrench' => 'ln-wrench',
            'ln-tools' => 'ln-tools',
            'ln-hammer' => 'ln-hammer',
            'ln-factory' => 'ln-factory',
            'ln-factory2' => 'ln-factory2',
            'ln-recycle' => 'ln-recycle',
            'ln-trash' => 'ln-trash',
            'ln-trash2' => 'ln-trash2',
            'ln-heart' => 'ln-heart',
            'ln-heart2' => 'ln-heart2',
            'ln-flag' => 'ln-flag',
            'ln-flag2' => 'ln-flag2',
            'ln-flag3' => 'ln-flag3',
            'ln-at-sign' => 'ln-at-sign',
            'ln-envelope' => 'ln-envelope',
            'ln-inbox' => 'ln-inbox',
            'ln-paperclip' => 'ln-paperclip',
            'ln-reply' => 'ln-reply',
            'ln-reply-all' => 'ln-reply-all',
            'ln-paper-plane' => 'ln-paper-plane',
            'ln-eye' => 'ln-eye',
            'ln-eye2' => 'ln-eye2',
            'ln-binoculars' => 'ln-binoculars',
            'ln-binoculars2' => 'ln-binoculars2',
            'ln-floppy-disk' => 'ln-floppy-disk',
            'ln-printer' => 'ln-printer',
            'ln-file' => 'ln-file',
            'ln-folder' => 'ln-folder',
            'ln-copy' => 'ln-copy',
            'ln-scissors' => 'ln-scissors',
            'ln-paste' => 'ln-paste',
            'ln-clipboard' => 'ln-clipboard',
            'ln-clipboard-check' => 'ln-clipboard-check',
            'ln-register' => 'ln-register',
            'ln-enter' => 'ln-enter',
            'ln-exit' => 'ln-exit',
            'ln-papers' => 'ln-papers',
            'ln-news' => 'ln-news',
            'ln-document' => 'ln-document',
            'ln-document2' => 'ln-document2',
            'ln-license' => 'ln-license',
            'ln-graduation-hat' => 'ln-graduation-hat',
            'ln-license2' => 'ln-license2',
            'ln-medal' => 'ln-medal',
            'ln-medal2' => 'ln-medal2',
            'ln-medal3' => 'ln-medal3',
            'ln-medal4' => 'ln-medal4',
            'ln-podium' => 'ln-podium',
            'ln-trophy' => 'ln-trophy',
            'ln-music-note' => 'ln-music-note',
            'ln-music' => 'ln-music',
            'ln-music2' => 'ln-music2',
            'ln-playlist' => 'ln-playlist',
            'ln-shuffle' => 'ln-shuffle',
            'ln-headset' => 'ln-headset',
            'ln-presentation' => 'ln-presentation',
            'ln-play' => 'ln-play',
            'ln-film-play' => 'ln-film-play',
            'ln-camera' => 'ln-camera',
            'ln-photo' => 'ln-photo',
            'ln-picture' => 'ln-picture',
            'ln-book' => 'ln-book',
            'ln-book-closed' => 'ln-book-closed',
            'ln-bookmark' => 'ln-bookmark',
            'ln-bookmark2' => 'ln-bookmark2',
            'ln-books' => 'ln-books',
            'ln-library' => 'ln-library',
            'ln-contacts' => 'ln-contacts',
            'ln-profile' => 'ln-profile',
            'ln-user' => 'ln-user',
            'ln-users' => 'ln-users',
            'ln-users2' => 'ln-users2',
            'ln-woman' => 'ln-woman',
            'ln-man' => 'ln-man',
            'ln-shirt' => 'ln-shirt',
            'ln-cart' => 'ln-cart',
            'ln-cart-empty' => 'ln-cart-empty',
            'ln-cart-full' => 'ln-cart-full',
            'ln-tag' => 'ln-tag',
            'ln-tags' => 'ln-tags',
            'ln-cash' => 'ln-cash',
            'ln-credit-card' => 'ln-credit-card',
            'ln-barcode' => 'ln-barcode',
            'ln-barcode2' => 'ln-barcode2',
            'ln-barcode3' => 'ln-barcode3',
            'ln-phone' => 'ln-phone',
            'ln-phone2' => 'ln-phone2',
            'ln-pin' => 'ln-pin',
            'ln-map-marker' => 'ln-map-marker',
            'ln-compass' => 'ln-compass',
            'ln-map' => 'ln-map',
            'ln-location' => 'ln-location',
            'ln-road-sign' => 'ln-road-sign',
            'ln-calendar' => 'ln-calendar',
            'ln-calendar2' => 'ln-calendar2',
            'ln-calendar3' => 'ln-calendar3',
            'ln-mouse' => 'ln-mouse',
            'ln-keyboard' => 'ln-keyboard',
            'ln-delete' => 'ln-delete',
            'ln-spell-check' => 'ln-spell-check',
            'ln-screen' => 'ln-screen',
            'ln-signal' => 'ln-signal',
            'ln-iphone' => 'ln-iphone',
            'ln-smartphone' => 'ln-smartphone',
            'ln-ipad' => 'ln-ipad',
            'ln-tablet' => 'ln-tablet',
            'ln-laptop' => 'ln-laptop',
            'ln-desktop' => 'ln-desktop',
            'ln-radio' => 'ln-radio',
            'ln-tv' => 'ln-tv',
            'ln-power' => 'ln-power',
            'ln-lightning-bolt' => 'ln-lightning-bolt',
            'ln-lamp' => 'ln-lamp',
            'ln-plug-cord' => 'ln-plug-cord',
            'ln-outlet' => 'ln-outlet',
            'ln-drawer' => 'ln-drawer',
            'ln-drawer2' => 'ln-drawer2',
            'ln-drawer3' => 'ln-drawer3',
            'ln-archive' => 'ln-archive',
            'ln-archive2' => 'ln-archive2',
            'ln-comment' => 'ln-comment',
            'ln-comments' => 'ln-comments',
            'ln-chat' => 'ln-chat',
            'ln-quote-open' => 'ln-quote-open',
            'ln-quote-close' => 'ln-quote-close',
            'ln-pulse' => 'ln-pulse',
            'ln-syringe' => 'ln-syringe',
            'ln-first-aid' => 'ln-first-aid',
            'ln-lifebuoy' => 'ln-lifebuoy',
            'ln-patch' => 'ln-patch',
            'ln-patch2' => 'ln-patch2',
            'ln-lab' => 'ln-lab',
            'ln-skull' => 'ln-skull',
            'ln-construction' => 'ln-construction',
            'ln-construction-cone' => 'ln-construction-cone',
            'ln-pie-chart' => 'ln-pie-chart',
            'ln-pie-chart2' => 'ln-pie-chart2',
            'ln-graph' => 'ln-graph',
            'ln-chart-growth' => 'ln-chart-growth',
            'ln-cake' => 'ln-cake',
            'ln-gift' => 'ln-gift',
            'ln-balloon' => 'ln-balloon',
            'ln-rank' => 'ln-rank',
            'ln-rank2' => 'ln-rank2',
            'ln-rank3' => 'ln-rank3',
            'ln-crown' => 'ln-crown',
            'ln-lotus' => 'ln-lotus',
            'ln-diamond' => 'ln-diamond',
            'ln-diamond2' => 'ln-diamond2',
            'ln-diamond3' => 'ln-diamond3',
            'ln-diamond4' => 'ln-diamond4',
            'ln-linearicons' => 'ln-linearicons',
            'ln-teacup' => 'ln-teacup',
            'ln-glass' => 'ln-glass',
            'ln-bottle' => 'ln-bottle',
            'ln-cocktail-glass' => 'ln-cocktail-glass',
            'ln-dinner' => 'ln-dinner',
            'ln-dinner2' => 'ln-dinner2',
            'ln-hamburger' => 'ln-hamburger',
            'ln-dumbbell' => 'ln-dumbbell',
            'ln-apple' => 'ln-apple',
            'ln-leaf' => 'ln-leaf',
            'ln-pine-tree' => 'ln-pine-tree',
            'ln-tree' => 'ln-tree',
            'ln-paw' => 'ln-paw',
            'ln-paw2' => 'ln-paw2',
            'ln-footprint' => 'ln-footprint',
            'ln-speed-slow' => 'ln-speed-slow',
            'ln-speed-medium' => 'ln-speed-medium',
            'ln-speed-fast' => 'ln-speed-fast',
            'ln-rocket' => 'ln-rocket',
            'ln-gamepad' => 'ln-gamepad',
            'ln-dice' => 'ln-dice',
            'ln-ticket' => 'ln-ticket',
            'ln-hammer2' => 'ln-hammer2',
            'ln-balance' => 'ln-balance',
            'ln-briefcase' => 'ln-briefcase',
            'ln-plane' => 'ln-plane',
            'ln-gas' => 'ln-gas',
            'ln-transmission' => 'ln-transmission',
            'ln-car' => 'ln-car',
            'ln-bus' => 'ln-bus',
            'ln-truck' => 'ln-truck',
            'ln-trailer' => 'ln-trailer',
            'ln-train' => 'ln-train',
            'ln-ship' => 'ln-ship',
            'ln-anchor' => 'ln-anchor',
            'ln-boat' => 'ln-boat',
            'ln-bicycle' => 'ln-bicycle',
            'ln-cube' => 'ln-cube',
            'ln-puzzle' => 'ln-puzzle',
            'ln-glasses' => 'ln-glasses',
            'ln-accessibility' => 'ln-accessibility',
            'ln-wheelchir' => 'ln-wheelchir',
            'ln-icons' => 'ln-icons',
            'ln-icons2' => 'ln-icons2',
            'ln-sitemap' => 'ln-sitemap',
            'ln-earth' => 'ln-earth',
            'ln-happy' => 'ln-happy',
            'ln-smile' => 'ln-smile',
            'ln-grin' => 'ln-grin',
            'ln-tongue' => 'ln-tongue',
            'ln-sad' => 'ln-sad',
            'ln-wink' => 'ln-wink',
            'ln-dream' => 'ln-dream',
            'ln-shocked' => 'ln-shocked',
            'ln-shocked2' => 'ln-shocked2',
            'ln-tongue2' => 'ln-tongue2',
            'ln-neutral' => 'ln-neutral',
            'ln-happy-grin' => 'ln-happy-grin',
            'ln-cool' => 'ln-cool',
            'ln-mad' => 'ln-mad',
            'ln-grin-evil' => 'ln-grin-evil',
            'ln-evil' => 'ln-evil',
            'ln-shocked3' => 'ln-shocked3',
            'ln-annoyed' => 'ln-annoyed',
            'ln-mustache' => 'ln-mustache',
            'ln-wondering' => 'ln-wondering',
            'ln-confused' => 'ln-confused',
            'ln-bell' => 'ln-bell',
            'ln-bullhorn' => 'ln-bullhorn',
            'ln-volume-high' => 'ln-volume-high',
            'ln-volume-medium' => 'ln-volume-medium',
            'ln-volume-low' => 'ln-volume-low',
            'ln-volume' => 'ln-volume',
            'ln-mute' => 'ln-mute',
            'ln-wifi' => 'ln-wifi',
            'ln-wifi2' => 'ln-wifi2',
            'ln-wifi3' => 'ln-wifi3',
            'ln-mic' => 'ln-mic',
            'ln-mic2' => 'ln-mic2',
            'ln-mic-mute' => 'ln-mic-mute',
            'ln-hourglass' => 'ln-hourglass',
            'ln-loading' => 'ln-loading',
            'ln-loading2' => 'ln-loading2',
            'ln-loading3' => 'ln-loading3',
            'ln-undo' => 'ln-undo',
            'ln-redo' => 'ln-redo',
            'ln-sync' => 'ln-sync',
            'ln-sync2' => 'ln-sync2',
            'ln-refresh' => 'ln-refresh',
            'ln-refresh2' => 'ln-refresh2',
            'ln-history' => 'ln-history',
            'ln-history2' => 'ln-history2',
            'ln-clock' => 'ln-clock',
            'ln-clock2' => 'ln-clock2',
            'ln-clock3' => 'ln-clock3',
            'ln-clock4' => 'ln-clock4',
            'ln-clock5' => 'ln-clock5',
            'ln-timer' => 'ln-timer',
            'ln-timer2' => 'ln-timer2',
            'ln-download' => 'ln-download',
            'ln-upload' => 'ln-upload',
            'ln-arrow-up' => 'ln-arrow-up',
            'ln-arrow-down' => 'ln-arrow-down',
            'ln-arrow-left' => 'ln-arrow-left',
            'ln-arrow-right' => 'ln-arrow-right',
            'ln-arrow-up2' => 'ln-arrow-up2',
            'ln-arrow-down2' => 'ln-arrow-down2',
            'ln-arrow-left2' => 'ln-arrow-left2',
            'ln-arrow-right2' => 'ln-arrow-right2',
            'ln-arrow-up3' => 'ln-arrow-up3',
            'ln-arrow-down3' => 'ln-arrow-down3',
            'ln-arrow-left3' => 'ln-arrow-left3',
            'ln-arrow-right3' => 'ln-arrow-right3',
            'ln-arrow-up4' => 'ln-arrow-up4',
            'ln-arrow-down4' => 'ln-arrow-down4',
            'ln-arrow-left4' => 'ln-arrow-left4',
            'ln-arrow-right4' => 'ln-arrow-right4',
            'ln-terminal' => 'ln-terminal',
            'ln-bug' => 'ln-bug',
            'ln-code' => 'ln-code',
            'ln-file-code' => 'ln-file-code',
            'ln-file-image' => 'ln-file-image',
            'ln-file-zip' => 'ln-file-zip',
            'ln-file-audio' => 'ln-file-audio',
            'ln-file-video' => 'ln-file-video',
            'ln-link' => 'ln-link',
            'ln-link2' => 'ln-link2',
            'ln-unlink' => 'ln-unlink',
            'ln-link3' => 'ln-link3',
            'ln-unlink2' => 'ln-unlink2',
            'ln-thumbs-up' => 'ln-thumbs-up',
            'ln-thumbs-down' => 'ln-thumbs-down',
            'ln-thumbs-up2' => 'ln-thumbs-up2',
            'ln-thumbs-down2' => 'ln-thumbs-down2',
            'ln-thumbs-up3' => 'ln-thumbs-up3',
            'ln-thumbs-down3' => 'ln-thumbs-down3',
            'ln-share' => 'ln-share',
            'ln-share2' => 'ln-share2',
            'ln-share3' => 'ln-share3',
            'ln-options' => 'ln-options',
            'ln-list' => 'ln-list',
            'ln-list2' => 'ln-list2',
            'ln-magnifier' => 'ln-magnifier',
            'ln-zoom-in' => 'ln-zoom-in',
            'ln-zoom-out' => 'ln-zoom-out',
            'ln-question' => 'ln-question',
            'ln-checkmark' => 'ln-checkmark',
            'ln-cross' => 'ln-cross',
            'ln-chevron-up' => 'ln-chevron-up',
            'ln-chevron-down' => 'ln-chevron-down',
            'ln-chevron-left' => 'ln-chevron-left',
            'ln-chevron-right' => 'ln-chevron-right',
            'ln-arrow-up5' => 'ln-arrow-up5',
            'ln-arrow-down5' => 'ln-arrow-down5',
            'ln-arrow-left5' => 'ln-arrow-left5',
            'ln-arrow-right5' => 'ln-arrow-right5',
            'ln-expand' => 'ln-expand',
            'ln-shrink' => 'ln-shrink',
            'ln-expand2' => 'ln-expand2',
            'ln-shrink2' => 'ln-shrink2',
            'ln-move' => 'ln-move',
            'ln-tab' => 'ln-tab',
            'ln-warning' => 'ln-warning',
            'ln-circle-exclamation' => 'ln-circle-exclamation',
            'ln-circle-question' => 'ln-circle-question',
            'ln-circle-checkmark' => 'ln-circle-checkmark',
            'ln-circle-cross' => 'ln-circle-cross',
            'ln-circle-plus' => 'ln-circle-plus',
            'ln-circle-minus' => 'ln-circle-minus',
            'ln-circle-up' => 'ln-circle-up',
            'ln-circle-down' => 'ln-circle-down',
            'ln-circle-left' => 'ln-circle-left',
            'ln-circle-right' => 'ln-circle-right',
            'ln-circle-up2' => 'ln-circle-up2',
            'ln-circle-down2' => 'ln-circle-down2',
            'ln-circle-left2' => 'ln-circle-left2',
            'ln-circle-right2' => 'ln-circle-right2',
            'ln-circle-backward' => 'ln-circle-backward',
            'ln-circle-first' => 'ln-circle-first',
            'ln-circle-previous' => 'ln-circle-previous',
            'ln-circle-stop' => 'ln-circle-stop',
            'ln-circle-play' => 'ln-circle-play',
            'ln-circle-pause' => 'ln-circle-pause',
            'ln-circle-next' => 'ln-circle-next',
            'ln-circle-last' => 'ln-circle-last',
            'ln-circle-forward' => 'ln-circle-forward',
            'ln-circle-eject' => 'ln-circle-eject',
            'ln-crop' => 'ln-crop',
            'ln-frame' => 'ln-frame',
            'ln-ruler' => 'ln-ruler',
            'ln-funnel' => 'ln-funnel',
            'ln-flip-horizontal' => 'ln-flip-horizontal',
            'ln-flip-vertical' => 'ln-flip-vertical',
            'ln-subtract' => 'ln-subtract',
            'ln-combine' => 'ln-combine',
            'ln-intersect' => 'ln-intersect',
            'ln-exclude' => 'ln-exclude',
            'ln-align-center-vertical' => 'ln-align-center-vertical',
            'ln-align-right' => 'ln-align-right',
            'ln-align-bottom' => 'ln-align-bottom',
            'ln-align-left' => 'ln-align-left',
            'ln-align-center-horizontal' => 'ln-align-center-horizontal',
            'ln-align-top' => 'ln-align-top',
            'ln-square' => 'ln-square',
            'ln-circle' => 'ln-circle',

        );
        asort($return);

        return $return;
    }
    public function getVideoNotificationDropDown()
    {
        $return = array(
            '' => 'Videonotification',
            'false' => 'No',
            'true' => 'Yes',
        );

        return $return;
    }
    public function getBlogNotificationDropDown()
    {
        $return = array(
            '' => 'Blognotification',
            'false' => 'No',
            'true' => 'Yes',
        );

        return $return;
    }

    public function changeStatus($id)
    {
        $query = $this->db->query('SELECT `status` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();
        $status = $query->status;
        if ($status == 1) {
            $status = 0;
        } elseif ($status == 0) {
            $status = 1;
        }
        $query = $this->db->query('UPDATE `user`
 SET `status` = '.$this->db->escape($status).'
 WHERE id = ('.$this->db->escape($id).')');
        if (!$query) {
            return 0;
        } else {
            return 1;
        }
    }
    public function editAddress($id, $address, $city, $pincode)
    {
        $query = $this->db->query('UPDATE `user`
 SET `address` = '.$this->db->escape($address).',`city` = '.$this->db->escape($city).',`pincode` = '.$this->db->escape($pincode).',
 WHERE id = ('.$this->db->escape($id).')');
        if ($query) {
            $this->saveUserLog($id, 'User Address Edited');
        }

        return 1;
    }

    public function saveUserLog($id, $status)
    {
        //		$fromuser = $this->session->userdata('id');
        $data2 = array(
            'onuser' => $id,
            'status' => $status,
        );
        $query2 = $this->db->insert('userlog', $data2);
        $query = $this->db->query('UPDATE `user` SET `status`='.$this->db->escape($status).' WHERE `id`='.$this->db->escape($user).'');
    }
    public function signUp($email, $password)
    {
        $password = md5($password);
        $query = $this->db->query('SELECT `id` FROM `user` WHERE `email`=('.$this->db->escape($email).')');
        if ($query->num_rows == 0) {
            $this->db->query('INSERT INTO `user` (`id`, `firstname`, `lastname`, `password`, `email`, `website`, `description`, `eventinfo`, `contact`, `address`, `city`, `pincode`, `dob`, `accesslevel`, `timestamp`, `facebookuserid`, `newsletterstatus`, `status`,`logo`,`showwebsite`,`eventsheld`,`topeventlocation`) VALUES (NULL, NULL, NULL, '.$this->db->escape($password).', '.$this->db->escape($email).', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP, NULL, NULL, NULL,NULL, NULL, NULL,NULL);');
            $user = $this->db->insert_id();
            $newdata = array(
                'email' => $email,
                'password' => $password,
                'logged_in' => true,
                'id' => $user,
            );

            $this->session->set_userdata($newdata);

            //  $queryorganizer=$this->db->query("INSERT INTO `organizer`(`name`, `description`, `email`, `info`, `website`, `contact`, `user`) VALUES(NULL,NULL,NULL,NULL,NULL,NULL,'$user')");


            return $user;
        } else {
            return false;
        }
    }
    public function login($email, $password)
    {
        $password = md5($password);
        $query = $this->db->query('SELECT `id` FROM `user` WHERE `email`=('.$this->db->escape($email).') AND `password`= ('.$this->db->escape($password).')');
        if ($query->num_rows > 0) {
            $user = $query->row();
            $user = $user->id;

            $newdata = array(
                'email' => $email,
                'password' => $password,
                'logged_in' => true,
                'id' => $user,
            );

            $this->session->set_userdata($newdata);
            //print_r($newdata);
            return $user;
        } else {
            return false;
        }
    }
    public function authenticate()
    {
        $is_logged_in = $this->session->userdata('logged_in');
        //        return $is_logged_in;
        //print_r($this->session->userdata( 'logged_in' ));
        if ($is_logged_in != true) {
            return false;
        } //$is_logged_in !== 'true' || !isset( $is_logged_in )
        else {
            $userid = $this->session->userdata('id');
            $query = $this->db->query('SELECT `id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage` FROM `user` WHERE `id`=('.$this->db->escape($userid).')')->row();
            // $userid = $this->session->userdata( );
            return $query;
        }
    }

    public function getLogintypeDropDown()
    {
        $query = $this->db->query('SELECT * FROM `logintype`  ORDER BY `id` ASC')->result();
        $return = array();
        foreach ($query as $row) {
            $return[$row->id] = $row->name;
        }

        return $return;
    }

    public function socialLogin($user_profile, $provider, $os, $token)
    {
        $query = $this->db->query("SELECT * FROM `user` WHERE `user`.`socialid`='$user_profile->identifier'");
        if ($query->num_rows == 0) {
            $googleid = '';
            $facebookid = '';
            $twitterid = '';
            switch ($provider) {
                case 'Google':
                    $googleid = $user_profile->identifier;
                    $providerid = 'Google';
                    break;
                case 'Facebook':
                    $facebookid = $user_profile->identifier;
                    $providerid = 'Facebook';
                    break;
                case 'Twitter':
                    $twitterid = $user_profile->identifier;
                    $providerid = 'Twitter';
                    break;
                case 'Instagram':
                    $instagramid = $user_profile->identifier;
                    $providerid = 'Instagram';
                    break;
            }
            $query2 = $this->db->query("INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`,`instagram`,`eventnotification`,`photonotification`,`videonotification`,`blognotification`) VALUES (NULL, '$user_profile->displayName', '', '$user_profile->email', '3', CURRENT_TIMESTAMP, '1', '$user_profile->photoURL', '', '$user_profile->identifier', '$providerid', '', '$user_profile->birthYear-$user_profile->birthMonth-$user_profile->birthDay', '', '$user_profile->address,$user_profile->region', '$user_profile->city', '', '$user_profile->country', '', '$facebookid', '$googleid', '$twitterid','$instagramid','false','false','false','false')");
            $id = $this->db->insert_id();

            $query4 = $this->db->query('SELECT * FROM `notificationtoken` WHERE `os`=('.$this->db->escape($os).') AND `token`=('.$this->db->escape($token).')');
            if ($query4->num_rows == 0) {
                $query3 = $this->db->query('INSERT INTO `notificationtoken`(`os`,`token`,`user`) VALUES ('.$this->db->escape($os).','.$this->db->escape($token).','.$this->db->escape($id).')');
                $tokenid = $this->db->insert_id();
            } else {
            }

            $newdata = array(
                'email' => $user_profile->email,
                'password' => '',
                'logged_in' => true,
                'id' => $id,
                'name' => $user_profile->displayName,
                'image' => $user_profile->photoURL,
                'logintype' => $provider,
            );

            $this->session->set_userdata($newdata);

            return $newdata;
        } else {
            $query = $query->row();
            $newdata = array(
                'email' => $user_profile->email,
                'password' => '',
                'logged_in' => true,
                'id' => $query->id,
                'name' => $user_profile->displayName,
                'image' => $user_profile->photoURL,
                'logintype' => $provider,
            );

            $this->session->set_userdata($newdata);

            return $newdata;
        }
    }

    public function getIdByEmail($useremail)
    {
        $query = $this->db->query('SELECT `id` FROM `user`
		WHERE `email`=('.$this->db->escape($useremail).')')->row();
        $userid = $query->id;

        return $userid;
    }
    public function forgotPasswordSubmit($newpassword, $userid)
    {
        $newpassword = md5($newpassword);
        $query = $this->db->query('UPDATE `user` SET `forgotpassword`=('.$this->db->escape($newpassword).') WHERE `id`=('.$this->db->escape($userid).')');
        if (!$query) {
            return 0;
        } else {
            return 1;
        }
    }
    public function clearUserImage($id)
    {
        $query = $this->db->query("UPDATE `user`
 SET `image` = ''
 WHERE id = (".$this->db->escape($id).')');
        if (!$query) {
            return 0;
        } else {
            return 1;
        }
    }
    public function clearCoverImage($id)
    {
        $query = $this->db->query("UPDATE `user`
 SET `coverimage` = ''
 WHERE id = (".$this->db->escape($id).')');
        if (!$query) {
            return 0;
        } else {
            return 1;
        }
    }
    public function multipleDelete($selected) {
        $query = $this->db->query("DELETE FROM `user` WHERE `id` IN ($selected)");
        return $query;
    }
}
