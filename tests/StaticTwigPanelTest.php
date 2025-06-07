<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Tests;


use JDWX\Panels\PanelPage;
use JDWX\Twig\AbstractTwigPanel;
use JDWX\Twig\StaticTwigPanel;
use JDWX\Twig\TwigHelper;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( AbstractTwigPanel::class )]
#[CoversClass( StaticTwigPanel::class )]
final class StaticTwigPanelTest extends TestCase {


    public function testToString() : void {
        $sp = new StaticTwigPanel(
            TwigHelper::forDirectory( __DIR__ . '/templates/' ),
            'test',
            [ 'name' => 'world' ]
        );

        $page = new PanelPage( $sp );

        # Check the body.
        self::assertStringContainsString( '<body>Hello, world!</body>', (string) $page );
    }


}
