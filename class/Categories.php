<?php declare(strict_types=1);

namespace XoopsModules\Adslight;

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

use Xmf\Module\Helper\Permission;
use XoopsModules\Adslight\{
    Form
};

//$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class Categories
 */
class Categories extends \XoopsObject
{
    public  $cid;
    public  $pid;
    public  $title;
    public  $cat_desc;
    private $cat_keywords;
    public  $img;
    public  $cat_order;
    public  $affprice;
    public  $cat_moderate;
    public  $moderate_subcat;
    public  $helper;
    public  $permHelper;

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        // /** @var Adslight\Helper $helper */
        //        $this->helper = Adslight\Helper::getInstance();
        $this->permHelper = new Permission();

        $this->initVar('cid', \XOBJ_DTYPE_INT);
        $this->initVar('pid', \XOBJ_DTYPE_INT);
        $this->initVar('title', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_desc', \XOBJ_DTYPE_OTHER);
        $this->initVar('cat_keywords', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('img', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_order', \XOBJ_DTYPE_INT);
        $this->initVar('affprice', \XOBJ_DTYPE_INT);
        $this->initVar('cat_moderate', \XOBJ_DTYPE_INT);
        $this->initVar('moderate_subcat', \XOBJ_DTYPE_INT);
    }

    /**
     * Get form
     *
     * @param null
     * @return Form\CategoriesForm
     */
    public function getForm(): Form\CategoriesForm
    {
        $form = new Form\CategoriesForm($this);

        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('cid'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('cid'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('cid'));
    }
}
