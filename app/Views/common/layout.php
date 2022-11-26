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
                <div class="navbar navbar-sm navbar-footer border-top">
                    <div class="container-fluid">
                        <span>&copy; 2022 <a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328">Limitless Web App Kit</a></span>

                        <ul class="nav">
                            <li class="nav-item">
                                <a href="https://kopyov.ticksy.com/" class="navbar-nav-link navbar-nav-link-icon rounded" target="_blank">
                                    <div class="d-flex align-items-center mx-md-1">
                                        <i class="ph-lifebuoy"></i>
                                        <span class="d-none d-md-inline-block ms-2">Support</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item ms-md-1">
                                <a href="https://demo.interface.club/limitless/demo/Documentation/index.html" class="navbar-nav-link navbar-nav-link-icon rounded" target="_blank">
                                    <div class="d-flex align-items-center mx-md-1">
                                        <i class="ph-file-text"></i>
                                        <span class="d-none d-md-inline-block ms-2">Docs</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item ms-md-1">
                                <a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link navbar-nav-link-icon text-primary bg-primary bg-opacity-10 fw-semibold rounded" target="_blank">
                                    <div class="d-flex align-items-center mx-md-1">
                                        <i class="ph-shopping-cart"></i>
                                        <span class="d-none d-md-inline-block ms-2">Purchase</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /footer -->
            </div>
            <div class="btn-to-top"><button class="btn btn-secondary btn-icon rounded-pill" type="button"><i class="ph-arrow-up"></i></button></div>

        </div>

    </div>

    <!-- /content -->

</body>

</html>