/**
 * 检验两次输入的密码是否一致
 * @returns true or false
 */
function isPasswordEqual(){
    var passwd = $("#password").attr("value");
    var passwd1 = $("#password1").attr("value");
    
    if(passwd!==passwd1){
        document.getElementById("errorpassword").style.display="inline";
        document.getElementById("rightpassword").style.display="none";
        return false;
    }
    else if(passwd===passwd1)
    {
        document.getElementById("errorpassword").style.display="none";
        document.getElementById("rightpassword").style.display="inline";
        document.getElementById("password2").style.display="inline";
    }
    return true;
}

//创建ajax引擎
function getXmlHttpObject(){
    var xmlHttp;
    //检测浏览器是否支持XMLHttpRequest对象
    if(window.XMLHttpRequest){
        xmlHttp = new XMLHttpRequest();
    }else{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlHttp;
}

/**
 * 验证用户名是否存在
 * @type @exp;getXmlHttpObject@pro;xmlHttp
 */
var xmlHttp = getXmlHttpObject();
function isUserExist(){
    
    if(xmlHttp){
        //通过xmlHttp对象发送请求到服务器的某个页面
        //第一个参数表示请求的方式
        //第二个参数指定url,对哪个页面发出ajax请求(本质是http请求)
        //true表示使用异步机制
        var url = "../action/register_action.php?flag=usernamecheck&username="+$("#user_name").attr("value");
        xmlHttp.open("get",url,true);
        //指定回调函数
        xmlHttp.onreadystatechange=userDeal;
        
        //发送请求,get请求参数为null即可，post请求则填入实际的数据
        xmlHttp.send(null);
    }
}

//回调函数,获取ajax的返回信息后进行处理
function userDeal(){
       //取出从register_action.php返回的数据
       if(xmlHttp.readyState===4){
           var return_values = xmlHttp.responseText;
           if(return_values === '0'){
               document.getElementById("userexist").style.display="none";
               document.getElementById("usernotexist").style.display="inline";
               
           }
           else if(return_values === '1')
           {
               document.getElementById("userexist").style.display="inline";
               document.getElementById("usernotexist").style.display="none";
               
           }
       }
}

/**
 * 验证邮箱是否存在
 * @returns {undefined}
 */
function isEmailExist(){
    
    if(xmlHttp){
        //通过xmlHttp对象发送请求到服务器的某个页面
        //第一个参数表示请求的方式
        //第二个参数指定url,对哪个页面发出ajax请求(本质是http请求)
        //true表示使用异步机制
        var url = "../action/register_action.php?flag=emailcheck&useremail="+$("#user_email").attr("value");
        xmlHttp.open("get",url,true);
        //指定回调函数
        xmlHttp.onreadystatechange=emailDeal;
        
        //发送请求,get请求参数为null即可，post请求则填入实际的数据
        xmlHttp.send(null);
    }
}

//回调函数,获取ajax的返回信息后进行处理
function emailDeal(){
    
       //取出从register_action.php返回的数据
       if(xmlHttp.readyState===4){
           var return_values = xmlHttp.responseText;
          
           if(return_values === '0'){
               document.getElementById("emailexist").style.display="none";
               document.getElementById("emailnotexist").style.display="inline";
           }
           else if(return_values === '1')
           {
               document.getElementById("emailexist").style.display="inline";
               document.getElementById("emailnotexist").style.display="none";
               
           }
       }
}

/**
 * 验证手机号码是否存在
 * @returns {undefined}
 */
function isPhoneExist(){
    
    if(xmlHttp){
        //通过xmlHttp对象发送请求到服务器的某个页面
        //第一个参数表示请求的方式
        //第二个参数指定url,对哪个页面发出ajax请求(本质是http请求)
        //true表示使用异步机制
        var url = "../action/register_action.php?flag=phonecheck&userphone="+$("#user_phonenumber").attr("value");
        xmlHttp.open("get",url,true);
        //指定回调函数
        xmlHttp.onreadystatechange=phoneDeal;
        
        //发送请求,get请求参数为null即可，post请求则填入实际的数据
        xmlHttp.send(null);
    }
}

//回调函数,获取ajax的返回信息后进行处理
function phoneDeal(){
    
       //取出从register_action.php返回的数据
       if(xmlHttp.readyState===4){
           var return_values = xmlHttp.responseText;
           
           if(return_values === '0'){
               document.getElementById("phoneexist").style.display="none";
               document.getElementById("phonenotexist").style.display="inline";
               
           }
           else if(return_values === '1')
           {
               document.getElementById("phoneexist").style.display="inline";
               document.getElementById("phonenotexist").style.display="none";              
           }
       }
}

/**
 * 若表单填写有误则禁止提交表单
 * @returns {Boolean}
 */
function prevent_form_post(){
     
    //判断用户名是否为空
    if($("#user_name").attr("value")===""){
        document.getElementById("user_name").focus();
        return false;
    }
    else if(document.getElementById("userexist").style.display==="inline"){
        document.getElementById("user_name").focus();
        return false;
    }
    //判断密码是否为空
    else if($("#password").attr("value")===""){
        document.getElementById("password").focus();
        return false;
    }
    else if(document.getElementById("errorpassword").style.display==="inline"){
        document.getElementById("password1").focus();
        return false;
    }
    //判断Email是否为空
    else if($("#user_email").attr("value")===""){
        document.getElementById("user_email").focus();
        return false;
    }
    else if(document.getElementById("emailexist").style.display==="inline"){
        document.getElementById("user_email").focus();
        return false;
    }
    //判断手机号码是否为空
    else if($("#user_phonenumber").attr("value")===""){
        document.getElementById("user_phonenumber").focus();
        return false;
    } 
    else if(document.getElementById("phoneexist").style.display==="inline"){
        document.getElementById("user_phonenumber").focus();
        return false;
    }
    else if($("#login_identity").attr("value")!=="sadmin"){
        alert("权限不足！只有超级管理员才能添加管理员");
        return false;
    }
    alert("添加成功!");
    return true;
}

function confirm_del()
{
    if($("#login_identity").attr("value")!=="sadmin"){
        alert("权限不足！");
        return false;
    }
    else{
        if(confirm("确定删除该管理员账号吗?")===true){
        return true;
    }
    }
    return false;
}

//判断是否为超级管理员，否则不能修改管理员信息
function comfirm_identity(){
    if($("#login_identity").attr("value")!=="sadmin"){
        alert("权限不足，只有超级管理员才能修改其他人信息！");
        return false;
    }
    return true;
}

//显示修改密码
function show_changepasswd(){
    
    if($('#show_changepassword').attr("value")==='修改密码'){
        
        document.getElementById('passwd').style.display='block';
        document.getElementById('passwd1').style.display='block';
        document.getElementById('old_passwd').style.display='block';
        document.getElementById('show_changepassword').value='取消';
    }
    else if($('#show_changepassword').attr("value")==='取消'){
        document.getElementById('passwd').style.display='none';
        document.getElementById('passwd1').style.display='none';
        document.getElementById('old_passwd').style.display='none';
        document.getElementById('show_changepassword').value='修改密码';
    }
}

/**
 * 检验旧密码是否正确
 * @returns {undefined}
 */
function check_oldpassword(){
    if($("#old_password").attr("value")!==$("#login_password").attr("value")){
        $("#old_password_false").css("display","inline");
        $("#old_password_true").css("display","none");
    }
    else if($("#old_password").attr("value")===$("#login_password").attr("value")){
        $("#old_password_false").css("display","none");
        $("#old_password_true").css("display","inline");
    }
}


/**
 * 若表单填写有误则禁止提交表单
 * @returns {Boolean}
 */
function can_change_userinfo(){
     
    if(document.getElementById("old_password_false").style.display==="inline"){
        document.getElementById("old_password").focus();
        return false;
    }
    //判断Email是否为空
    else if($("#user_email").attr("value")===""){
        document.getElementById("user_email").focus();
        return false;
    }
    else if(document.getElementById("emailexist").style.display==="inline"){
        document.getElementById("user_email").focus();
        return false;
    }
    //判断手机号码是否为空
    else if($("#user_phonenumber").attr("value")===""){
        document.getElementById("user_phonenumber").focus();
        return false;
    } 
    else if(document.getElementById("phoneexist").style.display==="inline"){
        document.getElementById("user_phonenumber").focus();
        return false;
    }
    return true;
}



