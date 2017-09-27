@extends('index')

@section('scripts')
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".nano").nanoScroller({
                alwaysVisible: true
            });
        });
        function agree() {
            $.ajax({
                url: '/indicacao/agree',
                data: { _token: window.csrfToken },
                dataType: 'json',
                success: function (data) {
                    if (data.status) {
                        window.location.href = '/indicacao'
                    }else{
                        Script._modal('Houve um erro ao aceitar, tente novamente.');
                    }
                },
                error: function () {
                    Script._modal('Houve um erro ao aceitar, Entre em contato conosco.');
                }
            })
        }
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="/js/nanoscroller.css">
    <link rel="stylesheet" type="text/css" href="/site/css/sobre.css">
@endsection

@section('content')
    <div id="content" class="text">
        <div>
            <img id="logo" src="/site/media/images/{{ env('APP_LOGO') }}">

            <div class="nano">
                <div class="nano-content">
                    <p><strong>REGULAMENTO GERAL&nbsp;</strong></p>

                    <p>&nbsp;</p>

                    <p><strong>O que &eacute; o Startup Awards?&nbsp;</strong></p>

                    <p>&nbsp;</p>

                    <p>O Startup Awards &eacute; uma cerim&ocirc;nia de premia&ccedil;&atilde;o para prestigiar os mais influentes agentes do cen&aacute;rio do empreendedorismo digital brasileiro atrav&eacute;s da entrega do primeiro pr&ecirc;mio Startup Awards, em 12 categorias, atrav&eacute;s de indica&ccedil;&atilde;o.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>1. Elegibilidade Indicados:&nbsp;</strong></p>

                    <p>&nbsp;</p>

                    <p>A indica&ccedil;&atilde;o dos nomeados &eacute; p&uacute;blica e ocorrer&aacute; atrav&eacute;s do website da premia&ccedil;&atilde;o (www.startupawards.com.br). Na primeira etapa da premia&ccedil;&atilde;o, o p&uacute;blico indicar&aacute; os nomes que considera mais relevantes para cada categoria de premia&ccedil;&atilde;o. Os 3 (tr&ecirc;s) nomes mais indicados de cada categoria ser&atilde;o revelados no website da premia&ccedil;&atilde;o e o vencedor ser&aacute; revelado no dia 8 de novembro de 2016 no evento CASE &ndash; Confer&ecirc;ncia Anual de Startups e Empreendedorismo.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; Os indicados devem exercer suas atividades em territ&oacute;rio brasileiro.&nbsp;</p>

                    <p>&bull; Todos os produtos e empresas s&atilde;o eleg&iacute;veis para concorrer ao pr&ecirc;mio, desde que estejam de acordo com a descri&ccedil;&atilde;o da categoria e os crit&eacute;rios referentes a esta.&nbsp;</p>

                    <p>&bull; Todos as indica&ccedil;&otilde;es devem ter link de refer&ecirc;ncia para o indicado.&nbsp;</p>

                    <p>&bull; Os indicados podem ser nomeados para mais de uma categoria, e possivelmente podem ganhar o pr&ecirc;mio em m&uacute;ltiplas categorias.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>2. Per&iacute;odo de Participa&ccedil;&atilde;o&nbsp;</strong></p>

                    <p>&nbsp;</p>

                    <p>A participa&ccedil;&atilde;o no evento tem 3 (tr&ecirc;s) fases:&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>1. Fase de indica&ccedil;&atilde;o p&uacute;blica (de 12:00h do dia 11 de outubro de 2016 &agrave;s 23:59h do dia 26 de outubro de 2016).&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>2. Fase de apresenta&ccedil;&atilde;o dos 3 nomes mais indicados em cada categoria para vota&ccedil;&atilde;o (de 12:00h do dia 27 de outubro de 2016 &agrave;s 23:59h do dia 03 de novembro de 2016).&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>3. Fase de premia&ccedil;&atilde;o que ir&aacute; acontecer no dia 8 de novembro de 2016 a partir das 19:00h &agrave;s 22:00h durante o evento CASE no Anhembi em S&atilde;o Paulo.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>O aludido per&iacute;odo de participa&ccedil;&atilde;o compreende o per&iacute;odo em que os participantes poder&atilde;o se inscrever e participar da Campanha.&nbsp;</p>

                    <p>Os hor&aacute;rios refletem o fuso hor&aacute;rio de bras&iacute;lia-DF.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>3. Quem n&atilde;o pode participar</strong>&nbsp;</p>

                    <p>N&atilde;o poder&atilde;o participar (serem indicados em qualquer categoria) empregados da ABStartups (Associa&ccedil;&atilde;o Brasileira de Startups), da Blanko ou de qualquer pessoa relacionada profissionalmente a esta premia&ccedil;&atilde;o bem como seus familiares.&nbsp;</p>

                    <p>&ldquo;Familiares&rdquo; significa qualquer c&ocirc;njuge, parente at&eacute; 3o grau, filho natural ou adotado e irm&atilde;os (sendo natural ou adotado pelos pais), vivendo ou n&atilde;o na mesma casa.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>4. Como Participar&nbsp;</strong></p>

                    <p>&nbsp;</p>

                    <p>O participante dever&aacute; seguir os passos abaixo dentro do per&iacute;odo de participa&ccedil;&atilde;o:&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>1&ordm; passo:&nbsp;</strong></p>

                    <p>Por meio do acesso &agrave; p&aacute;gina online do evento (www.startupawards.com.br), o participante far&aacute; um cadastro com login atrav&eacute;s do Facebook ou login e senha* (*)&nbsp;</p>

                    <p>O participante que optar pela participa&ccedil;&atilde;o atrav&eacute;s de login e senha fica ciente de que ir&aacute; preencher um formul&aacute;rio para as suas indica&ccedil;&otilde;es em cada categoria e este preenchimento mediado para aprova&ccedil;&atilde;o ou n&atilde;o atrav&eacute;s de um comit&ecirc; interno para evitar fraudes.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>PARTICIPANTES COM IP INTERNACIONAL: Apenas poder&atilde;o participar atrav&eacute;s de login/senha.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>2&ordm; passo:&nbsp;</strong></p>

                    <p>Durante a fase de indica&ccedil;&atilde;o, o participante indicar&aacute; os nomes dos candidatos que desejar em cada categoria, de acordo com os crit&eacute;rios de cada uma e inserindo uma refer&ecirc;ncia**. (**) Refer&ecirc;ncia: Cada indica&ccedil;&atilde;o, juntamente com o nome, deve acompanhar um link de acesso de uma p&aacute;gina p&uacute;blica do indicado a fim de contribuir na identifica&ccedil;&atilde;o e an&aacute;lise do perfil dos indicados.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>3&ordm; Passo:&nbsp;</strong></p>

                    <p>Os 3 nomes mais indicados em cada categoria ser&atilde;o apresentados no dia 27 de outubro de 2016 no website do Startup Awards (www.startupawards.com.br) para realiza&ccedil;&atilde;o de vota&ccedil;&atilde;o. Durante a fase de vota&ccedil;&atilde;o, o participante votar&aacute; os nomes dos candidatos que desejar em cada categoria.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>4&ordm; Passo:</strong>&nbsp;</p>

                    <p>O nome mais votado em cada categoria ser&aacute; o vencedor e receber&aacute; o pr&ecirc;mio presencialmente no dia 08 de novembro de 2016 durante o evento CASE - Confer&ecirc;ncia Anual de Startups e Empreendedorismo - no Anhembi em S&atilde;o Paulo. Condi&ccedil;&atilde;o especial: A indica&ccedil;&atilde;o &eacute; restrita a uma vez por pessoa por categoria e por n&uacute;mero de ip. A participa&ccedil;&atilde;o &eacute; gratuita e n&atilde;o &eacute; necess&aacute;ria a compra de nenhum programa, produto ou servi&ccedil;o ABStartups ou qualquer patrocinador/apoiador.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>5. Crit&eacute;rios para premia&ccedil;&atilde;o&nbsp;</strong></p>

                    <p>&nbsp;</p>

                    <p>Todos est&atilde;o convidados a indicar seus candidatos favoritos ao pr&ecirc;mio. At&eacute; uma indica&ccedil;&atilde;o por categoria, por endere&ccedil;o de ip, ser&aacute; contado na vota&ccedil;&atilde;o final.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>O Comit&ecirc; Startup Awards reserva-se no direito de descartar qualquer ou todas as indica&ccedil;&otilde;es consideradas fraudulentos ou enviados por bots (rob&ocirc;s) ou outras aplica&ccedil;&otilde;es de indica&ccedil;&atilde;o geradas por computador.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>Os vencedores finais do pr&ecirc;mio ser&atilde;o determinados com base no maior n&uacute;mero de votos recebidos atrav&eacute;s do site (www.startupawards.com.br). Os vencedores ser&atilde;o anunciados ao vivo na cerim&ocirc;nia de premia&ccedil;&atilde;o a ser realizada no dia 08 de Novembro de 2016, durante o evento CASE - Confer&ecirc;ncia Anual de Startups e Empreendedorismo - no Anhembi (Rua Professor Milton Rodrigues, S/N &ndash; Parque Anhembi &ndash; S&atilde;o Paulo &ndash; SP) Em caso de empate, o vencedor ser&aacute; determinado considerando aquele que tiver recebido o maior n&uacute;mero de indica&ccedil;&otilde;es.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>Permanecendo o empate, o pr&ecirc;mio ser&aacute; dividido entre os indicados, tendo portanto m&uacute;ltiplos vencedores.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>6. Pr&ecirc;mios&nbsp;</strong></p>

                    <p>&nbsp;</p>

                    <p>Cada categoria vencedora receber&aacute; como pr&ecirc;mio o trof&eacute;u Startup Awards e o reconhecimento p&uacute;blico por sua atua&ccedil;&atilde;o destacada, com publica&ccedil;&atilde;o no website e m&iacute;dias eletr&ocirc;nicas do pr&ecirc;mio.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>Os indicados podem concorrer em diversas categorias, desde que sejam eleg&iacute;veis de acordo com a descri&ccedil;&atilde;o da categoria.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; Esse pr&ecirc;mio n&atilde;o inclui passagem a&eacute;rea, nem hospedagem em hotel, assim como tamb&eacute;m n&atilde;o inclui traslados at&eacute; o aeroporto em S&atilde;o Paulo - SP. Os premiados s&atilde;o respons&aacute;veis pela locomo&ccedil;&atilde;o e hospedagem em S&atilde;o Paulo, caso sejam de outros estados.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; &Eacute; de total e exclusiva responsabilidade do premiado todas e quaisquer despesas que n&atilde;o tenham sido expressamente especificadas na descri&ccedil;&atilde;o acima, tais como, gorjetas, taxas de servi&ccedil;o, excurs&otilde;es/passeios, telefonemas, lavanderia, despesas m&eacute;dicas e outras.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p><strong>7. Condi&ccedil;&otilde;es Gerais&nbsp;</strong></p>

                    <p>&nbsp;</p>

                    <p>&bull; Ao participar da campanha o participante declara estar ciente e de acordo com todas as condi&ccedil;&otilde;es estipuladas pelos presentes Termos e Condi&ccedil;&otilde;es.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; A promotora se reserva o direito de verificar a qualquer momento se algum participante cumpre as condi&ccedil;&otilde;es de elegibilidade para participar da Campanha.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>A promotora estar&aacute; isenta de qualquer obriga&ccedil;&atilde;o (incluindo a entrega de pr&ecirc;mios ou qualquer outra) em rela&ccedil;&atilde;o a qualquer participante que tenha participado ou tentado participar da campanha sem cumprir as condi&ccedil;&otilde;es de elegibilidade.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; A promotora n&atilde;o se responsabiliza por qualquer perda ou dano, incluindo, mas n&atilde;o se limitando a danos indiretos ou conseq&uuml;&ecirc;ncias (incluindo econ&ocirc;micos). As condi&ccedil;&otilde;es aqui estabelecidas n&atilde;o afetam quaisquer direitos que o vencedor possua na forma da lei. A responsabilidade da promotora est&aacute; restrita &agrave; premia&ccedil;&atilde;o aqui estabelecidos.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; A promotora se reserva ao direito de n&atilde;o divulgar os n&uacute;meros de indica&ccedil;&otilde;es e vota&ccedil;&atilde;o de cada categoria, empresa, ou finalista. Assim como n&atilde;o ser&atilde;o divulgados os nomes das pessoas que participaram atrav&eacute;s de indica&ccedil;&atilde;o e/ou vota&ccedil;&atilde;o. Ambas informa&ccedil;&otilde;es est&atilde;o restritas ao Comit&ecirc; Startup Awards. N&atilde;o ser&aacute; feita nenhuma recontagem de votos, sob pedido dos participantes.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; Se por alguma raz&atilde;o esta campanha n&atilde;o puder ocorrer conforme planejado, incluindo situa&ccedil;&otilde;es decorrentes de v&iacute;rus de computador, bug, interven&ccedil;&otilde;es n&atilde;o autorizadas, fraude, problemas t&eacute;cnicos ou qualquer outra causa que v&aacute; al&eacute;m do controle da promotora, que corrompa ou interfira numa administra&ccedil;&atilde;o segura e justa do mesmo, a promotora se reserva o direito de cancelar, terminar, modificar ou suspender o mesmo.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; A promotora n&atilde;o assume responsabilidade por erro, omiss&atilde;o, interrup&ccedil;&atilde;o, exclus&atilde;o, defeito, atraso na opera&ccedil;&atilde;o ou transmiss&atilde;o, falha da linha de comunica&ccedil;&otilde;es, roubo ou destrui&ccedil;&atilde;o ou acesso n&atilde;o autorizado, ou altera&ccedil;&atilde;o, das inscri&ccedil;&otilde;es.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&nbsp;A promotora n&atilde;o &eacute; respons&aacute;vel por nenhum problema ou mau funcionamento das linhas de rede ou telef&ocirc;nicas, sistemas online de computadores, servidores ou provedores, equipamento do computador, software, falhas t&eacute;cnicas ou congestionamento da internet ou em qualquer website nos e-mails ou nas inscri&ccedil;&otilde;es a serem recebidas pela promotora. Aten&ccedil;&atilde;o: Qualquer ato que deliberadamente tenha por finalidade prejudicar os websites da promotora ou de qualquer outra forma causar preju&iacute;zo &agrave; mesma ou a terceiros de boa f&eacute;, poder&aacute; ser considerado uma viola&ccedil;&atilde;o civil e criminal, reservando-se a promotora o direito de promover todas as a&ccedil;&otilde;es permitidas pela lei para recuperar os danos ocasionados por tais atos. A promotora se reserva o direito de desqualificar qualquer indiv&iacute;duo que violar os presentes termos.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; A promotora &eacute; a Associa&ccedil;&atilde;o Brasileira de Startups, com sede a Rua Casa do Ator 919, Vila Ol&iacute;mpia, no munic&iacute;pio de S&atilde;o paulo, estado de S&atilde;o Paulo, Cep 04570001, inscrita no CNPJ sob o n&uacute;mero 19.939.915/0001-95.&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&bull; No ato da inscri&ccedil;&atilde;o fica a promotora autorizada a utilizar &ndash; durante a vig&ecirc;ncia desta campanha e por um per&iacute;odo adicional de 60 (sessenta) meses - nomes, imagens e vozes dos inscritos, sem que isso implique em qualquer tipo de &ocirc;nus a Associa&ccedil;&atilde;o Brasileira de Startups.</p>

                    <p>&nbsp;</p>
                </div>
            </div>
            <div id="actions">
                <div class="button light">
                    <span></span>
                        <span class="_link">
                            <a href="/indicacao"></a>
                            <div>VOLTAR</div>
                        </span>
                </div>
            </div>
        </div>
    </div>
@endsection