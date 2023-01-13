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
use XoopsModules\Adslight\Helper;

/** @var Helper $helper */

/**
 * Xoops Header
 */
require_once __DIR__ . '/header.php';
//require_once XOOPS_ROOT_PATH . '/header.php';
//require_once XOOPS_ROOT_PATH . '/class/criteria.php';

/**
 * Module classes
 */
if (!$GLOBALS['xoopsSecurity']->check()) {
    redirect_header(Request::getString('HTTP_REFERER', '', 'SERVER'), 3, _ADSLIGHT_TOKENEXPIRED);
}

/**
 * Receiving info from input parameters
 */
$cod_img = Request::getString('cod_img', '', 'POST');

/**
 * Creating the factory  and the criteria to delete the picture
 * The user must be the owner
 */
$picturesHandler = $helper->getHandler('Pictures');
$criteria_img    = new \Criteria('cod_img', $cod_img);
$uid             = $GLOBALS['xoopsUser']->getVar('uid');
$criteria_uid    = new \Criteria('uid_owner', $uid);
//$criteria_lid = new \Criteria ('lid',$lid);
$criteria = new \CriteriaCompo($criteria_img);
$criteria->add($criteria_uid);

$objectsArray = $picturesHandler->getObjects($criteria);
$image_name   = $objectsArray[0]->getVar('url');
/**
 * Try to delete
 */
if ($picturesHandler->deleteAll($criteria)) {
    $pathUpload = $helper->getConfig('adslight_path_upload', '');
    unlink("{$pathUpload}/{$image_name}");
    unlink("{$pathUpload}/thumbs/thumb_{$image_name}");
    unlink("{$pathUpload}/midsize/resized_{$image_name}");

    $lid = Request::getInt('lid', 0, 'POST');
    $sql = 'UPDATE ' . $xoopsDB->prefix('adslight_listing') . " SET photo=photo-1 WHERE lid='{$lid}'";
    $xoopsDB->queryF($sql);
    $helper->redirect("view_photos.php?lid={$lid}&uid={$uid}", 10, _ADSLIGHT_DELETED);
} else {
    $helper->redirect("view_photos.php?lid={$lid}&uid={$uid}", 10, _ADSLIGHT_NOCACHACA);
}

/**
 * Close page
 */
require_once XOOPS_ROOT_PATH . '/footer.php';
