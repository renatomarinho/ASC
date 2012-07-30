<?

////////////////////////////////////////////////////////////////////////////////////////
//                                                                                    //
// NOTICE OF COPYRIGHT                                                                //
//                                                                                    //
// ASC - Ajax Sales Cloud - http://www.greyland.com.br                                                  //
//                                                                                    //
// Copyright (C) 2008 onwards Renato Marinho ( renato.marinho@greyland.com.br )         //
//                                                                                    //
// This program is free software; you can redistribute it and/or modify it under      //
// the terms of the GNU General Public License as published by the Free Software      //
// Foundation; either version 3 of the License, or (at your option) any later         //
// version.                                                                           //
//                                                                                    //
// This program is distributed in the hope that it will be useful, but WITHOUT ANY    // 
// WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A    //
// PARTICULAR PURPOSE.  See the GNU General Public License for more details:          //
//                                                                                    //
//  http://www.gnu.org/copyleft/gpl.html                                              //
//                                                                                    //
////////////////////////////////////////////////////////////////////////////////////////


class Daruma{

	public $strCupom = "";

	/*
	 * Abre o cupom fiscal na impressora fiscal Daruma.
	 * 
	 * CPF ou CNPJ: Vari�vel String de at� 29 caracteres com o CPF ou CNPJ.
	 */

	public $strCNPJ = '';
	
	public function EmiteCupomVenda($CNPJ, $Itens){
	
		$this->FI_AbreCupom($strCNPJ);
		$this->FI_VendeItem($Itens);
		
		
	}
	
	private function FI_AbreCupom($strCNPJ){
	
		$this->strCupom .= 'Daruma_FI_AbreCupom('.$strCNPJ.');'."\r\n";
	
	}
	
	private function FI_VendeItem($arrItens){
	
		for( $i=0;$i<count($arrItens);$i++ ){
			$this->strCupom .= 'Daruma_FI_VendeItem( '.$arrItens[$i]['Codigo'].', '.$arrItens[$i]['Descricao'].', '.$arrItens[$i]['Aliquota'].', '.$arrItens[$i]['Tipo_de_Quantidade'].', '.$arrItens[$i]['Quantidade'].', '.$arrItens[$i]['Casas_Decimais'].', '.$arrItens[$i]['Valor_Unitario'].', '.$arrItens[$i]['Tipo_de_Desconto'].', '.$arrItens[$i]['Valor_do_Desconto'].' );'."\r\n";
		}
		
	}

	public function  FI_CancelaCupom(){
	
		//$this->strCupom
	
	}
	
	public function  FI_CancelaItemAnterior(){
	
	
	}

	public function  FI_CancelaItemGenerico(){
	
	
	}
	
	/*
	 * Str_Acrescimo_ou_Desconto:='D';
	 * Str_Tipo_do_Acrescimo_Desconto:='$'; ou '%';
	 * Str_Valor_do_Acrescimo_Desconto:='0,01';
	 * 
	 */
	public function  FI_IniciaFechamentoCupom(){
	
		for( $i=0;$i<count($arrItens);$i++ ){
			if ($arrItens[$i]['Valor_do_Acrescimo_Desconto'])
				$this->strCupom .= 'Daruma_FI_IniciaFechamentoCupom( '.$arrItens[$i]['Acrescimo_ou_Desconto'].', '.$arrItens[$i]['Tipo_do_Acrescimo_Desconto'].', '.$arrItens[$i]['Valor_do_Acrescimo_Desconto'].' );'."\r\n";
		}
		
	}
	
	public function  FI_EfetuaFormaPagamento(){
	
		$this->strCupom .= 'Daruma_FI_EfetuaFormaPagamento( '.$arrItens[$i]['Descricao_da_Forma_Pagamento'].', '.$arrItens[$i]['Valor_da_Forma_Pagamento'].' );'."\r\n";
	
	}
	
	public function  FI_EfetuaFormaPagamentoDescricaoForma(){
	
		$this->strCupom .= 'Daruma_FI_EfetuaFormaPagamentoDescricaoForma( '.$arrItens[$i]['Descricao_da_Forma_Pagamento'].', '.$arrItens[$i]['Valor_da_Forma_Pagamento'].', '.$arrItens[$i]['Texto_Livre'].' );'."\r\n";
	
	}
	
	public function  FI_FechaCupomResumido(){
	
		$this->strCupom .= 'Daruma_FI_FechaCupomResumido( '.$arrItens[$i]['Descricao_da_Forma_Pagamento'].', '.$arrItens[$i]['Mensagem_Promocional'].' );'."\r\n";
	
	}
	
	/*
	 * 	Str_Descricao_da_Forma_Pagamento: = 'Descricao';
	 *	Str_Acrescimo_ou_Desconto := 'D';
	 *	Str_Tipo_Acrescimo_ou_Desconto := '$';
	 *	Str_Valor_Acrescimo_ou_Desconto := '0,01';
	 *	Str_Valor_Pago := '0,50';
	 *  Str_Mensagem_Promocional := 'Obrigado Volte Sempre!!!';
	 * 
	 */
	public function  FI_FechaCupom(){
	
		$this->strCupom .= 'Daruma_FI_FechaCupom( '.$arrItens[$i]['Descricao_da_Forma_Pagamento'].', '.$arrItens[$i]['AcrescimoDesconto'].', '.$arrItens[$i]['Tipo_Acrescimo_ou_Desconto'].', '.$arrItens[$i]['Valor_Acrescimo_ou_Desconto'].', '.$arrItens[$i]['Valor_Pago'].', '.$arrItens[$i]['Mensagem_Promocional'].' );'."\r\n";
	
	}
	
	public function  FI_TerminaFechamentoCupom(){
	
		$this->strCupom .= 'Daruma_FI_TerminaFechamentoCupom( '.$arrItens[$i]['Mensagem_Promocional'].' );'."\r\n";
	
	}
	
	public function  FI_EstornoFormasPagamento(){
	
		$this->strCupom .= 'Daruma_FI_EstornoFormasPagamento( '.$arrItens[$i]['Forma_de_Origem'].', '.$arrItens[$i]['Nova_Forma'].', '.$arrItens[$i]['Valor_Total_Pago'].' );';
	
	}
	
	public function  FI_IdentificaConsumidor(){
	
	
	}
	
	public function  FI_EmitirCupomAdicional(){
	
	
	}
	
	public function  FI_UsaUnidadeMedida(){
	
	
	}
	
	public function  FI_AumentaDescricaoItem(){
	
	
	}
	
	public function  FI_AbreComprovanteNaoFiscalVinculado(){
	
	
	}
	
	public function  FI_UsaComprovanteNaoFiscalVinculado(){
	
	
	}
	
	public function  FI_FechaComprovanteNaoFiscalVinculado(){
	
	
	}
	
	public function  FI_AbreRelatorioGerencial(){
	
	
	}
	
	public function  FI_FechaRelatorioGerencial(){
	
	
	}
	
	public function  FI_AbreRecebimentoNaoFiscal(){
	
	
	}
	
	public function  FI_EfetuaFormaPagamentoNaoFiscal(){
	
	
	}
	
	public function  FI_LeituraMemoriaFiscalData(){
	
	
	}
	
	public function  FI_LeituraMemoriaFiscalReducao(){
	
	
	}
	
	public function  FI_LeituraMemoriaFiscalSerialData(){
	
	
	}
	
	public function  FI_LeituraMemoriaFiscalSerialReducao(){
	
	
	}
	
	public function  FI_LeituraX(){
	
	
	}
	
	public function  FI_RecebimentoNaoFiscal(){
	
	
	}
	
	public function  FI_ReducaoZ(){
	
	
	}
	
	public function  FI_ReducaoZAjustaDataHora(){
	
	
	}
	
	public function  FI_RelatorioGerencial(){
	
	
	}
	
	public function  FI_Sangria(){
	
	
	}
	
	public function  FI_Suprimento(){
	
	
	}
	
	public function  FI_FechamentoDoDia(){
	
	
	}
	
	public function  FI_ImprimeConfiguracoesImpressora(){
	
	
	}
	
	public function  FI_ProgramaAliquota(){
	
	
	}
	
	public function  FI_NomeiaTotalizadorNaoSujeitoIcms(){}
	
	public function  FI_ProgramaFormasPagamento(){}
	
	public function  FI_ProgramaOperador(){}
	
	public function  FI_LinhasEntreCupons(){}
	
	public function  FI_EspacoEntreLinhas(){}
	
	public function  FI_ProgramaHorarioVerao(){
	
	
	}
	
	public function  FI_EqualizaFormasPgto(){}
	
	public function  FI_ProgramaVinculados(){}
	
	public function  FI_ProgramaFormasPgtoSemVincular(){}
	
	public function  FI_CfgHorarioVerao(){
	
	
	}
	
	public function  FI_CfgCupomAdicional(){
	
	
	}
	
	public function  FI_CfgEspacamentoCupons(){
	
	
	}
	
	public function  FI_CfgPermMensPromCNF(){
	
	
	}
	
	public function  Registry_Porta(){}
	
	public function  Registry_Path(){}
	
	public function  Registry_Status(){}
	
	public function  Registry_StatusFuncao(){}
	
	public function  Registry_Retorno(){}
	
	public function  Registry_ControlePorta(){}
	
	public function  Registry_Log(){}
	
	public function  Registry_NomeLog(){}
	
	public function  Registry_Separador(){}
	
	public function  Registry_SeparaMsgPromo(){}
	
	public function  Registry_Vende1Linha(){}
	
	public function  Registry_XAutomatica(){}
	
	public function  Registry_ZAutomatica(){}
	
	public function  Registry_TerminalServer(){}
	
	public function  Registry_AbrirDiaFiscal(){}
	
	public function  Registry_IgnorarPoucoPapel(){}
	
	public function  Registry_ImprimeRegistry(){}
	
	public function  Registry_RetornaValor(){}
	
	public function  Registry_Default(){}
	
	public function  Registry_ErroExtendidoOk(){}
	
	public function  Registry_Velocidade(){}
	
	public function  Registry_Produto(){}
	
	public function  Registry_AplMensagem1(){}
	
	public function  Registry_AplMensagem2(){}
	
	public function  Registry_TEF_NumeroLinhasImpressao(){}
	
	public function  Registry_NumeroSerieNaoFormatado(){}
	
	public function  Registry_NumeroLinhasImpressao(){}
	
	public function  Registry_MFD_ProgramarSinalSonoro(){}
	
	public function  Registry_CupomAdicionalDll(){}
	
	public function  Registry_CupomAdicionalDllConfig(){}
	
	public function  Registry_FinalLote(){}
	
	public function  Registry_PathLote(){}
	
	public function  Registry_PCExpanionLogin(){}
	
	public function  Registry_MFDValorFinal(){}
	
	public function  Registry_LogTamMaxMB(){}
	
	public function  Registry_SintegraSeparador(){}
	
	public function  Registry_SintegraPath(){}
	
	public function  FI_StatusCupomFiscal(){}
	
	public function  FI_StatusRelatorioGerencial(){}
	
	public function  FI_StatusComprovanteNaoFiscalVinculado(){}
	
	public function  FI_StatusComprovanteNaoFiscalNaoVinculado(){}
	
	public function  FI_VerificaImpressoraLigada(){}
	
	public function  FI_VerificaModeloECF(){}
	
	public function  FI_VerificaHorarioVerao(){}
	
	public function  FI_VerificaDiaAberto(){}
	
	public function  FI_VerificaZPendente(){}
	
	public function  FI_VerificaXPendente(){}
	
	public function  FI_VerificaTipoImpressora(){}
	
	public function  FI_VerificaDescricaoFormasPagamento(){}
	
	public function  FI_VerificaFormasPagamentoEx(){}
	
	public function  FI_VerificaEstadoImpressora(){}
	
	public function  FI_VerificaAliquotasIss(){}
	
	public function  FI_VerificaIndiceAliquotasIss(){}
	
	public function  FI_VerificaTotalizadoresNaoFiscaisEx(){}
	
	public function  FI_VerificaEpromConectada(){}
	
	public function  FI_VerificaRecebimentosNaoFiscal(){}
	
	public function  FI_VerificaTruncamento(){}
	
	public function  FI_VerificaModoOperacao(){}
	
	public function  FI_VerificaTotalizadoresParciais(){}
	
	public function  FI_ClicheProprietarioEx(){}
	
	public function  FI_NumeroCaixa(){}
	
	public function  FI_NumeroLoja(){}
	
	public function  FI_NumeroSerie(){}
	
	public function  FI_RegistraNumeroSerie(){}
	
	public function  FI_VerificaNumeroSerie(){}
	
	public function  FI_RetornaSerialCriptografada(){}
	
	public function  FI_VersaoFirmware(){}
	
	public function  FI_CGC_IE(){}
	
	public function  FI_NumeroCupom(){}
	
	public function  FI_COO(){}
	
	public function  FI_MinutosImprimindo(){}
	
	public function  FI_MinutosLigada(){}
	
	public function  FI_NumeroSubstituicoesProprietario(){}
	
	public function  FI_NumeroIntervencoes(){}
	
	public function  FI_NumeroReducoes(){}
	
	public function  FI_NumeroCuponsCancelados(){}
	
	public function  FI_NumeroOperacoesNaoFiscais(){}
	
	public function  FI_DataHoraImpressora(){}
	
	public function  FI_DataHoraReducao(){}
	
	public function  FI_DataMovimento(){}
	
	public function  FI_ContadoresTotalizadoresNaoFiscais(){}
	
	public function  FI_LerAliquotasComIndice(){}
	
	public function  FI_VendaBruta(){}
	
	public function  FI_VendaBrutaAcumulada(){}
	
	public function  FI_GrandeTotal(){}
	
	public function  FI_Descontos(){}
	
	public function  FI_Acrescimos(){}
	
	public function  FI_Cancelamentos(){}
	
	public function  FI_DadosUltimaReducao(){}
	
	public function  FI_SubTotal(){}
	
	public function  FI_Troco(){}
	
	public function  FI_SaldoAPagar(){}
	
	public function  FI_RetornoAliquotas(){}
	
	public function  FI_ValorPagoUltimoCupom(){}
	
	public function  FI_UltimaFormaPagamento(){}
	
	public function  FI_ValorFormaPagamento(){}
	
	public function  FI_ValorTotalizadorNaoFiscal(){}
	
	public function  FI_UltimoItemVendido(){}
	
	public function  FI_TipoUltimoDocumento(){}
	
	public function  FI_MapaResumo(){}
	
	public function  FI_RelatorioTipo60Analitico(){}
	
	public function  FI_RelatorioTipo60Mestre(){}
	
	public function  FI_FlagsFiscais(){}
	
	public function  FI_FlagsFiscaisStr(){}
	
	public function  FI_SimboloMoeda(){}
	
	public function  FI_RetornaAcrescimoNF(){}
	
	public function  FI_RetornaCFCancelados(){}
	
	public function  FI_RetornaCNFCancelados(){}
	
	public function  FI_RetornaCLX(){}
	
	public function  FI_RetornaCNFNV(){}
	
	public function  FI_RetornaCNFV(){}
	
	public function  FI_RetornaCRZ(){}
	
	public function  FI_RetornaCRZRestante(){}
	
	public function  FI_RetornaCancelamentoNF(){}
	
	public function  FI_RetornaDescontoNF(){}
	
	public function  FI_RetornaGNF(){}
	
	public function  FI_RetornaTempoImprimindo(){}
	
	public function  FI_RetornaTempoLigado(){}
	
	public function  FI_RetornaTotalPagamentos(){}
	
	public function  FI_RetornaTroco(){}
	
	public function  FI_RetornaRegistradoresNaoFiscais(){}
	
	public function  FI_RetornarVersaoDLL(){}
	
	public function  FIMFD_DownloadDaMFD(){}
	
	public function  FIMFD_DescontoAcrescimoItem(){}
	
	public function  FIMFD_RetornaInformacao(){}
	
	public function  FIMFD_ImprimeCodigoBarras(){}
	
	public function  FIMFD_TerminaFechamentoCupomCodigoBarras(){}
	
	public function  FIMFD_StatusCupomFiscal(){}
	
	public function  FIMFD_SinalSonoro(){}
	
	public function  FIMFD_ProgramaRelatoriosGerenciais(){}
	
	public function  FIMFD_AbreRelatorioGerencial(){}
	
	public function  FIMFD_VerificaRelatoriosGerenciais(){}
	
	public function  FIMFD_EmitirCupomAdicional(){}
	
	public function  FIMFD_AcionarGuilhotina(){}
	
	public function  FIMFD_EqualizarVelocidade(){}
	
	
	
	
	
	
}

?>