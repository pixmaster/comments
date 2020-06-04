function AddCommentForm()
 {
  coord = getPos(oCommentArea);

  if (oBox = getGlobal("comment_box"))
   {}
  else
   {
    var oBox = new BoxClass("&nbsp;Форма добавления комментария",475,620,true,document.body.scrollTop,coord.x);
    setGlobal("comment_box",oBox);
   }


  oBox.Show();

  oTPL.insertAJAX(oBox.getElementBody(),
                  "comment_form",
                  "/comment/index.php?load_tpl=form&plugin=comment&id={ID}");
 }

function CommentSave(oBtn)
 {
  function ErrorAuth()
   {
    alert("Ошибка авторизации!\r\nНеверный логин или пароль");
    oBtn.disabled = false;
   }

  function SendFile()
   {
    oFormFile = getElementById("comment_form_upload");
    oFormFile.login.value = login;
    oFormFile.pwd.value   = pwd;
    oFormFile.submit();
    file_upload_timer = setInterval(Listener_upload,100);
   }

  function SendComment()
   {
    oReq = {"plugin":"comment",
            "action":"add",
            "login" :login,
            "pwd"   :pwd,
            "data[ProductID]"   :ProductID,
            "data[SaleDate]"    :SaleDate,
            "data[StrongPoints]":StrongPoints,
            "data[WeakPoints]"  :WeakPoints,
            "data[Analogs]"     :Analogs,
            "data[CommentText]" :CommentText,
            "rating[Rating]"    :ratingVal,
            "rating[ProductID]" :ProductID};

    if (SendComment.arguments.length == 1)
     {
      for(i=0;i<SendComment.arguments[0].length;i++)
       {
        oReq['data[Pic'+(i+1)+']'] = SendComment.arguments[0][i];
       }
     }

    new AJAX_Request("/comment/index.php","POST",Listener_add,oReq);
   }

  function Listener_upload()
   {
    if (aUploadedFiles = getGlobal("uploaded_files"))
     {
      result_upload = getGlobal("result_upload");

      clearInterval(file_upload_timer);

      if (result_upload != 200)
       {
        alert(result_upload+"\r\nКомментарий не добавлен, исправте ошибки с картинками");
        oBtn.disabled = false;
        setGlobal("result_upload",false);
        getElementById("upload_file_frame").location = "about:blank";
       }
      else
       {
        SendComment(aUploadedFiles);
       }
     }
   }

  function Listener_add(oResponseVars)
   {
    if (oResponseVars.result == 1)
     {
      alert("Коментарий добавлен, будет виден после проверки администратором");

      if (oResponseVars.resultRating == 0)
       {
        alert("Вы уже голосовали");
       }

      oBox.Hide();
     }
    else
     {
      ErrorAuth();
     }
   }

  function Listener_check_auth(oResponseVars)
   {
    if (oResponseVars.result == 1)
     {
      aPic = document.getElementsByName("comment_pic[]");
      isset_file_send = false;

      for(i=0;i<aPic.length;i++)
       {
        if (aPic[i].value != "")
         {
          isset_file_send = true;
          break;
         }
       }

      if (isset_file_send) SendFile();
      else                 SendComment();
     }
    else ErrorAuth();
   }

  var oBox  = getGlobal("comment_box");
  var login = getElementById("comment_login").value;
  var pwd   = getElementById("comment_pwd").value;
  var SaleDate     = getElementById("SaleDate").value;
  var StrongPoints = getElementById("StrongPoints").value;
  var WeakPoints   = getElementById("WeakPoints").value;
  var Analogs      = getElementById("Analogs").value;
  var CommentText  = getElementById("CommentText").value;
  var ratingVal    = 0;

  for(i=0;i<getElementById("comment_form").rating.length;i++)
   {
    if (getElementById("comment_form").rating[i].checked)
     {
      ratingVal = getElementById("comment_form").rating[i].value;
      break;
     }
   }

  var file_upload_timer = null;

  oBtn.disabled = true;

  if (login != "" && pwd != "")
   {
    oReq = {"plugin":"comment",
            "action":"check_auth",
            "login" :login,
            "pwd"   :pwd};

    new AJAX_Request("/comment/index.php","POST",Listener_check_auth,oReq);
   }
  else
   {
    alert("Поля 'Логин' и 'Пароль' не должны быть пусты");
    oBtn.disabled = false;
   }
 }

function RegistrationForm()
 {
  coord = getPos(oCommentArea);

  if (oBox = getGlobal("reg_box"))
   {}
  else
   {
    var oBox = new BoxClass("&nbsp;Форма регистрации",220,240,true,document.body.scrollTop,coord.x);
    setGlobal("reg_box",oBox);
   }

  oBox.Show();

  oTPL.insertAJAX(oBox.getElementBody(),
                  "registr_form",
                  "/comment/index.php?load_tpl=form_reg&plugin=comment&id={ID}");
 }

function RegSave(oBtn)
 {

  function Listener_reg_save(oResponseVars)
   {
    if (oResponseVars.result == 1)
     {
      alert("Регистрация прошла успешно.\r\nМожете оставлять комментарии");
      oBox.Hide();
     }
    else
     {
      alert("Ошибка регистрации!");
      oBtn.disabled = false;
     }
   }

  function Listener_check_login(oResponseVars)
   {
    if (oResponseVars.result == 1)
     {
      alert("Логин уже существует!");
      oBtn.disabled = false;
     }
    else
     {
      oReq = {"plugin":"comment",
              "action":"reg_save",
              "data[Login]":login,
              "data[Pwd]":pwd,
              "data[Name]":name,
              "data[Email]":email};

      new AJAX_Request("/comment/index.php","POST",Listener_reg_save,oReq);
     }
   }

  var oBox  = getGlobal("reg_box");
  var login = getElementById("comment_login").value;
  var pwd   = getElementById("comment_pwd").value;
  var name  = getElementById("comment_name").value;
  var email = getElementById("comment_email").value;

  oBtn.disabled = true;

  if (login != "" && pwd != "")
   {
    oReq = {"plugin":"comment",
            "action":"check_login",
            "login":login};

    new AJAX_Request("/comment/index.php","POST",Listener_check_login,oReq);
   }
  else
   {
    alert("Поля 'Логин' и 'Пароль' не должны быть пусты");
   }
 }
