<?php 
include("conexao.php");
$nomeMes = $_SESSION['mes'];
$mes = $_SESSION['MesNumero'];
$tipo = $_SESSION['tipo'];
$ano = $_SESSION['ano'];
?>
    <table border="1" cellpadding="5" width="450">
        <thead>
            <tr>
                <th colspan="7">Pesquisa de Satisfação do <?php echo $tipo;?> - Relatório do Mês de <?php echo $nomeMes;?></th>
            </tr>
            <tr>
                <th width="70">Data</th>
                <th width="180">Principal</th>
                <th width="40">Otimo</th>
                <th width="40">Bom</th>
                <th width="40">Regular</th>
                <th width="40">Ruim</th>
                <th width="40">Total</th>
            </tr>
        </thead>
        <?php
        if ($mes and $tipo) {
            if ($tipo == "Café") { 
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
                    <?php if ($tipo == "Café") { ?>
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
    
<?php }?>
<?php
if ($mes and $tipo) {
    if ($tipo == "Café") { 
        $sql = "select sum(votacaocafe.otimo),sum(votacaocafe.bom),sum(votacaocafe.regular),sum(votacaocafe.ruim) from cafe, votacaocafe where cafe.idcafe=votacaocafe.idcafe and month(data)='$mes' and year(data) = '$ano'";
    }else{
        $sql = "select sum(votacaoalmoco.otimo),sum(votacaoalmoco.bom),sum(votacaoalmoco.regular),sum(votacaoalmoco.ruim) from almoco, votacaoalmoco where almoco.idalmoco=votacaoalmoco.idalmoco and month(data)='$mes' and year(data) = '$ano'";
    }
    $stmt =	$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        if ($tipo == "Café") {  
            $otimo =  $result['sum(votacaocafe.otimo)'];
            $bom = $result['sum(votacaocafe.bom)'];
            $regular = $result['sum(votacaocafe.regular)'];
            $ruim =  $result['sum(votacaocafe.ruim)'];
        }else{
            $otimo = $result['sum(votacaoalmoco.otimo)'];
            $bom = $result['sum(votacaoalmoco.bom)'];
            $regular = $result['sum(votacaoalmoco.regular)'];
            $ruim =  $result['sum(votacaoalmoco.ruim)'];
        }
    }
}
$total = ($otimo+$bom+$ruim+$regular);
?>
    <br><br>  
    <table border="1" cellpadding="3">
        <thead>
            <tr>
                <th colspan="3"><?php echo $tipo;?> - Total</th>
            </tr>
            <tr>
                <th width="100">Descrição</th>
                <th width="100">Total</th>
                <th width="100">Porcentagem</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <th width="100">Otimo</th>
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
                </tr>
                <tr>
                    <th width="100">Bom</th>
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
                </tr>
                <tr>
                    <th width="100">Regular</th>
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
                </tr>
                <tr>
                    <th width="100">Ruim</th>
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