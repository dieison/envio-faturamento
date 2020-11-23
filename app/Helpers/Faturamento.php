<?php

namespace App\Helpers;

use App\EnvioFaturamento;
use App\Http\Controllers\GerarNotaController;
use App\Mail\SendFaturamento;
use App\Titulo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Faturamento
{
    public static function enviofaturamento($array_cdrcd)
    {
        for ($i = 0; $i < count($array_cdrcd); $i++) {
            try {
                if (EnvioFaturamento::getEnvioByCDRCD($array_cdrcd[$i])->count() == 1) { //Verifica se o email já foi enviado para esse CDRCD
                    $nota = 'Nota-' . $array_cdrcd[$i] . '.pdf';
                    $titulo = Titulo::getInformacaoBoleto($array_cdrcd[$i]); //Pega as informações de um título pelo seu CDRCD
                    Faturamento::getNota($titulo); //Faz a geração da nota e retorna o caminho do mesmo dentro do servidor caso não seja caixa
                    $boleto_anexo = Helper::gerarBoleto($titulo, true); //Faz a geração do boleto e retorna o caminho do mesmo dentro do servidor
                    EnvioFaturamento::atualizaEnvio($array_cdrcd[$i], "Enviado"); //Muda o Status de envio para "ENVIADO"
                    $array_email = array();
                    if ($titulo->Email != NULL) {
                        $email1 = explode(";", $titulo->Email);
                        for ($j = 0; $j < count($email1); $j++) {
                            array_push($array_email, trim($email1[$j]));
                        }
                    }
                    if ($titulo->Email2 != NULL) {
                        $email2 = explode(";", $titulo->Email2);
                        for ($k = 0; $k < count($email2); $k++) {
                            array_push($array_email, trim($email2[$k]));
                        }
                    }
                    Mail::to($array_email)
                        ->bcc('boletos@wirelink.com.br')
                        ->send(new SendFaturamento($boleto_anexo, $titulo, $nota) //Faz o envio do Boleto para o cliente 
                        );
                }
            } catch (\Throwable $th) {
                EnvioFaturamento::atualizaEnvio($array_cdrcd[$i], "Não Enviado"); //Caso não seja enviado o e-mail o status de envio volta para "Não Enviado"
                Log::info('Erro no Envio CDRCD:' . $array_cdrcd[$i]);
                Log::info($th);
            }
        }
    }

    public static function getNota($titulo)
    {
        if ($titulo->NrBco != '104-0') {
            GerarNotaController::downloadNota($titulo->CdRcd);
        }
    }
}
