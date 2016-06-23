<h2> Dados do Cliente </h2>

Nome: <?php echo $cliente->nome;?> <br/>
CPF: <?php echo $cliente->cpf;?> <br/>
Telefone: <?php echo $cliente->telefone;?> <br/>
Estado: <?php echo $cliente->getCidade()->getEstado()->nome; ?><br/>
Cidade: <?php echo $cliente->getCidade()->nome;?><br/>
Data Nascimento: <?php echo $cliente->dataNascimento;?><br/>
<br/>

<h3>Contratos do Cliente</h3>

<table border="1" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Valor</th>
            <th>Data Cadastro</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($contratos as $contrato): ?>
        <tr>
            <td><a href="<?php echo "/contrato/read/id/".$contrato['id'];?>"><?php echo $contrato['id'];?></a></td>
            <td><a href="<?php echo "/contrato/read/id/".$contrato['id'];?>"><?php echo $contrato['codigo'];?></a></td>
            <td><?php echo $contrato['valor'];?></td>
            <td><?php echo $contrato['dataCadastro'];?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br/>

<button type="button" onclick="javascript:location.href='/cliente/index'">Voltar</a>