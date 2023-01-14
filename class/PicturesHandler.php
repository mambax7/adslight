<?php declare(strict_types=1);

namespace XoopsModules\Adslight;

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project (https://xoops.org)
 * @license      GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author       XOOPS Development Team
 * @author       Pascal Le Boustouller: original author (pascal.e-xoops@perso-search.com)
 * @author       Luc Bizet (www.frxoops.org)
 * @author       jlm69 (www.jlmzone.com)
 * @author       mamba (www.xoops.org)
 */

use Xmf\Request;

/**
 * Protection against inclusion outside the site
 */

/**
 * Includes of form objects and uploader
 */
require_once XOOPS_ROOT_PATH . '/class/uploader.php';
require_once XOOPS_ROOT_PATH . '/kernel/object.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require_once XOOPS_ROOT_PATH . '/kernel/object.php';

// -------------------------------------------------------------------------
// ------------------light_pictures user handler class -------------------
// -------------------------------------------------------------------------

/**
 * PicturesHandler class definition
 *
 * This class provides simple mechanism to manage {@see Pictures} objects
 * and generate forms for inclusion
 *
 * @todo change this to a XoopsPersistableObjectHandler and remove 'most' method overloads
 */
class PicturesHandler extends \XoopsPersistableObjectHandler
{
    private const TABLE      = 'adslight_pictures';
    private const ENTITY     = Pictures::class;
    private const ENTITYNAME = 'Pictures';
    private const KEYNAME    = 'cod_img';
    private const IDENTIFIER = 'title';

    /**
     * Class constructor
     * @param \XoopsDatabase|null $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        $this->db = $db;
        parent::__construct($db, static::TABLE, static::ENTITY, static::KEYNAME, static::IDENTIFIER);
    }

    /**
     * create a new light_pictures
     *
     * @param bool $isNew flag the new objects as "new"?
     *
     * @return \XoopsObject
     */
    public function create($isNew = true)
    {
        $adslightPictures = new Pictures();
        if ($isNew) {
            $adslightPictures->setNew();
        } else {
            $adslightPictures->unsetNew();
        }

        return $adslightPictures;
    }

    /**
     * retrieve a light_pictures
     *
     * @param int|null   $id of the light_pictures
     * @param array|null $fields
     * @return false|\XoopsModules\Adslight\Pictures reference to the {@link light_pictures} object, FALSE if failed
     */
    public function get($id = null, $fields = null)
    {
        //        $sql = 'SELECT * FROM ' . $this->db->prefix('adslight_pictures') . ' WHERE cod_img=' . $id . ' AND lid=' . $lid . ' ';
        $sql = 'SELECT * FROM ' . $this->db->prefix('adslight_pictures') . ' WHERE cod_img=' . $id . ' ';
        if (!$result = $this->db->query($sql)) {
            return false;
        }
        $numrows = $this->db->getRowsNum($result);
        if (1 === $numrows) {
            $adslightPictures = new Pictures();
            $adslightPictures->assignVars($this->db->fetchArray($result));

            return $adslightPictures;
        }

        return false;
    }

    /**
     * insert a new AdslightPicture object into the database
     *
     * @param bool $force
     * @return bool FALSE if failed, TRUE if already present and unchanged or successful
     */
    public function insert(\XoopsObject $object, $force = false): bool
    {
        global $lid;
        if (!$object instanceof Pictures) {
            return false;
        }
        if (!$object->isDirty()) {
            return true;
        }
        if (!$object->cleanVars()) {
            return false;
        }
        foreach ($object->cleanVars as $k => $v) {
            ${$k} = $v;
        }
        $now = \time();
        if ($object->isNew()) {
            // add/modify of Pictures
            $object = new Pictures();

            $format = 'INSERT INTO `%s` (cod_img, title, date_created, date_updated, lid, uid_owner, url)';
            $format .= 'VALUES (%u, %s, %s, %s, %s, %s, %s)';
            $sql    = \sprintf($format, $this->db->prefix('adslight_pictures'), $cod_img, $this->db->quoteString($title), $now, $now, $this->db->quoteString($lid), $this->db->quoteString($uid_owner), $this->db->quoteString($url));
            $force  = true;
        } else {
            $format = 'UPDATE `%s` SET ';
            $format .= 'cod_img=%u, title=%s, date_created=%s, date_updated=%s, lid=%s, uid_owner=%s, url=%s';
            $format .= ' WHERE cod_img = %u';
            $sql    = \sprintf($format, $this->db->prefix('adslight_pictures'), $cod_img, $this->db->quoteString($title), $now, $now, $this->db->quoteString($lid), $this->db->quoteString($uid_owner), $this->db->quoteString($url), $cod_img);
        }
        if ($force) {
            $result = $this->db->queryF($sql);
        } else {
            $result = $this->db->query($sql);
        }
        if (!$result) {
            return false;
        }
        if (empty($cod_img)) {
            $cod_img = $this->db->getInsertId();
        }
        $object->assignVars([
                                'cod_img' => $cod_img,
                                'lid'     => $lid,
                                'url'     => $url,
                            ]);

        return true;
    }

    /**
     * delete Pictures object from the database
     *
     * @param \XoopsObject $object reference to the Pictures to delete
     * @param bool         $force
     * @return bool        FALSE if failed.
     */
    public function delete(\XoopsObject $object, $force = false): bool
    {
        if (!$object instanceof Pictures) {
            return false;
        }
        $sql = \sprintf('DELETE FROM `%s` WHERE cod_img = %u', $this->db->prefix('adslight_pictures'), $object->getVar('cod_img'));
        if ($force) {
            $result = $this->db->queryF($sql);
        } else {
            $result = $this->db->query($sql);
        }
        if (!$result) {
            return false;
        }

        return true;
    }

    /**
     * retrieve Pictures object(s) from the database
     *
     * @param \CriteriaCompo|\CriteriaElement|null $criteria  {@link \CriteriaElement} conditions to be met
     * @param bool                                 $id_as_key use the UID as key for the array?
     * @param mixed                                $as_object
     * @return array  array of {@link Pictures} objects
     */
    public function &getObjects($criteria = null, $id_as_key = false, $as_object = true) //&getObjects(?\CriteriaElement $criteria = null, $id_as_key = false): array
    {
        $ret   = [];
        $limit = $start = 0;
        $sql   = 'SELECT * FROM ' . $this->db->prefix('adslight_pictures');
        if (\is_object($criteria) && \is_subclass_of($criteria, \CriteriaElement::class)) {
            $sql .= ' ' . $criteria->renderWhere();
            if ('' !== $criteria->getSort()) {
                $sql .= ' ORDER BY ' . $criteria->getSort() . ' ' . $criteria->getOrder();
            }
            $limit = $criteria->getLimit();
            $start = $criteria->getStart();
        }
        $result = $this->db->query($sql, $limit, $start);
        if (!$result) {
            return $ret;
        }
        while (false !== ($myrow = $this->db->fetchArray($result))) {
            $adslightPictures = new Pictures();
            $adslightPictures->assignVars($myrow);
            if ($id_as_key) {
                $ret[$myrow['cod_img']] = $adslightPictures;
            } else {
                $ret[] = $adslightPictures;
            }
            unset($adslightPictures);
        }

        return $ret;
    }

    /**
     * count Pictures matching a condition
     *
     * @param \CriteriaElement|null $criteria {@link \CriteriaElement} to match
     * @return int    count of Pictures
     */
    public function getCount(?\CriteriaElement $criteria = null): int
    {
        $sql = 'SELECT COUNT(*) FROM ' . $this->db->prefix('adslight_pictures');
         if (\is_object($criteria) && \is_subclass_of($criteria, \CriteriaElement::class)) {
            $sql .= ' ' . $criteria->renderWhere();
        }
        $result = $this->db->query($sql);
        if (!$result) {
            return 0;
        }
        [$count] = $this->db->fetchRow($result);

        return (int)$count;
    }

    /**
     * delete Pictures matching a set of conditions
     *
     * @param \CriteriaCompo|\CriteriaElement|null $criteria {@link \CriteriaElement}
     * @param mixed                                $force
     * @param mixed                                $asObject
     * @return bool   FALSE if deletion failed
     */
    //    public function deleteAll(?\CriteriaElement $criteria = null): bool
    public function deleteAll(\CriteriaElement $criteria = null, $force = true, $asObject = false)
    {
        $sql = 'DELETE FROM ' . $this->db->prefix('adslight_pictures');
         if (\is_object($criteria) && \is_subclass_of($criteria, \CriteriaElement::class)) {
            $sql .= ' ' . $criteria->renderWhere();
        }
        if (!$result = $this->db->query($sql)) {
            return false;
        }

        return true;
    }

    /**
     * Render a form to send pictures
     *
     * @param int       $uid
     * @param int       $lid
     * @param int       $maxbytes the maximum size of a picture
     * @param \XoopsTpl $xoopsTpl the one in which the form will be rendered
     * @return bool   TRUE
     *
     * obs: Some functions wont work on php 4 so edit lines down under acording to your version
     */
    public function renderFormSubmit(
        $uid,
        $lid,
        $maxbytes,
        $xoopsTpl
    ): bool {
        global $xoopsUser;
        $uid        = (int)$uid;
        $lid        = (int)$lid;
        $form       = new \XoopsThemeForm(\_ADSLIGHT_SUBMIT_PIC_TITLE, 'form_picture', XOOPS_URL . "/modules/adslight/add_photo.php?lid={$lid}&uid=" . $xoopsUser->getVar('uid'), 'post', true);
        $field_url  = new \XoopsFormFile(\_ADSLIGHT_SELECT_PHOTO, 'sel_photo', 2000000);
        $field_desc = new \XoopsFormText(\_ADSLIGHT_CAPTION, 'caption', 35, 55);

        $form->setExtra('enctype="multipart/form-data"');
        $button_send   = new \XoopsFormButton('', 'submit_button', \_ADSLIGHT_UPLOADPICTURE, 'submit');
        $field_warning = new \XoopsFormLabel(\sprintf(\_ADSLIGHT_YOUCANUPLOAD, $maxbytes / 1024));
        $field_lid     = new \XoopsFormHidden('lid', $lid);
        $field_uid     = new \XoopsFormHidden('uid', $uid);

        $field_token = $GLOBALS['xoopsSecurity']->getTokenHTML();

        $form->addElement($field_warning);
        $form->addElement($field_url, true);
        $form->addElement($field_desc, true);
        $form->addElement($field_lid, true);
        $form->addElement($field_uid, true);

        $form->addElement($field_token, true);

        $form->addElement($button_send);
        if (\str_replace('.', '', \PHP_VERSION) > 499) {
            $form->assign($xoopsTpl);
        } else {
            $form->display();
        }

        return true;
    }

    /**
     * Render a form to edit the description of the pictures
     *
     * @param string $caption  The description of the picture
     * @param int    $cod_img  the id of the image in database
     * @param string $filename the url to the thumb of the image so it can be displayed
     * @return bool   TRUE
     */
    public function renderFormEdit(
        $caption,
        $cod_img,
        $filename
    ): bool {
        $form       = new \XoopsThemeForm(\_ADSLIGHT_EDIT_CAPTION, 'form_picture', 'editdesc.php', 'post', true);
        $field_desc = new \XoopsFormText($caption, 'caption', 35, 55);
        $form->setExtra('enctype="multipart/form-data"');
        $button_send = new \XoopsFormButton(\_ADSLIGHT_EDIT, 'submit_button', \_SUBMIT, 'submit');
        //@todo - replace alt with language string
        $field_warning = new \XoopsFormLabel("<img src='{$filename}' alt='sssss'>");
        $field_cod_img = new \XoopsFormHidden('cod_img', $cod_img);
        //    $field_lid = new \XoopsFormHidden('lid', $lid);
        $field_marker = new \XoopsFormHidden('marker', 1);

        $field_token = $GLOBALS['xoopsSecurity']->getTokenHTML();

        $form->addElement($field_warning);
        $form->addElement($field_desc);
        $form->addElement($field_cod_img);
        $form->addElement($field_marker);
        $form->addElement($field_token);
        $form->addElement($button_send);
        $form->display();

        return true;
    }

    /**
     * Upload the file and Save into database
     *
     * @param string $title         A litle description of the file
     * @param string $pathUpload    The path to where the file should be uploaded
     * @param int    $thumbwidth    the width in pixels that the thumbnail will have
     * @param int    $thumbheight   the height in pixels that the thumbnail will have
     * @param int    $pictwidth     the width in pixels that the pic will have
     * @param int    $pictheight    the height in pixels that the pic will have
     * @param int    $maxfilebytes  the maximum size a file can have to be uploaded in bytes
     * @param int    $maxfilewidth  the maximum width in pixels that a pic can have
     * @param int    $maxfileheight the maximum height in pixels that a pic can have
     * @return bool FALSE if upload fails or database fails
     */
    public function receivePicture(
        $title,
        $pathUpload,
        $thumbwidth,
        $thumbheight,
        $pictwidth,
        $pictheight,
        $maxfilebytes,
        $maxfilewidth,
        $maxfileheight
    ): bool {
        global $lid;
        //busca id do user logado
        $uid = $GLOBALS['xoopsUser']->getVar('uid');
        $lid = Request::getInt('lid', 0, 'POST');
        //create a hash so it does not erase another file
        $hash1 = \time();
        $hash  = \mb_substr((string)$hash1, 0, 4);
        // mimetypes and settings put this in admin part later
        $allowed_mimetypes = [
            'image/jpeg',
            'image/gif',
        ];
        $maxfilesize       = $maxfilebytes;
        // create the object to upload
        $uploader = new \XoopsMediaUploader($pathUpload, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight);
        // fetch the media
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            //let'screate a name for it
            $uploader->setPrefix("pic_{$lid}_");
            //now let s upload the file
            if (!$uploader->upload()) {
                // if there are errors let'sreturn them
                echo '<div style="color:#FF0000; background-color:#FFEAF4; border-color:#FF0000; border-width:thick; border-style:solid; text-align:center;"><p>' . $uploader->getErrors() . '</p></div>';

                return false;
            }
            // now let s create a new object picture and set its variables
            $picture = $this->create();
            $url     = $uploader->getSavedFileName();
            $picture->setVar('url', $url);
            $picture->setVar('title', $title);
            $uid = $GLOBALS['xoopsUser']->getVar('uid');
            //            $lid = $lid;
            $picture->setVar('lid', $lid);
            $picture->setVar('uid_owner', $uid);
            $this->insert($picture);
            $saved_destination = $uploader->getSavedDestination();
            $this->resizeImage($saved_destination, $thumbwidth, $thumbheight, $pictwidth, $pictheight, $pathUpload);
        } else {
            echo '<div style="color:#FF0000; background-color:#FFEAF4; border-color:#FF0000; border-width:thick; border-style:solid; text-align:center;"><p>' . $uploader->getErrors() . '</p></div>';

            return false;
        }

        return true;
    }

    /**
     * Resize a picture and save it to $pathUpload
     *
     * @param string $img         the path to the file
     * @param int    $thumbwidth  the width in pixels that the thumbnail will have
     * @param int    $thumbheight the height in pixels that the thumbnail will have
     * @param int    $pictwidth   the width in pixels that the pic will have
     * @param int    $pictheight  the height in pixels that the pic will have
     * @param string $pathUpload  The path to where the files should be saved after resizing
     */
    public function resizeImage(
        $img,
        $thumbwidth,
        $thumbheight,
        $pictwidth,
        $pictheight,
        $pathUpload
    ): void {
        $img2   = $img;
        $path   = \pathinfo($img);
        $img    = \imagecreatefromjpeg($img);
        $xratio = $thumbwidth / \imagesx($img);
        $yratio = $thumbheight / \imagesy($img);
        if ($xratio < 1 || $yratio < 1) {
            if ($xratio < $yratio) {
                $resized = \imagecreatetruecolor((int)$thumbwidth, (int)\floor(\imagesy($img) * $xratio));
            } else {
                $resized = \imagecreatetruecolor((int)\floor(\imagesx($img) * $yratio), $thumbheight);
            }
            \imagecopyresampled($resized, $img, 0, 0, 0, 0, \imagesx($resized) + 1, \imagesy($resized) + 1, \imagesx($img), \imagesy($img));
            \imagejpeg($resized, "{$pathUpload}/thumbs/thumb_{$path['basename']}");
            \imagedestroy($resized);
        } else {
            \imagejpeg($img, "{$pathUpload}/thumbs/thumb_{$path['basename']}");
        }
        \imagedestroy($img);
        $path2   = \pathinfo($img2);
        $img2    = \imagecreatefromjpeg($img2);
        $xratio2 = $pictwidth / \imagesx($img2);
        $yratio2 = $pictheight / \imagesy($img2);
        if ($xratio2 < 1 || $yratio2 < 1) {
            if ($xratio2 < $yratio2) {
                $resized2 = \imagecreatetruecolor((int)$pictwidth, (int)\floor(\imagesy($img2) * $xratio2));
            } else {
                $resized2 = \imagecreatetruecolor((int)\floor(\imagesx($img2) * $yratio2), (int)$pictheight);
            }
            \imagecopyresampled($resized2, $img2, 0, 0, 0, 0, \imagesx($resized2) + 1, \imagesy($resized2) + 1, \imagesx($img2), \imagesy($img2));
            \imagejpeg($resized2, "{$pathUpload}/midsize/resized_{$path2['basename']}");
            \imagedestroy($resized2);
        } else {
            \imagejpeg($img2, "{$pathUpload}/midsize/resized_{$path2['basename']}");
        }
        \imagedestroy($img2);
    }
}
