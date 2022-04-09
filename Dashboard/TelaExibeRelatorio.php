<?php include ("../views/header.php");
include("api/controller/conexao.php");
$_POST['mes'] = isset($_POST['mes']) ? $_POST['mes'] : null;
$_POST['ano'] = isset($_POST['ano']) ? $_POST['ano'] : null;
$_POST['tipo'] = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$_SESSION['MesNumero'] = $_POST['mes'];
$_SESSION['ano'] = $_POST['ano'];
$_SESSION['tipo'] = $_POST['tipo'];

//Chama a classe que converte o numero em mês
$_SESSION['Balanco'] = 1;
include("api/controller/converteMes.php");

?>
    <div class="tabela-edicao">
    <table border="1" cellpadding="5" width="800">
        <thead>
            <tr>
                <th colspan="7">Pesquisa de Satisfação do <?php echo $_POST['tipo'];?> - Relatório do Mês de <?php echo $_SESSION['mes'];?></th>
            </tr>
            <tr>
                <th width="100">Data</th>
                <th width="250">Principal</th>
                <th width="50">Otimo</th>
                <th width="50">Bom</th>
                <th width="50">Regular</th>
                <th width="50">Ruim</th>
                <th width="50">Total</th>
            </tr>
        </thead>
        <?php
        if ($_POST['mes'] and $_POST['tipo']) {
            $mes = $_POST['mes'];
            $ano = $_POST['ano'];
            if ($_POST['tipo'] == "Café") {      
                $sql = "select cafe.data, cafe.opcao, votacaocafe.otimo, votacaocafe.bom, votacaocafe.regular, votacaocafe.ruim from cafe, votacaocafe where cafe.idcafe = votacaocafe.idcafe and month(data) = '$mes' and year(data) = '$ano' order by cafe.data asc";
            }else{
                $sql = "select almoco.data, almoco.principal, votacaoalmoco.otimo, votacaoalmoco.bom, votacaoalmoco.regular, votacaoalmoco.ruim from almoco, votacaoalmoco where almoco.idalmoco = votacaoalmoco.idalmoco and month(data) = '$mes' and year(data) = '$ano' order by almoco.data asc";
            }
            $stmt =	$conn->prepare($sql);
            $stmt->execute();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        ?>
        <tbody>
				<tr align="center">
					<th><?php echo $result['data']; ?></th>
                    <?php if ($_POST['tipo'] == "Café") { ?>
                        <td align="left"><?php echo $result['opcao']; ?></td>
                    <?php }else{?>
					    <td align="left"><?php echo $result['principal']; ?></td>
                    <?php }?>
                    <th><?php echo $result['otimo']; ?></th>
					<td><?php echo $result['bom']; ?></td>
                    <th><?php echo $result['regular']; ?></th>
					<td><?php echo $result['ruim']; ?></td>
                    <td><?php echo $total = $result['otimo']+$result['bom']+$result['ruim']+$result['regular'] ; ?></td>
				</tr>
                <tr align="center">
					<td colspan="2" align="right">Percentual: </td>
                    <th>
                        <?php 
                            if ($result['otimo'] > 0) {
                                $otimo = ($result['otimo']/$total)*100; 
                                $formatted_percentage = number_format($otimo , 0);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $otimo = 0,' %';
                            }
                        ?>
                    </th>
					<td>
                        <?php 
                            if ($result['bom'] > 0) {
                                $bom = ($result['bom']/$total)*100; 
                                $formatted_percentage = number_format($bom , 0);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $bom = 0,' %';
                            }
                        ?>
                    </td>
                    <th>
                        <?php 
                            if ($result['regular'] > 0) {
                                $regular = ($result['regular']/$total)*100; 
                                $formatted_percentage = number_format($regular , 0);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $regular = 0,' %';
                            }
                        ?>
                    </th>
					<td>
                        <?php 
                            if ($result['ruim'] > 0) {
                                $ruim = ($result['ruim']/$total)*100; 
                                $formatted_percentage = number_format($ruim , 0);
                                echo ($formatted_percentage),' %';
                            }else{
                                echo $ruim = 0,' %';
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            $soma = $otimo+$bom+$regular+$ruim;
                            echo ($soma), ' %'; 
                        }?>
                    </td>
				</tr>

		</tbody>
	</table>
    </div>
    <div class="orderLabel">
        <div class="buttons">
            <a class="btn-medium" id="cadastrar" href="TelaConsultaRelatorio.php">Voltar</a>
        </div> 	
        <div class="buttons">
			<a class="btn-medium" id="editar" href="api/controller/Relatorio.php">Exportar PDF</a>           
        </div> 	
    </div> 	
<?php }
include("../views/footer.php")?>