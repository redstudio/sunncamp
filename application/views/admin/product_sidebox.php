
<!--add attributes/options and stock level MOVE TO SIDE BOX-->



<?= form_open('admin/add_attribute/' . $product_id) ?>
<div class="product_input_l" style="width:98%; margin-top:10px;">
    If this product has no options, just enter 'none' in both the option category and option. Then enter the stock level. At least one option is required to add a stock level.
    <div class="label">Attribute Category (eg. colour)</div>

    <input id="autocompleteoptions" name="option_category" value=""/>

    <div class="label">Attribute (eg. red)</div>

    <input  name="option" value=""/>

    <div class="label">Stock Level</div>

    <input name="stock_level" value=""/>
    <input  type="hidden" name="product_id" value="<?= $product_id ?>"/>
</div>  
<input type="submit" />     
<?= form_close() ?>
<!--end of adding options-->

<div id="attributes">
    <div id="label_attribute">Cat.</div>  <div id="label_attribute">Option</div>  <div id="label_attribute">Stock</div> <div id="label_attribute">Action</div>
    <?php if ($attributes != NULL) {
        foreach ($attributes as $row): ?>
            <?= form_open('admin/edit_attribute/') ?>
            <input name="option_category" value="<?= $row->option_category ?>"/><input name="option" value="<?= $row->option ?>"/><input name="stock_level" value="<?= $row->stock_level ?>"/>
            <input  type="hidden" name="option_id" value="<?= $row->option_id ?>"/>
            <input  type="hidden" name="product_id" value="<?= $row->product_id ?>"/>
            <input type="submit" name="submit" value="Update" />   
            <input style="width:15px;" class="deletebutton" type="submit" name="submit" value="X" /> 
            <br/>
            <?= form_close() ?>
        <?php endforeach;
    } ?>
</div>

<!--set product categories-->

<hr/>
<?= form_open('admin/add_product_category/' . $product_id) ?>
<div class="ui-widget">

    <div class="label">Product Category</div>

    <input  id="autocompletecategories" name="product_category" value=""/>

    <input type="submit" />  

</div>  
<input  type="hidden" name="product_id" value="<?= $product_id ?>"/>

<?= form_close() ?>

<div id="attributes">      
    <?php if ($categories != NULL) {
        foreach ($categories as $row): ?>
            <?= form_open('admin/remove_category/' . $product_id) ?>
            <input style="width:190px" disabled="disabled" value="<?= $row->product_category_name ?>"/>
            <input  type="hidden" name="category_link_id" value="<?= $row->category_link_id ?>"/>

            <input style="width:15px;" class="deletebutton" type="submit" value="X" /> <br/>
            <?= form_close() ?>
        <?php endforeach;
    } ?>
</div>
<!--end of product categories-->