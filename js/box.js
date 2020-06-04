function BoxClass(HeadText,width,height,CoverFlag)
 {
  this.Show = function()
   {
    if (CoverFlag)
     {
      oCover.Show();
     }

    oMainBox.style.display = "";
   }

  this.Hide = function()
   {
    Hide();
   }

  function Hide()
   {
    if (CoverFlag)
     {
      oCover.Hide();
     }

    oBodyArea.innerHTML = "";
    oMainBox.style.display = "none";
   }

  function OverCloseBtn()
   {
    oTitleCloseBtn.src = ImagesDir+"/"+ImgCloseABtn;
   }

  function OutCloseBtn()
   {
    oTitleCloseBtn.src = ImagesDir+"/"+ImgCloseBtn;
   }

  this.appendObj = function(obj)
   {
    oBodyArea.innerHTML = "";
    oBodyArea.appendChild(obj);
   }

  this.innerHTML = function(html)
   {
    oBodyArea.innerHTML = html;
   }

  this.EraseBody = function()
   {
    oBodyArea.innerHTML = "";
   }

  this.Add2Body = function(obj)
   {
    oBodyArea.appendChild(obj);
   }

  this.SetTitle = function(text)
   {
    oTitle.innerHTML = text;
   }

  this.getElementBody = function()
   {
    return oBodyArea;
   }
// ==================================================================
  var ImagesDir     = "images";
  var ImgTitleBg    = "box_title_bg.png";
  var ImgCloseBtn   = "box_title_close.png";
  var ImgCloseABtn  = "box_title_close_a.png";

  var oMainBox           = document.createElement("DIV");
  oMainBox.className     = "class_box";
  oMainBox.style.zIndex  = 10000;
  oMainBox.style.display = "none";
  oMainBox.style.width   = width+"px";
  oMainBox.style.height  = height+"px";

  if (CoverFlag)
   {
    var oCover = new PopUpDialogCover();
   }

  if (BoxClass.arguments.length > 4)
   {
    oMainBox.style.top = BoxClass.arguments[4]+"px";

    if (BoxClass.arguments.length > 5)
     {
      oMainBox.style.left = BoxClass.arguments[5]+"px";
     }
   }

  box_tpl = '<table border="0" cellspacing="0" cellpadding="0" class="{TITLE_CLASS}" style="background-image:url(images/box_title_bg.png)"><tr><td width="100%" id="{TITLE_ID}" style="color:white">{TITLE_TEXT}</td><td></td><td></td><td><img src="images/box_title_close.png" id="{CLOSE_BTN_ID}"></td></tr></table><div class="{BODY_CLASS}" id="{BODY_ID}">{BOX_BODY}</div>';

  rnd = Math.round(Math.random()*1000);

  box_tpl = box_tpl.replace(/\{TITLE_CLASS\}/,"class_boxTitle");
  box_tpl = box_tpl.replace(/\{TITLE_TEXT\}/,HeadText);
  box_tpl = box_tpl.replace(/\{TITLE_ID\}/,"title"+rnd);
  box_tpl = box_tpl.replace(/\{CLOSE_BTN_ID\}/,"cbtn"+rnd);
  box_tpl = box_tpl.replace(/\{BODY_ID\}/,"body"+rnd);
  box_tpl = box_tpl.replace(/\{BODY_CLASS\}/,"class_boxBody");
  box_tpl = box_tpl.replace(/\{BOX_BODY\}/,"");

  oMainBox.innerHTML = box_tpl;
  document.body.appendChild(oMainBox);
  var oTitleCloseBtn = document.getElementById("cbtn"+rnd);

  var oBodyArea = document.getElementById("body"+rnd);
  var oTitle    = document.getElementById("title"+rnd);

  setAttributeExt(oTitleCloseBtn,"onclick",Hide);
  setAttributeExt(oTitleCloseBtn,"onmouseover",OverCloseBtn);
  setAttributeExt(oTitleCloseBtn,"onmouseout",OutCloseBtn);
 }
