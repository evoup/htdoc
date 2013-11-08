function inits(){
isDOM=document.getElementById?true:false
  isOpera=isOpera5=window.opera && isDOM
  isOpera6=isOpera && window.print
  isOpera7=isOpera && document.readyState
  isMSIE=isIE=document.all && document.all.item && !isOpera
  isStrict=document.compatMode=='CSS1Compat'
  isNN=isNC=navigator.appName=="Netscape"
  isNN4=isNC4=isNN && !isDOM
  isMozilla=isNN6=isNN && isDOM
}

inits(); 