/**
 * 进行对分类管理的一些操作
 */

/**
 * 确认删除分类，
 * 判断是否有权限删除分类
 */
function confirm_del()
{
    if($("#login_identity").attr("value")!=="sadmin"&&$("#login_identity").attr("value")!=="admin"){
        alert("权限不足！");
        return false;
    }
    else
    {
        if(confirm("确定删除该分类吗?")===true)
        {
            return true;
        }
        else
             return false;
    }
   return false;
}

/**
 * 创建Ajax引擎
 * @returns 
 */
function getXmlHttpObject()
{
    var xmlHttp;
    //检测浏览器是否支持XMLHttpRequest对象
    if(window.XMLHttpRequest)
    {
        xmlHttp = new XMLHttpRequest();
    }else{
        xmlHttp = new ActiveXObject("Microsoft.XMLHttp");
    }
    return xmlHttp;
}

/**
 * 判断要创建的分类是否已经存在
 */
var xmlHttp = getXmlHttpObject();
function isCategoryExist()
{
    if(xmlHttp)
    {
        //通过xmlHttp对象发送请求到服务器的某个页面
        //第一个参数表示请求的方式
        //第二个参数指定url,对哪个页面发出ajax请求(本质是http请求)
        //true表示使用异步机制
        var url = "../action/category_action.php?flag=iscategoryexist&categoryname="+$("#category_name").attr("value");
        xmlHttp.open("get",url,true);
        //指定回调函数
        xmlHttp.onreadystatechange = categoryDeal;
        
        //发送请求,get请求参数为null即可，post请求则填入实际的数据
        xmlHttp.send(null);
    }
}

//回调函数，获取ajax的返回信息后进行处理
function categoryDeal()
{
    //取出从category_action.php返回的数据
    if(xmlHttp.readyState === 4)
    {
            var return_value = xmlHttp.responseText;                        
            if(return_value === '0'){
                //该分类名称不存在，可以新建
                document.getElementById("categoryexist").style.display="none";
                document.getElementById("categorynotexist").style.display="inline";
            }
            else
            {
                //该分类名称存在，无法新建
                document.getElementById("categoryexist").style.display="inline";
                document.getElementById("categorynotexist").style.display="none";
            }
    }
}

/**
 * 检测表单是否符合提交条件，不符合无法提交表单
 * @returns {undefined}
 */
function prevent_form_post()
{
    //判断分类名是否为空
    if($("#category_name").attr("value")===""){
        alert("分类名称不能为空！");
        document.getElementById("category_name").focus();
        return false;
    }
    else if(document.getElementById("categoryexist").style.display==="inline"){
        return false;
    }
    return true;
}


