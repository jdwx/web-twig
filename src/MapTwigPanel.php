<?php


declare( strict_types = 1 );


namespace JDWX\Twig;


use Ds\Map;
use Twig\Environment;


class MapTwigPanel extends AbstractTwigPanel {


    use MapTwigTrait;


    /** @param Map<string, mixed> $map */
    public function __construct( Environment $env, string $stTemplate, Map $map ) {
        parent::__construct( $env, $stTemplate );
        $this->twigSetMap( $map );
    }


}
