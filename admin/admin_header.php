<?php
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
 * @copyright    XOOPS Project (http://xoops.org)
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */

$rootPath = dirname(dirname(dirname(__DIR__)));
//$moduleDirName = $GLOBALS['xoopsModule']->getVar('dirname');
//$moduleDirName = $xoopsModule->getVar('dirname');

include_once $rootPath . '/mainfile.php';
include_once $rootPath . '/include/cp_functions.php';
require_once $rootPath . '/include/cp_header.php';
include_once $rootPath . '/class/xoopsformloader.php';
require __DIR__ . '/../class/utilities.php';



global $xoopsModule;
$moduleDirName = $xoopsModule->getVar('dirname');
//$moduleDirName2 = basename(dirname(__DIR__));

include_once $rootPath . '/modules/' . $moduleDirName . '/include/gtickets.php';
include_once $rootPath . '/modules/' . $moduleDirName . '/class/utilities.php';
include_once $rootPath . '/modules/' . $moduleDirName . '/class/classifiedstree.php';
//include_once $GLOBALS['xoops']->path( "/modules/adslight/class/grouppermform.php");
include_once $rootPath . '/class/xoopsform/grouppermform.php';
include_once $rootPath . '/modules/adslight/class/classifiedstree.php';

//if functions.php file exist
//require_once dirname(__DIR__) . '/include/functions.php';

// Load language files
xoops_loadLanguage('admin', $moduleDirName);
xoops_loadLanguage('modinfo', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);

$pathIcon16 = \Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32 = \Xmf\Module\Admin::iconUrl('', 32);
$pathModuleAdmin =& $xoopsModule->getInfo('dirmoduleadmin');

include_once $GLOBALS['xoops']->path($pathModuleAdmin . '/moduleadmin.php');

if ($GLOBALS['xoopsUser']) {
    //  $xoopsModule = XoopsModule::getByDirname($moduleDirName);
    if (!$GLOBALS['xoopsUser']->isAdmin($xoopsModule->mid())) {
        redirect_header(XOOPS_URL . '/', 3, _NOPERM);
    }
} else {
    redirect_header(XOOPS_URL . '/', 3, _NOPERM);
}

$myts        = MyTextSanitizer::getInstance();
$adminObject = new ModuleAdmin();
