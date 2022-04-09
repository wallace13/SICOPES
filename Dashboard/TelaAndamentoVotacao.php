<?php include("api/controller/conexao.php"); 
include ("../views/header.php");
include('api/controller/verifica_login.php');

$_POST['data'] = isset($_POST['data']) ? $_POST['data'] : null;
$_POST['tipo'] = isset($_POST['tipo']) ? $_POST['tipo'] : null;

$dataNova = implode("-",array_reverse(explode("/",$_POST['data'])));
if ($_POST['tipo'] == "Café") {  
    $sql = "select * from cafe where Data='$dataNova'";
}else{
    $sql = "select * from almoco where Data='$dataNova'";
}
$stmt =	$conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($_POST['tipo'] == "Café") {  
    if(empty($result)){
        $result['idCafe'] = 0;
        $result['Data'] = " ";
        $result['principal'] = " ";
        $result['opcao'] = " ";
    }
    $idCafe = $result['idCafe'];
    $sql = "select * from votacaoCafe where idCafe='$idCafe'";
}else{
    if(empty($result)){
        $result['idAlmoco'] = 0;
        $result['Data'] = " ";
        $result['salada'] = " ";
        $result['complemento'] = " ";
        $result['principal'] = " ";
        $result['sobremesa'] = " ";
        $result['suco'] = " ";
    }
    $idAlmoco = $result['idAlmoco'];
    $sql = "select * from votacaoalmoco where idAlmoco='$idAlmoco'";
}
$stmt =	$conn->prepare($sql);
$stmt->execute();
$votos = $stmt->fetch(PDO::FETCH_ASSOC);
        
    if(empty($votos)){
        $votos['otimo'] = 0;
        $votos['bom'] = 0;
        $votos['regular'] = 0;
        $votos['ruim'] = 0;
    }

$otimo = $votos['otimo'] ;
$bom = $votos['bom'];
$regular = $votos['regular'];
$ruim = $votos['ruim'];
$total = ($otimo+$bom+$ruim+$regular);
?>

<h4>Pesquisa de Satisfação - Andamento da Votação do  <?php echo $_POST['tipo'];?></h4>
    <table class="tablePequena" cellpadding="2" width="600">
        <thead>
            <tr>
                <th width="400"></th>
                <th width="200"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center">
                    <?php if ($_POST['tipo'] == "Café") {  ?>
                        <p class="textPequeno"><?php echo  implode("/",array_reverse(explode("-",$result['Data'])));?></p>
                        <p class="textPequeno"><?php echo $result['principal'];?></p>
                        <p class="textPequeno"><?php echo $result['opcao'];?></p>
                    <?php }else{ ?>
                        <p class="textPequeno"><?php echo  implode("/",array_reverse(explode("-",$result['Data'])));?></p>
                        <p class="textPequeno"><?php echo $result['salada'];?></p>
                        <p class="textPequeno"><?php echo $result['complemento'];?></p>
                        <p class="textPequeno"><?php echo $result['principal'];?></p>
                        <p class="textPequeno"><?php echo $result['sobremesa'];?></p>
                        <p class="textPequeno"><?php echo $result['suco'];?></p>
                    <?php }?>
                </td>
                <td align="center">
                        <!--Grafico Pizza-->
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                            ['Voto', 'Total'],
                            ['Otimo',     <?php echo $votos['otimo'];?>],
                            ['Bom',      <?php echo $votos['bom'];?>],
                            ['Regular',  <?php echo $votos['regular'];?>],
                            ['Ruim', <?php echo $votos['ruim'];?>],
                            ]);

                            var options = {
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
                    <div id="piechart" style="width: 250px; height: 150px;"></div>
                </td>
            </tr>
        </tbody>
    </table>
        <br>    
    <table class="tablePequena" cellpadding="3" width="600">
        <thead bgcolor="#666666">
            <tr>
                <th width="80">Descrição</th>
                <th width="50">Total</th>
                <th width="70">%</th>
                <th width="400">Gráfico</th>
            </tr>
        </thead>
        <tbody align="center">
            <tr>
                <td align="center">Otimo</td>
                <td align="center"><?php echo $votos['otimo'];?></td>
                <td align="center">
                         <?php 
                            if ($otimo > 0) {
                                $otimoPercentual = ($otimo/$total)*100; 
                                $formatted_percentage = number_format($otimoPercentual , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $otimoPercentual = 0,' %';
                            }
                        ?>
                </td>
                <td rowspan="5">
                    <!--Grafico Coluna-->
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {packages:['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ["Element", "votos", { role: "style" } ],
                            ["Otimo", <?php echo $votos['otimo'];?>, "blue"],
                            ["Bom", <?php echo $votos['bom'];?>, "green"],
                            ["Regular", <?php echo $votos['regular'];?>, "orange"],
                            ["Ruim", <?php echo $votos['ruim'];?>, "red"]
                        ]);

                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                                        { calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation" },
                                        2]);

                        var options = {
                            backgroundColor: 'white',
                            fontName: 'Arial',
                            bar: {groupWidth: "95%"},
                            legend: { position: "none" },
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                        chart.draw(view, options);
                    }
                    </script>
                    <div id="columnchart_values" style="width: 400px; height: 150px;"></div>
                </td>
            </tr>
            <tr>
                <td align="center">Bom</td>
                <td align="center"><?php echo $votos['bom'];?></td>
                <td>
                        <?php 
                            if ($bom > 0) {
                                $bomPercentual = ($bom/$total)*100; 
                                $formatted_percentage = number_format($bomPercentual , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $bomPercentual = 0,' %';
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td align="center">Regular</td>
                <td align="center"><?php echo $votos['regular'];?></td>
                <td>
                        <?php 
                            if ($regular > 0) {
                                $regularPercentual = ($regular/$total)*100; 
                                $formatted_percentage = number_format($regularPercentual , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $regularPercentual = 0,' %';
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td align="center">Ruim</td>
                <td align="center"><?php echo $votos['ruim'];?></td>
                <td>
                        <?php 
                            if ($ruim > 0) {
                                $ruimPercentual = ($ruim/$total)*100; 
                                $formatted_percentage = number_format($ruimPercentual , 1);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $ruimPercentual = 0,' %';
                            }
                        ?>
                </td>
            </tr>
            <tr  bgcolor="#666666">
                <td align="center">Total</td>
                <td align="center"><?php echo $total;?></td>
                <td>
                        <?php 
                            if ($total > 0) {
                                $totalPercentual = ($total/$total)*100; 
                                $formatted_percentage = number_format($totalPercentual);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $totalPercentual = 0,' %';
                            }
                        ?>
                </td>
            </tr>
        </tbody>
    </table>

</section>
    <footer class = "rodape">
        <a class="btn-x-small" href="TelaConsultaAndamento.php">Voltar</a>
    </footer>
<?php include("../views/footer.php")?>