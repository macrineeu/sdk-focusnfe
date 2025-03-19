<?php

namespace Macrineeu\SdkFocusnfe\Traits;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
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

    public function listAll(): array
    {
        try {
            $response = $this->request->get( "https://api.focusnfe.com.br/v2/empresas", [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode("$this->token:")
                ]
            ]);

            return [
                'status_code' => $response->getStatusCode(),
                'data' => json_decode($response->getBody())
            ];
        } catch (RequestException $th) {
            return [
                'status_code' => $th->getCode(),
                'exception' => (string) $th->getResponse()->getBody() 
            ];
        }
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
            'descrimina_impostos' => $data['descrimina_impostos'] ?? false,
            'cpf_cnpj_contabilidade' => $data['cpf_cnpj_contabilidade'] ?? null,
            'habilita_nfe' => $data['habilita_nfe'] ?? false,
            'habilita_nfce' => $data['habilita_nfce'] ?? false,
            'habilita_nfse' => $data['habilita_nfse'] ?? false,
            'habilita_nfsen_producao' => $data['habilita_nfsen_producao'] ?? false,
            'habilita_nfsen_homologacao' => $data['habilita_nfsen_homologacao'] ?? false,
            'habilita_cte' => $data['habilita_cte'] ?? false,
            'habilita_mdfe' => $data['habilita_mdfe'] ?? false,
            'habilita_manifestacao' => $data['habilita_manifestacao'] ?? false,
            'habilita_manifestacao_cte' => $data['habilita_manifestacao_cte'] ?? false,
            'habilita_contingencia_offline_nfce' => $data['habilita_contingencia_offline_nfce'] ?? false,
            'reaproveita_numero_nfce_contingencia' => $data['reaproveita_numero_nfce_contingencia'] ?? false,
            'orientacao_danfe' => $data['orientacao_danfe'] ?? null,
            'mostrar_danfse_badge' => $data['mostra_danfse_badge'] ?? false,
            'recibo_danfe' => $data['recibo_danfe'] ?? false,
            'exibe_sempre_ipi_danfe' => $data['exibe_sempre_ipi_danfe'] ?? false,
            'exibe_issqn_danfe' => $data['exibe_issqn_danfe'] ?? false,
            'exibe_impostos_adicionais_danfe' => $data['exibe_impostos_adicionais_danfe'] ?? false,
            'exibe_unidade_tributaria_danfe' => $data['exibe_unidade_tributaria_danfe'] ?? false,
            'exibe_sempre_volumes_danfe' => $data['exibe_sempre_volumes_danfe'] ?? false,
            'exibe_composicao_carga_mdfe' => $data['exibe_composicao_carga_mdfe'] ?? false,
            'enviar_email_destinatario' => $data['enviar_email_destinatario'] ?? false,
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
            'proximo_numero_nfse_producao' => $data['proximo_numero_nfse_producao'] ?? null,
            'proximo_numero_nfse_homologacao' => $data['proximo_numero_nfse_homologacao'] ?? null,
            'serie_nfse_producao' => $data['serie_nfse_producao'] ?? null,
            'serie_nfse_homologacao' => $data['serie_nfse_homologacao'] ?? null,
            'proximo_numero_nfsen_producao' => $data['proximo_numero_nfsen_producao'] ?? null,
            'proximo_numero_nfsen_homologacao' => $data['proximo_numero_nfsen_homologacao'] ?? null,
            'serie_nfsen_producao' => $data['serie_nfsen_producao'] ?? null,
            'serie_nfsen_homologacao' => $data['serie_nfsen_homologacao'] ?? null,
            'proximo_numero_cte_producao' => $data['proximo_numero_cte_producao'] ?? null,
            'proximo_numero_cte_homologacao' => $data['proximo_numero_cte_homologacao'] ?? null,
            'serie_cte_producao' => $data['serie_cte_producao'] ?? null,
            'serie_cte_homologacao' => $data['serie_cte_homologacao'] ?? null,
            'proximo_numero_cte_os_producao' => $data['proximo_numero_cte_os_producao'] ?? null,
            'proximo_numero_cte_os_homologacao' => $data['proximo_numero_cte_os_homologacao'] ?? null,
            'serie_cte_os_producao' => $data['serie_cte_os_producao'] ?? null,
            'serie_cte_os_homologacao' => $data['serie_cte_os_homologacao'] ?? null,
            'proximo_numero_mdfe_producao' => $data['proximo_numero_mdfe_producao'] ?? null,
            'proximo_numero_mdfe_homologacao' => $data['proximo_numero_mdfe_homologacao'] ?? null,
            'serie_mdfe_producao' => $data['serie_mdfe_producao'] ?? null,
            'serie_mdfe_homologacao' => $data['serie_mdfe_homologacao'] ?? null,
            'nfe_sincrono' => $data['nfe_sincrono'] ?? null,
            'nfe_sincrono_homologacao' => $data['nfe_sincrono_homologacao'] ?? null,
            'mdfe_sincrono' => $data['mdfe_sincrono'] ?? null,
            'mdfe_sincrono_homologacao' => $data['mdfe_sincrono_homologacao'] ?? null,
            'arquivo_certificado_base64' => $data['arquivo_certificado_base64'] ?? null,
            'senha_certificado' => $data['senha_certificado'] ?? null,
            'certificado_especifico' => $data['certificado_especifico'] ?? false,
            'arquivo_logo_base64' => $data['arquivo_logo_base64'] ?? null,
            'nome_responsavel' => $data['nome_responsavel'] ?? null,
            'cpf_responsavel' => $data['cpf_responsavel'] ?? null,
            'login_responsavel' => $data['login_responsavel'] ?? null,
            'senha_responsavel' => $data['senha_responsavel'] ?? null,
            'senha_responsavel_preenchida' => $data['senha_responsavel_preenchida'] ?? null,
            'data_inicio_recebimento_nfe' => $data['data_inicio_recebimento_nfe'] ?? null,
            'data_inicio_recebimento_cte' => $data['data_inicio_recebimento_cte'] ?? null,
            'smtp_endereco' => $data['smtp_endereco'] ?? null,
            'smtp_dominio' => $data['smtp_dominio'] ?? null,
            'smtp_autenticacao' => $data['smtp_autenticacao'] ?? null,
            'smtp_porta' => $data['smtp_porta'] ?? null,
            'smtp_login' => $data['smtp_login'] ?? null,
            'smtp_senha' => $data['smtp_senha'] ?? null,
            'smtp_remetente' => $data['smtp_remetente'] ?? null,
            'smtp_responder_para' => $data['smtp_responder_para'] ?? null,
            'smtp_modo_verificacao_openssl' => $data['smtp_modo_verificacao_openssl'] ?? null,
            'smtp_habilita_starttls' => $data['smtp_habilita_starttls'] ?? null,
            'smtp_ssl' => $data['smtp_ssl'] ?? null,
            'smtp_tls' => $data['smtp_tls'] ?? null
        ];

        try {
            $response = $this->request->post( "https://api.focusnfe.com.br/v2/empresas" . ($this->sandbox ? '?dry_run=1' : ''), [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode("$this->token:")
                ],
                "json" => $body,
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

    public function update(int $id, array $data): array
    {
        try {
            $response = $this->request->put( "https://api.focusnfe.com.br/v2/empresas/{$id}" . ($this->sandbox ? '?dry_run=1' : ''), [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode("$this->token:")
                ],
                "json" => $data,
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