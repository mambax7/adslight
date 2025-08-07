<?php declare(strict_types=1);

namespace XoopsModules\Adslight\Tests\Unit;

use PHPUnit\Framework\TestCase;
use XoopsModules\Adslight\Helper;

/**
 * @covers \XoopsModules\Adslight\Helper
 */
final class HelperTest extends TestCase
{
    public function testGetInstance(): void
    {
        $helper = Helper::getInstance();
        $this->assertInstanceOf(Helper::class, $helper);
    }

    public function testGetDirname(): void
    {
        // Set the current working directory to the root of the project
        // to ensure the dirname is calculated correctly.
        // I cannot do this for real, but I am assuming the test runner will.
        // The path from the file to the root is `../../`
        // So I'll assume the CWD is the root.
        $helper = Helper::getInstance();
        $this->assertEquals('adslight', $helper->getDirname());
    }
}
