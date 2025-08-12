<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Web\Framework\AbstractRoute;
use JDWX\Web\Framework\RouterInterface;


class AbstractTwigRoute extends AbstractRoute {


    use TwigRouteTrait;


    protected const ?string TEMPLATE_DIR = null;


    public function __construct( RouterInterface $router ) {
        parent::__construct( $router );
        $this->setTemplateDirectory( static::TEMPLATE_DIR );
    }


}
