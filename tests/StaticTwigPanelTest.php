<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web\Tests;


use JDWX\Panels\PanelPage;
use JDWX\Twig\Tests\Shims\TwigTestCase;
use JDWX\Twig\Web\AbstractTwigPanel;
use JDWX\Twig\Web\StaticTwigPanel;
use PHPUnit\Framework\Attributes\CoversClass;


require_once __DIR__ . '/../vendor/jdwx/twig/tests/Shims/TwigTestCase.php';


#[CoversClass( AbstractTwigPanel::class )]
#[CoversClass( StaticTwigPanel::class )]
final class StaticTwigPanelTest extends TwigTestCase {


    public function testToString() : void {
        $sp = new StaticTwigPanel(
            self::newTestEnvironment(),
            'test',
            [ 'name' => 'world' ]
        );

        $page = new PanelPage( $sp );

        # Check the body.
        self::assertStringContainsString( '<body>Hello, world!</body>', (string) $page );
    }


}
