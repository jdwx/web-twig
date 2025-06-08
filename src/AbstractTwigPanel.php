<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Panels\AbstractBodyPanel;
use JDWX\Twig\Environments\EnvironmentInterface;
use JDWX\Twig\TwigTrait;


abstract class AbstractTwigPanel extends AbstractBodyPanel {


    use TwigTrait;


    public function __construct( EnvironmentInterface $env, string $stTemplate ) {
        $this->twigSetTemplate( $env, $stTemplate );
    }


    /** @return iterable<string> */
    public function body() : iterable {
        yield from $this->twigStream();
    }


}
