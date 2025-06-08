<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use Ds\Map;
use JDWX\Twig\Environments\EnvironmentInterface;
use JDWX\Twig\MapTwigTrait;


/**
 * Allows populating a Twig template with a Map that can be
 * modified externally up until rendering occurs.
 */
class MapTwigPage extends AbstractTwigPage {


    use MapTwigTrait;


    /** @param Map<string, mixed> $map */
    public function __construct( EnvironmentInterface $env, string $stTemplate, Map $map ) {
        parent::__construct( $env, $stTemplate );
        $this->twigSetMap( $map );
    }


}
