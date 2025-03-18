<?php

namespace Macrineeu\SdkFocusnfe\Traits;

use Macrineeu\SdkFocusnfe\Requests\EmpresaRequest;

class Empresas
{
    protected $isProduction;
    public function __construct(bool $isProduction = false)
    {
        $this->isProduction = $isProduction;
    }

    public function create($data): array
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
            'inscricao_municipal' => str_replace(['.','-','/'], '', $data['inscricao_municipal']),
            'regime_tributario' => $data['regime_tributario'],
            'email' => $data['email'],
            'telefone' => str_replace(['(', ')', '-', ' ', '_'], '', $data['telefone']),
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cep' => str_replace(['-'], '', $data['cep']),
            'municipio' => $data['municipio'],
            'uf' => $data['uf'],
            'enviar_email_destinatario' => false,
            'descrimina_impostos' => true,
            'habilita_nfe' => true,
            'habilita_nfce' => true,
            'mostrar_danfse_badge' => false,
            'enviar_email_homologacao' => false,
            'csc_nfce_producao' => $data['csc_nfce_producao'],
            'csc_nfce_homologacao' => $data['csc_nfce_homologacao'],
            'id_token_nfce_producao' => $data['id_token_nfce_producao'],
            'id_token_nfce_homologacao' => $data['id_token_nfce_homologacao'],
            'proximo_numero_nfe_producao' => $data['proximo_numero_nfe_producao'],
            'proximo_numero_nfe_homologacao' => $data['proximo_numero_nfe_homologacao'],
            'serie_nfe_producao' => $data['serie_nfe_producao'],
            'serie_nfe_homologacao' => $data['serie_nfe_homologacao'],
            'proximo_numero_nfce_producao' => $data['proximo_numero_nfce_producao'],
            'proximo_numero_nfce_homologacao' => $data['proximo_numero_nfce_homologacao'],
            'serie_nfce_producao' => $data['serie_nfce_producao'],
            'serie_nfce_homologacao' => $data['serie_nfce_homologacao'],
        ];

        return ['production' => $this->isProduction, 'data' => $body];
    }
}