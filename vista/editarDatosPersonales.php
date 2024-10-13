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
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1>Datos Personales</h1>
            </div>
        </div>
    </section>
    <section>
        <div class="content" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-info card-outline" style="background-color: #f8f9fa;">
                            <div class="card-body boxprofile">
                                <div class="text-center">
                                    <img src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                                </div>
                                <h3 class="profile-username text-center" style="color:black">Nombres</h3>
                                    <p class="text-muted text-center">Apellidos</p>
                                    <ul class="list group list-group-unbordered mb-3 pl-0 ml-0 ">
                                        <li class="list-group-item" style="background-color: #f8f9fa; color:black" >
                                            <b>Edad</b><a class="float-right">10</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #f8f9fa; color:black">
                                            <b>Edad</b><a class="float-right">10</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #f8f9fa; color:black">
                                            <b>Edad</b><a class="float-right">10</a>
                                        </li>
                                    </ul>
                            </div>
                        </div>
                    </div>
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