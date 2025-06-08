<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use Ds\Map;
use JDWX\Twig\MapTwigTrait;
use Twig\Environment;


/**
 * Allows populating a Twig template with a Map that can be
 * modified externally up until rendering occurs.
 */
class MapTwigPage extends AbstractTwigPage {


    use MapTwigTrait;


    /** @param Map<string, mixed> $map */
    public function __construct( Environment $env, string $stTemplate, Map $map ) {
        parent::__construct( $env, $stTemplate );
        $this->twigSetMap( $map );
    }


}
