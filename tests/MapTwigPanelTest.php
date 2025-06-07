<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Tests;


use Ds\Map;
use JDWX\Panels\PanelPage;
use JDWX\Twig\MapTwigPanel;
use JDWX\Twig\Tests\Shims\TwigTestCase;
use PHPUnit\Framework\Attributes\CoversClass;


require_once __DIR__ . '/Shims/TwigTestCase.php';


#[CoversClass( MapTwigPanel::class )]
final class MapTwigPanelTest extends TwigTestCase {


    public function testToString() : void {
        $map = new Map();
        $map->put( 'name', 'Foo' );
        $twig = new MapTwigPanel( self::newTestEnvironment(), 'test', $map );
        $page = new PanelPage( $twig );
        self::assertStringContainsString( '<body>Hello, Foo!</body>', (string) $page );
    }


}
