<?php

namespace App\Mail;

use App\Http\Controllers\GerarNotaController;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFaturamento extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($anexo, $dados, $nota)
    {
        $this->anexo = $anexo;
        $this->dados = $dados;
        $this->nota = $nota;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->dados->TipoDeDocumento == 'Nota de Telecomunicação - Fortel') {
            return $this->subject('WIRELINK INFORMA: SUA FATURA CHEGOU!')
                ->with(['boleto' => $this->dados])
                ->attach(storage_path('app/boletos/' . $this->anexo))
                ->attach(storage_path('app/notas/' . $this->nota))
                ->view('emails.envioFaturamento');
        } else {
            if ($this->dados->TipoDeDocumento == 'Nota Fiscal de Serviço Eletrônica' ) {
                return $this->subject('WIRELINK INFORMA: SUA FATURA CHEGOU!')
                    ->with(['boleto' => $this->dados])
                    ->attach(storage_path('app/boletos/' . $this->anexo))
                    ->attach(storage_path('app/notas/' . $this->nota))
                    ->view('emails.envioFaturamento');
            } else {
                return $this->subject('WIRELINK INFORMA: SUA FATURA CHEGOU!')
                    ->with(['boleto' => $this->dados])
                    ->attach(storage_path('app/boletos/' . $this->anexo))
                    ->view('emails.envioFaturamento');
            }
        }
    }
}
