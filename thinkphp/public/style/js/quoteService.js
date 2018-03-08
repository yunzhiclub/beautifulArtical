'use strict';

$(function() {
    /**
     * 待插入的节点，拼接HTML
     * 目前还没有找到能把这段HTML代码分离出来的方法
     * @type {string}
     */
    var quote = '<div class="row">\n' +
        '    <div class="form-group col-md-3">\n' +
        '        <label>名称</label>\n' +
        '        <input type="text" class="form-control" name="designation[]">\n' +
        '    </div>\n' +
        '    <div class="form-group col-md-2">\n' +
        '        <label>成人单价</label>\n' +
        '        <input type="text" class="form-control" name="adultUnitPrice[]">\n' +
        '    </div>\n' +
        '    <div class="form-group col-md-2">\n' +
        '        <label>儿童单价</label>\n' +
        '        <input type="text" class="form-control" name="childUnitPrice[]">\n' +
        '    </div>\n' +
        '    <div class="form-group col-md-2">\n' +
        '        <label>总价</label>\n' +
        '        <input type="text" class="form-control" name="totalPrice[]" readonly>\n' +
        '    </div>\n' +
        '    <div class="form-group col-md-3">\n' +
        '        <label>备注</label>\n' +
        '        <input type="text" class="form-control" name="remark[]">\n' +
        '    </div>\n' +
        '</div>';
    /**
     * newQuote新建方案报价
     * 为新建按钮添加点击事件
     */
    $('#newQuote').click(function() {
        // 在方案报价组中追加元素
        $('#quoteGroup').append(quote);
    });
    /**
     * removeQuote删除方案报价
     * 为删除按钮添加点击事件
     */
    $('#removeQuote').click(function() {
        // 获取节点组中所有方案报价
        var node = $('#quoteGroup>.row');
        // 获取方案报价个数
        var length = node.length;
        // 如果方案报价不为空
        if (length > 0) {
            // 待删除节点设置为最后一个方案报价
            var deleteNode = node[length - 1];
            // 删除方案报价
            deleteNode.remove();
        }
    });
});