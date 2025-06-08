<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Twig\Environments\EnvironmentInterface;
use JDWX\Twig\StaticTwigTrait;


class StaticTwigPage extends AbstractTwigPage {


    use StaticTwigTrait;


    /** @param array<string, mixed> $rValues */
    public function __construct( EnvironmentInterface $env, string $stTemplate, array $rValues = [] ) {
        parent::__construct( $env, $stTemplate );
        $this->twigSetValues( $rValues );
    }


}
