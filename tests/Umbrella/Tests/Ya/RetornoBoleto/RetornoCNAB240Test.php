<?php

namespace Umbrella\Tests\Ya\RetornoBoleto;

use Umbrella\Ya\RetornoBoleto\ProcessFactory;
use Umbrella\Ya\RetornoBoleto\ProcessHandler;

class RetornoCNAB240Test extends AbstractCnabTestCase
{

    public function cnabProvider()
    {
        return array(
            array(__DIR__ . '/../../Resources/ret/retorno_cnab240.ret'),
            array(__DIR__ . '/../../Resources/ret/IEDCBR361502201214659.ret')
        );
    }

    /**
     * @dataProvider cnabProvider
     */
    public function testCnab240($fileName)
    {
        $cnab = ProcessFactory::getRetorno($fileName);

        $processor = new ProcessHandler($cnab);
        $retorno = $processor->processar();

        $this->assertInstanceOf("Umbrella\\Ya\\RetornoBoleto\\Retorno", $retorno);

        $this->assertInstanceOf("Umbrella\Ya\RetornoBoleto\Cnab\Cnab240\\Header",
                                $retorno->getHeader());

        $this->assertInstanceOf("Umbrella\Ya\RetornoBoleto\Cnab\Cnab240\\Trailer",
                                $retorno->getTrailer());
    }
}