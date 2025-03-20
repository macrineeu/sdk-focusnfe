<?php

namespace Macrineeu\SdkFocusnfe\Requests;

use Exception;

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
                    throw new Exception( "A campo {$field} não pode ser vazio ou nulo!", 1);
                }
            }

            if (!array_key_exists($field, $data)) {
                throw new Exception( "A campo {$field} é obrigatório!", 1);
            }
        }

        return $validate;
    }
}