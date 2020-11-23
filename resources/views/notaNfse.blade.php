<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Page Title</title>
</head>
<body>

    <div class="container">
        <div class="row row-extended">
            <div class="col-3 border border-secondary">
                <img src="logopmf.jpg" />
            </div>
            <div class="col-7 border border-secondary">
                <div class="row row-extended" style=" margin-left: 70px;vertical-align: middle;font-size: 13px;">PREFEITURA MUNICIPAL MUNICIPAL DE FORTALEZ</div>
                <div class="row row-extended" style=" margin-left: 110px;vertical-align: middle;font-size: 13px;">SECRETARIA MUNICIPAL DAS FINANÇAS</div>
                <div class="row row-extended" style=" margin-left: 62px;vertical-align: middle;font-size: 16px;">
                    <b>NOTA FISCAL ELETRÔNICA DE SERVIÇO - NFS-e</b>
                </div>
            </div>
            <div class="col-2 border border-secondary" style="font-size: 15px;">
                <strong>Número da</strong>
                <br />
                <strong>NFS-e</strong>
                <br />
                <strong>{{$dados->Numero}}</strong>
            </div>

            <div class="col-2 border border-secondary infor">Data e Hora da Emissão</div>
            <div class="col-2 border border-secondary infor">{{$dados->DataEmissao}}</div>
            <div class="col-2 border border-secondary infor">Competência</div>
            <div class="col-2 border border-secondary infor">08/2020</div>
            <div class="col-2 border border-secondary infor">Código de Verificação</div>
            <div class="col-2 border border-secondary infor">{{$dados->CodigoVerificacao}}</div>
            <div class="col-2 border border-secondary infor">Número do RPS</div>
            <div class="col-2 border border-secondary infor">{{$dados->IdentificacaoRps->Numero}}</div>
            <div class="col-2 border border-secondary infor">No. da NFS-e</div>
            <div class="col-2 border border-secondary infor"></div>
            <div class="col-2 border border-secondary infor">Local da Prestação</div>
            <div class="col-2 border border-secondary infor"></div>

            <div class="col-12 border border-secondary infor">
                <b>Dados do Prestador de Serviços</b>
            </div>
        </div>
        <div class="row row-extended">
            <div class="col-2 " style="border-left-style: solid;"></div>
            <div class="col-2 border border-secondary infor">Razão Social/Nome</div>
            <div class="col-8 border border-secondary infor">{{$dados->PrestadorServico->RazaoSocial}}</div>
            <div class="col-2 " style="border-left-style: solid;"></div>
            <div class="col-2 border border-secondary infor">Nome Fantasia</div>
            <div class="col-8 border border-secondary infor">{{$dados->PrestadorServico->NomeFantasia}}</div>
        </div>

        <div class="row row-extended">
            <div class="col-2 " style="border-left-style: solid;"></div>
            <div class="col-1 border border-secondary infor">CNPJ/CPF</div>
            <div class="col-2 border border-secondary infor">{{$dados->PrestadorServico->IdentificacaoPrestador->Cnpj}}</div>
            <div class="col-2 border border-secondary infor">Inscrição Municipal</div>
            <div class="col-2 border border-secondary infor">{{$dados->PrestadorServico->IdentificacaoPrestador->InscricaoMunicipal}}</div>
            <div class="col-1 border border-secondary infor">Município</div>
            <div class="col-2 border border-secondary infor"></div>
        </div>

        <div class="row row-extended">
            <div class="col-2 " style="border-left-style: solid;"></div>
            <div class="col-2 border border-secondary infor">Endereço e Cep</div>
            <div class="col-8 border border-secondary infor">
                {{
            $dados->PrestadorServico->Endereco->Endereco
            .', '.$dados->PrestadorServico->Endereco->Numero
            .', '.$dados->PrestadorServico->Endereco->Bairro
            .' CEP : '.$dados->PrestadorServico->Endereco->Cep
        }}
            </div>
        </div>
        <div class="row row-extended">
            <div class="col-2 " style="border-left-style: solid;"></div>
            <div class="col-2 border border-secondary infor">Complemento</div>
            <div class="col-1 border border-secondary infor">****</div>
            <div class="col-1 border border-secondary infor">Telefone</div>
            <div class="col-2 border border-secondary infor">{{$dados->PrestadorServico->Contato->Telefone}}</div>
            <div class="col-1 border border-secondary infor">Email</div>
            <div class="col-3 border border-secondary infor">{{$dados->PrestadorServico->Contato->Email}}</div>
        </div>

        <div class="row row-extended">
            <div class="col-12 border border-secondary infor ">Dados do Tomador de Serviços</div>

            <div class="col-2 border border-secondary infor ">Razão Social/Nome</div>
            <div class="col-10 border border-secondary infor ">
                {{$dados->TomadorServico->RazaoSocial}}
            </div>

            <div class="col-1 border border-secondary infor ">CNPJ/CPF</div>
            <div class="col-2 border border-secondary infor ">
                {{$dados->TomadorServico->IdentificacaoTomador->CpfCnpj->Cnpj}}
            </div>
            <div class="col-2 border border-secondary infor ">Inscrição Municipal</div>
            <div class="col-2 border border-secondary infor ">
                {{$dados->TomadorServico->Endereco->CodigoMunicipio}}
            </div>
            <div class="col-2 border border-secondary infor ">Município</div>
            <div class="col-3 border border-secondary infor ">
            </div>

            <div class="col-2 border border-secondary infor ">Endereço e Cep</div>
            <div class="col-10 border border-secondary infor ">
                {{
            $dados->TomadorServico->Endereco->Endereco
            .', '.$dados->PrestadorServico->Endereco->Numero
            .', '.$dados->PrestadorServico->Endereco->Bairro
            .' CEP : '.$dados->PrestadorServico->Endereco->Cep
        }}
            </div>

            <div class="col-1 border border-secondary infor ">Complemento</div>
            <div class="col-2 border border-secondary infor "></div>
            <div class="col-2 border border-secondary infor ">Telefone</div>
            <div class="col-2 border border-secondary infor ">
                {{$dados->TomadorServico->Contato->Telefone}}
            </div>
            <div class="col-2 border border-secondary infor ">Email</div>
            <div class="col-3 border border-secondary infor ">
                {{$dados->TomadorServico->Contato->Email}}
            </div>
        </div>



        <div class="row row-extended">
            <div class="col-12 border border-secondary infor">
                <b>Discriminação dos Serviços</b>
            </div>
            <div class="col-12 border border-secondary descriminacao infor">
                {{$dados->Servico->Discriminacao}}
            </div>
        </div>
        <div class="row row-extended">
            <div class="col-12 border border-secondary infor">
                <b>Código de Atividade CNAE</b>
            </div>
        </div>
        <div class="row row-extended">
            <div class="col-12 border border-secondary infor">
                {{$dados->Servico->ItemListaServico}} / {{$dados->Servico->CodigoCnae}}
            </div>
        </div>
        <div class="row row-extended">
            <div class="col-12 border border-secondary infor">
                <b>Detalhamento Específico da Construção Civil</b>
            </div>
        </div>

        <div class="row row-extended">
            <div class="col-2 border border-secondary infor">Código da Obra</div>
            <div class="col-4 border border-secondary infor"></div>
            <div class="col-2 border border-secondary infor">Código ART</div>
            <div class="col-4 border border-secondary infor"></div>
        </div>

        <div class="row row-extended">
            <div class="col-12 border border-secondary infor">
                <b>Tributos Federais</b>
            </div>
        </div>

        <div class="row row-extended">
            <div class="col-1 border border-secondary infor">PIS</div>

            <div class="col-1 border border-secondary infor"></div>

            <div class="col-1 border border-secondary infor">IR(R$)</div>

            <div class="col-1 border border-secondary infor"></div>

            <div class="col-1 border border-secondary infor">INSS(R$)</div>

            <div class="col-1 border border-secondary infor"></div>

            <div class="col-2 border border-secondary infor">INSS(R$)</div>
            <div class="col-1 border border-secondary infor"></div>

            <div class="col-2 border border-secondary infor">CSLL(R$)</div>
            <div class="col-1 border border-secondary infor"></div>
        </div>

        <div class="row row-extended">
            <div class="col-12 border border-secondary infor">
                <b>Detalhamento de Valores - Prestador dos Serviços</b>
                &#160;&#160; &#160;&#160; &#160;&#160; &#160;&#160;
                &#160;&#160; &#160;&#160; &#160;&#160; &#160;&#160;
                <b>Outras Retenções</b>
                &#160;&#160; &#160;&#160; &#160;&#160; &#160;&#160;
                &#160;&#160; &#160;&#160; &#160;&#160; &#160;&#160;
                <b>Cálculo do ISSQN devido no Município</b>
            </div>
        </div>

        <div class="row row-extended">
            <div class="col-3 border border-secondary infor">Valor dos Serviços R$</div>
            <div class="col-2 border border-secondary infor">
                {{$dados->Servico->Valores->ValorServicos}}
            </div>
            <div class="col-3 border border-secondary infor">Natureza Operação</div>
            <div class="col-2 border border-secondary infor">Valor dos Serviços R$</div>
            <div class="col-2 border border-secondary infor">
                {{$dados->Servico->Valores->ValorServicos}}
            </div>
        </div>

        <div class="row row-extended">
            <div class="col-2 border border-secondary infor">(-) Desconto Incondicionado</div>
            <div class="col-2 border border-secondary infor"></div>
            <div class="col-3 border border-secondary infor">1 - Tributação no Município</div>
            <div class="col-3 border border-secondary infor">(-) Deduções permitidas em lei</div>
            <div class="col-2 border border-secondary infor"></div>
        </div>

        <div class="row row-extended">
            <div class="col-2 border border-secondary infor">(-) Desconto Incondicionado</div>
            <div class="col-2 border border-secondary infor"></div>
            <div class="col-3 border border-secondary infor">Regime especial Tributação</div>
            <div class="col-3 border border-secondary infor">(-) Desconto Incondicionado</div>
            <div class="col-2 border border-secondary infor"></div>
        </div>

        <div class="row row-extended">
            <div class="col-2 border border-secondary infor">(-) Retenções Federais</div>
            <div class="col-2 border border-secondary infor">0,00</div>
            <div class="col-3 border border-secondary infor">0 - Nenhum</div>
            <div class="col-3 border border-secondary infor">Base de Cálculo</div>
            <div class="col-2 border border-secondary infor">
                {{$dados->Servico->Valores->ValorServicos}}
            </div>
        </div>

        <div class="row row-extended">
            <div class="col-2 border border-secondary infor">Outras Retenções</div>
            <div class="col-2 border border-secondary infor"></div>
            <div class="col-3 border border-secondary infor">Opção Simples Nacional</div>
            <div class="col-3 border border-secondary infor">(x) Alíquota %</div>
            <div class="col-2 border border-secondary infor">
                {{$dados->Servico->Valores->Aliquota}}
            </div>
        </div>
        <div class="row row-extended">
            <div class="col-2 border border-secondary infor">(-) ISS Retido</div>
            <div class="col-2 border border-secondary infor">
                {{$dados->Servico->Valores->ValorIssRetido}}
            </div>
            <div class="col-3 border border-secondary infor">
                {{$dados->OptanteSimplesNacional}} - Não</div>
            <div class="col-3 border border-secondary infor">ISS a reter</div>
            <div class="col-2 border border-secondary infor">( ) Sim (X) Não</div>
        </div>

        <div class="row row-extended">
            <div class="col-2 border border-secondary infor">(=) Valor Líquido R$</div>
            <div class="col-2 border border-secondary infor">
                {{$dados->Servico->Valores->ValorLiquidoNfse}}
            </div>
            <div class="col-3 border border-secondary infor">Incentivador Cultural</div>
            <div class="col-2 border border-secondary infor">
                {{$dados->IncentivadorCultural}} - Não</div>
            <div class="col-2 border border-secondary infor">(=) Valor do ISS: R$</div>
            <div class="col-1 border border-secondary infor">
                {{$dados->Servico->Valores->ValorIss}}
            </div>
        </div>

        <div class="row row-extended">
            <div class="col-2 border border-secondary infor">Avisos</div>
            <div class="col-10 border border-secondary infor">
                <p>1- Uma via desta Nota Fiscal será enviada através do e-mail fornecido pelo Tomador dos Serviços, no sítio http://iss.fortaleza.ce.gov.br</p>
                <p>2- A autenticidade desta Nota Fiscal poderá ser validada no site http://iss.fortaleza.ce.gov.br/, com a utilização do Código de Verificação.</p>
            </div>
        </div>
    </div>

</body>
</html>

<style scope>
div.row-extended {
  text-align: center;
  vertical-align: middle;
}

.descriminacao {
  height: 200px;
}

.container {
  width: 800px;
}

.infor {
  font-size: 9px;
    border-style: solid;
    font-weight: bold;
}

</style>