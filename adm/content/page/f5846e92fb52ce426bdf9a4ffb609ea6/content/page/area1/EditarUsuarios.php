

<div class="dynatable dv">

<div class='page-header dataTables_wrapper '>
            <h3 class="no-select"><small class='glyphicon glyphicon-globe ' aria-hidden='true'></small > Tabela com registros</h3><div class='clear'></div>
            </div>
		
<?php 		
if($_SESSION['UsuarioNivel'] == "3"){
echo "

<div class='btn-group '>
  <button type='button' class='btn btn-success dropdown-toggle bttable' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    <span class='glyphicon glyphicon-download' aria-hidden='true'></span> Exportar dados 
  </button>
<ul class='dropdown-menu'>
<!--<li><a href='#' onClick ='$('#my-table').tableExport({type:'json',escape:'false',ignoreColumn: [ 0 ] });'>JSON</a></li>
<li><a href='#' onClick ='$('#my-table').tableExport({type:'json',escape:'false',ignoreColumn: [ 0 ] });'>JSON (ignoreColumn)</a></li>
<li><a href='#' onClick ='$('#my-table').tableExport({type:'json',escape:'true',ignoreColumn: [ 0 ] });'>JSON (with Escape)</a></li>
<li class='divider'></li>    
<li><a href='#' onClick ='$('#my-table').tableExport({type:'xml',escape:'false',ignoreColumn: [ 0 ] });'>XML</a></li>
<li><a href='#' onClick ='$('#my-table').tableExport({type:'sql',ignoreColumn: [ 0 ], tableName:'artigo' });'>SQL</a></li>
<li class='divider'></li>    
<li><a href='#' onClick ='$('#my-table').tableExport({type:'csv',escape:'false',ignoreColumn: [ 0 ] });'>CSV</a></li>
<li><a href='#' onClick ='$('#my-table').tableExport({type:'txt',escape:'false',ignoreColumn: [ 0 ] , separator: ','});'>TXT</a></li>
<li class='divider'></li>	
<li><a href='#' onClick ='$('#my-table').tableExport({type:'excel',escape:'false', ignoreColumn: [ 0 ] });'>XLS</a></li>
<li><a href='#' onClick ='$('#my-table').tableExport({type:'doc',escape:'false', ignoreColumn: [ 0 ] , separator: ',' });'>Word</a></li>
<li><a href='#' onClick ='$('#my-table').tableExport({type:'powerpoint',escape:'false', ignoreColumn: [ 0 ] });'>PowerPoint</a></li>
<li class='divider'></li>   
<li><a href='#' onClick ='$('#my-table').tableExport({type:'png',escape:'false'});'>PNG</a></li>-->
<li><a href='#' target='_blank' onClick ='$('#my-table').tableExport({type:'pdf',pdfFontSize:'7', pdfLeftMargin:-10 , escape:'false',ignoreColumn: [ 0 ]});' >PDF</a></li>
</ul>
</div>

";}


  ?>
<button type="button" onClick='history.go(0)' class="btn btn-warning dropdown-toggle bttable" >
  <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Atualizar
  </button>

  <?php 		
if($_SESSION['UsuarioNivel'] == "3"){
echo "
<label class='on-off '><input type='checkbox' name='ligado' /><span><a></a></span></label>
";}


  ?>


<?php

include "../../core/connect/conexao.php";
$mostraDados = mysqli_query($conecta, "SELECT id_usuario, nome, ativo, data_ultimo, nivel_usuario FROM usuario WHERE nivel_usuario < '3' ORDER BY id_usuario DESC") or die (mysqli_error($mostraDados));





echo "<table id='my-table' class='table'>
<thead>
  <tr>
    <th></th>
    <th>Nome</th>
    <th>Ultimo login</th>
    <th>Ativo</th>
    <th>nivel</th>
    
  </tr>
</thead>";


if(mysqli_num_rows($mostraDados) < 1) {
	echo "<tbody>
      <tr>
	    <td class='op' >
		 </td>
		<td><div class='table_nome'><strong>Nenhum registro</strong></div></td>
        <td></td>
        <td ></td>
        <td></td>
		
		</tr>
	  </tbody>";
}

else {
	while ($linha=mysqli_fetch_array($mostraDados)) {
	$id          = $linha["id_usuario"];
	$nome        = $linha["nome"];
	$ativo       = $linha["ativo"];
	$ultimologin = $linha["data_ultimo"];
    $nivel       = $linha["nivel_usuario"];


 if (isset($_GET['ligado']))
{
$on = "s";
} else {
$on = "n";
}

		if($ativo=="s") {
	    $ativo = "Sim";
		$class = "background:#2ecc71; color:#ffffff; font-weight: bold;";
		$menu = "
		<div class='col-xs-4 col-md-2'>
        <a href='home.php?link=7&acao=bloquear&id=$id' class='thumbnail'>
        <img  src='../../plugin/tab/img/menu-01.png' alt='...'>
        <h5 class='text-center'>Bloquear Usuario</h5>
        </a>
        </div>";
		
		}
		elseif ($ativo=="n" && $ultimologin=="0000-00-00 00:00:00"){
		$ativo = "Não";
		$class = "background:#f0ad4e; color:#ffffff; font-weight: bold;";
		$menu = "
		<div class='col-xs-4 col-md-2'>
        <a href='content/page/area1/core/scriptAcao.php?acao=email&id=$id' class='thumbnail'>
        <img  src='../../plugin/tab/img/menu-04.png' alt='...'>
        <h5 class='text-center'>Re-enviar E-email</h5>
        </a>
        </div>";
		
		}else {	
		$ativo = "Não";
		$class = "background:#e74c3c; color:#ffffff; font-weight: bold;";
		$menu = "
		<div class='col-xs-4 col-md-2'>
        <a href='home.php?link=7&acao=ativar&id=$id' class='thumbnail'>
        <img  src='../../plugin/tab/img/menu-02.png' alt='...'>
        <h5 class='text-center'>Ativar Usuario</h5>
        </a>
        </div>";
		}

		if($nivel=="0") {
			$nivel = "Usuario";
		}

		if($nivel=="1") {
			$nivel = "Moderador";

		}

		if($nivel=="2") {
			$nivel = "Administrador";
		}


		echo "<tbody>
      <tr>
	    <td class='op' >
		 <div class='box'>
          <div class='top'>
          <span class='label label-default nohover'>Opções</span>
          </div>
		  
          <div class='bottom'>";
           
		  include ('menutab/menu_tab_user.php');
		  
        echo "  </div>
        </div>
		</td>
		<td><div class='table_nome'><strong>$nome</strong></div></td>
        <td>$ultimologin</td>
        <td ><div class='badge' style='$class'>$ativo</div></td>
        <td><span class='badge'>$nivel</span></td>
		
		</tr>
	  </tbody>
      ";
	  
	
	}
}

echo "</table>
</div>";


?>
