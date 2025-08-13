<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Panels\PanelPage;
use JDWX\Stream\StreamHelper;
use JDWX\Twig\Environments\EnvironmentInterface;
use JDWX\Twig\TwigHelper;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;


trait TwigRouteTrait {


    abstract protected function getTemplateDirectory() : ?string;


    protected function getTwig() : EnvironmentInterface {
        static $twig = null;
        if ( ! $twig instanceof EnvironmentInterface ) {
            $nstDirectory = $this->getTemplateDirectory();
            if ( ! is_string( $nstDirectory ) ) {
                throw new \InvalidArgumentException( 'TEMPLATE_DIR has not been established for ' . static::class );
            }
            $twig = TwigHelper::forDirectory( $nstDirectory );
        }
        return $twig;
    }


    /** @param array<string, mixed> $i_rContext */
    protected function makeStaticPage( string $i_stTemplateName, array $i_rContext = [] ) : PanelPage {
        return new PanelPage( $this->makeStaticPanel( $i_stTemplateName, $i_rContext ) );
    }


    /** @param array<string, mixed> $i_rContext */
    protected function makeStaticPanel( string $i_stTemplateName, array $i_rContext = [] ) : StaticTwigPanel {
        return new StaticTwigPanel( $this->getTwig(), $i_stTemplateName, $i_rContext );
    }


    /** @param array<string, mixed> $i_rContext */
    protected function respondWithStaticTemplateHtml( string $i_stTemplateName,
                                                      array  $i_rContext = [] ) : ResponseInterface {
        return Response::page( $this->makeStaticPage( $i_stTemplateName, $i_rContext ) );
    }


    /** @param array<string, mixed> $i_rContext */
    protected function respondWithStaticTemplateText( string $i_stTemplateName,
                                                      array  $i_rContext = [], int $i_uStatus = 200,
                                                      string $i_stContentType = 'text/plain' ) : ResponseInterface {
        $panel = $this->makeStaticPanel( $i_stTemplateName, $i_rContext );
        return Response::text( StreamHelper::toString( $panel->body() ), $i_uStatus,
            [ "Content-Type: {$i_stContentType}" ] );
    }


}