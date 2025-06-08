<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web\Tests;


use JDWX\Twig\Environments\EnvironmentInterface;
use JDWX\Twig\Tests\Shims\TwigTestCase;
use JDWX\Twig\TwigHelper;
use JDWX\Twig\Web\AbstractTwigPage;
use JDWX\Twig\Web\StaticTwigPage;
use PHPUnit\Framework\Attributes\CoversClass;


require_once __DIR__ . '/../vendor/jdwx/twig/tests/Shims/TwigTestCase.php';


#[CoversClass( AbstractTwigPage::class )]
#[CoversClass( StaticTwigPage::class )]
final class StaticTwigPageTest extends TwigTestCase {


    public function testConstructForFullName() : void {
        $page = $this->newStaticTwigPage( [ 'name' => 'world' ], 'test.html.twig' );
        self::assertSame( 'Hello, world!', strval( $page ) );
    }


    public function testConstructForHtmlName() : void {
        $page = $this->newStaticTwigPage( [ 'name' => 'galaxy' ], 'test.html' );
        self::assertSame( 'Hello, galaxy!', strval( $page ) );
    }


    public function testConstructForString() : void {
        $env = TwigHelper::forStrings();
        $page = $this->newStaticTwigPage( [ 'name' => 'multiverse' ], 'Hello, {{ name }}!', $env );
        self::assertSame( 'Hello, multiverse!', strval( $page ) );
    }


    public function testConstructForTagOnly() : void {
        $page = $this->newStaticTwigPage( [ 'name' => 'universe' ], 'test' );
        self::assertSame( 'Hello, universe!', strval( $page ) );
    }


    /** @param array<string, mixed> $i_rValues */
    private function newStaticTwigPage( array                 $i_rValues, string $i_stTemplate,
                                        ?EnvironmentInterface $i_env = null ) : AbstractTwigPage {
        return new StaticTwigPage( $i_env ?? self::newTestEnvironment(), $i_stTemplate, $i_rValues );
    }


}
