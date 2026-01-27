# 🔍 Consultor CNPJ

O **Consultor CNPJ** é um projeto web cujo objetivo é permitir que o usuário informe o **CNPJ de uma empresa** e, a partir disso, o sistema retorne **os dados públicos da empresa de forma clara e organizada**.

---

## 🎯 Objetivo do Projeto

Criar uma página simples e intuitiva onde o usuário possa:

* Informar o CNPJ de uma empresa
* Consultar os dados relacionados a esse CNPJ
* Visualizar as informações de forma rápida, responsiva e amigável

O projeto tem foco em **facilidade de uso**, **organização do código** e **boas práticas de desenvolvimento**.

---

## 🧠 Funcionamento Geral

1. O usuário acessa a página de consulta
2. Informa o **CNPJ** no campo disponível
3. O sistema valida o CNPJ informado
4. O backend processa a requisição
5. Os dados da empresa são retornados e exibidos na tela

Exemplos de dados retornados:

* Razão social
* Nome fantasia
* Situação cadastral
* Data de abertura
* Atividade principal
* Endereço

---

## 🛠️ Tecnologias Utilizadas

O projeto utiliza as seguintes tecnologias:

### 🌐 Frontend

* **HTML5** → Estrutura da página
* **CSS3** → Estilização
* **Bootstrap** → Layout responsivo e componentes visuais
* **JavaScript** → Interações, validações e requisições assíncronas

### ⚙️ Backend

* **PHP** → Processamento das requisições e regras de negócio

### 🗄️ Banco de Dados

* **MySQL** → Armazenamento de dados (logs, histórico de consultas ou cache, se aplicável)

---

## 📂 Estrutura do Projeto (sugestão)

```
consultor-cnpj/
│── public/
│   ├── index.html
│   ├── css/
│   ├── js/
│── backend/
│   ├── consultar-cnpj.php
│── database/
│   ├── schema.sql
│── README.md
```

---

## ✅ Requisitos Funcionais

* Campo para entrada do CNPJ
* Validação básica do CNPJ
* Retorno dos dados da empresa
* Exibição clara das informações
* Interface responsiva

---

## 🚀 Futuras Melhorias

* Máscara automática para o campo de CNPJ
* Histórico de consultas
* Cache de resultados
* Tratamento avançado de erros
* Integração com API externa de consulta

---

## 👨‍💻 Colaboração

O projeto segue um fluxo de trabalho padronizado com uso de branches, commits organizados e merge realizado pelo desenvolvedor responsável.

Consulte o documento de **Fluxo de Trabalho do Projeto** para mais detalhes.

---

## 📌 Considerações Finais

O **Consultor CNPJ** é um projeto voltado para aprendizado, organização e boas práticas no desenvolvimento web, podendo evoluir facilmente para uma aplicação mais robusta no futuro.

Contribuições são bem-vindas 🚀