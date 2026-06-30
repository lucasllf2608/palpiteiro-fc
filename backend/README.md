# ⚽ Palpiteiro FC - Backend API

O **Palpiteiro FC** é uma API REST desenvolvida para gerenciar um sistema de bolão de jogos de futebol. O principal objetivo deste projeto foi explorar o ecossistema do **PHP com Laravel**, aplicando conceitos de Orientação a Objetos, Clean Code e padrões de arquitetura de software modernos.

---

## 🛠️ Tecnologias e Conceitos Aplicados

* **Framework:** PHP 8.x + Laravel 10/11
* **Banco de Dados:** MySQL / PostgreSQL (via Eloquent ORM)
* **Autenticação:** Laravel Sanctum (Tokens via Bearer Auth)
* **Arquitetura:** Camada de Controle (Controllers) separada da Camada de Regras de Negócio (Services)
* **Tipagem:** Uso de *Type Hinting* moderno do PHP para garantir robustez e segurança

---

## 🚀 Endpoints da API

Abaixo estão os principais endpoints implementados na API:

### 🔒 Autenticação (`AuthController`)
* `POST /api/login` 
    * **Descrição:** Autentica o usuário e retorna o token de acesso (Sanctum).

### 🏟️ Gerenciamento de Partidas (`JogoController`)
* `GET /api/jogos`
    * **Descrição:** Rota pública que retorna os jogos filtrados exclusivamente para o dia atual.
* `POST /api/jogos/{id}/encerrarPartida` *(Protegida)*
    * **Descrição:** Encerra uma partida gravando o placar real e aciona o serviço automático de cálculo de pontos de todos os palpites daquele jogo.

### 🏆 Palpites e Classificação (`PalpiteController`)
* `POST /api/palpites` *(Protegida)*
    * **Descrição:** Registra o palpite do usuário para uma determinada partida.
* `GET /api/ranking` *(Protegida)*
    * **Descrição:** Consolida o ranking geral do bolão, somando os pontos ganhos de cada usuário e ordenando do maior pontuador para o menor.

---

## 🧠 Regra de Pontuação Embutida (Service)

O sistema conta com um algoritmo cirúrgico de pontuação fatiada dentro da `JogoService`, distribuindo os pontos da seguinte forma:

* **Acerto de Tendência (Quem vence ou Empate):** 5 pontos
* **Acerto de Gols do Time Casa:** 2 pontos
* **Acerto de Gols do Time Visitante:** 2 pontos
* **Bônus de Placar Exato:** 3 pontos
* **Pontuação Máxima Possível por jogo:** 12 pontos

---