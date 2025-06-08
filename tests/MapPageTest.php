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
        $map->put( 'name', 'map' );
        $stPage = strval( $page );
        self::assertSame( 'Hello, map!', $stPage );

        $map->put( 'name', 'atlas' );
        self::assertSame( 'Hello, atlas!', strval( $page ) );
    }


}
