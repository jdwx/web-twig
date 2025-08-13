<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Web\Framework\AbstractRoute;


class AbstractTwigRoute extends AbstractRoute {


    use TwigRouteTrait;


    private ?string $nstTemplateDir = null;


    protected function getTemplateDirectory() : ?string {
        return $this->nstTemplateDir;
    }


    protected function setTemplateDirectory( string $i_nstTemplateDir ) : void {
        $this->nstTemplateDir = $i_nstTemplateDir;
    }


}
