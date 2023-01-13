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
$moduleDirName = \basename(\dirname(__DIR__));

$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class RepliesHandler
 */
class RepliesHandler extends \XoopsPersistableObjectHandler
{
    private const TABLE      = 'adslight_replies';
    private const ENTITY     = Replies::class;
    private const ENTITYNAME = 'Replies';
    private const KEYNAME    = 'r_lid';
    private const IDENTIFIER = 'title';
    /**
     * @var Helper
     */
    public $helper;

    /**
     * Constructor
     * @param \XoopsDatabase|null                $db
     * @param \XoopsModules\Adslight\Helper|null $helper
     */
    public function __construct(\XoopsDatabase $db = null, $helper = null)
    {
        /** @var \XoopsModules\Adslight\Helper $this- >helper */
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
}
