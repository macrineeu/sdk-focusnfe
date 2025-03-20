<?php

namespace Macrineeu\SdkFocusnfe\Traits;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Macrineeu\SdkFocusnfe\Requests\NfeRequest;

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
     * Referencia da UUID
     * @var string $referencia
     */
    protected $referencia;

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

    /**
     * URL de requisição
     * @var string $url
     */
    protected $url;

    public function __construct(string $token, bool $sandbox)
    {
        $this->request = new Client();
        $this->token = $token;
        $this->url = $sandbox ? "https://homologacao.focusnfe.com.br" : "https://api.focusnfe.com.br";
    }

    /**
     * Informa a Referência Interna para o controle da emissão
     * @param string $referencia
     * @return static
     */
    public function referencia(string $referencia): static
    {
        $this->referencia = $referencia;
        return $this;
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

    /**
     * Valida se as informações obrigatórias do emitente foram enviadas
     * @param array $data
     * @return Nfe
     */
    public function emitente(array $data): static
    {
        (new NfeRequest())->emitente($data);

        $this->emitente = $data;
        return $this;
    }

    /**
     * Valida se as informações obrigatórias do destinatário foram enviadas
     * @param array $data
     * @return static
     */
    public function destinatario(array $data): static
    {
        (new NfeRequest())->destinatario($data);

        $this->destinatario = $data;
        return $this;
    }

    /**
     * Valida se as informações obrigatórias do produto foram enviadas
     * @param array $data
     * @return static
     */
    public function itens(array $data): static
    {
        (new NfeRequest())->itens($data);

        $this->itens = $data;
        return $this;
    }

    public function enviar(): array
    {
        if (!$this->referencia) {
            throw new Exception('Referencia da NFe não informada, favor chamar o método referencia()');
        }

        if (!$this->infoEmissao) {
            throw new Exception('Informações Gerais da NFe não informada, favor chamar o método infoEmissao()');
        }

        if (!$this->emitente) {
            throw new Exception('Informações do emitente da NFe não informada, favor chamar o método emitente()');
        }

        if (!$this->destinatario) {
            throw new Exception('Informações do destinatário da NFe não informada, favor chamar o método destinatario()');
        }

        if (!$this->itens) {
            throw new Exception('Informações dos Produtos da NFe não informada, favor chamar o método itens()');
        }

        $body = array_merge($this->infoEmissao, $this->emitente, $this->destinatario, ['itens' => $this->itens]);

        try {
            $response = $this->request->post($this->url . "/v2/nfe?ref={$this->referencia}", [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode("$this->token:")
                ],
                "json" => $body
            ]);

            return [
                'status_code' => $response->getStatusCode(),
                'data' => json_decode($response->getBody())
            ];
        } catch (RequestException $th) {
            return [
                'status_code' => $th->getCode(),
                'exception' => json_decode((string) $th->getResponse()->getBody()) 
            ];
        }
    }
}