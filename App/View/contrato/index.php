<h2> Contratos </h2>

<a href="/contrato/create">Cadastrar Novo</a>
<br/><br/>
<table border="1" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Valor</th>
            <th>Data Cadastro</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($contratos as $contrato): ?>
        <tr>
            <td><a href="<?php echo "/contrato/read/id/".$contrato['id'];?>"><?php echo $contrato['id'];?></a></td>
            <td><a href="<?php echo "/contrato/read/id/".$contrato['id'];?>"><?php echo $contrato['codigo'];?></a></td>
            <td><?php echo $contrato['valor'];?></td>
            <td><?php echo $contrato['dataCadastro'];?></td>
            <td>
                <a href="<?php echo "/contrato/update/id/".$contrato['id'];?>"><i class="fa fa-pencil"></i></a>
                <a href="<?php echo "/contrato/delete/id/".$contrato['id'];?>"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br/>

<?php App\Components\Paginator::printPaginator('contrato', 'index', $pageNum, $pageSize, $numElements); ?>

<br/><br/>
<a href="/contrato/create">Cadastrar Novo</a>
