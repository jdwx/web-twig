<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Twig\Environments\EnvironmentInterface;
use JDWX\Twig\TwigTrait;
use JDWX\Web\Pages\AbstractPage;
use Stringable;


abstract class AbstractTwigPage extends AbstractPage {


    use TwigTrait;


    public function __construct( EnvironmentInterface $env, string $stTemplate, string $i_stContentType = 'text/html',
                                 ?string              $i_nstCharset = null ) {
        parent::__construct( $i_stContentType, $i_nstCharset );
        $this->twigSetTemplate( $env, $stTemplate );
    }


    /** @return iterable<string|Stringable> */
    public function stream() : iterable {
        yield from $this->twigStream();
    }


}
