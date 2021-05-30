<style>
    .card.card--twitter {
        z-index: 0;
    }

    tr th,
    tr td {
        padding-left: 1%;
    }

    tbody tr:hover {
        background-color: #07439326 !important;
        cursor: pointer;
    }

    table#tabela_de_livros tbody tr td {
        /* border: 1px solid #000;*/
    }

    table#tabela_de_livros {
        font-size: 0.8rem !important;
        margin: 0 2% 0 0;
    }
</style>

<figure class="wp-block-table aligncenter is-style-stripes">
    <table class="has-subtle-pale-blue-background-color has-background" id="tabela_de_livros">
        <thead>
            <tr>
                <th class="has-text-align-left" data-align="center">Livro</th>
                <th class="has-text-align-left" data-align="center">Descrição</th>
            </tr>
        </thead>
        <tbody>
            <!-- ✖✔ -->

        </tbody>
        <tfoot>
            <tr>
                <td class="has-text-align-left" data-align="left"></td>
                <td class="has-text-align-left" data-align="left"></td>
                <td class="has-text-align-left" data-align="left"></td>
                <td class="has-text-align-center" data-align="center"></td>
            </tr>
        </tfoot>
    </table>
</figure>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function() {
        //Adiciona o bootstrap antes do utilizado no WP  para não afetar o estilo/layout padrão
        jQuery("head").prepend("<link id='bootstrap_3_4_1' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css' type='text/css' rel='stylesheet' />");

    });

    function appendRow(livro) {
        var data_json_str = JSON.stringify(livro);
        jQuery('#tabela_de_livros').append('' +
            '<tr>' +
            '<td class="has-text-align-left" data-align="left">' + livro.livro + '</td>' +
            '<td class="has-text-align-left" data-align="left">' + livro.descricao + '</td>' +
            '<td class="has-text-align-left" data-align="center">' +
            '<button type="button" class="btn btn-info btn-sm open_mini_resume" data-toggle="modal" old-data-json=\'{"mini_resume":"Curriculo 3 aqui"}\' data-json=\'' + data_json_str + '\' data-target="#livro_details">Ver detalhes</button>' +
            '</td>' +
            '</tr>'
        );
    }


    $(document).ready(function() {
        var tutors_json_url = "http://0.0.0.0:8005/get_csv.php";

        fetch(tutors_json_url)
            .then(
                function(response) {
                    if (response.status !== 200) {
                        console.log('Looks like there was a problem. Status Code: ' +
                            response.status);
                        return;
                    }

                    response.json().then(function(data) {
                        $.each(data, function(i, field) {
                            appendRow(field);
                        });
                        startAfterFetch();
                    });
                }
            )
            .catch(function(err) {
                console.log('Fetch Error :-S', err);
            });

    });
</script>