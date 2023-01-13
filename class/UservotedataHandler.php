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

use Xmf\Module\Helper\Permission;

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
$moduleDirName = \basename(\dirname(__DIR__));
$permHelper    = new Permission();

/**
 * Class UservotedataHandler
 */
class UservotedataHandler extends \XoopsPersistableObjectHandler
{
    private const TABLE      = 'adslight_user_votedata';
    private const ENTITY     = Uservotedata::class;
    private const ENTITYNAME = 'Uservotedata';
    private const KEYNAME    = 'ratingid';
    private const IDENTIFIER = 'ratingid';

    /**
     * Constructor
     * @param \XoopsDatabase|null $xoopsDatabase
     */
    public function __construct(?\XoopsDatabase $xoopsDatabase = null)
    {
        $this->db = $xoopsDatabase;
        parent::__construct($xoopsDatabase, static::TABLE, static::ENTITY, static::KEYNAME, static::IDENTIFIER);
    }
}
