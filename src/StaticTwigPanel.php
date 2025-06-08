<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Twig\StaticTwigTrait;
use Twig\Environment;


/**
 * A template page that is populated with a static array of values
 * at the time of instantiation.
 */
class StaticTwigPanel extends AbstractTwigPanel {


    use StaticTwigTrait;


    /** @param array<string, mixed> $rValues */
    public function __construct( Environment $env, string $stTemplate, array $rValues = [] ) {
        parent::__construct( $env, $stTemplate );
        $this->twigSetValues( $rValues );
    }


}
