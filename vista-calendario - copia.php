<?php
# definimos los valores iniciales para nuestro calendario
$month=date("n");
$year=date("Y");
$diaActual=date("j");
 
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
 
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<!--http://www.lawebdelprogramador.com-->
	<title>Ejemplo de un simple calendario en PHP</title>
	<meta charset="utf-8">
	<style>
        /*Estilos contenedor principal*/
        .organizador{
            display: flex;
        }
        /*Estilos tabla*/
		#calendar {
            font-family: Arial, serif;
			font-size:15px;
            margin-right: 30px;
            max-height: 400px;
            width: 500px;
		}
		#calendar caption {
			text-align:left;
			padding:5px 10px;
			background-color:#003366;
			color:#fff;
			font-weight:bold;
		}
		#calendar th {
			background-color:#006699;
			color:#fff;
			width:40px;
		}
		#calendar td {
			text-align:right;
			padding:2px 5px;
			background-color:silver;
		}
		#calendar .hoy {
			background-color:red;
		}
        /*Estilos eventos*/
        #eventos{
            border: #1a1a1a 1px solid;
            width: 500px;
        }
        .titulo{
            text-align: center;
            /*display: block;*/
        }
        .centrar{
            text-align: center;
            padding: 5% 0;
            /*display: block;*/
        }
        button{
            width: 70px;
            height: 40px;
            font-size: 17px;
            font-weight: bold;
        }
	</style>
</head>
 
<body>
<h1>Ejemplo de un simple calendario en PHP</h1>
<div  class="organizador">
    <table id="calendar">
        <caption><?php echo $meses[$month]." ".$year?></caption>
        <tr>
            <th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
            <th>Vie</th><th>Sab</th><th>Dom</th>
        </tr>
        <tr bgcolor="silver">
            <?php
            $last_cell=$diaSemana+$ultimoDiaMes;
            // hacemos un bucle hasta 42, que es el máximo de valores que puede
            // haber... 6 columnas de 7 dias
            for($i=1;$i<=42;$i++)
            {
                if($i==$diaSemana)
                {
                    // determinamos en que dia empieza
                    $day=1;
                }
                if($i<$diaSemana || $i>=$last_cell)
                {
                    // celca vacia
                    echo "<td>&nbsp;</td>";
                }else{
                    // mostramos el dia
                    if($day==$diaActual)
                        echo "<td class='hoy'>$day</td>";
                    else
                        echo "<td>$day</td>";
                    $day++;
                }
                // cuando llega al final de la semana, iniciamos una columna nueva
                if($i%7==0)
                {
                    echo "</tr><tr>\n";
                }
            }
            ?>
        </tr>
    </table>
    <div id="eventos">
        <div class="titulo">
            <h2 class="titulo">
                ¿Quieres añadir un evento?
            </h2>
        </div>
        <div class="centrar">
            <button id="si" class="button">Si</button>
            <button id="no" class="button">No</button>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script>
   $("button").on("click", function(){
       let bid = $(this).attr('id');

       if (bid === "si") {
           if ($('#nocreaEvent').length === 0 && $('#creaEvent').length === 0 ){
               $('#eventos').append('<div id="creaEvent" class="centrar createxto"><textarea name="textarea" rows="10" cols="50" placeholder="Introduce tu evento"></textarea></div>');
           }else{
               $('#nocreaEvent,#creaEvent').remove();
               /*$('#creaEvent').remove();*/
               $('#eventos').append('<div id="creaEvent" class="centrar createxto"><textarea name="textarea" rows="10" cols="50" placeholder="Introduce tu evento"></textarea></div>');
           }
       } else {
           if ($('#nocreaEvent').length === 0 && $('#creaEvent').length === 0 ){
               $('#eventos').append('<h3 id="nocreaEvent" class="centrar">De acuerdo, no se añadirá ningún evento</h3>');
               setTimeout(function() {
                   $('#nocreaEvent').remove();
               }, 2000);
           }else {
               $('#nocreaEvent,#creaEvent').remove();
               /*$('#creaEvent').remove();*/
               $('#eventos').append('<h3 id="nocreaEvent" class="centrar">De acuerdo, no se añadirá ningún evento</h3>');
               setTimeout(function() {
                   $('#nocreaEvent').remove();
               }, 2000);
           }
       }
   });

</script>
</body>
</html>
