<?php


declare( strict_types = 1 );


use JDWX\Twig\Web\AbstractTwigRoute;
use JDWX\Twig\Web\StaticTwigRoute;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Framework\RouteTestRouter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( AbstractTwigRoute::class )]
#[CoversClass( StaticTwigRoute::class )]
final class StaticTwigRouteTest extends TestCase {


    private const string TEMPLATE_DIR = __DIR__ . '/../examples/templates/';


    public function testHandleGETForNoTemplateDir() : void {
        $rtr = new RouteTestRouter();
        $route = new StaticTwigRoute( $rtr );
        $route->setTemplateName( 'static.html.twig' );
        $this->expectException( InvalidArgumentException::class );
        $this->expectExceptionMessage( 'TEMPLATE_DIR has not been established' );
        $rtr->test( $route );
    }


    public function testHandleGETForNoTemplateName() : void {
        $rtr = new RouteTestRouter();
        $route = new class( $rtr ) extends StaticTwigRoute {


            protected const ?string TEMPLATE_DIR = __DIR__ . '/../examples/templates/';


        };
        $this->expectException( InvalidArgumentException::class );
        $this->expectExceptionMessage( 'TEMPLATE_NAME has not been established' );
        $rtr->test( $route );
    }


    public function testRespondWithStaticTemplateHtml() : void {
        $rtr = new RouteTestRouter();
        $route = StaticTwigRoute::make( $rtr, self::TEMPLATE_DIR, 'static.html.twig' );

        $route->set( 'name', 'Foo' );
        $response = $rtr->test( $route );

        self::assertInstanceOf( ResponseInterface::class, $response );
        $st = strval( $response );
        self::assertStringContainsString( '<!DOCTYPE html>', $st ); # Confirm that it responded with HTML.
        self::assertStringContainsString( 'Hello, Foo!', $st );
    }


    public function testRespondWithStaticTemplateText() : void {
        $rtr = new RouteTestRouter();
        $route = StaticTwigRoute::make( $rtr, self::TEMPLATE_DIR, 'static.txt.twig' );
        $route->setContext( [ 'name' => 'Bar' ] );
        $response = $rtr->test( $route );
        self::assertInstanceOf( ResponseInterface::class, $response );
        $st = strval( $response );
        self::assertStringContainsString( 'text/plain', $response->getHeader( 'Content-Type' ) ?? '' );
        self::assertStringNotContainsString( '<!DOCTYPE html>', $st ); # Confirm that it did not respond with HTML.
        self::assertStringContainsString( 'plain text', $st ); # Confirm that it responded with text.
        self::assertStringContainsString( 'Hello, Bar!', $st );
    }


}
