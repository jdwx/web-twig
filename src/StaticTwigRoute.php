<?php


declare( strict_types = 1 );


namespace JDWX\Twig\Web;


use JDWX\Web\Framework\ResponseInterface;


class StaticTwigRoute extends AbstractTwigRoute {


    protected const ?string TEMPLATE_NAME = null;


    /** @var array<string, mixed> */
    private array $rContext;


    public function set( string $i_stKey, mixed $i_xValue ) : void {
        $this->rContext[ $i_stKey ] = $i_xValue;
    }


    /** @param array<string, mixed> $i_rContext */
    public function setContext( array $i_rContext ) : void {
        $this->rContext = $i_rContext;
    }


    protected function handleGET( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        $nstTemplateName = static::TEMPLATE_NAME;
        /** @noinspection PhpConditionAlreadyCheckedInspection You're wrong, buddy. */
        if ( ! is_string( $nstTemplateName ) ) {
            throw new \InvalidArgumentException( 'TEMPLATE_NAME has not been established for ' . static::class );
        }
        $rPieces = explode( '.', $nstTemplateName );
        $stLast = array_pop( $rPieces );
        while ( 'twig' === $stLast ) {
            $stLast = array_pop( $rPieces );
        }
        $stLast ??= 'txt';
        return match ( $stLast ) {
            default => $this->respondWithStaticTemplateText( $nstTemplateName, $this->rContext ),
            'html' => $this->respondWithStaticTemplateHtml( $nstTemplateName, $this->rContext ),
        };
    }


}
