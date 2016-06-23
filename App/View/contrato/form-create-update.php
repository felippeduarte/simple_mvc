<form action="/contrato/<?php echo $action;?>" method="post">
    <input type="hidden" name="id" value="<?php echo $contrato->id;?>" />
    Código: <input type="text" name="codigo" value="<?php echo htmlspecialchars($contrato->codigo);?>" /> <br/>
    Valor: <input type="text" name="valor"  value="<?php echo htmlspecialchars($contrato->valor);?>" /> <br/>
    Cliente: <select name="cliente_id">
    <?php foreach($clientes as $cliente): ?>
        <option
            value="<?php echo $cliente['id'];?>"
            <?php if($cliente['id'] == $contrato->cliente_id) echo "selected";?>
        >
            <?php echo $cliente['nome'] . "-" . $cliente['cpf'];?>
        </option>
    <?php endforeach; ?>
    </select> <br/>
    
    Data Cadastro (dd/mm/aaaa): <input type="text" name="dataCadastro"  value="<?php echo empty($contrato->dataCadastro)? date('d/m/Y') : htmlspecialchars($contrato->dataCadastro);?>" /> <br/>
    <button type="submit">Enviar</button> <button type="button" onclick="javascript:location.href='/contrato/index'">Voltar</a>
</form>