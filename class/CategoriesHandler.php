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

/**
 * Class CategoriesHandler
 */
class CategoriesHandler extends \XoopsPersistableObjectHandler
{
    private const TABLE      = 'adslight_categories';
    private const ENTITY     = Categories::class;
    private const ENTITYNAME = 'Categories';
    private const KEYNAME    = 'cid';
    private const IDENTIFIER = 'title';
    /**
     * @var Helper
     */
    public $helper;

    /**
     * Constructor
     * @param null|\XoopsDatabase                $db
     * @param null|Helper $helper
     */
    public function __construct(\XoopsDatabase $db = null, $helper = null)
    {
        /** @var Helper $this- >helper */
        $this->helper = $helper;
        $this->db     = $db;
        parent::__construct($db, static::TABLE, static::ENTITY, static::KEYNAME, static::IDENTIFIER);
    }

    /**
     * @param bool $isNew
     *
     * @return \XoopsObject
     */
    public function create($isNew = true)
    {
        $obj         = parent::create($isNew);
        $obj->helper = $this->helper;

        return $obj;
    }

    //====================================

    /**
     * @param int $pid
     *
     * @return int
     */
    public function getCategoriesCount($pid = 0): int
    {
        if (-1 == $pid) {
            return $this->getCount();
        }
        $helper = Helper::getInstance();
        /** @var \Xmf\Module\Helper\Permission $permHelper */
        $permHelper = $this->helper->getHandler('Permission');
        $criteria   = new \CriteriaCompo();
        if (isset($pid) && (-1 != $pid)) {
            $criteria->add(new \Criteria('pid', $pid));
            if (!$helper->isUserAdmin()) {
                $categoriesGranted = $permHelper->getGrantedItems('category_read');
                if (\is_array($categoriesGranted) && \count($categoriesGranted) > 0) {
                    $criteria->add(new \Criteria('cid', '(' . \implode(',', $categoriesGranted) . ')', 'IN'));
                } else {
                    return 0;
                }
                //                if (\is_object($GLOBALS['xoopsUser'])) {
                //                    $criteria->add(new \Criteria('moderator', $GLOBALS['xoopsUser']->getVar('uid')), 'OR');
                //                }
            }
        }

        return $this->getCount($criteria);
    }

    /**
     * Get all subcats and put them in an array indexed by parent id
     *
     * @param array $categories
     *
     * @return array
     */
    public function getSubCats($categories): array
    {
        $helper   = Helper::getInstance();
        $criteria = new \CriteriaCompo(new \Criteria('pid', '(' . \implode(',', \array_keys($categories)) . ')', 'IN'));
        $ret      = [];
        if (!$helper->isUserAdmin()) {
            $categoriesGranted = $this->helper->getHandler('Permission')->getGrantedItems('category_read');
            if (\count($categoriesGranted) > 0) {
                $criteria->add(new \Criteria('cid', '(' . \implode(',', $categoriesGranted) . ')', 'IN'));
            } else {
                return $ret;
            }

            if (\is_object($GLOBALS['xoopsUser'])) {
                $criteria->add(new \Criteria('moderator', $GLOBALS['xoopsUser']->getVar('uid')), 'OR');
            }
        }
        $criteria->setSort('weight');
        $criteria->order = 'ASC'; // patch for XOOPS <= 2.5.10, does not set order correctly using setOrder() method
        $subcats         = $this->getObjects($criteria, true);
        /** @var Categories $subcat */
        foreach ($subcats as $subcat) {
            $ret[$subcat->getVar('pid')][$subcat->getVar('cid')] = $subcat;
        }

        return $ret;
    }
}
