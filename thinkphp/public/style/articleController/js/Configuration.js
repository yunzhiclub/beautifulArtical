Sortable.create(document.getElementById('foo'), {
                                animation: 150, //动画参数
                                forceFallback: true,
                                onAdd: function (evt){   //拖拽时候添加有新的节点的时候发生该事件
                                	console.log('onAdd.foo:', [evt.item, evt.from]); 
                                },
                                onUpdate: function (evt){  //拖拽更新节点位置发生该事件
                                	console.log('onUpdate.foo:', [evt.item, evt.from]);  
                                },
                                onRemove: function (evt){   //删除拖拽节点的时候促发该事件
                                	console.log('onRemove.foo:', [evt.item, evt.from]); 
                                },
                                onStart:function(evt){  //开始拖拽出发该函数
                                	console.log('onStart.foo:', [evt.item, evt.from]);
                                },
                                onSort:function(evt){  //发生排序发生该事件
                                	console.log('onSort.foo:', [evt.item, evt.from]);
                                },
                                onEnd: function(evt){ //拖拽完毕之后发生该事件
                                	console.log('onEnd.foo:', [evt.item, evt.from]); 
                                }
                            });