<h1 align="center">
    <a href="https://diogosoares.com.br/projetos/laravel_asaas/public/" target="_blank"><img alt="Laravel Asaas" title="Laravel Asaas" src="https://github.com/dgsoaresdev/laravel-asaas/assets/25693566/057de366-bde3-40e3-b446-911eb8562193" width="100%" /></a>

<a href="https://diogosoares.com.br/projetos/laravel_asaas/public/" target="_blank">Acesse o projeto publicado</a>

<h4 align="center"> 
 Version 1.0 🚀 Concluído! 
</h4>

<p align="center">
  
  <img src="https://img.shields.io/static/v1?label=Languages&message=Laravel/PHP/JavaScript/CSS3/HTML5&color=blue&style=flat" />
  	
  <a href="https://twitter.com/DgSoaresTech">
    <img alt="Siga no Twitter" src="https://img.shields.io/twitter/url?url=https://twitter.com/DgSoaresTech">
  </a>
	
   <img alt="License" src="https://img.shields.io/badge/license-MIT-brightgreen">
   
</p>


## 💻 Sobre o projeto
sistema de processamento de pagamentos integrado ao ambiente de homologação do Asaas, levando em consideração que o cliente deve acessar uma página onde irá selecionar a opção de pagamento entre Boleto, Cartão ou Pix.

## 💻 ROADMAP
- Estruturas Globais: 100%
- Routes: 100%
- Controllers: 100%
- Views: 100%
- Models: 100%
- Migrations 100%
- API Asaas: 100%
- Deploy: 100%

## 💻 Testando a aplicação 
A partir dos dados listados abaixo, você poderá realizar testes na aplicação de checkout integrado à Assas, através das opções: PIX, Cartão de Crédito e Boleto.

### Carrinho
- Os dados do carrinho já são automaticamente preenchidos toda vez que você acessa a home (ex: https://diogosoares.com.br/projetos/laravel_asaas/public/).
- Para seguir à tela de checkout, basta clicar no botão "Proceder para o Checkout".

### Checkout: Cadastro
- Preencha todos os dados obrigatórios solicitados no formulário "Dados pessoais")
- Os dados serão salvos utilizados para a criação do usuário na aplicação de checkout e também na Asaas.
- Escolha o método de pagamento: PIX, cartão ou boleto.

### PIX
- Clique no botão "Pagar com segurança", contido no card PIX.
- Aguarde o carregamento da próxima página com o resultado da ação.
- Após a requisição, é esperada uma nova tela, com o QRCODE e chave PIX, junto dos demais dados do pedido.

### Cartão de Crédito
- Preencha todos os campos obrigatórios contidos no card "Cartão de Crédito"
- Nome: Insira um nome qualquer
- Número do cartão: 5515 0436 9862 9208 (gerador na internet)
- Caso queira simular um erro no cartão, é necessário informar o cartão de crédito de número 5184019740373151 (Mastercard) ou 4916561358240741 (Visa).
- Validade: Selecione qualquer mês ou ano (Obs: Na aplicação não foi feita ainda uma validação que impeça o usuário de incluir os meses passados dentro do mesmo ano.)
- CVV: Qualquer número entre 3 e 4 dígitos.
- Parcela: 1
- CPF: Digite um CPF válido.
- Clique em Pagar com segurança
- Se a compra for aprovada, é esperada uma tela de sucesso, com os dados do pedido e também um botão para a ipressão do documento do pagamento.
- Se a compra não for aprovada, é esperado que o usuário permaneça na mesma tela e receba a iformação do motivo da falha no pagamento.
- Nesta situação, a palicação salva o pedido no banco de dados e disponibiliza o checkout do pedido na tela, para que o usuário faça uma nova tentativa de pagamento, mantendo as 3 opções de pagamento como válidas.

### Boleto
- Clique no botão "Pagar com segurança", contido no card Boleto.
- Aguarde o carregamento da próxima página com o resultado da ação.
- Após a requisição, é esperada uma nova tela, com o botão de link para a geração do boleto em PDF.

## 🛠 Tabelas do banco de dados
- Tabela "customers": Guarda os dados de todos os compradores.
- Tabela "orders": Guarda os dados de todos os pedidos.
- Tabela "payments": Guarda os dados de pagamentos:
- payments: Toda tentativa ou efetivação de pagamento é registrada na tabela payments.
- payments: Na tabela payments são guaradados todos os dados referente ao pagamento do pedido.
- payments: A tabela payments se relaciona com as tabelas "customers" através da coluna customer_id e "orders" através da coluna order_id.
  

## 🛠 Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:

- Laravel 8
- PHP 7.4
- Composer 2
- PHP e MySQL
- Bootstrap
- HTML5 e CSS3
- JavaScript
- jQuery
- Ajax

## 🛠 Integrações

Gateway da Asaas
- Documentação da API: https://asaasv3.docs.apiary.io/
- Link do sandbox: https://sandbox.asaas.com/


## 🚀 Como rodar o projeto?

###Pré-requisitos

Também é bom ter um editor para trabalhar com o código como [VSCode][vscode]

### 🎲 Running 
```bash
## Clone este repositório
$ git clone git@github.com:dgsoaresdev/laravel-asaas.git

## Acesse o diretório do projeto via terminal/cmd
$ cd laravel-asaas

##Instale as dependências do projeto, via composer
$ composer install

## Crie as tabelas do banco dados
$ php artisan migrate


```

## 📝 Licence

This project is licensed under the MIT license.

Made with ❤️ by Diogo Soares 👋🏽 [Contact me!](https://www.linkedin.com/in/dgsoares/)


