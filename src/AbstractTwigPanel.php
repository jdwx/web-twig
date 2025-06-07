<?php


declare( strict_types = 1 );


namespace JDWX\Twig;


use JDWX\Panels\AbstractBodyPanel;
use Twig\Environment;


abstract class AbstractTwigPanel extends AbstractBodyPanel {


    use TwigTrait;


    public function __construct( Environment $env, string $stTemplate ) {
        $this->twigSetTemplate( $env, $stTemplate );
    }


    /** @return iterable<string> */
    public function body() : iterable {
        yield from $this->twigStream();
    }


}
