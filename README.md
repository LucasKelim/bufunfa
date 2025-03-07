# Bufunfa

O `Bufunfa` é um projeto pessoal desenvolvido para mim e minha namorada, com o objetivo de ajudar no controle financeiro do nosso dia a dia. O site permite que registremos o nosso salário mensal, além de adicionar as despesas ao longo do mês. As despesas podem ser categorizadas, facilitando a organização e análise dos gastos. O objetivo do `Bufunfa` é proporcionar uma visão clara sobre a distribuição dos recursos ao longo do mês e ajudar no **planejamento financeiro**.

O `Bufunfa` também está sendo utilizado como uma oportunidade para estudar e aprofundar os conhecimentos no **Laravel 12** e na integração com o **Inertia.js** e **Vue.js**.

## Para fazer
- Mostrar dados no dashboard
- Remover cadastro de novos usuários

## Funcionalidades

- Cadastro de salários mensais.
- Adição de categorias de gastos.
- Adição de despesas categorizadas ao longo do mês.
- Visualização do histórico de gastos.
- Controle das finanças de forma simples.

## Tecnologias Utilizadas

- **Backend:** Laravel
- **Frontend:** Vue.js
- **Banco de Dados:** MySQL

## Como Rodar o Projeto

1. Clone o repositório:
  ```bash
  git clone https://github.com/LucasKelim/bufunfa.git
  ```

2. Instale as dependências:
  ```bash
  cd bufunfa
  composer install
  npm install
  ```

3. Configure o banco de dados no arquivo `.env`

4. Rode as migrations e os seeds:
  ```bash
  php artisan migrate --seed
  ```

5. Inicie o servidor:
  ```bash
  composer run dev 
  ```

Agora, o projeto estará disponível em http://localhost:8000.
