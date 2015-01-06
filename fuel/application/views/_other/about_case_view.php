<?php 

$kw = isset($_GET['kw'])?htmlspecialchars($_GET['kw'], ENT_QUOTES, 'UTF-8'):"";
?>
<style>
.timeline-item .panel-body
{
  height: 200px;
  overflow-y: hidden;
}
</style>
<!--breadcrumbs start-->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <h1>找案子</h1>
            </div>
            <div class="col-lg-8 col-sm-8">
                <ol class="breadcrumb pull-right">
                    <li><a href="<?php echo site_url();?>">首頁</a></li>
                    <li class="active">找案子</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs end-->
<div class="row">
    <div class="col-lg-12">
        <!--timeline start-->
        <section class="panel">
            <div class="panel-body">
              <table class="table table-striped table-advance table-hover">
                <thead>
                 <tr>
                    <th colspan="4" style="text-align:center;">
                      <h2><?php echo $filter ?>找不到你想要的案子嗎？您可以直接到<a href="http://case.518.com.tw/">518外包網</a>去找，<a href="http://9icase.com/case/help">提案</a>也可以直接貼網址唷！</h2>
                    </th>
                  </tr>
                 <tr>
                    <th colspan="4">
                      <div class="row">
                        <div class="col-lg-1 col-sm-1">
                          <img src="<?php echo site_url().'assets/images/search.png'?>" alt="Search" title="Search" width="50" height="50"/>
                        </div>
                        <div class="col-lg-11 col-sm-11">
                        <ul class="list-inline list-unstyled caseCate">
                          <li><a class="btn <?php if($sub_id == 0):?>btn-success<?php else:?>btn-primary<?php endif;?> btn-sm" href="<?php echo $this_url?>">無限制</a></li>
                          <?php if(isset($case_cate)):?>
                            <?php foreach($case_cate as $row):?>
                              <li><a class="btn <?php if($parent_id == $row->code_id):?>btn-success<?php else:?>btn-primary<?php endif;?> btn-sm" href="<?php echo $this_url."?case_type=".$row->code_id;?>"><?php echo $row->code_name;?></a></li>
                            <?php endforeach;?>
                          <?php endif;?>
                        </ul>
                        </div>
                      </div>
                      <div class="row" <?php if($display_sub_cate == 1):?>style="display:block;"<?php else:?>style="display:none;"<?php endif;?>>
                        <div class="col-lg-1 col-sm-1"></div>
                        <div class="col-lg-11 col-sm-11">
                            <div class="subCate">
                              <ul class="list-inline list-unstyled caseSubCate">
                                <?php if(isset($sub_cate)):?>
                                  <?php foreach($sub_cate as $row):?>
                                    <li><a class="btn <?php if($sub_id == $row->code_id):?>btn-info<?php else:?>btn-default<?php endif;?> btn-xs" href="<?php echo $this_url."?case_type=".$row->code_id;?>"><?php echo $row->code_name;?></a></li>
                                  <?php endforeach;?>
                                <?php endif;?>
                              </ul>
                            </div>
                        </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th colspan="1">
                      <input type="text" placeholder=" Search" id="serach_text" name="serach_text" class="form-control search">
                    </th>
                    <th colspan="3">
                      <a class="btn btn-info" id="serach_btn" name="serach_btn"  >關鍵字搜尋</a>
                      
                    </th>
                  </tr>
                  <tr>
                    <th>#</th>
                    <th style="width:70%">案件標題</th>
                    <th>案件來源</th>
                    <th>幫我提案</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($case_result)): ?>
                    <?php foreach ($case_result as $key=>$row): ?>
                      <tr>
                        <td><?php echo $key+1;?></td>
                        <td>
                          <a href="<?php echo $detail_url.$row->cd_id?>"><h4><?php echo $row->cd_title?></h4></a>

                          <?php echo nl2br(mb_substr($row->cd_content,0,150,"UTF-8"));?><br />
                          ...
                        </td>
                        <td>518外包網<br>更新日期：<?php echo $row->run_date ?></td>
                        <td><a class="btn btn-info" href="<?php echo site_url().'case/help/step3?cd_id='.$row->cd_id?>">幫我提案</a></td>
                      </tr>
                  
                    <?php endforeach;?>
                  <?php else:?>
                  <tr>
                    <td colspan="4">
                    科科～空的唷！
                  </td>
                    </tr>
                <?php endif;?>

                </tbody>
              </table>
            </div>
        </section>
        <!--timeline end-->
    </div>
    <div style="text-align:center">
      <ul class="pagination">
      <?php echo $page_jump?>
      </ul>
    </div>
</div>
<script type="text/javascript">
$("#serach_text").val("<?php echo $kw ?>")
$("#serach_btn").click(function(){
  if($("#serach_text").val() == "" ){
    alert("請點擊旁邊的放大鏡，就可以輸入關鍵字了唷！");
  }else{
      location.href = '<?php echo site_url()."case?kw=" ?>'+$("#serach_text").val();
  }
  
})

</script>