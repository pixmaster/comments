window.GLOBAL = {};

function setGlobal(name,obj)
 {
  window.GLOBAL[name] = obj;
 }

function getGlobal(name)
 {
  return window.GLOBAL[name];
 }

function RemoveElementsFromObj(obj)
 {
  count_el = obj.children.length;

  if (count_el > 0)
   {
    ch_el = [];
    for(i = 0;i < count_el;i++)
     {
      ch_el[i] = obj.children.item(i);
     }

    for(i = 0;i < ch_el.length;i++)
     {
      obj.removeChild(ch_el[i]);
     }
   }
 }

function GetInputObjValueById(id)
 {
  return GetInputObjValue(getElementById(id));
 }

function GetInputObjValue(obj)
 {
  return obj.value;
 }

function DisplayId(id)
 {
  obj = getElementById(id);
  if (obj.style.display == "") obj.style.display = "none";
  else                         obj.style.display = "";
 }

function DisplayObj(obj)
 {
  if (obj.style.display == "") obj.style.display = "none";
  else                         obj.style.display = "";
 }

function GetVisibilityObj(obj)
 {
  if (obj.style.display == "") return true;
  else                         return false;
 }

function getElementById(el)
 {
  return document.getElementById(el);
 }

function createElement(tag)
 {
  return document.createElement(tag.toUpperCase());
 }

function createTable(iRow,iCell)
 {
  oTab = createElement("table");
  oTb  = createElement("tbody");
  oTab.appendChild(oTb);

  for (indexRow=1;indexRow<=iRow;indexRow++)
   {
    oTr = createElement("tr");
    for (indexCell=1;indexCell<=iCell;indexCell++)
     {
      td = createElement("td");
      oTr.appendChild(td);
     }
    oTb.appendChild(oTr);
   }

  return oTab;
 }

function MergeStyleStrs(str1,str2)
 {
  var oStyleArea = {};

  atmpStr1 = str1.split(";");
  atmpStr2 = str2.split(";");

  for(var i in atmpStr1)
   {
    tmpCurrStyle = atmpStr1[i].split(":");
    oStyleArea[tmpCurrStyle[0]] = tmpCurrStyle[1];
   }

  for(var i in atmpStr2)
   {
    tmpCurrStyle = atmpStr2[i].split(":");
    oStyleArea[tmpCurrStyle[0]] = tmpCurrStyle[1];
   }

  var return_str = "";

  for(var i in oStyleArea)
   {
    if (!isEmpty(i) && !isEmpty(oStyleArea[i]))
     {
      return_str += i+":"+oStyleArea[i]+";";
     }
   }

  return return_str;
 }

function setStyle(oElement,sStyle)
 {
  var aStyle = sStyle.split(";");

  if (isArray(aStyle))
   {
    for(var i in aStyle)
     {
      sItemStyle = aStyle[i];
      aStyleParam = sItemStyle.split(":");
      oElement.style[aStyleParam[0]] = aStyleParam[1];
     }
   }
 }

function setAttributeExt(oElement,sAttrName,mAttr)
 {
  if (sAttrName.match(/^on.*/ig))
   {
    if (!(window.attachEvent)) oElement.addEventListener(sAttrName.substr(2), mAttr, false);
    else oElement.attachEvent(sAttrName,mAttr);
   }
  else if (sAttrName.toLowerCase() == "style") setStyle(oElement,mAttr);
  else if (sAttrName.toLowerCase() == "class") oElement.className = mAttr;
  else oElement.setAttribute(sAttrName,mAttr);
 }

function getPos(el)
 {
  var r = {x : el.offsetLeft, y : el.offsetTop};

  if (el.offsetParent)
   {
    var tmp = getPos(el.offsetParent);
    r.x += tmp.x;
    r.y += tmp.y;
   }

  return r;
 }

function isNumber(obj)
 {
  if (typeof(obj) == "number") return true;
  return false;
 }

function isString(obj)
 {
  if (typeof(obj) == "string") return true;
  return false;
 }

function isObject(obj)
 {
  if ((obj instanceof Object) || (typeof(obj) == "object")) return true;
  return false;
 }

function isArray(obj)
 {
  if (obj instanceof Array) return true;
  return false;
 }

function isUndefined(property)
 {
  return (typeof property == 'undefined');
 }

function isEmpty(obj)
 {
  if ((isString(obj) || isArray(obj)) && obj.length > 0) return false;
  else if (isObject(obj) && obj.count() > 0) return false;
  else return true;
 }

function isEven(iVal)
 {
  return !(iVal%2);
 }