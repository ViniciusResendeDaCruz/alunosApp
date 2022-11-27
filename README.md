[![Acesse a versão ao vivo](https://ohubbi.com.br/wp-content/uploads/2022/11/live_version.png)](https://alunosapp.ohubbi.com.br)

# Alunos App

## A Aplicação
	Sistema feito em PHP com CodeIgniter, com uma tela inicial de menu que leva para um crud de aluno com os campos : nome, endereço e foto. O crud deve permitir o upload da imagem em JPG. 
	Para a entrega, você deve enviar o código fonte completo da sua solução e instruções de instalação. O local de armazenamento das informações deve ser escolhido por você. 
	Extras não obrigatórios : disponibilizar o código na web, permitindo o teste completo da aplicação desenvolvida.

## Instalação

	• O sistema necessita de um servidor local funcionando(**WAMP** recomendado).

	• Um arquivo de banco de dados **MySQL** está disponível dentro da pasta public/database, importe-o no seu servidor MySQL.

	• Use o comando **`composer update`**.

	• O sistema também estará disponível no domínio.

 ## Usabilidade

	• A página inicial conta com uma métrica de alunos cadastrados no sistema e a barra superior de navegação.

	• Ao acessar a área de Alunos na barra superior, você é redirecionado para a tela principal da aplicação.

	• Nesta tela é possível ver um botão para adicionar alunos, logo acima de uma tabela com todos os alunos cadastrados

	• Nesta tabela, cada linha possui, na última célula, opções que podem ser realizadas com o aluno. São essas
		•Visualizar - Mostra os dados do aluno
		•Editar - Edita os dados cadastrados daquele dado aluno
		•Remover - Remove o aluno do banco de dados

 ## Estratégias, ferramentas e tecnologias
	• Foi utilizado um banco de dados MySQL(5.7.36) para armazenagem de dados

	• Foram utilizados os seguintes plugins e bibliotecas
		•Jquery
		•DataTables
		•NotifyJS
		•BlockUI
		•PhosphorIcons
		•Bootstrap
	
	• Foi utilizado o tema Limitless como kit de criação de layout 

	• Para desenvolvimento, foi utilizado um servidor local Apache(2.4.51) com PHP(7.4.26) providos pelo WAMP(3.2.6)