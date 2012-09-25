function enviaReport(id){
var sendReport = new Request({
    url: '../ajax/enviaReport.php?Id='+id.value,
    method: 'get',
	encoding:'UTF-8',
    onFailure: function(){
        alert('Erro ao Enviar comando de Report. Envie Novamente')
    },
	onRequest: function(event, xhr){
		$('dv_title_rep').innerHTML = 'Enviando..';
	},	
	onSuccess: function(responseText){
		if(responseText === 'Cl_N_Existe') {
			alert('id Inexistente. Verifique a id Digitada');
		} else {
			$("dv_title_rep").innerHTML = 'Reporte Enviado';
			setTimeout("$(\"dv_title_rep\").innerHTML = 'Reporte'",1250);
			$('Report').innerHTML = responseText;
		}
		id.value = '';
	}
}).send();
}

function add_rapido(id){
var sendReport = new Request({
    url: '../ajax/verifica_add.php?recordID='+id.value,
    method: 'get',
	encoding:'UTF-8',
    onFailure: function(){
        alert('Erro ao Enviar comando para adicionar a Ordem de Serviço. Envie Novamente')
    },
	onRequest: function(event, xhr){
		$('dv_title_os').innerHTML = 'Verificando..';
	},
	onSuccess: function(responseText){
		$('dv_title_os').innerHTML = 'Ordem R&aacute;pida';
		if(responseText === '-1') {
			alert('id Inexistente. Verifique a id Digitada');
		} else {
			window.location = 'add_a.php?recordID='+responseText;
		}
		id.value = '';
	}
}).send();
}

function Tecnico(id){
var sendReport = new Request({
    url: '../ajax/altera_tecnico.php?recordID='+id,
    method: 'get',
	encoding:'UTF-8',
    onFailure: function(){
        alert('Erro ao Alterar Técnico. Tente Novamente')
    },
    	onSuccess: function(responseText){
    	if (responseText == 'ERRO') alert('Erro ao Alterar Técnico. Tente Novamente');
    	else $('OS_'+id).innerHTML = responseText;
	}    
}).send();
}

var Forma_Pgto = 0;
function Val_Fpgto(event){
	if ((Forma_Pgto == 0) && (!confirm('Deseja Realmente manter esta forma de Pagamento?'))){
		if (event.preventDefault) event.preventDefault();
		else event.returnValue = false;
		return false;
	} else Forma_Pgto = 0;
}
	
function format(elem,e){
var ch = elem.value;
var ln = ch.length;
if (ln == 1) elem.value = '0,0'+elem.value;
if (ln>2)	e.preventDefault();
	     //e.returnValue=false;
     return false;
}

function MM_openBrWindow(theURL,winName,wid,heig) { //v2.0
	var meio_w = screen.width/2;
	meio_w = meio_w - (wid/2);
	window.open(theURL,winName,"STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, SCROLLBARS=NO, width="+wid+",height="+heig+",left="+meio_w);
}


function  volta(){
	window.history.back();	
}

function setFocus(element){
	$(element).focus();
}

function leadZero(num,count){
	num = parseFloat(num); 
	var numZeropad = num + '';
	while(numZeropad.length < count) {
	numZeropad = "0" + numZeropad; 
	}
	return numZeropad;
}


window.addEvent('domready', function(){
try{ $('id').focus(); }catch(e){}
try{ $('Cliente').focus(); }catch(e){}
try{ $('fornecedor').focus(); }catch(e){}
try{ 
	new Form.Validator($('form1'),{
    useTitles:true,
	errorPrefix:''
}); }catch(e){}

try{
	var options = {
		script:"../auto/test.php?json=true&",
		varname:"input",
		timeout:10000,
		json:true,
		cache:true,
		minchars:2,
		shownoresults:true,
		noresults:''
	};
	var as_json = new AutoSuggest('Cliente', options);	
}catch(e){};

try{
myCal = new Calendar({
  	Data_Entrada: 'd/m/Y',
	}, {direction: 1,tweak: { x: -185, y: -60 },delay:100})
}catch(e){};

});

function busca_mes(lnk){
		var mes = prompt('Digite o mês que deseja listar as Ordens de Serviço');
		window.location = lnk+"?mes="+mes ;
}

function del(cod,cli){
	if (confirm("Deseja Realmente apagar o cliente "+cli+" Código "+cod)){
		window.location = "../ajax/exx_c?id="+cod;
	}	
}

function delOS(cod){
	if (confirm("Deseja realmente apagar esta Ordem de Serviço?")){
		window.location = "../ajax/exx_a?recordID="+cod;
	}	
}

function delUSU(cod,usu){
	if (confirm("Deseja Realmente apagar o Usuário "+usu)){
		window.location = "../ajax/exx_u?recordID="+cod;
	}	
}

function muda(qual)
{
uCase = qual.value.toUpperCase();
qual.value = uCase;
}

function formatar(src, mask)
{
  var i = src.value.length;
  var saida = mask.substring(0,1);
  var texto = mask.substring(i)
if (texto.substring(0,1) != saida)
  {
        src.value += texto.substring(0,1);
  }
}

function calcula_total(){
	var val_mo = $('mao_de_obra').value.toFloat();
	var val_mat = $('valor_material').value.toFloat();
	var soma = 	val_mo+val_mat;
	$('valor').value = soma.format({
		group: "",
		decimal:'.',
		decimals: 2,
	});	
}

/*
* função para formatação de valores monetários retirada de
* http://jonasgalvez.com/br/blog/2003-08/egocentrismo
*/

function Evento(e){
	if (e.preventDefault) e.preventDefault();
	else e.returnValue = false
}


// funcao que formata Moeda
function formataMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var whichCode = (window.Event) ? e.which : e.keyCode; 
	// 13=enter, 8=backspace as demais retornam 0(zero)
	// whichCode==0 faz com que seja possivel usar todas as teclas como delete, setas, etc 
	if ((whichCode == 13) || (whichCode == 0) || (whichCode == 8))
		return true;
	key = String.fromCharCode(whichCode); // Valor para o código da Chave
	Evento(e);
	if (strCheck.indexOf(key) == -1) return false; // Chave inválida
	len = objTextBox.value.length;
	for(i = 0; i < len; i++) if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break; aux = ''; for(; i < len; i++) if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i); aux += key; len = aux.length; if (len == 0) objTextBox.value = ''; if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux; if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux; 
	if (len > 2) {
		aux2 = '';
		for (j = 0, i = len - 3; i >= 0; i--) {
			if (j == 3) {
				aux2 += SeparadorMilesimo;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}
		objTextBox.value = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
			objTextBox.value += aux2.charAt(i);
			objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
	}
	calcula_total();
	return false;
}

function mascaraInteiro(e){ 
	var code = '';
	if (e.keyCode) code = e.keyCode; 
	else if (e.which) code = e.which; // Netscape 4.? 
	else if (e.charCode) code = e.charCode; // Mozilla 

	if ((code < 48 || code > 57) && (code !='' && code != 8 && code != 9 && code != 46)) { 
		if (window.event) //IE 
		e.returnValue = false; 
	else //Firefox 
		e.preventDefault(); 
		return false; 
	} 
	return true; 
}

function MascaraCep(cep,e){
		
                if(mascaraInteiro(e)==false){
                e.returnValue = false;
        }       
        return formataCampo(cep, '00000-000', e);
}

//valida CEP

function ValidaCep(cep){
        exp = /\d{5}\-\d{3}/
        if(!exp.test(cep.value)){
            alert('Numero de Cep Invalido!');
        }               
}
 
function formataCampo(campo, Mascara, evento) { 
        var boleanoMascara; 
        var Digitato = evento.keyCode;
        exp = /\-|\.|\/|\(|\)| /g
        campoSoNumeros = campo.value.toString().replace( exp, "" ); 
   
        var posicaoCampo = 0;    
        var NovoValorCampo="";
        var TamanhoMascara = campoSoNumeros.length;; 
        
        if (Digitato != 8) { // backspace 
                for(i=0; i<= TamanhoMascara; i++) { 
                    boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".") || (Mascara.charAt(i) == "/")) 
                    boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
                    if (boleanoMascara) { 
                        NovoValorCampo += Mascara.charAt(i); 
                        TamanhoMascara++;
                    } else { 
                        NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
                        posicaoCampo++; 
                   }              
                }      
                campo.value = NovoValorCampo;
                  return true; 
        }else { 
                return true; 
        }
}