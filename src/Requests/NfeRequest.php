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
}