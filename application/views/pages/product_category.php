
<div style="padding:25px;">
  <div class="clearfix" >    </div>
    <div class="grid_16">
       <div style="padding:0px;">
           <h1><?=$title?></h1>
        </div>
    </div>
    <div class="right_column">
        <?=$this->load->view('cart/frontcart')?>
    </div>

    <div class="clearfix" >    </div>
    <hr/>
 <div class="grid_16">
<?php foreach ($products as $row): ?>

    <div id="productview" >
        <a href="<?=base_url()?>products/show/<?= $row->product_id ?>">
        <div style="border:1px solid #333333; height:106px;" >
            <img  style="vertical-align: middle;" src="<?=base_url()?>/images/products/<?= $row->product_id ?>/thumbs/<?= $row->filename ?>" width="134px"/>
        </div>
    
        <?= $row->product_name ?>
        </a>
    </div>
<?php endforeach; ?>

</div>
<div class="right_column">
<?=$this->load->view('sidebox/product_cats')?>
</div>
</div>
