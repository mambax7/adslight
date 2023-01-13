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
 * @link            https://xoops.org/
 * @since           1.0.0
 */

use Xmf\Module\Helper\Permission;

//$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class Uservotedata
 */
class Uservotedata extends \XoopsObject
{
    private $ratingid;
    private $usid;
    private $ratinguser;
    private $rating;
    private $ratinghostname;
    private $date_created;
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
        /** @var Helper $helper */
        $this->helper     = Helper::getInstance();
        $this->permHelper = new Permission();
        $this->initVar('ratingid', \XOBJ_DTYPE_INT);
        $this->initVar('usid', \XOBJ_DTYPE_INT);
        $this->initVar('ratinguser', \XOBJ_DTYPE_INT);
        $this->initVar('rating', \XOBJ_DTYPE_INT);
        $this->initVar('ratinghostname', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('date_created', \XOBJ_DTYPE_INT);
    }

    /**
     * Get form
     *
     * @return \XoopsModules\Adslight\Form\UservotesForm
     */
    public function getForm(): Form\UservotesForm
    {
        return new Form\UservotesForm($this);
    }

    /**
     * @return array|null
     */
    public function getGroupsRead(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem(
            'sbcolumns_read',
            $this->getVar('ratingid')
        );
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem(
            'sbcolumns_submit',
            $this->getVar('ratingid')
        );
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem(
            'sbcolumns_moderation',
            $this->getVar('ratingid')
        );
    }
}
