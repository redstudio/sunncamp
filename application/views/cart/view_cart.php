
<div style="padding:25px;">
    <div class="clearfix" >    </div>
    <div class="grid_16">
        <div style="padding:0px;">
            <h1>Your Cart</h1>
        </div>
    </div>
    <div class="right_column">
        <?= $this->load->view('cart/frontcart') ?>
    </div>

    <div class="clearfix" >    </div>
    <hr/>
    <div class="grid_16">


        <table id="box-table-a">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Product Ref</th>

                    <th>Type</th>
                   <th>Item Cost</th>
                    <th>Total Cost</th>
                    
                    <th>In Cart</th>
                </tr>
            </thead>
            <tbody>

                <?php if ($cart != NULL) {
                	$totalcost = NULL;
                    foreach ($cart as $row): ?>
                        <tr>
                            <td>
                                <a href="<?= base_url() ?>products/show/<?= $row->product_id ?>"><?= $row->product_name ?></a>
                            </td>

                            <td>
                                [<?= $row->product_ref ?>] <?= $row -> cart_id ?>
                            </td>

                            <td>
        <?= $row->option_category ?>: <?= $row->option ?>
                            </td>



      <td>
	<?=$row->price?>
</td>                 

<td>
	<?php $thisprice = $row->quantity*$row->price; echo $thisprice;?>
</td>

                            

                            <td>
                                <span id="cart_<?= $row->option_id ?>"><?= $row->quantity ?></span>
                            </td> 








                        </tr>
    <?php 
    $totalcost = $totalcost + $thisprice;
    endforeach;
} ?>
            </tbody>
        </table>
        <?php if ($cart == NULL) { ?>
            <p>Your Cart is empty</p>
        <?php } else {  ?>
        
       
       <a href="<?=base_url()?>usercart/shipping_address">Shipping Address -></a>
        
        <?=$this->load->view('cart/view_orders')?>
        
        <? } ?>
    </div>
    <div class="right_column">
<?= $this->load->view('sidebox/product_cats') ?>
    </div>

