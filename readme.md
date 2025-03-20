# SDK FocusNFE

Este SDK foi desenvolvido para facilitar a integração de sistemas com o **FOCUS NFE**, proporcionando uma comunicação rápida, eficiente e segura. A solução foi criada para resolver a falta de um SDK nativo da Focus, permitindo que desenvolvedores integrem suas aplicações com o sistema da NFE de forma simples.

## Motivação

Durante minha experiência em diversos projetos, enfrentei a necessidade de validar informações obrigatórias de forma manual, já que a **Focus** não possuía um SDK nativo. A validação manual demandava muito tempo e esforço, o que me motivou a criar essa solução: um pacote que facilita a integração e automação do processo de comunicação com a NFE, economizando tempo e melhorando a confiabilidade do processo.

## Funcionalidades

- **Validação de Dados**: Validações automáticas para garantir que as informações obrigatórias estejam corretas antes de enviar para a NFE.
- **Emissão de Notas Fiscais**: Facilita a criação e envio de NFE para o sistema da Focus.
- **Documentação Clara e Exemplos**: Fornece exemplos práticos e documentação clara para que você possa começar a usar rapidamente.
- **Integração Simples**: Integração fácil com qualquer sistema, com foco em simplicidade e eficiência.

## Requisitos

- **PHP 7.4+**
- **Composer** para gerenciar dependências

## Instalação

Para instalar o SDK, basta usar o **Composer**. Execute o comando abaixo no diretório do seu projeto:

```bash
composer require macrineeu/sdk-focusnfe
```