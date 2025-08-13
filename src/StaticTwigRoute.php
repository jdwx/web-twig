<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Framework\RouterInterface;


class StaticTwigRoute extends AbstractTwigRoute {


    protected string $stTemplateName;


    /** @var array<string, mixed> */
    private array $rContext = [];


    /** @param array<string, mixed> $i_rContext */
    public static function make( RouterInterface $i_router, string $i_stTemplateDir, string $i_stTemplateName,
                                 array           $i_rContext = [] ) : static {
        $route = new static( $i_router );
        $route->setTemplateDirectory( $i_stTemplateDir );
        $route->stTemplateName = $i_stTemplateName;
        $route->setContext( $i_rContext );
        return $route;
    }


    public function set( string $i_stKey, mixed $i_xValue ) : void {
        $this->rContext[ $i_stKey ] = $i_xValue;
    }


    /** @param array<string, mixed> $i_rContext */
    public function setContext( array $i_rContext ) : void {
        $this->rContext = $i_rContext;
    }


    public function setTemplateName( string $i_stTemplateName ) : void {
        $this->stTemplateName = $i_stTemplateName;
    }


    protected function handleGET( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        if ( ! isset( $this->stTemplateName ) ) {
            throw new \InvalidArgumentException( 'TEMPLATE_NAME has not been established for ' . static::class );
        }
        $rPieces = explode( '.', $this->stTemplateName );
        $stLast = array_pop( $rPieces );
        while ( 'twig' === $stLast ) {
            $stLast = array_pop( $rPieces );
        }
        $stLast ??= 'txt';
        return match ( $stLast ) {
            default => $this->respondWithStaticTemplateText( $this->stTemplateName, $this->rContext ),
            'html' => $this->respondWithStaticTemplateHtml( $this->stTemplateName, $this->rContext ),
        };
    }


}
