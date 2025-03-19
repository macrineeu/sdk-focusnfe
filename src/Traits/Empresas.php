<?php

namespace Macrineeu\SdkFocusnfe\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Macrineeu\SdkFocusnfe\Requests\EmpresaRequest;

class Empresas
{
    protected $sandbox;
    protected $token;
    protected $request;

    public function __construct(string $token, bool $sandbox)
    {
        $this->sandbox = $sandbox;
        $this->token = $token;
        $this->request = new Client();
    }

    public function create(array $data): array
    {
        $requiredFields = (new EmpresaRequest())->create($data);

        if (!empty($requiredFields)) {
            return $requiredFields;
        }

        $body = [
            'nome' => $data['nome'],
            'nome_fantasia' => $data['nome_fantasia'],
            'cnpj' => str_replace(['.','-','/'], '', $data['cnpj']),
            'inscricao_estadual' => str_replace(['.','-','/'], '', $data['inscricao_estadual']),
            'inscricao_municipal' => isset($data['inscricao_municipal']) && !empty($data['inscricao_municipal']) ? str_replace(['.','-','/'], '', $data['inscricao_municipal']) : null,
            'regime_tributario' => $data['regime_tributario'],
            'email' => $data['email'],
            'telefone' => str_replace(['(', ')', '-', ' ', '_'], '', $data['telefone']),
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'] ?? null,
            'bairro' => $data['bairro'],
            'cep' => str_replace(['-', ' ', '.'], '', $data['cep']),
            'municipio' => $data['municipio'],
            'uf' => $data['uf'],
            'enviar_email_destinatario' => $data['enviar_email_destinatario'] ?? false,
            'descrimina_impostos' => $data['descrimina_impostos'] ?? false,
            'habilita_nfe' => $data['habilita_nfe'] ?? false,
            'habilita_nfce' => $data['habilita_nfce'] ?? false,
            'mostrar_danfse_badge' => $data['mostra_danfse_badge'] ?? false,
            'enviar_email_homologacao' => $data['enviar_email_homologacao'] ?? false,
            'csc_nfce_producao' => $data['csc_nfce_producao'] ?? null,
            'csc_nfce_homologacao' => $data['csc_nfce_homologacao'] ?? null,
            'id_token_nfce_producao' => $data['id_token_nfce_producao'] ?? null,
            'id_token_nfce_homologacao' => $data['id_token_nfce_homologacao'] ?? null,
            'proximo_numero_nfe_producao' => $data['proximo_numero_nfe_producao'] ?? null,
            'proximo_numero_nfe_homologacao' => $data['proximo_numero_nfe_homologacao'] ?? null,
            'serie_nfe_producao' => $data['serie_nfe_producao'] ?? null,
            'serie_nfe_homologacao' => $data['serie_nfe_homologacao'] ?? null,
            'proximo_numero_nfce_producao' => $data['proximo_numero_nfce_producao'] ?? null,
            'proximo_numero_nfce_homologacao' => $data['proximo_numero_nfce_homologacao'] ?? null,
            'serie_nfce_producao' => $data['serie_nfce_producao'] ?? null,
            'serie_nfce_homologacao' => $data['serie_nfce_homologacao'] ?? null,
        ];

        try {
            $response = $this->request->post( "https://api.focusnfe.com.br/v2/empresas?dry_run=1", [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode("$this->token:")
                ],
                "json" => $body,
            ]);

            return [
                'status_code' => $response->getStatusCode(),
                'data' => json_decode($response->getBody())
            ];
        } catch (ClientException $th) {
            return [
                'status_code' => $th->getCode(),
                'message' => $th->getMessage()
            ];
        }
    }
}