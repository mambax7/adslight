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
 * Class Condition
 */
class Condition extends \XoopsObject
{
    private $id_condition;
    private $nom_condition;
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
        $this->permHelper = new \Xmf\Module\Helper\Permission();

        $this->initVar('id_condition', \XOBJ_DTYPE_INT);
        $this->initVar('nom_condition', \XOBJ_DTYPE_TXTBOX);
    }

    /**
     * Get form
     *
     * @param null
     * @return Form\ConditionForm
     */
    public function getForm(): Form\ConditionForm
    {
        $form = new Form\ConditionForm($this);

        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('id_condition'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('id_condition'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration(): ?array
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('id_condition'));
    }
}
