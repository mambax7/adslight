<?php declare(strict_types=1);

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
use XoopsModules\Adslight\{
    Helper,
    PicturesHandler
};


/**
 * Xoops header ...
 */
require_once \dirname(__DIR__, 2) . '/mainfile.php';
$GLOBALS['xoopsOption']['template_main'] = 'adslight_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';
global $xoopsDB, $xoopsUser;
$helper = Helper::getInstance();
/**
 * Modules class includes
 */

/**
 * Factory of pictures created
 */
$picturesHandler = $helper->getHandler('Pictures');
/**
 * Getting the title
 */
$title = Request::getString('caption', '', 'POST');
$lid   = Request::getInt('lid', 0, 'POST');
/**
 * Getting parameters defined in admin side
 */
$pathUpload    = $helper->getConfig('adslight_path_upload', '');
$pictwidth     = $helper->getConfig('adslight_resized_width');
$pictheight    = $helper->getConfig('adslight_resized_height');
$thumbwidth    = $helper->getConfig('adslight_thumb_width');
$thumbheight   = $helper->getConfig('adslight_thumb_height');
$maxfilebytes  = $helper->getConfig('adslight_maxfilesize');
$maxfileheight = $helper->getConfig('adslight_max_orig_height');
$maxfilewidth  = $helper->getConfig('adslight_max_orig_width');

/**
 * If we are receiving a file
 */
if ('sel_photo' === Request::getArray('xoops_upload_file', '', 'POST')[0]) {
    //    if (!$GLOBALS['xoopsSecurity']->check()) {
    //        redirect_header(Request::getString('HTTP_REFERER', '', 'SERVER'), 3, _ADSLIGHT_TOKENEXPIRED);
    //    }

    /**
     * Try to upload picture resize it insert in database and then redirect to index
     */
    if ($picturesHandler->receivePicture(
        $title,
        $pathUpload,
        $thumbwidth,
        $thumbheight,
        $pictwidth,
        $pictheight,
        $maxfilebytes,
        $maxfilewidth,
        $maxfileheight
    )) {
        header('Location: ' . XOOPS_URL . "/modules/adslight/view_photos.php?lid={$lid}&uid=" . $GLOBALS['xoopsUser']->getVar('uid'));

        $xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('adslight_listing') . " SET photo=photo+1 WHERE lid={$lid}");
    } else {
        $helper->redirect('view_photos.php?uid=' . $xoopsUser->getVar('uid'), 15, _ADSLIGHT_NOCACHACA);
    }
}

/**
 * Close page
 */
require_once XOOPS_ROOT_PATH . '/footer.php';
