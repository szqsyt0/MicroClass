/**
 * 限制输入字符数
 * @param {type} field 表单输入框名
 * @param {type} countfield 剩余字符显示框名
 * @param {type} maxlimit 最大字符数
 * @returns {undefined} 剩余字符数
 */
function textCounter(field,countfield,maxlimit){
    
    if(filed.value.length > maxlimit){
        //如果元素区字符数大于最大字符数，按照最大字符数截断
        field.value = field.value.substring(0,maxlimit);
    }else{
        //在计数区文本框内显示剩余的字符数
        countfield.value = maxlimit - field.value.length;
    }  
}


