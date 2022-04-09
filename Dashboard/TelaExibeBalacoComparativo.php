<?php include ("../views/header.php");
include("api/controller/conexao.php");
$_POST['mes'] = isset($_POST['mes']) ? $_POST['mes'] : null;
$_POST['mes2'] = isset($_POST['mes2']) ? $_POST['mes2'] : null;
$_POST['ano'] = isset($_POST['ano']) ? $_POST['ano'] : null;
$_POST['tipo'] = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$_SESSION['ano'] = $_POST['ano'];
$_SESSION['tipo'] = $_POST['tipo'];

//Chama a classe que converte o numero em mês
$_SESSION['Balanco'] = 2;
include("api/controller/converteMes.php");
include("api/model/BalancoDAO.php");

?>
    <table border="1" cellpadding="5" width="800">
        <thead>
            <tr>
                <th colspan="9"><?php echo $_POST['tipo'];?> - Balanço Comparativo</th>
            </tr>
            <tr>
                <th width="100">Mês</th>
                <th colspan="2" width="100">Total de Otimos</th>
                <th colspan="2" width="100">Total de Bons</th>
                <th colspan="2" width="100">Total de Regulares</th>
                <th colspan="2" width="100">Total de Ruins</th>
            </tr>
        </thead>
        <tbody>
                <!--Mes 1-->
                <tr align="center">
                    <th >
                        <?php echo $_SESSION['mes'];?>
                    </th>
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
                <!--Mes 2-->
                <tr align="center">
                    <th >
                        <?php echo $_SESSION['mes2'];?>
                    </th>
                    <th >
                        <?php echo $otimo2;?>
                    </th>
                    <th>
                        <?php 
                            if ($otimo2 > 0) {
                                $otimoPercentual2 = ($otimo2/$total2)*100; 
                                $formatted_percentage = number_format($otimoPercentual2 , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $otimoPercentual2 = 0,' %';
                            }
                        ?>
                    </th>
                    <th>
                        <?php echo $bom2;?>
                    </th>
                    <th>
                        <?php 
                            if ($bom2 > 0) {
                                $bomPercentual2 = ($bom2/$total2)*100; 
                                $formatted_percentage = number_format($bomPercentual2 , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $bomPercentual2 = 0,' %';
                            }
                        ?>
                    </th>
					<th>
                        <?php echo $regular2;?>
                    </th>
                    <th>
                        <?php 
                            if ($regular2 > 0) {
                                $regularPercentual2 = ($regular2/$total2)*100; 
                                $formatted_percentage = number_format($regularPercentual2 , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $regularPercentual2 = 0,' %';
                            }
                        ?>
                    </th>
                    <th>
                        <?php echo $ruim2;?>
                    </th>
                    <th>
                        <?php 
                            if ($ruim2 > 0) {
                                $ruimPercentual2 = ($ruim2/$total2)*100; 
                                $formatted_percentage = number_format($ruimPercentual2 , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $ruimPercentual2 = 0,' %';
                            }
                        ?>
                    </th>
				</tr>
		</tbody>
	</table>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['', '<?php echo $_SESSION['mes'];?>', '<?php echo $_SESSION['mes2'];?>'],
          ['Otimo',  <?php echo $otimo;?>,      <?php echo $otimo2;?>],
          ['Bom',   <?php echo $bom;?>,       <?php echo $bom2;?>],
          ['Regular',  <?php echo $regular;?>,      <?php echo $regular2;?>],
          ['Ruim',  <?php echo $ruim;?>,      <?php echo $ruim2;?>]
        ]);

        var options = {
          vAxis: {title: 'Votos'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <div id="chart_div" style="width: 800px; height: 300px;"></div>
   
    <div class="buttons">
        <a class="btn-medium" id="cadastrar" href="TelaConsultaBalancoComparativo.php">Voltar</a>
        <div class="voto">
            <h5>Total de Votos: <?php echo $_SESSION['mes'];?>:  <?php echo $total;?>  -</h5> 
            <h5>-  <?php echo $_SESSION['mes2'];?>:  <?php echo $total2;?></h5>
        </div> 
    </div> 
<?php include("../views/footer.php")?>