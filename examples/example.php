<?php


declare( strict_types = 1 );


require_once __DIR__ . '/../vendor/autoload.php';


use Ds\Map;
use JDWX\Panels\PanelPage;
use JDWX\Twig\MapTwigPage;
use JDWX\Twig\StaticTwigPage;
use JDWX\Twig\StaticTwigPanel;
use JDWX\Twig\TwigHelper;


class ErrorPage extends PanelPage {


    /** @param array<string, mixed> $i_rValues */
    public function __construct( string $name, array $i_rValues = [] ) {
        # Give it the path to your error templates.
        $env = TwigHelper::forDirectory( __DIR__ . '/templates/' );
        $panel = new StaticTwigPanel( $env, $name, $i_rValues );
        parent::__construct( $panel );
    }


    /** @param array<string, mixed> $i_rValues */
    public static function get( string $name, array $i_rValues = [] ) : string {
        return ( new self( $name, $i_rValues ) )->render();
    }


}


/** @suppress PhanTypeSuspiciousEcho */
( function () : void {

    echo "\n";

    $env = TwigHelper::forDirectory( __DIR__ . '/templates/' );
    $page = new StaticTwigPage( $env, 'static', [ 'name' => 'World' ] );
    echo $page, "\n\n";

    $map = new Map();
    $page = new MapTwigPage( $env, 'map', $map );
    $map->put( 'name', 'Galaxy' );
    echo $page, "\n\n";

    echo ErrorPage::get( 'error404', [ 'return_url' => '/foo/bar/baz' ] ), "\n\n";

} )();