<?php
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
} else {
  require 'header.php';

  if ($_SESSION['escritorio'] == 1) {

    require_once "../modelos/Consultas.php";
    $consulta = new Consultas();
    $rsptac = $consulta->totalcomprahoy();
    $regc = $rsptac->fetch_object();
    $totalc = $regc->total_compra;

    $rsptav = $consulta->totalventahoy();
    $regv = $rsptav->fetch_object();
    $totalv = $regv->total_venta;
?>

    <div class="content-wrapper" style="background-image: url('data:image/jpeg;base64,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');">
      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h1 class="box-title">Escritorio</h1>
                <div class="box-tools pull-right">

                </div>
              </div>
              <!--box-header-->
              <!--centro-->
              <div class="panel-body">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h4 style="font-size: 17px;">
                        <strong>S/. <?php echo $totalc; ?> </strong>
                      </h4>
                      <p>Compras</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="ingreso.php" class="small-box-footer">Compras <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h4 style="font-size: 17px;">
                        <strong>S/. <?php echo $totalv; ?> </strong>
                      </h4>
                      <p>Ventas</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="venta.php" class="small-box-footer">Ventas <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
              <!--fin centro-->
            </div>
          </div>
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
<?php
  } else {
    require 'noacceso.php';
  }

  require 'footer.php';
}
ob_end_flush();
?>