<?php
include("api/controller/conexao.php");
date_default_timezone_set('America/Sao_Paulo');
$dataHoje = date("Y-m-d");
//$dataHoje = date("2021-10-06");
$sql = "select * from cafe where Data='$dataHoje'";
$stmt =	$conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if(empty($result)){
    $result['idCafe'] = 0;
    $result['Data'] = " ";
    $result['principal'] = " ";
    $result['opcao'] = " ";
}
?>
<?php include ("../views/header.php") ?>  
        <a name = "votacaoCafe"></a>
        <h4 class="title-votacao">Pesquisa de Satisfação - Café</h4>
        <div class="orderLabel">
            <div name ="idCafe"><?php $_SESSION['Cafe'] = $result['idCafe'];?></div>
        </div> 
        <div class="data">
            <label for="data">Data:</label>
            <?php echo  implode("/",array_reverse(explode("-",$result['Data'])));?>
        </div>
        <div class="orderLabel">
            <label for="principal">Principal:</label>
			<div class="ResultText"><?php echo $result['principal'];?></div>
        </div> 	
        <div class="orderLabel">
            <label for="sobremessa">Opções:</label>
			<div class="ResultText"><?php echo $result['opcao'];?></div>
        </div> 	
        <br><br>
        <?php 
        $idCafe = $result['idCafe'];
        $sql = "select * from votacaocafe where idCafe='$idCafe'";
        $stmt =	$conn->prepare($sql);
        $stmt->execute();
        $votos = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($votos)){
            $votos['otimo'] = 0;
            $votos['bom'] = 0;
            $votos['regular'] = 0;
            $votos['ruim'] = 0;
        }

        ?>
        <form method="post" action="api/model/Vota_Cafe.php">            
        <div class="orderLabel" id="voteAbaixo">Vote Abaixo:</div>
        <div class="orderLabel">
            <div class="orderVote">
                <img src = "../public/img/otimo.png" alt = "projeto">
                <div class="orderLabel" id="votoLabel">Ótimo</div>
                <button class="btn-Vote" id="btnEnvia" name="otimo">Vote</button>
            </div>   
            <div class="orderVote">
                <img src = "../public/img/bom.png" alt = "projeto">
                <div class="orderLabel" id="votoLabel">Bom</div>
                <button class="btn-Vote" id="btnEnvia" name="bom">Vote</button>			
            </div> 	
            <div class="orderVote">
                <img src = "../public/img/regular.png" alt = "projeto">
                <div class="orderLabel" id="votoLabel">Regular</div>
                <button class="btn-Vote" id="btnEnvia" name="regular">Vote</button>
            </div> 	
            <div class="orderVote">
                <img src = "../public/img/ruim.png" alt = "projeto">
                <div class="orderLabel" id="votoLabel">Ruim</div>            
                <button class="btn-Vote" id="btnEnvia" name="ruim">Vote</button>
            </div> 	
        </div>
        </form>
        <?php include("api/controller/exibeModal.php");?>
	</div>
    </section>
    <footer class = "rodape">
        <a class="btn-x-small" href="../index.php">Voltar</a>
    </footer>
    <script src = "../public/js/script.js"></script>

<?php include("../views/footer.php")	?>
