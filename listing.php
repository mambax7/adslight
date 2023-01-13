<?php declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: Adslight
 *
 * @category        Module
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */

use Xmf\Request;
use XoopsModules\Adslight\{
    Helper,
    Listing,
    Utility
};
/** @var Helper $helper */

require __DIR__ . '/header.php';

$op = \Xmf\Request::getCmd('op', 'list');

if ('edit' !== $op) {
    if ('view' === $op) {
        $GLOBALS['xoopsOption']['template_main'] = 'adslight_listing.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'adslight_listing_list0.tpl';
    }
}
require_once XOOPS_ROOT_PATH . '/header.php';

global $xoTheme;

$start = \Xmf\Request::getInt('start', 0);
// Define Stylesheet
/** @var xos_opal_Theme $xoTheme */
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsModules\Adslight\ListingHandler $listingHandler */
$listingHandler = $helper->getHandler('Listing');

$listingPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($listingPaginationLimit);
$criteria->setStart($start);

$listingCount = $listingHandler->getCount($criteria);
$listingArray = $listingHandler->getAll($criteria);

$lid = \Xmf\Request::getInt('lid', 0, 'GET');

switch ($op) {
    case 'edit':
        /** @var \XoopsModules\Adslight\Listing $listingObject */
        $listingObject = $listingHandler->get(Request::getString('lid', ''));
        $form          = $listingObject->getForm();
        $form->display();
        break;
    case 'view':
        //        viewItem();
        $listingPaginationLimit = 1;
        $myid                   = $lid;
        //lid
        $listingObject = $listingHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('lid');
        $criteria->setOrder('DESC');
        $criteria->setLimit($listingPaginationLimit);
        $criteria->setStart($start);
        $listing['lid'] = $listingObject->getVar('lid');
        /** @var \XoopsPersistableObjectHandler $categoriesHandler */
        $categoriesHandler = $helper->getHandler('Categories');

        $listing['cid']    = $categoriesHandler->get($listingObject->getVar('cid'))->getVar('title');
        $listing['title']  = $listingObject->getVar('title');
        $listing['status'] = $listingObject->getVar('status');
        $listing['expire'] = $listingObject->getVar('expire');
        /** @var \XoopsPersistableObjectHandler $typeHandler */
        $typeHandler = $helper->getHandler('Type');

        $listing['type']     = $typeHandler->get($listingObject->getVar('type'))->getVar('nom_type');
        $listing['desctext'] = $listingObject->getVar('desctext');
        $listing['tel']      = $listingObject->getVar('tel');
        $listing['price']    = $listingObject->getVar('price');
        /** @var \XoopsPersistableObjectHandler $priceHandler */
        $priceHandler = $helper->getHandler('Price');

        $listing['typeprice'] = $priceHandler->get($listingObject->getVar('typeprice'))->getVar('nom_price');
        /** @var \XoopsPersistableObjectHandler $conditionHandler */
        $conditionHandler = $helper->getHandler('Condition');

        $listing['typecondition'] = $conditionHandler->get($listingObject->getVar('typecondition'))->getVar('nom_condition');
        $listing['date_created']  = formatTimestamp($listingObject->getVar('date_created'), 's');
        $listing['email']         = $listingObject->getVar('email');
        $listing['submitter']     = strip_tags(\XoopsUser::getUnameFromId($listingObject->getVar('submitter')));
        $listing['usid']          = $listingObject->getVar('usid');
        $listing['town']          = $listingObject->getVar('town');
        $listing['country']       = strip_tags(\XoopsLists::getCountryList()[$listingObject->getVar('country')]);
        $listing['contactby']     = $listingObject->getVar('contactby');
        $listing['premium']       = $listingObject->getVar('premium');
        $listing['valid']         = $listingObject->getVar('valid');
        $listing['photo']         = $listingObject->getVar('photo');
        $listing['hits']          = $listingObject->getVar('hits');
        $listing['item_rating']   = $listingObject->getVar('item_rating');
        $listing['item_votes']    = $listingObject->getVar('item_votes');
        $listing['user_rating']   = $listingObject->getVar('user_rating');
        $listing['user_votes']    = $listingObject->getVar('user_votes');
        $listing['comments']      = $listingObject->getVar('comments');
        $listing['remind']        = $listingObject->getVar('remind');

        //       $GLOBALS['xoopsTpl']->append('listing', $listing);
        $keywords[] = $listingObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('listing', $listing);
        $start = $lid;

        // Display Navigation
        if ($listingCount > $listingPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('listing.php'));
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($listingCount, $listingPaginationLimit, $start, 'op=view&lid');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($listingCount > 0) {
            $GLOBALS['xoopsTpl']->assign('listing', []);
            foreach (array_keys($listingArray) as $i) {
                $listing['lid'] = $listingArray[$i]->getVar('lid');
                /** @var \XoopsPersistableObjectHandler $categoriesHandler */
                $categoriesHandler = $helper->getHandler('Categories');

                $listing['cid']    = $categoriesHandler->get($listingArray[$i]->getVar('cid'))->getVar('title');
                $listing['title']  = $listingArray[$i]->getVar('title');
                $listing['status'] = $listingArray[$i]->getVar('status');
                $listing['expire'] = $listingArray[$i]->getVar('expire');
                /** @var \XoopsPersistableObjectHandler $typeHandler */
                $typeHandler = $helper->getHandler('Type');

                $listing['type']     = $typeHandler->get($listingArray[$i]->getVar('type'))->getVar('nom_type');
                $listing['desctext'] = $listingArray[$i]->getVar('desctext');
                $listing['tel']      = $listingArray[$i]->getVar('tel');
                $listing['price']    = $listingArray[$i]->getVar('price');
                /** @var \XoopsPersistableObjectHandler $priceHandler */
                $priceHandler = $helper->getHandler('Price');

                $listing['typeprice'] = $priceHandler->get($listingArray[$i]->getVar('typeprice'))->getVar('nom_price');
                /** @var \XoopsPersistableObjectHandler $conditionHandler */
                $conditionHandler = $helper->getHandler('Condition');

                $listing['typecondition'] = $conditionHandler->get($listingArray[$i]->getVar('typecondition'))->getVar('nom_condition');
                $listing['date_created']  = formatTimestamp($listingArray[$i]->getVar('date_created'), 's');
                $listing['email']         = $listingArray[$i]->getVar('email');
                $listing['submitter']     = strip_tags(\XoopsUser::getUnameFromId($listingArray[$i]->getVar('submitter')));
                $listing['usid']          = $listingArray[$i]->getVar('usid');
                $listing['town']          = $listingArray[$i]->getVar('town');
                //        $listing['country'] = strip_tags(\XoopsLists::getCountryList()[$listingArray[$i]->getVar('country')])??'';
                $listing['contactby']   = $listingArray[$i]->getVar('contactby');
                $listing['premium']     = $listingArray[$i]->getVar('premium');
                $listing['valid']       = $listingArray[$i]->getVar('valid');
                $listing['photo']       = $listingArray[$i]->getVar('photo');
                $listing['hits']        = $listingArray[$i]->getVar('hits');
                $listing['item_rating'] = $listingArray[$i]->getVar('item_rating');
                $listing['item_votes']  = $listingArray[$i]->getVar('item_votes');
                $listing['user_rating'] = $listingArray[$i]->getVar('user_rating');
                $listing['user_votes']  = $listingArray[$i]->getVar('user_votes');
                $listing['comments']    = $listingArray[$i]->getVar('comments');
                $listing['remind']      = $listingArray[$i]->getVar('remind');
                $GLOBALS['xoopsTpl']->append('listing', $listing);
                $keywords[] = $listingArray[$i]->getVar('title');
                unset($listing);
            }
            // Display Navigation
            if ($listingCount > $listingPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('listing.php'));
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($listingCount, $listingPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
$utility = new Utility();
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_ADSLIGHT_LISTING_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('listing.php'));
$GLOBALS['xoopsTpl']->assign('adslight_url', $helper->url());
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

//$GLOBALS['xoopsTpl']->assign('admin', ADSLIGHT_ADMIN);
//$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/footer.php';
