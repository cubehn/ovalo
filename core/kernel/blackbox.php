

[[eventsbb]]

<script type="text/javascript">

var wmode = new Array('');
function dragElement(elmnt){
  wl=wmode.length;
  wmode[wl]=elmnt;
  var p1=0,p2=0,p3=0,p4=0;
  if (document.getElementById("h"+elmnt.id.substr(4)))
    document.getElementById("h"+elmnt.id.substr(4)).onmousedown = dragMouseDown;
  else
    elmnt.onmousedown = dragMouseDown;

  function dragMouseDown(e){
	for(i=1;i<wmode.length;i++){
		wmode[i].style.zIndex=5;
	}
	elmnt.style.zIndex=100;
    e = e || window.event;
    e.preventDefault();
    p3 = e.clientX;
    p4 = e.clientY;
    document.onmouseup = closeDragElement;
    document.onmousemove = elementDrag;
  }
  function elementDrag(e){
    e = e || window.event;
    e.preventDefault();
    p1 = p3 - e.clientX;
    p2 = p4 - e.clientY;
    p3 = e.clientX;
    p4 = e.clientY;
    elmnt.style.top = (elmnt.offsetTop - p2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - p1) + "px";
	elmnt.style.zIndex=100;
  }
  function closeDragElement(){
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

dragElement(document.getElementById("mainsec2"));
dragElement(document.getElementById("mainsec3"));
dragElement(document.getElementById("mainsec4"));

function INIT(secs){
	s=secs.split(',');
	for(i=0;i<s.length;i++){
		call(s[i]);
	}
}
function call(s,t=0){
	$.ajax({
	    type: "post", url: "../core/saprocess/sa_section.php",data:{exe:s,temp:t},
	    success: function (rx) {
	    	if(rx[0]=='<'){
	    		document.getElementById('xerror').innerHTML=rx;
	    	}
	    	if(rx.indexOf("¬")>0){
	    		r=rx.split("¬");
				$("#"+r[0]).html(r[2]);
			}else{
				alert(rx);
				$("#debug").html(rx);
			}
	    },
	    error: function (request, status, error) {
	    	showAlert(status,error);
	    }
	});
}
function bbprocess(e,type){
	//alert(e);
	c='';
	capsule='';
	if(type=='eventObjs'){
		c=e.split("#");
		caracter='|';
	}
	if(c.length>0){
		comm=c[0].split(":");
		p=comm[1];
		if(p.indexOf(caracter)>0){
			o=p.split(caracter);p='';
			for(i=0;i<o.length;i++){
				if(i!=0)p=p+'","';p=p+o[i];
			}
		}
		if(c.length>1){
			for(i=1;i<c.length;i++)
			if(c[i]!='')capsule=capsule+c[i]+'|#';
		}
		//alert(comm[0]+'("'+p+'","'+capsule+'");');
		eval(comm[0]+'("'+p+'","'+capsule+'");');
	}
}
function showSection(s,bsec='',cap=''){
	e=document.getElementById('main'+s);
	e1=document.getElementById('main_c'+s);
	e2=document.getElementById('mod'+s);
	if(typeof(e) != 'undefined' && e != null){
		e.style.display = 'block';
	}
	if(typeof(e1) != 'undefined' && e1 != null){
		e1.style.display = 'block';
	}
	if(typeof(e2) != 'undefined' && e2 != null){
		$('#mod'+s).modal('show');
	}
	if(cap!=''){
		bbprocess(cap,'eventObjs');
	}
}
function hideSection(s,bsec='',cap=''){
	e=document.getElementById('main'+s);
	e1=document.getElementById('main_c'+s);
	e2=document.getElementById('mod'+s);
	if(typeof(e) != 'undefined' && e != null){
		e.style.display = 'none';
	}
	if(typeof(e1) != 'undefined' && e1 != null){
		e1.style.display = 'none';
	}
	if(typeof(e2) != 'undefined' && e2 != null){
		$('#mod'+s).modal('hide');
	}
	if(cap!=''){
		bbprocess(cap,'eventObjs');
	}
}
function switchSection(s1,s2,cap=''){
	var uno = $("#"+objPrincipal(s1)+s1).contents();
	var dos = $("#"+objPrincipal(s2)+s2).contents();
	$("#"+objPrincipal(s1)+s1).append(dos);
	$("#"+objPrincipal(s2)+s2).append(uno);

	if(cap!=''){
		bbprocess(cap,'eventObjs');
	}
}
function objPrincipal(s){
	r='';
	e=document.getElementById('main'+s);
	e1=document.getElementById('main_c'+s);
	e2=document.getElementById('mod'+s);
	if(typeof(e) != 'undefined' && e != null){
		r='main';
	}
	if(typeof(e1) != 'undefined' && e1 != null){
		r='main_c';
	}
	if(typeof(e2) != 'undefined' && e2 != null){
		r='mod';
	}
	return r;
}
function exec_process2(n,p,cap=''){
	$.ajax({
	    type: "post", url: "../Core/Kernel/process.php",data:{n:n,p:p},
	    success: function (rx) {
	    	//alert(rx);
	    	if(rx[0]=='<'){
	    		document.getElementById('xerror').innerHTML=rx;
	    	}
	    	obj=rx.split('¬');
	    	q=obj.length-1;
	    	for(iw=0;iw<q;iw++){
	    		item=obj[iw].split('|');
	    		q2=item.length-1;
	    		for(j=0;j<q2;j++){
					fields=item[j].split(';');
					switch(fields[1]){
						case 'IST001':document.getElementById("f"+fields[0]).style.backgroundColor=fields[2];break;
						case 'IST002':document.getElementById("cont"+fields[0]).style.backgroundImage="url("+fields[2]+")";break;
						case 'IST003':document.getElementById("cont"+fields[0]).style.border=fields[2];break;
						case 'IST004':document.getElementById("cont"+fields[0]).style.boxShadow=fields[2];break;
						case 'IST005':document.getElementById("cont"+fields[0]).style.backgroundSize=fields[2];break;
						case 'IST006':document.getElementById("b"+fields[0]).style.padding=fields[2];break;
						case 'IST007':document.getElementById("main"+fields[0]).style.backgroundColor=fields[2];break;
						case 'IST008':document.getElementById(fields[0]).style.fontFamily=fields[2];break;
						case 'IST009':document.getElementById(fields[0]).style.fontSize=fields[2];break;
						case 'IST010':document.getElementById("t"+fields[0]).style.fontFamily=fields[2];break;
						case 'IST011':document.getElementById("t"+fields[0]).style.fontSize=fields[2];break;
						case 'IST012':document.getElementById("s"+fields[0]).style.fontFamily=fields[2];break;
						case 'IST013':document.getElementById("s"+fields[0]).style.fontSize=fields[2];break;
						case 'IST014':document.getElementById("h"+fields[0]).style.display="flex";document.getElementById("h"+fields[0]).style.justifyContent="space-between";break;
						case 'IST015':document.getElementById("h"+fields[0]).style.borderBottom=fields[2];break;
						case 'IST016':document.getElementById("f"+fields[0]).style.padding=fields[2];break;
						case 'IST017':document.getElementById("f"+fields[0]).style.borderTop=fields[2];break;
						case 'IST018':document.getElementById("a"+fields[0]).style.display="flex";document.getElementById("a"+fields[0]).style.justifyContent="space-between";break;
						case 'IST019':document.getElementById("cont"+fields[0]).style.borderRadius=fields[2];break;
						case 'IST020':document.getElementById("f"+fields[0]).style.borderRadius=fields[2];break;
						case 'IST021':document.getElementById("h"+fields[0]).style.borderRadius=fields[2];break;
						case 'IST022':document.getElementById("cont"+fields[0]).style.backgroundColor=fields[2];break;
						case 'IST023':document.getElementById(fields[0]).style.color=fields[2];break;
						case 'IST024':document.getElementById("t"+fields[0]).style.color=fields[2];break;
						case 'IST025':document.getElementById("s"+fields[0]).style.color=fields[2];break;
						case 'IST026':document.getElementById("h"+fields[0]).style.backgroundColor=fields[2];break;
						case 'IST027':document.getElementById("h"+fields[0]).style.fontSize=fields[2];break;
						case 'IST028':document.getElementById("t"+fields[0]).style.textAlign=fields[2];break;
						case 'IST029':document.getElementById("t"+fields[0]).style.textDecoration=fields[2];break;
						case 'IST030':document.getElementById("t"+fields[0]).style.textDecorationColor=fields[2];break;
						case 'IST031':document.getElementById("t"+fields[0]).style.textDecorationStyle=fields[2];break;
						case 'IST032':document.getElementById("s"+fields[0]).style.textDecoration=fields[2];break;
						case 'IST033':document.getElementById("s"+fields[0]).style.textDecorationColor=fields[2];break;
						case 'IST034':document.getElementById("s"+fields[0]).style.textDecorationStyle=fields[2];break;
						case 'IST035':document.getElementById("h"+fields[0]).style.textDecoration=fields[2];break;
						case 'IST036':document.getElementById("h"+fields[0]).style.textDecorationColor=fields[2];break;
						case 'IST037':document.getElementById("h"+fields[0]).style.textDecorationStyle=fields[2];break;
						case 'IST038':document.getElementById("s"+fields[0]).style.textAlign=fields[2];break;
						case 'IST039':document.getElementById("s"+fields[0]).style.backgroundColor=fields[2];break;
						case 'IST040':document.getElementById("t"+fields[0]).style.backgroundColor=fields[2];break;
						case 'IST041':document.getElementById("t"+fields[0]).style.fontWeight=fields[2];break;
						case 'IST042':document.getElementById("s"+fields[0]).style.fontWeight=fields[2];break;
						case 'IST043':document.getElementById("h"+fields[0]).style.fontWeight=fields[2];break;
						case 'IST044':document.getElementById("t"+fields[0]).style.textShadow=fields[2];break;
						case 'IST045':document.getElementById("s"+fields[0]).style.textShadow=fields[2];break;
						case 'IST046':document.getElementById("h"+fields[0]).style.textShadow=fields[2];break;
						case 'IST047':document.getElementById("h"+fields[0]).style.color=fields[2];break;
						case 'IPR001':
							if(fields[2]!='')
							document.getElementById("t"+fields[0]).innerHTML=fields[2];
							break;
						case 'IPR002':
							if(fields[2]!='')
							document.getElementById("h"+fields[0]).innerHTML=fields[2];
							break;
						case 'IPR003':
							if(fields[2]!='')
							document.getElementById("s"+fields[0]).innerHTML=fields[2];
							break;
						case 'IPR004':
							for(i=1;i<=12;i++)document.getElementById("main"+fields[0]).classList.remove("col-md-"+i);
							document.getElementById("main"+fields[0]).classList.add("col-md-"+fields[2]);
							break;
						case 'IPR005':
							document.getElementById("main"+fields[0]).style.height=fields[2];
							break;
						case 'IPR006':
							document.getElementById("v"+fields[0]).src=fields[2];
							break;
						case 'IPR007':
							//document.getElementById("ala"+fields[0]).innerHTML=fields[2];
							break;
						case 'IPR008':
							//document.getElementById("ala"+fields[0]).innerHTML=fields[2];
							break;
						case 'IPR009':
							//document.getElementById("ala"+fields[0]).innerHTML=fields[2];
							break;
						case 'IPR010':
							document.getElementById("main"+fields[0]).style.top=fields[2];
							break;
						case 'IPR011':
							document.getElementById("main"+fields[0]).style.left=fields[2];
							break;
						case 'IPR012':
							w=fields[2];
							if(w==-1) w=$(window).width();
							document.getElementById("cont"+fields[0]).style.width=w+'px';
							break;
						case 'IPR013':
							h=fields[2];
							if(h==-1) h=$(window).height();
							document.getElementById("cont"+fields[0]).style.height=h+'px';
							break;
						case 'SEV001':
							setTimeout(function(){bbprocess('exec_process2:'+fields[0]+'|','eventObjs','encabez');},fields[2]);
							break;
						case 'SEV002':
							bbprocess('exec_process2:'+fields[0]+'|','eventObjs');
							break;
						case 'SEV003':
							bbprocess(fields[0],'eventObjs');
							break;
						case 'SEV004':
							call(fields[0]); // analizar si necesitar ejecutar el "cap"
							break;
						case 'SEV005':
							switchSection(fields[0],fields[2],cap);
							break;
					}
	    		}
	    	}
	    	if(cap!=''){
	    		bbprocess(cap,'eventObjs');
	    	}
	    },
	    error: function (request, status, error) {
	    	alert(status);
	    	alert(error);
	    }
	});	
}




function test(p,s){

	var controls = document.getElementById(s).getElementsByClassName("i__ov_"+p);

	val='';
	tc=0;
	for(i=0;i<controls.length;i++){
		t=controls[i].dataset.xtype;
		f=controls[i].dataset.xform;
		v=controls[i].dataset.xval;
		
		val=val+controls[i].value+' = '+t+' = '+v+'  ¬';
	}
	//estos datos se deben enviar a un "sa"
	alert(val);
}
function spot(s,n,m){
	$.ajax({
	    type: "post", url: "../Core/saprocess/sa_spots.php",data:{exe:s,exe2:n,exe3:m},
	    success: function (rx) {
			$("#"+s).html(rx);
	    },
	    error: function (request, status, error) {
	    	showAlert(status,error);
	    }
	});
}
function interact2(s,com,v,bsec=''){
	$e='document.getElementById("cont'+s+'").'+com+'='+v;eval($e);
	alert($e);
}
function interact(s,com,v,bsec=''){
	$e='document.getElementById("cont'+s+'").style.'+com+'="'+v+'"';eval($e);
	alert($e);
}

function flowSection(s,bsec=''){
	$('#cont'+s).removeClass('card');
	$('#cont'+s).removeClass('card-flow');
	$('#cont'+s).addClass('card');
}
function freezeSection(s,bsec=''){
	$('#cont'+s).removeClass('card-flow');
	$('#cont'+s).removeClass('card');
	$('#cont'+s).addClass('card-flow');
}


function morphSpot(s,n,m){
	spot(s,n,m);
}


function getSpotValues(s){
	//buscar todos los elementos que comienzan don c__ en el id
	//que esten dentro del section indicado
	//y extraer los datos dependiendo de su type segun Spot que esta en data-xcode
	var controls = document.getElementById(s).getElementsByClassName("c__ovalo");

	val='';
	tc=0;
	for(i=0;i<controls.length;i++){
		type=controls[i].dataset.xcode;
		switch(type){
			case 'text':
				tc=1;
				break;
			case 'number':
				tc=0;
				break;
		}
		val=val+prepareValue(controls[i].value,tc)+'¬';
	}
	//estos datos se deben enviar a un "sa"
	alert(val);
}

function BB875277123(s){
	//esto de dev debe ser una variable de configuracion por si ya esta en produccion
	location.href='dev.php?shade='+s;
}

function prepareValue(v,tc){
	ret=v;
	if(tc==1){
		ret='"'+v+'"';
	}
	return ret;
}

function getValueElementById(s,e){
	var controls = document.getElementById(e);
	alert(controls.value);
}

//tambien debe recibir el nombre del section para que lo vuelva actualizar

/** 
LOS DATOS DEBEN SER ENVIADOS AL PROCESO EN FORMATO JSON

[element=1
type=text
name(id)=sd
value=hola,
element=2
type=text
name(id)=otro
value=prueba]


*/


function exec_process(s,p,f,x){
	var sec = document.getElementById(s), 
    elements = sec.getElementsByTagName('*'); 
	val='';
	tc=-1;
	elems=0;
	for(i=0;i<elements.length;i++){
		type=elements[i].dataset.ovtype;
		tc=-1;
		switch(type){
			case 'text':
				tc=1;
				break;
			case 'number':
				tc=0;
				break;
		}
		if(elems>0 && tc>=0)val=val+',';
		if(tc>=0){
			elems++;
			val=val+'{"id": "'+elements[i].id+'", "val": '+prepareValue(elements[i].value,tc)+'}';
		}
	}
	val='{"fields": ['+val+']}';
	//alert(val);

	$("#"+s).append("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
	$.ajax({
	    type: "post", url: "../Core/Kernel/process.php",data:{s:s,p:p,v:val,f:f,x:x},
	    success: function (rx) {
			v=rx.split('|');
			//ACTUALIZACION DE PAGINA
			if(v[0]=="1"){
				$("#"+s).html(v[1]);
				//alert(v[1]);
			}
			//MOSTRAR ALERTA
			if(v[2]!="0"){
				if(v[2]=="1")$("#"+s).prepend(v[3]);
				if(v[2]=="2")$("#"+s).append(v[3]);
			}
			//MOSTRAR ERROR
			if(v[4]=="1"){
				alert(v[5]);
			}
			//MOSTRAR OTHERS
			for(oi=0;oi<5;oi++){
				if(v[oi+6]!="" && v[oi+6]!=null){
					call(v[oi+6],1);
				}
			}
			//call(s);
	    	//alert(rx);
	    },
	    error: function (request, status, error) {
	    	showAlert(status,error);
	    }
	});	
}
</script>



