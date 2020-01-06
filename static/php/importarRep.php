<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Importar Reportes</title>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Datatables -->
    <!-- Css de mensaje informativo -->
    <link type="text/css" href="js/css/sweetalert.css" rel="stylesheet">

    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.png" type="image/png" />

    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>

    <script type="text/javascript">

      function MatSelArc() {
        console.log(this.value);
        document.getElementById('inpMatArc').value = document.getElementById('fileMat').files[0].name  + " - Fecha Modif.: " + document.getElementById('fileMat').files[0].lastModifiedDate.toLocaleString('en-GB') + " - Tamaño: " + document.getElementById('fileMat').files[0].size + " bytes" ;
      }

      function ProcSelArc() {
        console.log(this.value);
        document.getElementById('inpProcArc').value = document.getElementById('fileProc').files[0].name  + " - Fecha Modif.: " + document.getElementById('fileProc').files[0].lastModifiedDate.toLocaleString('en-GB') + " - Tamaño: " + document.getElementById('fileProc').files[0].size + " bytes" ;
      }

      function AsigSelArc() {
        console.log(this.value);
        document.getElementById('inpAsigArc').value = document.getElementById('fileAsig').files[0].name  + " - Fecha Modif.: " + document.getElementById('fileAsig').files[0].lastModifiedDate.toLocaleString('en-GB') + " - Tamaño: " + document.getElementById('fileAsig').files[0].size + " bytes" ;
      }

      function EjecSelArc() {
        console.log(this.value);
        document.getElementById('inpEjecArc').value = document.getElementById('fileEjec').files[0].name  + " - Fecha Modif.: " + document.getElementById('fileEjec').files[0].lastModifiedDate.toLocaleString('en-GB') + " - Tamaño: " + document.getElementById('fileEjec').files[0].size + " bytes" ;
      }

      function IngrSelArc() {
        console.log(this.value);
        document.getElementById('inpIngrArc').value = document.getElementById('fileIngr').files[0].name  + " - Fecha Modif.: " + document.getElementById('fileIngr').files[0].lastModifiedDate.toLocaleString('en-GB') + " - Tamaño: " + document.getElementById('fileIngr').files[0].size + " bytes" ;
      }

      function descartArcMat(){
        document.getElementById("fileMat").value = "";
        document.getElementById('inpMatArc').value = "Importación descartada";
      }

      function descartArcProc(){
        document.getElementById("fileProc").value = "";
        document.getElementById('inpProcArc').value = "Importación descartada";
      }

      function descartArcAsig(){
        document.getElementById("fileAsig").value = "";
        document.getElementById('inpAsigArc').value = "Importación descartada";
      }

      function descartArcEjec(){
        document.getElementById("fileEjec").value = "";
        document.getElementById('inpEjecArc').value = "Importación descartada";
      }

      function descartArcIngr(){
        document.getElementById("fileIngr").value = "";
        document.getElementById('inpIngrArc').value = "Importación descartada";
      }
    </script>

    <script type="text/javascript">
      var ray={
      ajax:function(st)
      	{
      		this.show('load');
      	},
      show:function(el)
      	{
      		this.getID(el).style.display='';
      	},
      getID:function(el)
      	{
      		return document.getElementById(el);
      	}
      }
    </script>
<style type="text/css">
#load{
    position:absolute;
    z-index:1;
    border:3px double #999;
    background:#f7f7f7;
    width:300px;
    height:120px;
    margin-top:-150px;
    margin-left:-150px;
    top:50%;
    left:50%;
    text-align:center;
    line-height:100px;
    font-family:"Trebuchet MS", verdana, arial,tahoma;
    font-size:18pt;
  }
</style>



  </head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="clearfix"></div>
      <!-- page content -->
      <div class="right_col" role="main" style="margin-left: 0px;">
        <div class="">
          <h2><span class=""></span><strong>Importar de Reportes</strong><span> SYPELC</span></h2>
          <div id="load" style="display:none;">
            <img  style='width: 80px; height: 80px;' src='images/rubik.gif'>
            Importando...
          </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <form class="form-horizontal form-label-left input_mask" action='impMat.php' method='post' onsubmit="return ray.ajax()" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>Materiales</h3>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div  class="btn btn-success" style="background-color: #26B99A; border-color: #169F85; color: #fff;">
                             <a href="templates/MATERIALES.csv" style="color: #fff;"><i class="fa fa-file-excel-o"></i></a>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div class="custom-input-file">
                             <input type="file" class="input-file" id="fileMat" onchange="MatSelArc()" name="fileMat" placeholder="" required="required" accept=".csv">
                             <i class="fa fa-file-text"></i>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" id="inpMatArc" name="inpMatArc" disabled placeholder="No se ha seleccionado archivo.">
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <center>
                          <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i></button>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <button type="button" class="btn btn-danger" onclick="descartArcMat()"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <form class="form-horizontal form-label-left input_mask" action='impProc.php' method='post' onsubmit="return ray.ajax()" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>Procesos</h3>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div  class="btn btn-success" style="background-color: #26B99A; border-color: #169F85; color: #fff;">
                             <a href="templates/PROCESOS.csv" style="color: #fff;"><i class="fa fa-file-excel-o"></i></a>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div class="custom-input-file">
                             <input type="file" class="input-file" id="fileProc" onchange="ProcSelArc()" name="fileProc" placeholder="" required="required" accept=".csv">
                             <i class="fa fa-file-text"></i>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" id="inpProcArc" name="inpProcArc" disabled placeholder="No se ha seleccionado archivo.">
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <center>
                          <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i></button>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <button type="button" class="btn btn-danger" onclick="descartArcProc()"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <form class="form-horizontal form-label-left input_mask" action='impAsig.php' method='post' onsubmit="return ray.ajax()" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>Asignación</h3>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div  class="btn btn-success" style="background-color: #26B99A; border-color: #169F85; color: #fff;">
                             <a href="templates/ASIGNACION.csv" style="color: #fff;"><i class="fa fa-file-excel-o"></i></a>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div class="custom-input-file">
                             <input type="file" class="input-file" id="fileAsig" onchange="AsigSelArc()" name="fileAsig" placeholder="" required="required" accept=".csv">
                             <i class="fa fa-file-text"></i>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" id="inpAsigArc" name="inpAsigArc" disabled placeholder="No se ha seleccionado archivo.">
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <center>
                          <center>
                            <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i></button>
                          </center>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <button type="button" class="btn btn-danger" onclick="descartArcAsig()"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <form class="form-horizontal form-label-left input_mask" action='impEjec.php' method='post' onsubmit="return ray.ajax()" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>Ejecutadas</h3>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div  class="btn btn-success" style="background-color: #26B99A; border-color: #169F85; color: #fff;">
                             <a href="templates/EJECUTADAS.csv" style="color: #fff;"><i class="fa fa-file-excel-o"></i></a>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div class="custom-input-file">
                             <input type="file" class="input-file" id="fileEjec" onchange="EjecSelArc()" name="fileEjec" placeholder="" required="required" accept=".csv">
                             <i class="fa fa-file-text"></i>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" id="inpEjecArc" name="inpEjecArc" disabled placeholder="No se ha seleccionado archivo.">
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <center>
                          <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i></button>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <button type="button" class="btn btn-danger" onclick="descartArcEjec()"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <form class="form-horizontal form-label-left input_mask" action='impIngr.php' method='post' onsubmit="return ray.ajax()" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>Ingresadas</h3>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div  class="btn btn-success" style="background-color: #26B99A; border-color: #169F85; color: #fff;">
                             <a href="templates/INGRESADAS.csv" style="color: #fff;"><i class="fa fa-file-excel-o"></i></a>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12">
                        <center>
                          <div class="custom-input-file">
                             <input type="file" class="input-file" id="fileIngr" onchange="IngrSelArc()" name="fileIngr" placeholder="" required="required" accept=".csv">
                             <i class="fa fa-file-text"></i>
                          </div>
                        </center>
                      </div>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" id="inpIngrArc" name="inpIngrArc" disabled placeholder="No se ha seleccionado archivo.">
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <center>
                          <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i></button>
                        </center>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-6">
                        <button type="button" class="btn btn-danger" onclick="descartArcIngr()"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>


      </div>
    </div>
  </div>
</div>

<script>!window.jQuery && document.write(unescape('%3Cscript src="../vendors/jquery/dist/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>



  <!-- jQuery -->
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../vendors/nprogress/nprogress.js"></script>
  <!-- iCheck -->
  <script src="../vendors/iCheck/icheck.min.js"></script>

  <!-- bootstrap-daterangepicker -->
  <script src="js/moment/moment.min.js"></script>
  <script src="js/moment/locale/es.js"></script>
  <script src="js/datepicker/daterangepicker.js"></script>

  <!-- Datatables -->
  <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.js"></script>
  <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>

  <!-- Select2 -->
  <script src="../vendors/select2/dist/js/select2.full.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
  <!-- JS De mensaje informativo -->
  <script src="js/sweetalert.min.js"></script>

</body>
</html>


<html>
