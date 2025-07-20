# controlador_financeiro_backend
Controlador Financeiro backend

Projeto complementar ao projeto controlador_financeiro desenvolvido em PHP com o framework Laravel 12 contendo as APIs e conexão com o banco de dados.

Contêm dois módulos:
   - Usuários;
   - Transações;

# APIs - Usuários
(GET)/users - Lista os Usuários
(GET)/users/{id} - Lista os Usuários
(GET)/users/{id} - Lista um Usuários
(POST)/users - Adiciona um usuário
(PUT)/users{id} - altera um usuário
(DELETE)/users{id} - Apaga um usuário

# APIs -Login 
(POST)/login - Autentica o usuário

#APIs - Transações
(GET)/transactions - Lista os Usuários
(GET)/transactions/{id} - Lista os Transações
(GET)/transactions/{id} - Lista um Transações
(POST)/transactions - Adiciona um Transações
(PUT)/transactions{id} - altera um Transações
(DELETE)/transactions{id} - Apaga um Transações

# APIs - Filtro
(GET)/transactionsRange/{user_id}/{Date_ini}/{date_end}
(GET)/transactionsType/{user_id}/{type}
