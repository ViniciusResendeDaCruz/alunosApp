<!--
    * [Arquivo com o conteúdo a ser inserido na tag <head> do layout padrão do sistema]
    *
    * @category [HTML - View que retorna os atributos de carregamento de plugins da tag <head>]
    * @name     [head.php]
    * @author   [Vinicius Resende <vinicius.resende.cruz@gmail.com>]
    * @version  [1.0.0] 
 -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="<?php echo base_url('asets/plugins/jquery/jquery.js') ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>


<script>
	const BASEURL = '<?php echo base_url() ?>'; //Cria a constante com o URL do servidor para ser usada em todo arquivo javascript
</script>

<title>Alunos App</title>