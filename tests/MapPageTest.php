<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Tests;


use Ds\Map;
use JDWX\Twig\MapTwigPage;
use JDWX\Twig\TwigHelper;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( MapTwigPage::class )]
final class MapPageTest extends TestCase {


    public function testRender() : void {
        $map = new Map();
        $page = new MapTwigPage( TwigHelper::forDirectory( __DIR__ . '/templates/' ), 'test', $map );
        $page->setTitle( 'TEST_TITLE' );
        $map->put( 'name', 'world' );
        $stPage = strval( $page );
        self::assertStringContainsString( '<title>TEST_TITLE</title>', $stPage );
        self::assertStringContainsString( '<body>Hello, world!</body>', $stPage );

        $map->put( 'name', 'galaxy' );
        self::assertStringContainsString( '<body>Hello, galaxy!</body>', strval( $page ) );
    }


}
