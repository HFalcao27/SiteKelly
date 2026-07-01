<?php

try{        //tenta executar o código da conexão, se por acaso o php der ruim ele vai para o catch, lance de if / else 

    $pdo = new PDO ('mysql:host=localhost;dbname=sittekelly','root','');


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //aqui gera um erro detalhado 
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //Limpa e usa menos memoria.

} catch (PDOException $e) { //Se acontecer qualquer erro de conexão entra aqui.

    die("Erro na conexão: " . $e->getMessage()); //Mostra o erro da mensagem.

} //Esse código está com tratamento!

/*<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=sittekelly',
    'root',
    ''
);

?> 

// Esse aqui código aqui apenas cria conexão e só!


*/

?>