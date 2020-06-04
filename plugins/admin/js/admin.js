function DeleteUserComment(area_id,UserID,oBtn)
 {
  function Listener(oResponse)
   {
    if (oResponse.result == 1)
     {
      oItem.outerHTML = "";
     }
    else
     {
      oBtn.disabled = false;
      alert("Ошибка удаления");
     }
   }

  oItem = getElementById(area_id);

  oReq = {"plugin":"admin",
          "action":"delete_user_comment",
          "UserID" :UserID};

  new AJAX_Request("/comment/index.php","POST",Listener,oReq);

  oBtn.disabled = true;
 }

function DeleteUser(area_id,UserID,oBtn)
 {
  function Listener(oResponse)
   {
    if (oResponse.result == 1)
     {
      oItem.outerHTML = "";
     }
    else
     {
      oBtn.disabled = false;
      alert("Ошибка удаления");
     }
   }

  oItem = getElementById(area_id);

  oReq = {"plugin":"admin",
          "action":"delete_user",
          "UserID" :UserID};

  new AJAX_Request("/comment/index.php","POST",Listener,oReq);

  oBtn.disabled = true;
 }

function OpenComment(area_id,CommentID,oBtn)
 {
  function Listener_open(oResponse)
   {
    if (oResponse.result == 1)
     {
      oItem.outerHTML = "";
     }
    else
     {
      oBtn.disabled = false;
      alert("Ошибка удаления");
     }
   }

  oItem = getElementById(area_id);

  oReq = {"plugin":"admin",
          "action":"open_comment",
          "CommentID" :CommentID};

  new AJAX_Request("/comment/index.php","POST",Listener_open,oReq);

  oBtn.disabled = true;
 }

function DeleteComment(area_id,CommentID,oBtn)
 {

  function Listener_delete(oResponse)
   {
    if (oResponse.result == 1)
     {
      oItem.outerHTML = "";
     }
    else
     {
      oBtn.disabled = false;
     }
   }

  oItem = getElementById(area_id);

  oReq = {"plugin":"admin",
          "action":"delete_comment",
          "CommentID" :CommentID};

  new AJAX_Request("/comment/index.php","POST",Listener_delete,oReq);

  oBtn.disabled = true;
 }


function menu_over(e)
 {
  el=window.event? window.event.srcElement: e.target
  el.style.backgroundColor = "#C6CDDD";
 }

function menu_out(e)
 {
  el=window.event? window.event.srcElement: e.target
  el.style.backgroundColor = el.real_color;
 }

function StartMenu()
 {
  oMain = document.getElementById("MenuArea");
  list  = oMain.childNodes;

  for(i=0;i<list.length;i++)
   {
    if (list.item(i).tagName == "DIV" && list.item(i).className == "")
     {
      list.item(i).real_color = list.item(i).style.backgroundColor;
      setAttributeExt(list.item(i),"onmouseover",menu_over);
      setAttributeExt(list.item(i),"onmouseout",menu_out);
     }
   }
 }

StartMenu();