<?php

namespace Macrineeu\SdkFocusnfe\Requests;

class EmpresaRequest
{
    public function create($data): array
    {
        $fieldsRequired = [
            'nome', 
            'nome_fantasia',
            'inscricao_estadual',
            'cnpj',
            'regime_tributario',
            'email',
            'telefone',
            'logradouro',
            'numero',
            'bairro',
            'cep',
            'municipio',
            'uf'
        ];

        $validate = [];

        foreach ($fieldsRequired as $field) {
            if (array_key_exists($field, $data)) {
                if (empty($data[$field])) {
                    $validate[] = [
                        'message' => "A campo {$field} não pode ser vazio ou nulo!"
                    ];
                }
            }

            if (!array_key_exists($field, $data)) {
                $validate[] = [
                    'message' => "A campo {$field} é obrigatório!"
                ];
            }
        }

        return $validate;
    }

    private function requiredInputs(string $key, array $data): array
    {
        if (!isset($data[$key]) || empty($data[$key])) {
            return [
                'message' => "A chave {$key} é obrigatória",
                'status' => 401
            ];
        }

        return [
            'status' => 200
        ];
    }
}