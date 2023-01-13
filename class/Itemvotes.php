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

use XoopsModules\Adslight\{
    Form
};

//$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class Itemvotes
 */
class Itemvotes extends \XoopsObject
{
    private $ratingid;
    private $lid;
    private $ratinguser;
    private $rating;
    private $ratinghostname;
    private $ratingtimestamp;
    public  $helper;
    public $permHelper;

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
        $this->permHelper = new \Xmf\Module\Helper\Permission();

        $this->initVar('ratingid', \XOBJ_DTYPE_INT);
        $this->initVar('lid', \XOBJ_DTYPE_INT);
        $this->initVar('ratinguser', \XOBJ_DTYPE_INT);
        $this->initVar('rating', \XOBJ_DTYPE_INT);
        $this->initVar('ratinghostname', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ratingtimestamp', \XOBJ_DTYPE_INT);
    }

    /**
     * Get form
     *
     * @param null
     * @return Form\ItemvotesForm
     */
    public function getForm(): Form\ItemvotesForm
    {
        $form = new Form\ItemvotesForm($this);

        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('ratingid'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('ratingid'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('ratingid'));
    }
}
