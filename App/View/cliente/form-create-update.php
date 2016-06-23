<form action="/cliente/<?php echo $action;?>" method="post">
    <input type="hidden" name="id" value="<?php echo $cliente->id;?>" />
    Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente->nome);?>" /> <br/>
    CPF: <input type="text" name="cpf"  value="<?php echo htmlspecialchars($cliente->cpf);?>" /> <br/>
    Telefone: <input type="text" name="telefone" value="<?php echo htmlspecialchars($cliente->telefone);?>" /> <br/>
    Estado: <select id="estado" name="estado" onchange="ajaxGetCidadesPorEstado()">
    <?php foreach($estados as $estado): ?>
        <option
            value="<?php echo $estado['id'];?>"
            <?php if($estado['id'] == $cliente->getCidade()->estado_id) echo "selected";?>
        >
            <?php echo $estado['sigla'] . "-" . $estado['nome'];?>
        </option>
    <?php endforeach; ?>
    </select> <br/>
    Cidade: <select id="cidade" name="cidade_id">
        <?php if(!empty($cliente->cidade_id)): ?>
        <option value="<?php echo $cliente->getCidade()->id;?>" selected><?php echo $cliente->getCidade()->nome;?></option>
        <?php else: ?>
        <option value="">-- Escolha um Estado --</option>
        <?php endif;?>
    </select>
         <br/>
    
    Data Nascimento (dd/mm/aaaa): <input type="text" name="dataNascimento"  value="<?php echo htmlspecialchars($cliente->dataNascimento);?>" /> <br/>
    <button type="submit">Enviar</button> <button type="button" onclick="javascript:location.href='/cliente/index'">Voltar</a>
</form>

<script type="text/javascript">
function ajaxGetCidadesPorEstado() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
            if(xmlhttp.status == 200){
                var dropdownCidade = document.getElementById("cidade");

                //remove todas as opções de cidade
                while(dropdownCidade.options.length > 0)
                {
                    dropdownCidade.remove(0);
                }
                
                var newOptions = eval(xmlhttp.responseText);

                for(var i = 0; i < newOptions.length; i++)
                {

                    var option = document.createElement('option');
                    option.text = newOptions[i].nome;
                    option.value = newOptions[i].id;

                    dropdownCidade.appendChild(option);
                }
            }
            else
            {
                alert('Ocorreu um erro');
            }
        }
    };

    var estado_id = document.getElementById("estado").value;

    xmlhttp.open("GET", "/cidade/ajaxGetCidadesPorEstado/estado_id/"+estado_id, true);
    xmlhttp.send();
}
</script>