<?php declare(strict_types=1);

/**
 * @param $invoice
 * @return bool
 */
function PaidAdslightlistingHook($invoice): bool
{
    $sql = 'update ' . $GLOBALS['xoopsDB']->prefix('adslight_listing') . ' set `valid` = \'Yes\' where `lid`= "' . $invoice->getVar('key') . '"';
    $GLOBALS['xoopsDB']->queryF($sql);
    require_once $GLOBALS['xoops']->path('/modules/xpayment/plugin/xpayment.php');

    return PaidXPaymentHook($invoice);
}

/**
 * @param $invoice
 * @return bool
 */
function UnpaidAdslightlistingHook($invoice): bool
{
    require_once $GLOBALS['xoops']->path('/modules/xpayment/plugin/xpayment.php');

    return UnpaidXPaymentHook($invoice);
}

/**
 * @param $invoice
 * @return bool
 */
function CancelAdslightlistingHook($invoice): bool
{
    require_once $GLOBALS['xoops']->path('/modules/xpayment/plugin/xpayment.php');

    return CancelXPaymentHook($invoice);
}
