<?PHP if(!isset($title_text)){$title_text="WELCOME TO LANGUAGE TRANSLATORS&nbsp; ";} $_SESSION["_appName"]="VMS"; if(!isset($sub_title)){$sub_title="&nbsp; ";} if(!isset($basefolder) || $basefolder=='')$basefolder='';   ?>
<style>
.logo-bg{
background:-webkit-linear-gradient(rgba(204,204,204,.1), rgba(153,153,153,.1), rgba(102,102,102,.1));
background:-o-linear-gradient( rgba(204,204,204,.1), rgba(153,153,153,.1), rgba(102,102,102,.1));
background:-moz-linear-gradient( rgba(204,204,204,.1), rgba(153,153,153,.1), rgba(102,102,102,.1));
background:transparent linear-gradient( rgba(204,204,204,.1), rgba(153,153,153,.1), rgba(102,102,102,.1)) ;
color:#333300; 
}
.page-body-font{
font-size:13px;
}
.cil-hdr-font1{
  font-family:arial;
  font-size:28px;	
  font-weight:900;
  text-align:left ;
   
}
.cil-hdr-font2{
	text-align:left ;
} 
.cil-img_{
display:block;
text-align:left;
margin-left:auto;
margin-right:0;	
} 
@media screen and (max-width:767px){
 	
.cil-hdr-font1{
  font-size:20px;	 
  text-align:left;
  padding-left:15px;
}
.cil-hdr-font2{ 
  text-align:left;
  padding-left:15px;
 }
.cil-img_{

display:block;
margin-left:auto;
margin-right:auto;	
} 
}

@media screen and (max-width:508px){
.cil-hdr-font1{
  font-size:15px;	
  
}
.cil-hdr-font2{	
  font-size:11px;
  
 } 
 .page-body-font{
font-size:11px;
}
.cil-img_{
height:65px;
width:65px;
} 
}
@media screen and (max-width:358px){
.cil-hdr-font1{
  font-size:11px;	 
  padding-left:22px;
} 
.cil-hdr-font2{
  padding-left:21px;
} 
.page-body-font{
font-size:10px; 
}
.cil-img_{
height:58px;
width:58px;
} 
}

</style>
<div class="container-fluid logo-bg" style="box-shadow:1px 1px .1px 1px rgba(204,204,204,.3); background:rgba(204,204,204,.3); z-index:100; " id="logo_title" >
<div class="container">
<div class="row">
    <div  class="col-xs-2" style="padding-top:7px;" id='hdr_img'>
        <img src="logo.png?v=2" draggable="false" style="max-width:100px; max-height:100px; opacity:.9;" class="img-responsive cil-img_" />
    </div>
    <div  class="col-xs-10" align="left" ><h1 class="cil-hdr-font1"><?PHP echo $title_text; ?></h1><p class="cil-hdr-font2" ><?PHP echo $sub_title; ?></p></div>
  </div>
  </div>
  </div>
  <script>
  function scrollToBottom(yourDivId){
	  if(document.getElementById(yourDivId)){
  		$('#'+yourDivId).scrollTop($('#'+yourDivId)[0].scrollHeight);
		 
	  }
	}
  function scrollUptoDv(dvid,Scrl_ele){
   var Scroll_dvEle="html, body"; /*Default element to be scrolled*/
  if(typeof Scrl_ele!="undefined" && Scrl_ele!=null && Scrl_ele!='' && document.getElementById(Scrl_ele)){Scroll_dvEle=document.getElementById(Scrl_ele);}	 
  if(document.getElementById(dvid)){ 
    $(document).ready(function(){ 
    $(Scroll_dvEle).animate({scrollTop: $("#"+dvid).offset().top}, 1000);
    });
  }  	
 }
 window._appvar ={'title':'Sales dispatch Vehicle Management.'};
 function setDataToAppvar(_xk_,_xv_){
    if(typeof window._appvar=='undefined' || window._appvar==null){window._appvar = {};}
    if(window._appvar){
        window._appvar[_xk_] = _xv_
    }
 }
 function getDataFromAppvar(_xk_){
    if(typeof window._appvar=='undefined' || window._appvar==null || typeof window._appvar[_xk_]=='undefined'){return null;}
    if(window._appvar[_xk_]){
        return window._appvar[_xk_];
    }
 }
 function pushDataToAppvar(_xk_,_xv_){
    if(typeof window._appvar=='undefined' || window._appvar==null ){window._appvar = {};}
    if(typeof window._appvar[_xk_]=='undefined' || window._appvar[_xk_]==null){window._appvar[_xk_] = [];}
    if(window._appvar){
        window._appvar[_xk_].push (_xv_);
    }
 }
 function deleteDatafromAppvar(_xk_){
    if(typeof window._appvar=='undefined' || window._appvar==null ){return false;}
    if(typeof window._appvar[_xk_]=='undefined' || window._appvar[_xk_]==null){return false;}
    if( window._appvar[_xk_]){
        delete window._appvar[_xk_];
    }
 }
 function clearAppvar(){
    if( window._appvar){
        window._appvar={};
    }
 }
  </script>
<?PHP 
 /*Display amount in text functions*/
 function StringifyNumb($ndgt){ 
		 $arrS=array('0'=>'Zero','1'=>'One','2'=>'Two', '3'=>'Three', '4'=>'Four', '5'=>'Five','6'=>'Six','7'=>'Seven','8'=>'Eight','9'=>'Nine','10'=>'Ten', '11'=>'Eleven','13'=>'Thirteen','14'=>'Fourteen','15'=>'Fifteen','16'=>'Sisteen','17'=>'Seveteen','18'=>'Eighteen', '19'=>'Ninteen','20'=>'Twenty','30'=>'Thirty','40'=>'Fourty','50'=>'Fifty','60'=>'Sixty','70'=>'Seventy','80'=>'Eighty','90'=>'Ninty');
		 $arrTY=array('2'=>'Twenty', '3'=>'Thirty', '4'=>'Fourty', '5'=>'Fifty','6'=>'Sixty','7'=>'Seventy','8'=>'Eighty','9'=>'Ninty','0'=>''); 
    if(strlen($ndgt)<2){return $arrS[$ndgt]; }else{if($ndgt[1]=='0' || ($ndgt[0]=='1' && $ndgt[1]<9)){ return $arrS[$ndgt]; }
    else{ return $arrTY[$ndgt[0]].'-'.$arrS[$ndgt[1]]; }}
 }
 function placeKey($NumPlace){
					 if($NumPlace>=8 && $NumPlace<=9){return " Crore "; 
					 }else if($NumPlace>=6 && $NumPlace<=7){return " Lack ";
					 }else if($NumPlace>=4 && $NumPlace<=5){return " Thousand ";
					 }else if($NumPlace==3){return " Hundreds ";
					 }else if($NumPlace>=11 && $NumPlace<=10){return " Arab ";
					 }else if($NumPlace>=13 && $NumPlace<=12){return " Kharab ";
					 }
					 
 } 
 function numberToTextAmount($amnt){
				    $splt=explode('.',$amnt); 
					$amt=$splt[0];
					/*------------Handling Decimal------------*/
					$Decimal_num='';
					if(count($splt)==2)
					{  $psa=$splt[1];
					   if($psa[0]=='0'){$psa=$psa[1];}
					   if($psa==0){$Decimal_num=' Zero ';}
					   else{$Decimal_num=StringifyNumb($psa);}
					}/*--------------./Handling Decimal---------------*/
					$len=strlen($amt);
					   
					$fstIndex=1; /*if amount is od digited*/
					if($len%2==0){
						$fstIndex=0;
					}
					$numToTextDigits='';
					$numToText_string='';
					$maxDigits=strlen($amt); 
					for($i=0;$i<strlen($amt);$i++){
					    
					   if($i<=$fstIndex){
						$numToTextDigits=$numToTextDigits.''.$amt[$i];
						if($i==$fstIndex){   
						  $numToText_string.=StringifyNumb($numToTextDigits)." ".placeKey($maxDigits);
						  if(strlen($amt)-($i+1)==3){
							$fstIndex+=1;  
							$maxDigits=$maxDigits-1;
						  }else{
						  $fstIndex+=2;
						  $maxDigits=$maxDigits-2;
						  }
						  $numToTextDigits='';	
						}
						
					   }
					}
				   return $numToText_string.($Decimal_num!=''?' And '.$Decimal_num.' Paisa Only':' Only');
 }
 ?>  