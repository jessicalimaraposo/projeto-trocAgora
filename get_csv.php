<?php
header("Access-Control-Allow-Origin: *");

//--- START FUNCTIONS -------------------------------------------------

function dd($param)
{
    return die(var_dump($param));
}

function getGoogleImgView(string $img_url)
{
    $url_components = parse_url($img_url);;

    parse_str($url_components['query'], $params);

    // Display result
    $img_id = $params['id'] ?? null;

    return $new_url = $img_id ? str_replace('IMG_ID', $img_id, "https://drive.google.com/file/d/IMG_ID/preview") : $img_url;
}

//--- END FUNCTIONS -------------------------------------------------

//$csv = file_get_contents('&single=true&output=csv'); 
//Separado por virgula

//Separado por tab
$csv_j = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQNs-fH6JGaeziWDFtRnSWZ6sauy_IozCXMiBPq4zwbh330003DoLi9CQTBaMLmCKWOxeG9vAWogVAz/pub?gid=1739508532&single=true&output=tsv";
$csv = file_get_contents($csv_j); 

$livros = [];
$linhas = explode("\n", $csv);
unset($linhas[0]);

foreach($linhas as $l)
{
    if(strlen($l) < 20)
        break;

    $_l= explode("\t", $l);
    $livros[] = [
        "timestamp"              => $_l[0],
        "livro"                  => $_l[1], // ocultado por segurança $_l[1],
        "descricao"              => nl2br($_l[2]),
        "tel_contato"            => $_l[3],
        "foto_livro"             => getGoogleImgView($_l[4]),
        "contato_types"          => explode(',', $_l[5]), //Liga\u00e7\u00e3o, WhatsApp
        "public_contacts"        => $_l[6], //bool
        "livro_url"              => $_l[7],
    ];
}

// Carimbo de data/hora
// Nome do livro
// Descrição
// Telefone para contato
// Carregue uma foto do livro
// Formas de Contato
// Cole a URL da imagem do livro

return print_r(json_encode($livros));

