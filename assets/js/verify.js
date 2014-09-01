/**
 * Created by www.jiunile.com on 13-11-24.
 */

(function($){
    $.extend({
        isEmpty : function(value)
        {
            if(value == '')
            {
                return true;
            }
            return false;
        },
        isPwd : function(value)
        {
            if(value.length >= 6 && value.length <= 20)
            {
                return true;
            }
            return false;
        },
        isEmail : function(value)
        {
            var myReg = /^[\.\-_A-Za-z0-9]+@([\-_A-Za-z0-9]+\.)+[A-Za-z0-9]{1,}$/;
            //中文域名
            //var myReg = /^[\.\-_A-Za-z0-9\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+@([_A-Za-z0-9\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+\.)+[A-Za-z0-9\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]{1,}$/;
            if (myReg.test(value)) {
                return true;
            }
            return false;
        },
        isEqual : function(obj1,obj2)
        {
            if(obj1.val() === obj2.val())
            {
                return true;
            }
            return false;
        },
        //手机验证
        isPhone: function(value){
            var myReg = /^(13)|(15)|(18)[0-9]{9}$/;
            if(myReg.test(value))
            {
                return true;
            }
            return false;
        },
        isUrl: function(value)
        {
            var myReg =/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
            if(myReg.test(value))
            {
                return true;
            }
            return false;
        },
        //判断真实姓名
        isName: function(value)
        {
            var myReg = /^[\u4e00-\u9fa5]{2,}$/;
            if(myReg.test(value))
            {
                return true;
            }
            return false;
        },
        isQQ: function(value)
        {
            var myReg =  /^[1-9]\d{4,11}$/g;
            if(myReg.test(value))
            {
                return true;
            }
            return false;
        },
        //固定电话
        isFixedPhone:function(value)
        {
            var myReg = /^((0[12][0-9]|0[3-9][0-9]{2})+(\-)+[1-9][0-9]{6,7})$/;
            if(myReg.test(value))
            {
                return true;
            }
            return false;
        },
        isInterger:function(value)
        {
            var myReg = /^\d{4}$/;
            if(myReg.test(value))
            {
                return true;
            }
            return false;
        },
        validate:function(value)
        {
            var re = /^\d+(?=\.{0,1}\d+$|$)/
            if(re.test(value))
            {
                return true;
            }
            return false;
        }
    });
})(jQuery);

