<div class="container">
<div class="modal fade" id="addlevel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="addlevel_modal-title">新增分类</h4>
    		</div>
        <div class="modal-body">
          <form role="form" id="addlevelform" name="addlevelform" method="post" action="<?php echo site_url('admin/addlevel')?>">
              <div class="form-group">
                <label >级别ID:</label>
				<input type="text" class="form-control" id="id" name="id" placeholder="级别名称">                
              </div>
              <div class="form-group">
                <label for="name">级别名称</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="级别名称">
              </div>  
				<div class="form-group">
                <label for="color">级别颜色</label>
                <input type="text" class="form-control" id="color" name="color" placeholder="级别颜色">
              </div> 			          			 
             
		
          </form>
        </div>
        <div class="modal-footer">
			 <button type="button" class="btn btn-default submitaddlevel" id="submitaddlevel" name="submitaddlevel">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
          </div>
          </div>
 </div><!--end <div class="modal fade" id="additem"-->   
    <table class="table">
        <thead>
      <tr>
        <th>
          级别ID
        </th>
        <th>
          级别名称
        </th>
        <th>
          级别颜色
        </th>
        <th>
          删除
        </th>
      </tr>
    </thead>
    <tbody>
    <?php
        
		   foreach($level->result() as $row){ ?>
                <tr class="level_row">
                <td><input type="text" class="level_id input-small"  value="<?php echo $row->id ?>"></td>
                <td><input type="text" class="level_name input-small"  value="<?php echo $row->name ?>"></td>
                <td><input type="text" class="level_color input-small" value="<?php echo $row->color ?>"></td>           
                <td>
					<a href="#" title="删除此条" class="btn_delete"  data-levelid="<?php echo $row->id; ?>">删除</a>
                </tr>
                <?php 
                
			}
		 ?>
    </tbody>
  </table>
    <a href="javascript:void(0);" title="" class="btn btn-primary" id="btn-save">保存</a>
	<button class="btn btn-primary" data-toggle="modal" data-target="#addlevel">手动新增</button>

</div>
 
<script>
	(function($){
		$('#submitaddlevel').click(function () {
			var url = "<?php echo site_url('admin/addlevel')?>";
			
			$.post(url,$('#addlevelform').serialize(),function(data){
				if(data){
					$('#addlevel').modal('hide');
					location.reload();
				}
			});
		});
		$('#btn-save').click(function(){
            var data = new Array();
            $('.level_row').each(function(index){
                data[index] = {
					id : $(this).find('.level_id').val(),
					 name : $(this).find('.level_name').val(),
					 color : $(this).find('.level_color').val()}
				 //var catname = $(this).find('.level_id');
				 alert($(this).find('.level_id').val() + $(this).find('.level_name').val() + $(this).find('.level_color').val());
            });
			
			$.post('<?php echo site_url("admin/updatalevel")?>',
				{data:JSON.stringify(data)},function(result){
						
						if(result != null){
							location.reload();
						}else{
							alert('更新失败');
						}
					});						                  
        });
        
        $('.btn_delete').click(function(){
			var r=confirm("你真的真的要删除吗？无法恢复！");
				if (r==true)
				{
					var that = $(this);
					var delete_article_id = $(this).data('levelid');
					
					$.post('<?php echo site_url("admin/deletelevel/")?>',
						{
							id: delete_article_id
						},function(data){
								if(data){ //如果删除成功
									that.parents('tr').fadeToggle();
								}
							});
				} else
				{
				}
		
		});
	})(jQuery);
</script>
</body>
<html>
