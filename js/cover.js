function PopUpDialogCover()
 {
  function Resize()
   {
    if (typeof(document.body.clientTop) != "undefined")
     {
      if (MainContentArea.scrollHeight > document.body.offsetHeight)
       {
        height = MainContentArea.scrollHeight;
        if (document.body.clientHeight < MainContentArea.scrollHeight)
         {
          height += IndentHeight;
         }
       }
      else
       {
        if (document.body.clientHeight < MainContentArea.scrollHeight)
         {
          height = document.body.offsetHeight-(document.body.clientTop*2);
         }
        else
         {
          height = document.body.scrollHeight;//document.body.clientHeight;
         }
       }

      if (MainContentArea.scrollWidth > document.body.offsetWidth)
       {
        width = MainContentArea.scrollWidth+IndentWidth;
       }
      else
       {
        width = document.body.offsetWidth-(document.body.clientLeft/2)-BodyMarginWidth;
       }
     }
    else
     {
      if (MainContentArea.scrollHeight > document.body.offsetHeight)
       {
        height = MainContentArea.scrollHeight;
        if (document.body.clientHeight < MainContentArea.scrollHeight)
         {
          height += IndentHeight;
         }
       }
      else
       {
        if (document.body.clientHeight < MainContentArea.scrollHeight)
         {
          height = document.body.offsetHeight+IndentHeight;
         }
        else
         {
          height = document.body.clientHeight;
         }
       }

      if (MainContentArea.scrollWidth+IndentWidth == document.body.scrollWidth)
       {
        width = MainContentArea.scrollWidth+IndentWidth;
       }
      else if ((MainContentArea.scrollWidth+IndentWidth == document.body.clientWidth) &&
               (document.body.clientWidth == document.body.scrollWidth))
       {
        width = document.body.clientWidth;
       }
      else
       {
        width = document.body.clientWidth-BodyMarginWidth;
       }
     }

    oCover.style.width  = width+"px";
    oCover.style.height = height+"px";
   }

  function EventResize()
   {
    Resize();

    if (typeof(oCover.style.MozOpacity)!="undefined") //мозилла и прочие Gecko
     {
      Resize();
     }
   }

  this.Show = function()
   {
    ContentHeight = document.body.scrollHeight;
    this.ContentHeight = document.body.scrollHeight;
    Resize();
    oCover.style.display = "";
   }

  function Hide()
   {
    oCover.style.display = "none";
   }

  this.Hide = function()
   {
    Hide();
   }

  this.InsertHTML = function(HTML)
   {
    oCover.innerHTML = HTML;
   }

  this.appendObj = function(obj)
   {
    if (this.appendObj.arguments.length == 1)
     {
      oCover.innerHTML = "";
     }

    oCover.appendChild(obj);
   }

  function Create()
   {
    document.body.appendChild(oCover);
   }

  this.Create = function()
   {
    Create();
   }

  function Destroy()
   {
    document.body.removeChild(oCover);
   }

  this.Destroy = function()
   {
    Destroy();
   }

  var oCover  = document.createElement("DIV");

  var MainContentArea = document.getElementsByTagName("DIV").item(0);

  oRules = (document.styleSheets[0].rules) ? document.styleSheets[0].rules : document.styleSheets[0].cssRules;

  var BodyMarginHeight  = parseInt(oRules.item('body').style.marginTop)+
                          parseInt(oRules.item('body').style.marginBottom);
  var BodyPaddingHeight = parseInt(oRules.item('body').style.paddingTop)+
                          parseInt(oRules.item('body').style.paddingBottom);

  var BodyMarginWidth   = parseInt(oRules.item('body').style.marginLeft)+
                          parseInt(oRules.item('body').style.marginRight);
  var BodyPaddingWidth  = parseInt(oRules.item('body').style.paddingLeft)+
                          parseInt(oRules.item('body').style.paddingRight);

  var IndentHeight = BodyMarginHeight+BodyPaddingHeight;
  var IndentWidth  = BodyMarginWidth+BodyPaddingWidth;
  var opacity = 50; // %

  this.cover = oCover;
  this.MainContentArea = MainContentArea;

  if      (typeof(oCover.style.KhtmlOpacity)!="undefined") //konquerror и его семейство
   {
    oCover.style.KhtmlOpacity = opacity/100;
   }
  else if (typeof(oCover.style.MozOpacity)!="undefined") //мозилла и прочие Gecko
   {
    oCover.style.MozOpacity = opacity/100;
   }
  else if (typeof(oCover.filters)!="undefined") //ИЕ
   {
    oCover.style.filter = "alpha(opacity="+opacity+")";
   }
  else if (typeof(oCover.style.opacity)!="undefined") //CSS3
   {
    oCover.style.opacity = opacity/100;
   }

  setAttributeExt(oCover,"style","position:absolute;zIndex:1000;padding:0px;margin:0px;border:0px solid red;top:0px;left:0px;backgroundColor:#25843C;display:none;");

  setAttributeExt(window,"onresize",EventResize);

  Create();
 }
