<?php /*
session_start();
if($_SESSION['us_tipo']==1){*/
    include_once 'layouts/header.php';
?>
        <title>SISTEMA ODONTOLOGIA</title>
<?php
    include_once 'layouts/nav.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="row mb-1">
            <div class="col-sm-12">
                <div class="card-header">
                        <h1 class="card-title">Mostrar Usuarios</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <!-- New User Button -->
                <div class="col-md-12">
                    <a href="nuevoUsuario.php" class="btn btn-primary">
                        <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
                <div class="card card-info card-outline">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-md-9 col-md-9">
                                    <div class="dt-buttons btn-group flex-wrap">               
                                        <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button">
                                            <span>Copy</span>
                                        </button>
                                        <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button">
                                            <span>CSV</span>
                                        </button>
                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button">
                                            <span>Excel</span>
                                        </button>
                                        <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button">
                                            <span>PDF</span>
                                        </button>
                                        <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button">
                                            <span>Print</span>
                                        </button> <div class="btn-group">
                                        <button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true" aria-expanded="true">
                                            <span>Column visibility</span>
                                            <span class="dt-down-arrow"></span>
                                        </button>
                                        <div class="dt-button-background" style=""></div>
                                        <div class="dt-button-collection" style="top: 38px; left: 285.469px;">
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dt-button dropdown-item buttons-columnVisibility active" tabindex="0" aria-controls="example1" href="#" data-cv-idx="0">
                                                    <span>Rendering engine</span>
                                                </a>
                                                <a class="dt-button dropdown-item buttons-columnVisibility active" tabindex="0" aria-controls="example1" href="#" data-cv-idx="1">
                                                    <span>Browser</span>
                                                </a>
                                                <a class="dt-button dropdown-item buttons-columnVisibility active" tabindex="0" aria-controls="example1" href="#" data-cv-idx="2">
                                                    <span>Platform(s)</span>
                                                </a>
                                                <a class="dt-button dropdown-item buttons-columnVisibility active" tabindex="0" aria-controls="example1" href="#" data-cv-idx="3">
                                                    <span>Engine version</span>
                                                </a>
                                                <a class="dt-button dropdown-item buttons-columnVisibility active" tabindex="0" aria-controls="example1" href="#" data-cv-idx="4">
                                                    <span>CSS grade</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-md-3"><div id="example1_filter" class="dataTables_filter">
                                <label>Search:
                                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row"><div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                            <thead>
                                <tr>   
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="">Rendering engine</th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column descending" style="" aria-sort="ascending">Browser</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="">Platform(s)</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">Engine version</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd">
                                    <td class="dtr-control" tabindex="0" style="">Other browsers</td>
                                    <td class="sorting_1" style="">All others</td>
                                    <td class="" style="">-</td>
                                    <td style="">-</td>
                                    <td style="">U</td>
                                </tr>
                                <tr class="even">
                                    <td class="dtr-control" tabindex="0" style="">Trident</td>
                                    <td class="sorting_1" style="">AOL browser (AOL desktop)</td>
                                    <td class="" style="">Win XP</td><td style="">6</td><td style="">A</td>
                                </tr>
                                <tr class="odd">
                                    <td class="dtr-control" tabindex="0" style="">Gecko</td>
                                    <td class="sorting_1" style="">Camino 1.0</td>
                                    <td class="" style="">OSX.2+</td>
                                    <td class="" style="">1.8</td>
                                    <td class="" style="">A</td>
                                </tr>
                                <tr class="even">
                                    <td class="dtr-control" tabindex="0" style="">Gecko</td>
                                    <td class="sorting_1" style="">Camino 1.5</td>
                                    <td class="" style="">OSX.3+</td><td class="" style="">1.8</td>
                                    <td class="" style="">A</td></tr><tr class="odd">
                                    <td class="dtr-control" tabindex="0" style="">Misc</td>
                                    <td class="sorting_1" style="">Dillo 0.8</td>
                                    <td class="" style="">Embedded devices</td>
                                    <td style="">-</td><td style="">X</td>
                                </tr>
                                <tr class="even">
                                    <td class="dtr-control" tabindex="0" style="">Gecko</td>
                                    <td class="sorting_1" style="">Epiphany 2.20</td>
                                    <td class="" style="">Gnome</td>
                                    <td class="" style="">1.8</td>
                                    <td class="" style="">A</td>
                                </tr>
                                <tr class="odd">
                                    <td class="dtr-control" tabindex="0" style="">Gecko</td>
                                    <td class="sorting_1" style="">Firefox 1.0</td>
                                    <td class="" style="">Win 98+ / OSX.2+</td>
                                    <td style="">1.7</td><td style="">A</td>
                                </tr>
                                <tr class="even">
                                    <td class="dtr-control" tabindex="0" style="">Gecko</td>
                                    <td class="sorting_1" style="">Firefox 1.5</td>
                                    <td class="" style="">Win 98+ / OSX.2+</td
                                    ><td style="">1.8</td>
                                    <td style="">A</td>
                                </tr>
                                <tr class="odd">
                                    <td class="dtr-control" tabindex="0" style="">Gecko</td>
                                    <td class="sorting_1" style="">Firefox 2.0</td>
                                    <td class="" style="">Win 98+ / OSX.2+</td>
                                    <td style="">1.8</td><td style="">A</td>
                                </tr>
                                <tr class="even">
                                    <td class="dtr-control" tabindex="0" style="">Gecko</td>
                                    <td class="sorting_1" style="">Firefox 3.0</td>
                                    <td class="" style="">Win 2k+ / OSX.3+</td>
                                    <td class="" style="">1.9</td>
                                    <td class="" style="">A</td>
                                </tr>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1" style="">Rendering engine</th>
                                    <th rowspan="1" colspan="1" style="">Browser</th>
                                    <th rowspan="1" colspan="1" style="">Platform(s)</th>
                                    <th rowspan="1" colspan="1" style="">Engine version</th>
                                    <th rowspan="1" colspan="1" style="">CSS grade</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-11">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-1"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="example1_previous">
                                    <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                                </li>
                                <li class="paginate_button page-item next" id="example1_next">
                                    <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
    </section>
</div>
<?php 
include_once 'layouts/footer.php'
/*
}
else{
    header('Location: /smileapp/vista/index.php');
}*/
?>