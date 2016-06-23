<h2> Clientes </h2>

<a href="/cliente/create">Cadastrar Novo</a>
<br/><br/>
<table border="1" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Data Nascimento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($clientes as $cliente): ?>
        <tr>
            <td><a href="<?php echo "/cliente/read/id/".$cliente['id'];?>"><?php echo $cliente['id'];?></a></td>
            <td><a href="<?php echo "/cliente/read/id/".$cliente['id'];?>"><?php echo $cliente['nome'];?></a></td>
            <td><?php echo $cliente['cpf'];?></td>
            <td><?php echo $cliente['telefone'];?></td>
            <td><?php echo $cliente['dataNascimento'];?></td>
            <td>
                <a href="<?php echo "/cliente/update/id/".$cliente['id'];?>"><i class="fa fa-pencil"></i></a>
                <a href="<?php echo "/cliente/delete/id/".$cliente['id'];?>"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br/>

<?php App\Components\Paginator::printPaginator('cliente', 'index', $pageNum, $pageSize, $numElements); ?>

<br/><br/>
<a href="/cliente/create">Cadastrar Novo</a>
