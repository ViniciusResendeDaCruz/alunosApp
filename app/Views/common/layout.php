<!--
    * [Arquivo com o layout padrão que é extendido , e com isso será usado por outras views.]
    * [esse arquivo carrega os arquivos JS, CSS, Plugins, Título da página e o Footer.]
    * [A tag [CONTENT] recebe o conteúdo passado pela outra view e exibe no layout da página.]
    *
    * @category [HTML - View que retorna a tela renderizada.]
    * @name     [layout.php]
    * @author   [Vinicius Resende <vinicius.resende.cruz@gmail.com>]
    * @version  [1.0.0] 
 -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php echo $this->include('common/head'); ?>

	<?php echo $this->renderSection('head'); ?>

</head>

<body>
	<div class="content">
		<?php echo $this->renderSection('content'); ?>
	</div>

</body>

</html>