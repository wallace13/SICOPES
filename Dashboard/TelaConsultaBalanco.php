<?php include ("../views/header.php") ?>
    <h4>Pesquisa de Satisfação - Consultar Balanço Mensal</h4>

    <form action="TelaExibeBalanco.php" method="post">
        <div class="voto">
            <p>Selecione o tipo de Balanço que deseja consultar: </p>
              <input type="radio" name="tipo" value="Café" required>Café
              <input type="radio" name="tipo" value="Almoço" required>Almoço
                <!--Global é igual a soma do Café + Almoço-->
              <input type="radio" name="tipo" value="Global" required>Global
        </div>
        <div class="voto">
            <p>Selecione o ano que deseja pesquisar:</p>
                <select id="ano" name="ano" required>
                <option></option>
                    <?php   
                    for ($i = 2019; $i <= date("Y"); $i++) {
                        print("<option value=$i>$i</option>");
                        
                    }?>
                </select>  
        </div>
        <div class="voto">
            <p>Selecione o mês que deseja consultar:</p>
                <select id="mes" name="mes" required>
                    <option></option>
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="05">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option> 
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>           
                </select>        
        </div>
        <div class="voto">
            <p>Selecione o Grafico que deseja visualizar:</p>
            <input type="radio" name="grafico" value="pizza" required>Pizza
            <input type="radio" name="grafico" value="coluna" required>Coluna
        </div>
        <br>
        <br>
        <div class="buttons">
            <a class="btn-medium" id="cadastrar" href="MenuDeBalancos.php">Voltar</a>
            <input class="btn-medium" id="consultar" type="submit" value="Pesquisar"/>
        </div> 	
    </form>
<?php include("../views/footer.php")?>