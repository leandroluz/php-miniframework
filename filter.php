<?php
//carregas as classes necessárias
include_once 'app.pdo/TExpression.class.php';
include_once 'app.pdo/TFilter.class.php';


// cria filtro por data
$filter1 = new TFilter('data', '=', '2021-04-07');

echo $filter1->dump();
echo "<br>\n";