/**
 * @authors zhuchenshu
 * @date    2017-09-13 16:47:11
 */
// 计算价格
function jisuan(){
    var dijie_number=document.getElementById("numberdijie").value;
    var dijie_unitPrice=document.getElementById("unitdijie").value;
    // 判断是否由传入的数据为空
    if(isNaN(parseFloat(dijie_number)*parseFloat(dijie_unitPrice))){
        document.getElementById("totaldijie").value=0;
    }else{
        document.getElementById("totaldijie").value=parseFloat(dijie_number)*parseFloat(dijie_unitPrice);
    }
    var zhusu_number=document.getElementById("numberzhusu").value;
    var zhusu_unitPrice=document.getElementById("unitzhusu").value;
    if(isNaN(parseFloat(zhusu_number)*parseFloat(zhusu_unitPrice))){
        document.getElementById("totalzhusu").value=0;
    }else{
        document.getElementById("totalzhusu").value=parseFloat(zhusu_number)*parseFloat(zhusu_unitPrice);
    }
}
