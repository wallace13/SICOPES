<?php include ("../views/header.php");
include("api/controller/conexao.php");
$_POST['mes'] = isset($_POST['mes']) ? $_POST['mes'] : null;
$_POST['ano'] = isset($_POST['ano']) ? $_POST['ano'] : null;
$_POST['tipo'] = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$_POST['grafico'] = isset($_POST['grafico']) ? $_POST['grafico'] : null;
$_SESSION['ano'] = $_POST['ano'];
$_SESSION['tipo'] = $_POST['tipo'];
//Chama a classe que converte o numero em mês
$_SESSION['Balanco'] = 1;
include("api/controller/converteMes.php");
include("api/model/BalancoDAO.php");
?>
    <table border="1" cellpadding="5" width="800">
        <thead>
            <tr>
                <th colspan="8">Balanço do <?php echo $_POST['tipo'];?> - Balanço Mensal do Mês <?php echo $_SESSION['mes'];?></th>
            </tr>
            <tr>
                <th colspan="2" width="100">Total de Otimos</th>
                <th colspan="2" width="100">Total de Bons</th>
                <th colspan="2" width="100">Total de Regulares</th>
                <th colspan="2" width="100">Total de Ruins</th>
            </tr>
        </thead>
        <tbody>
                <tr align="center">
                    <th >
                        <?php echo $otimo;?>
                    </th>
                    <th>
                        <?php 
                            if ($otimo > 0) {
                                $otimoPercentual = ($otimo/$total)*100; 
                                $formatted_percentage = number_format($otimoPercentual , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $otimoPercentual = 0,' %';
                            }
                        ?>
                    </th>
                    <th>
                        <?php echo $bom;?>
                    </th>
                    <th>
                        <?php 
                            if ($bom > 0) {
                                $bomPercentual = ($bom/$total)*100; 
                                $formatted_percentage = number_format($bomPercentual , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $bomPercentual = 0,' %';
                            }
                        ?>
                    </th>
					<th>
                        <?php echo $regular;?>
                    </th>
                    <th>
                        <?php 
                            if ($regular > 0) {
                                $regularPercentual = ($regular/$total)*100; 
                                $formatted_percentage = number_format($regularPercentual , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $regularPercentual = 0,' %';
                            }
                        ?>
                    </th>
                    <th>
                        <?php echo $ruim;?>
                    </th>
                    <th>
                        <?php 
                            if ($ruim > 0) {
                                $ruimPercentual = ($ruim/$total)*100; 
                                $formatted_percentage = number_format($ruimPercentual , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $ruimPercentual = 0,' %';
                            }
                        ?>
                    </th>
				</tr>
		</tbody>
	</table>
    <!--Grafico Pizza-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Voto', 'Total'],
          ['Otimo',     <?php echo $otimo;?>],
          ['Bom',      <?php echo $bom;?>],
          ['Regular',  <?php echo $regular;?>],
          ['Ruim', <?php echo $ruim;?>],
        ]);

        var options = {
          title:  'Pesquisa de Satisfação - <?php echo $_POST['tipo'];?>',
          backgroundColor: 'white',
          fontName: 'Arial',
          'chartArea': {'width': '90%', 'height': '80%'},
          'legend': {'position': 'bottom'},
          'colors': ['green', 'blue', 'orange', 'red']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <!--Grafico Coluna-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "votos", { role: "style" } ],
            ["Otimo", <?php echo $otimo;?>, "blue"],
            ["Bom", <?php echo $bom;?>, "green"],
            ["Regular", <?php echo $regular;?>, "orange"],
            ["Ruim", <?php echo $ruim;?>, "red"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);

        var options = {
            title:  'Pesquisa de Satisfação - <?php echo $_POST['tipo'];?>',
            backgroundColor: 'white',
            fontName: 'Arial',
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
    </script>
    
    <?php if($_POST['grafico'] == "pizza"){ ?>
        <div id="piechart" style="width: 800px; height: 300px;"></div>
    <?php }else{ ?>
        <div id="columnchart_values" style="width: 800px; height: 300px;"></div>
    <?php } ?>
    <div class="buttons">
        <a class="btn-medium" id="cadastrar" href="TelaConsultaBalanco.php">Voltar</a>
        <h2>Total de Votos:  <?php echo $total;?></h2>
    </div> 
<?php include("../views/footer.php")?>