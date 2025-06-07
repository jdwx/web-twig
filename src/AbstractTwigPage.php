<?php


declare( strict_types = 1 );


namespace JDWX\Twig;


use JDWX\Panels\CssListTrait;
use JDWX\Web\Pages\AbstractHtmlPage;
use JDWX\Web\Pages\HtmlHeadTrait;
use JDWX\Web\Pages\HtmlPageTrait;
use Stringable;
use Twig\Environment;


abstract class AbstractTwigPage extends AbstractHtmlPage {


    use CssListTrait;
    use HtmlHeadTrait;
    use HtmlPageTrait;
    use TwigTrait;


    public function __construct( Environment $env, string $stTemplate, ?string $i_nstDefaultLanguage = null ) {
        parent::__construct( $i_nstDefaultLanguage );
        $this->twigSetTemplate( $env, $stTemplate );
    }


    /** @return iterable<string|Stringable> */
    public function body() : iterable {
        yield from $this->twigStream();
    }


}
