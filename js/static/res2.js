/*function fixImgs(whichId, maxW) {
var pix=document.getElementById(whichId).getElementsByTagName('img');
  for (i=0; i<pix.length; i++) {
    w=pix[i].width;
    h=pix[i].height;
    if (w > maxW) {
      f=1-((w - maxW) / w);
      pix[i].width=w * f;
      pix[i].height=h * f;
    }
  }
}*/
function fixImgs(maxW) {
var pix=document.getElementById("content").getElementsByTagName("img");
  for (i=0; i<pix.length; i++) {
    w=pix[i].width;
    h=pix[i].height;
    if (w > maxW) {
      f=1-((w - maxW) / w);
      pix[i].width=w * f;
      pix[i].height=h * f;
    }
  }
}