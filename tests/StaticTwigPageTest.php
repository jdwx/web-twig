<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Tests;


use JDWX\Twig\AbstractTwigPage;
use JDWX\Twig\StaticTwigPage;
use JDWX\Twig\Tests\Shims\TwigTestCase;
use JDWX\Twig\TwigHelper;
use PHPUnit\Framework\Attributes\CoversClass;
use Twig\Environment;


require_once __DIR__ . '/Shims/TwigTestCase.php';


#[CoversClass( AbstractTwigPage::class )]
#[CoversClass( StaticTwigPage::class )]
final class StaticTwigPageTest extends TwigTestCase {


    public function testConstructForFullName() : void {
        $page = $this->newAbstractPage( [ 'name' => 'world' ], 'test.html.twig' );
        self::assertStringContainsString( 'Hello, world!', strval( $page ) );
    }


    public function testConstructForHtmlName() : void {
        $page = $this->newAbstractPage( [ 'name' => 'galaxy' ], 'test.html' );
        self::assertStringContainsString( 'Hello, galaxy!', strval( $page ) );
    }


    public function testConstructForString() : void {
        $env = TwigHelper::forStrings();
        $page = $this->newAbstractPage( [ 'name' => 'multiverse' ], 'Hello, {{ name }}!', $env );
        self::assertStringContainsString( 'Hello, multiverse!', strval( $page ) );
    }


    public function testConstructForTagOnly() : void {
        $page = $this->newAbstractPage( [ 'name' => 'universe' ], 'test' );
        self::assertStringContainsString( 'Hello, universe!', strval( $page ) );
    }


    /** @param array<string, mixed> $i_rValues */
    private function newAbstractPage( array        $i_rValues, string $i_stTemplate,
                                      ?Environment $i_env = null ) : AbstractTwigPage {
        return new StaticTwigPage( $i_env ?? self::newTestEnvironment(), $i_stTemplate, $i_rValues );
    }


}
