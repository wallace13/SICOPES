<?php include ("../views/header.php");?>
    <!--Esta Tela só é exibida, caso o usuario tente cadastrar uma data já cadastrada-->
    <h4>Pesquisa de Satisfação</h4>
    <br>
    <?php include("api/controller/exibeMensagem.php");?>
    <br>   
    <br>        
    <div class="buttons">
        <a class="btn-medium" id="cadastrar" href="javascript:history.back();">Voltar</a>

        <?php if($_SESSION['enviar'] == 2){?>
            <a class="btn-medium" id="editar" href="TelaDeEditarCafe.php">Editar</a>    
        <?php }?>
        <?php if($_SESSION['enviar'] == 1){?>
            <a class="btn-medium" id="editar" href="TelaDeEditarAlmoco.php">Editar</a>    
        <?php }?>
        
    </div> 	
<?php include("../views/footer.php")?>
