<h2> Dados do Contrato </h2>

Código: <?php echo $contrato->codigo;?> <br/>
Valor: <?php echo $contrato->valor;?> <br/>
Data Cadastro: <?php echo $contrato->dataCadastro;?><br/>
<br/>

<h3>Dados do Cliente</h3>

Nome: <?php echo $contrato->getCliente()->nome;?> <br/>
CPF: <?php echo $contrato->getCliente()->cpf;?> <br/>
Telefone: <?php echo $contrato->getCliente()->telefone;?> <br/>
Estado: <?php echo $contrato->getCliente()->getCidade()->getEstado()->nome; ?><br/>
Cidade: <?php echo $contrato->getCliente()->getCidade()->nome;?><br/>
Data Nascimento: <?php echo $contrato->getCliente()->dataNascimento;?><br/>

<br/>

<button type="button" onclick="javascript:location.href='/contrato/index'">Voltar</a>