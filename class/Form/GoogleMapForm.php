<?php declare(strict_types=1);

namespace XoopsModules\Adslight\Form;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */

use Xmf\Module\Helper\Permission;
use XoopsModules\Adslight\{
    Helper
};

class GoogleMapForm extends \XoopsFormElementTray
{
    private $apiKey;
    private $latitude;
    private $longitude;
    private $zoom;

    public function __construct($name, $apiKey, $latitude, $longitude, $zoom)
    {
        parent::__construct($name, '<br>');
        $this->apiKey    = $apiKey;
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
        $this->zoom      = $zoom;
    }

    public function render()
    {
        if (empty($this->apiKey)) {
            echo 'API Key is missing';
            exit();
        }

        $xoopsTpl = new \XoopsTpl();
        $xoopsTpl->assign('google_maps_api_key', $this->apiKey);
        $xoopsTpl->assign('google_maps_latitude', $this->latitude);
        $xoopsTpl->assign('google_maps_longitude', $this->longitude);
        $xoopsTpl->assign('google_maps_zoom', $this->zoom);
        $xoopsTpl->display('db:form_google_map.tpl');
    }
}
