<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web\Tests;


use Ds\Map;
use JDWX\Twig\Tests\Shims\TwigTestCase;
use JDWX\Twig\Web\MapTwigPage;
use PHPUnit\Framework\Attributes\CoversClass;


require_once __DIR__ . '/../vendor/jdwx/twig/tests/Shims/TwigTestCase.php';


#[CoversClass( MapTwigPage::class )]
final class MapPageTest extends TwigTestCase {


    public function testRender() : void {
        $map = new Map();
        $page = new MapTwigPage( self::newTestEnvironment(), 'test', $map );
        $page->setTitle( 'TEST_TITLE' );
        $map->put( 'name', 'world' );
        $stPage = strval( $page );
        self::assertStringContainsString( '<title>TEST_TITLE</title>', $stPage );
        self::assertStringContainsString( '<body>Hello, world!</body>', $stPage );

        $map->put( 'name', 'galaxy' );
        self::assertStringContainsString( '<body>Hello, galaxy!</body>', strval( $page ) );
    }


}
