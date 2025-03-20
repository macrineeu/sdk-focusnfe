<?php

namespace Macrineeu\SdkFocusnfe\Traits;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Macrineeu\SdkFocusnfe\Requests\NfeRequest;
use Throwable;

class Nfe {

    /**
     * Gluzze Http
     */
    protected $request;

    /**
     * Verifica se o endpoint utilizado será de testes
     * @var bool $sandox
     */
    protected $sandbox;

    /**
     * Informa o token do cliente (Homologação ou Produção)
     * @var string $token
     */
    protected $token;

    /**
     * Informações de Emissão
     * @var array $infoEmissao
     */
    protected $infoEmissao;

    /**
     * Emitente
     * @var array $emitente
     */
    protected $emitente;

    /**
     * Destinatario
     * @var array $destinatario
     */
    protected $destinatario;

    /**
     * Produtos da Emissão
     * @var array $itens
     */
    protected $itens;

    public function __construct(string $token, bool $sandbox)
    {
        $this->request = new Client();
        $this->sandbox = $sandbox;
        $this->token = $token;
    }

    /**
     * Valida se as informações gerais obrigatórias foram enviadas
     * @param array $data
     * @return Nfe
     */
    public function infoEmissao(array $data): static
    {
        (new NfeRequest())->info($data);
        
        $this->infoEmissao = $data;
        return $this;
    }

    
}