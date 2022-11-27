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
<html lang="en" dir="ltr" class="custom-scrollbars" data-color-theme="dark">

<head>
    <?php echo $this->include('common/head'); ?>

    <?php echo $this->renderSection('head'); ?>

</head>

<body>

    <!-- Main navbar -->
    <?php echo $this->include('common/navbar'); ?>
    <!-- /main navbar -->

    <!-- Content -->
    <div class="page-content">

        <div class="content-wrapper">

            <div class="content-inner">
                <div class="content container pt-3">

                    <?php echo $this->renderSection('content'); ?>
                </div>
                <!-- Footer -->
                <?php echo $this->include('common/footer'); ?>
                <!-- /footer -->
            </div>
            <div class="btn-to-top"><button class="btn btn-secondary btn-icon rounded-pill" type="button"><i class="ph-arrow-up"></i></button></div>

        </div>

    </div>

    <!-- /content -->

</body>

</html>