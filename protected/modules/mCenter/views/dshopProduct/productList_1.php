<body>

	<div class="kkfm_r_inner">
		<!--搜索框 count-top包含的部分-->
	    <div class="top">
	        <div class="name">
	        	商品管理
	        </div>
	    </div>
	    <div class="shop_menu">
	    	<ul>
	        	<li class="cur"><a href="#">商品管理</a></li>
	        	<li><a href="<?php echo Yii::app() -> createUrl('mCenter/ShopGroup/ShopGroupList');?>">商品分组</a></li>
	        </ul>
	    </div>
	    
        <?php $form = $this->beginWidget('CActiveForm', array(
	        'enableAjaxValidation' => true,
	        'id' => 'addpro',
	        'htmlOptions' => array('name' => 'createForm'),
	    ));?>
			<div class="contant shopList">
                        <?php if($merchant_id == TIANSHI_SHOP_API) { ?>
		        <div class="cz">
                            <a href="<?php echo Yii::app()->createUrl('mCenter/tianShi/ticketList',array('merchant_id'=>$merchant_id))?>" class="btn_com_blue">同步第三方接口数据</a>
                        </div>
                        <?php } ?>
                        <div class="cz">
                            <a href="<?php echo Yii::app()->createUrl('mCenter/shopProduct/addProductOfCategory')?>" class="btn_com_blue">添加商品</a>
                        </div>
		    	<div class="sh-search clearfix">
		            <?php echo CHtml::dropDownList('Product[shop_product_status]', isset($_POST['Product']['shop_product_status']) ? $_POST['Product']['shop_product_status'] : '', $pro_status_arr,array('id'=>'shop_product_status')) ?>
                            <?php echo CHtml::dropDownList('Product[shop_group]', isset($_POST['Product']['shop_group']) ? $_POST['Product']['shop_group'] : '', $group,array('id'=>'shop_group')) ?>
                    <!--隐藏的input-->
                    <input type="text" style="display:none" id="arrow_type" name="arrow_type" value="<?php echo $arrow_type?>">
                    <input type="text" style="display: none;" id="arrow" name="arrow" value="<?php echo $arrow?>">
                    <!--隐藏的input-->
                    <input type="text" placeholder="请输入关键字" class="txt" id="key_word" name="Product[key_word]" value="<?php echo isset($_POST['Product']['key_word']) ? $_POST['Product']['key_word'] : ''?>">
		            <input type="button" id="search" class="search" value="">
		        </div>

                <input type="text" style="display: none;" id="pro_status" name="pro_status" value="<?php echo $pro_status?>">
                <input type="text" style="display: none;" id="group_id" name="group_id" value="<?php echo $group_id?>">
                <input type="text" style="display: none;" id="entered_keyword" name="key_word" value="<?php echo $key_word?>">
		        <div class="recharge">
		            <table width="100%" cellspacing="0" cellpadding="0">
		              	<tr class="order-title" >
		                	<td width="10"><input type="checkbox" name="checkAll"></td>
		                    <td>商品</td>
		                    <td width="25%" class="blue"><span id="price">价格</span></td>
<!--		                    <td class="blue" id="views">访问量<em class="arrowUp"></em></td>-->
		                    <td class="blue"><span id="stock">库存</span></td>
		                    <td class="blue"><span id="volume">总销量</span></td>
		                    <td class="blue"><span id="create_time">创建时间</span></td>
		                    <td class="blue">序号</td>
		                    <td>操作</td>
		              	</tr>
		              	<?php if(!empty($product)){?>                                
		              	<?php foreach ($product as $k => $v){?>
		              	<tr>
		                	<td><input type="checkbox" value="<?php echo $v->id?>" name="checkatt"></td>
                                        <td><div class="htcon"><img src="<?php echo !empty($v->ts_product_id) ? $v->img : IMG_GJ_LIST.$v->img?>"></div></td>
		                    <td>
		                    	<h3><?php echo $v->name?></h3>
		                        <p class="orange">￥<?php echo number_format($v -> price,2);?></p>
		                    </td>
<!--		                    <td>-->
<!--		                    	<p>UV：0</p>-->
<!--		                        <p>PV：0</p>-->
<!--		                    </td>-->
		                    <td><?php echo $v -> num?></td>
		                    <td><?php echo $v -> sold_num?></td>
		                    <td><?php echo $v -> create_time?></td>
		                    <td>0</td>
		                    <td>
		                    	<a href="<?php echo Yii::app()->createUrl('mCenter/shopProduct/editProductOfCategory',array('pro_id'=>$v->id))?>" class="blue">编辑</a> -
		                    	<a href="<?php echo Yii::app()->createUrl('mCenter/shopProduct/delProduct', array('pro_id'=>$v->id))?>" onclick="return confirm('确认删除吗');" class="blue">删除</a> 
	<!--                     	<a href="#" class="blue">推广</a> -->
		                    </td>
		              	</tr>
		              	<?php }?>
		              	<?php }?>
		          	</table>
		            <div class="tfoot">
		            	<div class="l">
		                	<ul>
		                        <li><a href="#" onclick="delMore()">批量删除</li>
<!--		                    	<li><a href="#">修改模板</a></li>-->
 		                        <li><a href="javascript:;" id="changegroup">改分组</a></li>
                                        <?php if(!empty($_GET['pro_status']) && $_GET['pro_status'] == SHOP_PRODUCT_STATUS_DOWN) { ?>
                                        <li><a href="javascript:;" id="upcarriage">上架</a></li>
                                        <?php } else { ?>
		                        <li><a href="javascript:;" id="undercarriage">下架</a></li>
                                        <?php } ?>
		                    </ul>
		                </div>
		            	<div id="page" style="text-align:right">
		                		<?php $this->widget('CLinkPager', array(
		                        	'pages' => $pages,
		                        	'header' => '', //分页前显示的内容
		                        	'maxButtonCount' => 20, //显示分页数量
		                        	'firstPageCssClass' => '',
		                        	'lastPageCssClass' => '',
		                        	'firstPageLabel' => '首页',
		                        	'nextPageLabel' => '下一页',
		                        	'prevPageLabel' => '上一页',
		                        	'lastPageLabel' => '末页',
		                    	));?>
		            	</div>
		            </div>
		        </div>
		    </div>

    	<?php $this->endWidget(); ?>
	</div>

    <div class="popWrap" id="pop" style="width:200px; top:20%; left:40%; margin-left:-200px;display: none">
        <div class="pop_con">
            <div class="title">修改分组<a href="<?php echo Yii::app()->createUrl('mCenter/ShopGroup/ShopGroupList')?>"><input type="button" style="width: 100px;height: 30px;" value="管理" class="btn_com_blue"></a></div>

            <div class="pop_content popStored">
                <div class="fz">
                    <table width="100%" cellspacing="0" cellpadding="0">
                    <?php foreach($grouplist as $key=>$value){?>
                        <tr>
                        <td><input type="checkbox" value="<?php echo $key?>"></td>
                        <td><?php echo $value?></td>
                        </tr>
                    <?php }?>
                        <!-- 分页开始 -->
                        <tr style="border:none">
                            <td style="border:none;text-align:right" colspan="7">
                                <?php $this -> widget('CLinkPager',array(
                                    'pages'=>$pages,
                                    'header'=>'共&nbsp;<span class="yellow">'.$pages -> getItemCount().'</span>&nbsp;条&nbsp;',
                                    'prevPageLabel' => '上一页',
                                    'nextPageLabel'=>'下一页',
                                    'maxButtonCount'=>8
                                ));?>
                            </td>
                        </tr>
                        <!-- 分页结束 -->
                    </table>
                </div>
            </div>
            <div class="btn">
                <input type="button" value="保存" class="btn_com_blue" id="save">
                <input type="button" onclick="hiddenpop()" value="取消" class="btn_com_gray">
            </div>
        </div>
    </div>
	<script type="text/javascript">
        $(document).ready(
            function(e){
                var choosed_groupid=$('#group_id').val();//下拉框选中
                var key_word=$('#entered_keyword').val();//搜索输入的值
                var pro_status=$('#pro_status').val();//商品状态下拉框

                if(pro_status!='')
                {
//                     $("select#shop_product_status option[value=pro_status]").attr('selected', 'true');
                	$("select#shop_product_status").val(pro_status);
                }
                if(choosed_groupid!='')
                {
                    $("select#shop_group option[value='1']").attr('selected', 'true');
                }
                if(key_word!='')
                {
                    $('#key_word').val(key_word);
                }

                var arrow=$('#arrow').val();
                var arrow_type=$('#arrow_type').val();
                if(arrow_type=='create_time')
                {
                    $('#create_time').html("创建时间"+"<em class='"+arrow+"'></em>");
                }else if(arrow_type=='price')
                {
                    $('#price').html("价格"+"<em class='"+arrow+"'></em>");
                }else if(arrow_type=='stock'){
                    $('#stock').html("库存"+"<em class='"+arrow+"'></em>")
                }else if(arrow_type=='volume'){
                    $('#volume').html("总销量"+"<em class='"+arrow+"'></em>")
                }
            }
        );
		//全选
		$('input:checkbox[name="checkAll"]').click(function() {
			if($(this).is(":checked")){
				$(".recharge input:checkbox").each(function() {
					$(this).prop("checked", true);
				})
			}else{
				$(".recharge input:checkbox").each(function() {
					$(this).prop("checked", false);
				})
			}
		});

        $('#undercarriage').click(function(e){
            var tmp = new Array();
            if(confirm('确认下架吗')){

                $(".recharge input:checkbox").each(function() {
                    if($(this).is(":checked") && $(this).attr("name") != "checkAll") {
                        var id = $(this).val();
                        tmp.push(id);
                    }
                });
                $.ajax({
                    url: '<?php echo(Yii::app()->createUrl('mCenter/ShopProduct/UnderCarriage'));?>',
                    data: {content: tmp},
                    dataType:"json",
                    type: 'get',
                    success: function (data) {
                        if(data == <?php echo ERROR_NONE?>){
                            alert('下架成功');
                            window.location.reload();
                        }else{
                            alert(data);
                        }
                    }
                });
            }
        });
        
        $('#upcarriage').click(function(e){
            var tmp = new Array();
            if(confirm('确认上架吗')){

                $(".recharge input:checkbox").each(function() {
                    if($(this).is(":checked") && $(this).attr("name") != "checkAll") {
                        var id = $(this).val();
                        tmp.push(id);
                    }
                });
                $.ajax({
                    url: '<?php echo(Yii::app()->createUrl('mCenter/ShopProduct/UpCarriage'));?>',
                    data: {content: tmp},
                    dataType:"json",
                    type: 'get',
                    success: function (data) {
                        if(data == <?php echo ERROR_NONE?>){
                            alert('上架成功');
                            window.location.reload();
                        }else{
                            alert(data);
                        }
                    }
                });
            }
        });

        function hiddenpop()
        {
            $('#pop').toggle();
        }

        //商品改分组
        $('#changegroup').click(function (e) {
            var flag=false;
            var tmp = new Array();
            $(".recharge input:checkbox").each(function() {
                if($(this).is(":checked"))
                {
                    flag=true;
                    tmp.push($(this).val());
                }
            });
            $('.fz input:checkbox').each(function(){
               $(this).prop('checked',false);
            });
            if(flag)
            {
                //弹出分组框
                $('#pop').toggle();
            }
            else
            {
                alert('请选择商品');
            }
        });

        $('#save').click(function(e){
            var group_arr=new Array();
            var shop_arr=new Array();
            $('.fz input:checkbox').each(function(){
                if($(this).is(':checked'))
                {
                    group_arr.push($(this).val());
                }
            });

            $(".recharge input:checkbox").each(function() {
                if($(this).is(":checked")&&$(this).attr('name')!='checkAll')
                {
                    shop_arr.push($(this).val());
                }
            });
            $.ajax({
                url:'<?php echo Yii::app()->createUrl('mCenter/ShopProduct/ChangeGroup')?>',
                data:{group_arr:group_arr,shop_arr:shop_arr},
                dataType:'json',
                type:'get',
                success:function(data){
                    if(data=='success')
                    {
                        alert('修改成功');
                        window.location.href=window.location.href;
                    }
                    else
                    {
                        alert(data);
                    }
                }
            });
        });

        $('#search').click(function(e){
            var pro_status=$('#shop_product_status').val();
            var group_id=$('#group_id').val();
            var key_word=$('#key_word').val();
            var shop_group=$('#shop_group').val();
            var arrow_type=$('#arrow_type').val();
            var arrow=$('#arrow').val();
            if(arrow=='arrowUp')
                arrow='arrowDown';
            else if(arrow=='arrowDown')
                arrow='arrowUp';
            var url='<?php echo Yii::app()->createUrl('mCenter/ShopProduct/ProductList')?>?pro_status='+pro_status+'&group_id='+group_id+'&key_word='+key_word+'&shop_group='+shop_group+'&arrow='+arrow+'&arrow_type='+arrow_type;
            window.location=url;
        });

        $('#volume').click(function(e){
            //总销量
            var pro_status=$('#shop_product_status').val();
            var group_id=$('#group_id').val();
            var key_word=$('#key_word').val();
            var shop_group=$('#shop_group').val();
            var arrow=$('#arrow').val();
            var arrow_type=$('#arrow_type').val();
            arrow_type='volume';
            var url='<?php echo Yii::app()->createUrl('mCenter/ShopProduct/ProductList')?>?pro_status='+pro_status+'&group_id='+group_id+'&key_word='+key_word+
                '&shop_group='+shop_group+'&arrow='+arrow+'&arrow_type='+arrow_type;
            window.location=url;
        });

        $('#stock').click(function(e){
           //库存
            var pro_status=$('#shop_product_status').val();
            var group_id=$('#group_id').val();
            var key_word=$('#key_word').val();
            var shop_group=$('#shop_group').val();
            var arrow=$('#arrow').val();
            var arrow_type=$('#arrow_type').val();
            arrow_type='stock';
            var url='<?php echo Yii::app()->createUrl('mCenter/ShopProduct/ProductList')?>?pro_status='+pro_status+'&group_id='+group_id+'&key_word='+key_word+
                '&shop_group='+shop_group+'&arrow='+arrow+'&arrow_type='+arrow_type;
            window.location=url;
        });

        $('#create_time').click(function(e){
            var pro_status=$('#shop_product_status').val();
            var group_id=$('#group_id').val();
            var key_word=$('#key_word').val();
            var shop_group=$('#shop_group').val();
            var arrow=$('#arrow').val();
            var arrow_type=$('#arrow_type').val();
            arrow_type='create_time';
            var url='<?php echo Yii::app()->createUrl('mCenter/ShopProduct/ProductList')?>?pro_status='+pro_status+'&group_id='+group_id+'&key_word='+key_word+
                '&shop_group='+shop_group+'&arrow='+arrow+'&arrow_type='+arrow_type;
            window.location=url;
        });

        $('#price').click(function(e){
            var pro_status=$('#shop_product_status').val();
            var group_id=$('#group_id').val();
            var key_word=$('#key_word').val();
            var shop_group=$('#shop_group').val();
            var arrow=$('#arrow').val();
            var arrow_type=$('#arrow_type').val();
            arrow_type='price';
            var url='<?php echo Yii::app()->createUrl('mCenter/ShopProduct/ProductList')?>?pro_status='+pro_status+'&group_id='+group_id+'&key_word='+key_word+
                '&shop_group='+shop_group+'&arrow='+arrow+'&arrow_type='+arrow_type;
            window.location=url;
        });
		

	
		function delMore(){
            var tmp = new Array();
			if(confirm('确认删除吗')){

				$(".recharge input:checkbox").each(function() {
					if($(this).is(":checked") && $(this).attr("name") != "checkAll") {
						var id = $(this).val();
						tmp.push(id);
					}
				});
				$.ajax({
					url: '<?php echo(Yii::app()->createUrl('mCenter/ShopProduct/delMoreProduct'));?>',
                    data: {content: tmp},
                    dataType:"json",
                    type: 'get',
                    success: function (data) {
	                    if(data == <?php echo ERROR_NONE?>){
                            alert('删除成功');
                            window.location.reload();
	                    }else{
		                    alert(data);
	                    }
                    }
				});
			}
		}
	</script>
	
</body>