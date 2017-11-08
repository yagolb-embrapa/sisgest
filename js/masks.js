// JavaScript Document

function m_text(evt, valor) 
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
	
	if (!(evt.which))
	{	
		return true;
	}
	else if ( charCode == 34 && (evt.which))
		return false;
	else if ( charCode == 39 && (evt.which))
		return false;	
	else
		return true;
	
}


function m_enter(evt, valor) 
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
	
	if (!(evt.which))
	{	
		return true;
	}
	else if ( charCode == 13)
	{
		submit_login();
		return true;
	}
	else
		return true;
	
}


function m_int(evt, valor) 
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
	
	if (!(evt.which))
	{	
		return true;
	}
	else if ( (charCode > 31 && (charCode < 48 || charCode > 57)) && (evt.which) ) {
		return false
    }
	
}	  

//Permite ponto io
function m_dec(evt, valor) 
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
	
	if (!(evt.which))
	{	
		return true;
	}
	else if ( charCode == 46 && (evt.which))
	{
		vir = valor.indexOf('.');
		if (vir == -1)
			return true;
		else
			return false;
	}
	else if ( (charCode > 31 && (charCode < 48 || charCode > 57)) && (evt.which) ) {
		return false
    }
	
}

//Permite virgula 
function m_dec2(evt, valor)
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
   
    if (!(evt.which))
    {   
        return true;
    }
    else if ( charCode == 44 && (evt.which))
    {
        vir = valor.indexOf(',');
        if (vir == -1)
            return true;
        else
            return false;
    }
    else if ( (charCode > 31 && (charCode < 48 || charCode > 57)) && (evt.which) ) {
        return false
    }
   
}      	  



function mascara(o,f)
{
	v_obj=o
	v_fun=f
	setTimeout("execmascara()",1)	
}

function execmascara()
{
	v_obj.value= v_fun(v_obj.value)
}

function mtelefone(v)
{
	v=v.replace(/\D/g,"") //Remove tudo o que n�o � d�gito	
	v=v.replace(/(\d{2})(\d)/,"$1 $2") //Coloca um ponto entre o terceiro e o quarto d�gitos
	v=v.replace(/(\d{4})(\d)/,"$1-$2") //Coloca um ponto entre o terceiro e o quarto d�gitos
	return v
}


function mcpf(v){

v=v.replace(/\D/g,"") 

v=v.replace(/(\d{3})(\d)/,"$1.$2") 

v=v.replace(/(\d{3})(\d)/,"$1.$2") 


v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") 

return v

}

function mcep(v){

v=v.replace(/\D/g,"") 

v=v.replace(/(\d{5})(\d{1,3})$/,"$1-$2")  

return v

}

//trocar virgula por ponto 
function mfloat(v){
	/*v=v.replace(",",".")
	return v;*/
}

//so numeros 
function mnum(v){
	v=v.replace(/\D/g,"")
	return v;
}


function FormataCNPJ(Campo, teclapres){

   if(window.event){
    var tecla = teclapres.keyCode;
   }else  tecla = teclapres.which;

   var vr = new String(Campo.value);
   vr = vr.replace(".", "");
   vr = vr.replace(".", "");
   vr = vr.replace("/", "");
   vr = vr.replace("-", "");

   tam = vr.length + 1;

  
   if (tecla != 9 && tecla != 8){
      if (tam > 2 && tam < 6)
         Campo.value = vr.substr(0, 2) + '.' + vr.substr(2, tam);
      if (tam >= 6 && tam < 9)
         Campo.value = vr.substr(0,2) + '.' + vr.substr(2,3) + '.' + vr.substr(5,tam-5);
      if (tam >= 9 && tam < 13)
         Campo.value = vr.substr(0,2) + '.' + vr.substr(2,3) + '.' + vr.substr(5,3) + '/' + vr.substr(8,tam-8);
      if (tam >= 13 && tam < 15)
         Campo.value = vr.substr(0,2) + '.' + vr.substr(2,3) + '.' + vr.substr(5,3) + '/' + vr.substr(8,4)+ '-' + vr.substr(12,tam-12);
      }
}

function mdata(inputData, e){
	if(document.all) //Internet Explorer
		var tecla = event.keyCode;
	else //Outros Browsers
		var tecla = e.which;
	
	if(tecla >= 47 && tecla < 58){ // numeros de 0 a 9 e "/"
		var data = inputData.value;
		if (data.length == 2 || data.length == 5){
			data += '/';
			inputData.value = data;
		}
	}else if(tecla == 8 || tecla == 0) // Backspace, Delete e setas direcionais(para mover o cursor, apenas para FF)
		return true;
	else
		return false;
}
