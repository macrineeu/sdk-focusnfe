<?php

namespace Macrineeu\SdkFocusnfe\Requests;

use Exception;

class NfeRequest
{
    public function info(array $data)
    {
        $fieldsRequired = [
            'natureza_operacao',
            'data_emissao',
            'tipo_documento',
            'local_destino',
            'finalidade_emissao',
            'consumidor_final',
            'presenca_comprador'
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

    public function emitente(array $data)
    {
        $cpf = $data['cpf_emitente'] ?? null;
        $cnpj = $data['cnpj_emitente'] ?? null;

        if (!$cpf && !$cnpj) {
            throw new Exception( "É obrigatório informar CNPJ/CPF do emitente!", 1);
        }

        $fieldsRequired = [
            'inscricao_estadual_emitente',
            'logradouro_emitente',
            'numero_emitente',
            'bairro_emitente',
            'municipio_emitente',
            'uf_emitente',
            'regime_tributario_emitente'
        ];

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

        return true;
    }
}