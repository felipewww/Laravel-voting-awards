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
                    REGULAMENTO GERAL - STARTUP AWARDS 2017
                    <br>
                    <br>
                    O que é o Startup Awards?
                    <br>
                    <br>
                    O Startup Awards é uma cerimônia de premiação para prestigiar os mais influentes agentes do cenário do empreendedorismo digital brasileiro através da entrega do primeiro prêmio Startup Awards, em 11 (onze) categorias, através de indicação.
                    <br>
                    <br>
                    Quais são as categorias?
                    <br>
                    <br>
                    Investidor/a Anjo:
                    Investidor/a Anjo, são aqueles que fazem investimento no início da startup.
                    <br>
                    <br>
                    Critério: Ter investido pelo menos em 2 (dois) startups nos últimos 2 (dois) anos na pessoa física.
                    <br>
                    <br>
                    Profissional de Comunicação:
                    O Profissional de Comunicação é aquele/a que se dedicou em reportar ou publicar matérias/conteúdos sobre o mercado de startups nacional de uma maneira clara e que agregou conhecimento ao ecossistema.
                    <br>
                    <br>
                    Critério: Ter publicado pelo menos 3 (três) matérias/conteúdos no último ano.
                    <br>
                    <br>
                    Universidade:
                    A Universidade do ano é aquela que tem no seu currículo conteúdo voltado para a educação empreendedora.
                    <br>
                    <br>
                    Critério:
                    ter realizado no último ano algum projeto de fomento à criação e/ou desenvolvimento de startups, ter iniciativas voltadas para educação empreendedora e ser uma universidade de capital nacional
                    <br>
                    <br>
                    Coworking:
                    O Coworking do ano é aquele que, além de ter como residentes empresas inovadoras, ajuda e fomenta o ecossistema local.
                    <br>
                    <br>
                    Critério:
                    ações específicas para startups na cidade onde atua, tem que estar ativo, ter sido host de no mínimo 3 (três) eventos para empreendedores no último ano.
                    <br>
                    <br>
                    Aceleradora:
                    A Aceleradora do ano é aquela que realmente "acelerou" startups em seus programas, com cases de sucesso.
                    <br>
                    <br>
                    Critério:
                    Aceleração de no mínimo 3 (três) batchs, ter acelerado no mínimo 10 (dez) startups nos últimos 2 (dois) anos, a aceleradora tem que estar ativa.
                    <br>
                    <br>
                    Startup de Impacto:
                    A Startup de Impacto do ano é aquela que trabalha com impacto social, realmente fazendo a diferença, tratando problemas sociais na região em que atua.
                    <br>
                    <br>
                    Critério:
                    Projetos focados no público de baixa renda, impacto social deve ser a atividade principal da startup, tem que ser uma empresa e não uma ONG e deve ter impactado pelo menos 100 pessoas nacionalmente
                    <br>
                    <br>
                    Mentor/a:
                    Mentor/a do ano é aquela pessoa que realmente usa seu expertise e conhecimento em determinado mercado ou área para ajudar "pro bono" empreendedores e startups nacionais.
                    <br>
                    <br>
                    Critério: Ter participado como mentor/a em pelo menos 5 oportunidades no último ano;
                    <br>
                    <br>
                    Corporate:
                    A Corporate do ano é aquela grande empresa/corporação que sempre está presente no mercado de empreendedorismo nacional, incentivando startups locais à crescerem.
                    <br>
                    <br>
                    Critério: Ter pelo menos uma startup nacional como fornecedora, ter colaboradores dedicados exclusivamente para o relacionamento com o mercado de startup nacional
                    <br>
                    <br>
                    Herói/Heroína do Ano:
                    Herói/Heroína do ano é aquela pessoa que mesmo tendo seu trabalho no dia-a-dia dedica boa parte do seu tempo no fomento do ecossistema nacional.
                    <br>
                    <br>
                    Critério:
                    Pessoa com o mindset #giveback #givefirst
                    <br>
                    <br>
                    Startup do Ano:
                    Startup do Ano é aquela empresa que se destacou não só no seu próprio mercado, mas também em outros mercados fomentando a inovação nacional.
                    <br>
                    <br>
                    Critério:
                    tem que ser brasileira, tem que ter CNPJ, ser uma startup digital (soluções que sejam baseadas em web, mobile, hardware), não ser uma empresa prestadora de serviços (software house, desenvolvedora de aplicativos, games e consultoria), ter uma solução inovadora, ou seja trazendo uma solução para um problema existente que ninguém pensou antes.
                    <br>
                    <br>
                    Comunidade:
                    A Comunidade do Ano é aquele grupo de pessoas que dedicam boa parte do seu no fomento do empreendedorismo local da sua região.
                    <br>
                    <br>
                    Critério: ter no mínimo 10 startups participantes, ter realizado no mínimo 5 eventos para o ecossistema local no último ano (reuniões, meetups, palestras, startup weekend, eventos open source, etc), ter parcerias com no mínimo um dos agentes do ecossistema local (empresas, governo e universidade), ter atuação em apenas uma cidade ou estado

                    <br>
                    <br>
                    1. Elegibilidade
                    <br>
                    <br>

                    Indicados: A indicação dos nomeados é pública e ocorrerá através do website da premiação (www.startupawards.com.br).
                    <br>
                    <br>
                    Na primeira etapa da premiação, o público indicará os nomes que considera mais relevantes para cada categoria de premiação.
                    <br>
                    <br>
                    Os 10 (dez) nomes mais indicados de cada categoria serão enviados à Academia ABStartups(*), onde os membros da Academia irão votar em um dos nomes de cada categoria. Os 3 (três) nomes mais votados de cada categoria irão participar da premiação no CASE – Conferência Anual de Startups e Empreendedorismo, onde serão revelados os vencedores de cada categoria.
                    <br>
                    <br>
                    (*)Quem faz parte da Academia ABStartups?
                    Os integrantes da Academia ABStartups são os finalistas do último ano do prêmio, agentes do ecossistema nacional, founders de startups já consagradas e líderes de comunidades.
                    <br>
                    <br>

                    • Os indicados devem exercer suas atividades em território brasileiro.
                    • Todos os produtos e empresas são elegíveis para concorrer ao prêmio, desde que estejam de acordo com a descrição da categoria e os critérios referentes a esta.
                    • Todos as indicações devem ter link de referência para o indicado.
                    • Os indicados podem ser nomeados para mais de uma categoria, e possivelmente podem ganhar o prêmio em múltiplas categorias.
                    <br>
                    <br>

                    2. Período de Participação
                    <br>
                    <br>

                    A participação no evento tem 3 (três) fases:

                    <br>
                    <br>
                    2.1. Fase de indicação pública:
                    O público em geral poderá indicar os nomes em cada categoria. (de 10:00h do dia 28 de setembro de 2017 às 18:00h do dia 09 de outubro de 2017).
                    <br>
                    <br>

                    2.3 Votação da Academia:
                    Os 10 (dez) nomes mais indicados em cada categoria serão enviados para a Academia ABStartups, onde os membros da mesma poderão votar uma vez em apenas um nome de cada categoria.  (de 10:00h do dia 12 de outubro de 2017 às 18:00h do dia 15 de outubro de 2017)

                    <br>
                    <br>
                    Os 3 (três) nomes mais votados pela Academia ABStartups em cada categoria serão os finalistas.
                    <br>
                    <br>
                    2.4 Será enviado novamente à Academia ABStartups os 3 (três) nomes dos finalistas, onde o nome mais votado em cada categoria será o vencedor (de 10:00h do dia 18 de outubro de 2017 às 18:00h do dia 19 de outubro de 2017)
                    <br>
                    <br>
                    O voto é secreto e intransferível.

                    <br>
                    <br>
                    3. Premiação:
                    A premiação acontece no CASE – Conferência Anual de Startups e Empreendedorismo, onde estarão presentes os 3 (três) finalistas de cada categoria e os vencedores serão revelados.
                    <br>
                    <br>
                    Os nomes dos vencedores só serão revelados no dia da premiação.
                    <br>
                    <br>
                    O aludido período de participação compreende o período em que os participantes poderão se inscrever e participar da Campanha.
                    Os horários refletem o fuso horário de brasília-DF.
                    <br>
                    <br>

                    4. Quem NÃO pode participar

                    <br>
                    <br>
                    Não poderão participar (serem indicados em qualquer categoria) empregados da ABStartups (Associação Brasileira de Startups), da Blanko, Plug ou de qualquer pessoa relacionada profissionalmente a esta premiação bem como seus familiares.

                    <br>
                    <br>
                    “Familiares” significa qualquer cônjuge, parente até 3o grau, filho natural ou adotado e irmãos (sendo natural ou adotado pelos pais), vivendo ou não na mesma casa.
                    <br>
                    <br>

                    5. Como Participar
                    <br>
                    <br>

                    O participante deverá seguir os passos abaixo dentro do período de participação:
                    <br>
                    <br>

                    1o passo:
                    <br>
                    <br>

                    Por meio do acesso à página online do evento (www.startupawards.com.br), o participante fará um cadastro com login através do Facebook ou login e senha*
                    (*) O participante que optar pela participação através de login e senha fica ciente de que irá preencher um formulário para as suas indicações em cada categoria e este preenchimento mediado para aprovação ou não através de um comitê interno para evitar fraudes.

                    <br>
                    <br>


                    2o passo:
                    <br>
                    <br>

                    Durante a fase de indicação, o participante indicará os nomes dos candidatos que desejar em cada categoria, de acordo com os critérios de cada uma e inserindo uma referência**.
                    (**) Referência: Cada indicação, juntamente com o nome, deve acompanhar um link de acesso de uma página pública do indicado a fim de contribuir na identificação e análise do perfil dos indicados.
                    <br>
                    <br>

                    3o Passo:
                    <br>
                    <br>

                    Os 3 (três) nomes finalistas em cada categoria serão apresentados no dia 20 de outubro de 2017 no website do Startup Awards (www.startupawards.com.br).
                    4o Passo:
                    <br>
                    <br>

                    O nome mais votado pela Academia ABStartups em cada categoria será o vencedor e receberá o prêmio presencialmente no dia 27 de outubro de 2017 durante o evento CASE - Conferência Anual de Startups e Empreendedorismo - no Pro-Magno em São Paulo.

                    <br>
                    <br>
                    INFORMAÇÕES IMPORTANTES:
                    <br>
                    <br>
                    A indicação é restrita a uma vez por pessoa por categoria e por endereço de email validado.
                    <br>
                    <br>
                    A participação é gratuita e não é necessária a compra de nenhum programa, produto ou serviço ABStartups ou qualquer patrocinador/apoiador.
                    <br>
                    <br>

                    6. Critérios para premiação

                    <br>
                    <br>
                    Todos estão convidados a indicar (FASE 2.1) seus candidatos favoritos ao prêmio. Até uma indicação por categoria, por endereço de email validado, será contado na votação final.

                    <br>
                    <br>
                    O Comitê Startup Awards reserva-se no direito de descartar qualquer ou todas as indicações consideradas fraudulentos ou enviados por bots (robôs) ou outras aplicações de indicação geradas por computador.
                    <br>
                    <br>

                    Os vencedores finais do prêmio serão determinados com base no maior número de votos recebidos pela Academia ABStartups (FASE 2.2). Os vencedores de cada categoria serão anunciados ao vivo na cerimônia de premiação a ser realizada no dia 27 de Outubro de 2017, durante o evento CASE - Conferência Anual de Startups e Empreendedorismo - no Pro-Magno (Rua Samaritá, 230 - Casa Verde, São Paulo - SP, 02518-080) Em caso de empate, o vencedor será determinado considerando aquele que tiver recebido o maior número de indicações (FASE 2.1).
                    <br>
                    <br>

                    Permanecendo o empate, o prêmio será dividido entre os indicados, tendo portanto múltiplos vencedores.

                    <br>
                    <br>
                    7. Prêmios
                    <br>
                    <br>

                    Cada categoria vencedora receberá como prêmio o troféu Startup Awards e o reconhecimento público por sua atuação destacada, com publicação no website e mídias eletrônicas do prêmio.
                    <br>
                    <br>

                    Os indicados podem concorrer em diversas categorias, desde que sejam elegíveis de acordo com a descrição da categoria.
                    <br>
                    <br>

                    • Esse prêmio não inclui passagem aérea, nem hospedagem em hotel, assim como também não inclui traslados até o aeroporto em São Paulo - SP. Os premiados são responsáveis pela locomoção e hospedagem em São Paulo, caso sejam de outros estados.
                    <br>
                    <br>

                    • É de total e exclusiva responsabilidade do premiado todas e quaisquer despesas que não tenham sido expressamente especificadas na descrição acima, tais como, gorjetas, taxas de serviço, excursões/passeios, telefonemas, lavanderia, despesas médicas e outras.
                    <br>
                    <br>

                    8. Condições Gerais
                    <br>
                    <br>

                    • Ao participar da campanha o participante declara estar ciente e de acordo com todas as condições estipuladas pelos presentes Termos e Condições.

                    <br>
                    <br>
                    • A promotora se reserva o direito de verificar a qualquer momento se algum participante cumpre as condições de elegibilidade para participar da Campanha.
                    <br>
                    <br>

                    A promotora estará isenta de qualquer obrigação (incluindo a entrega de prêmios ou qualquer outra) em relação a qualquer participante que tenha participado ou tentado participar da campanha sem cumprir as condições de elegibilidade.

                    <br>
                    <br>
                    • A promotora não se responsabiliza por qualquer perda ou dano, incluindo, mas não se limitando a danos indiretos ou conseqüências (incluindo econômicos). As condições aqui estabelecidas não afetam quaisquer direitos que o vencedor possua na forma da lei. A responsabilidade da promotora está restrita à premiação aqui estabelecidos.

                    <br>
                    <br>
                    • A promotora se reserva ao direito de não divulgar os números de indicações e votação de cada categoria, empresa, ou finalista. Assim como não serão divulgados os nomes das pessoas que participaram através de indicação e/ou votação. Ambas informações estão restritas ao Comitê Startup Awards. Não será feita nenhuma recontagem de votos, sob pedido dos participantes.

                    <br>
                    <br>
                    • Se por alguma razão esta campanha não puder ocorrer conforme planejado, incluindo situações decorrentes de vírus de computador, bug, intervenções não autorizadas, fraude, problemas técnicos ou qualquer outra causa que vá além do controle da promotora, que corrompa ou interfira numa administração segura e justa do mesmo, a promotora se reserva o direito de cancelar, terminar, modificar ou suspender o mesmo.

                    <br>
                    <br>
                    • A promotora não assume responsabilidade por erro, omissão, interrupção, exclusão, defeito, atraso na operação ou transmissão, falha da linha de comunicações, roubo ou destruição ou acesso não autorizado, ou alteração, das inscrições.

                    <br>
                    <br>
                    • A promotora não é responsável por nenhum problema ou mau funcionamento das linhas de rede ou telefônicas, sistemas online de computadores, servidores ou provedores, equipamento do computador, software, falhas técnicas ou congestionamento da internet ou em qualquer website nos e-mails ou nas inscrições a serem recebidas pela promotora. Atenção: Qualquer ato que deliberadamente tenha por finalidade prejudicar os websites da promotora ou de qualquer outra forma causar prejuízo à mesma ou a terceiros de boa fé, poderá ser considerado uma violação civil e criminal, reservando-se a promotora o direito de promover todas as ações permitidas pela lei para recuperar os danos ocasionados por tais atos. A promotora se reserva o direito de desqualificar qualquer indivíduo que violar os presentes termos.

                    <br>
                    <br>
                    • A promotora é a Associação Brasileira de Startups, com sede a Rua Casa do Ator
                    919, Vila Olímpia, no município de São paulo, estado de São Paulo, Cep 04570001, inscrita no CNPJ sob o número 19.939.915/0001-95.

                    <br>
                    <br>
                    • No ato da inscrição fica a promotora autorizada a utilizar – durante a vigência desta campanha e por um período adicional de 60 (sessenta) meses - nomes, imagens e vozes dos inscritos, sem que isso implique em qualquer tipo de ônus a Associação Brasileira de Startups.
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