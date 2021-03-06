<h2>Categories</h2>
<p>If this company is a stockist, add the categories of products they stock here:</p>

<div id="generic_form">
    <?= form_open('user/user_admin/add_cat_to_company') ?>
    <div class="ui-widget">
        <label>Category: </label>
        <select name="category_id" id="combobox">
            <option value="">Select one...</option>
            <?php foreach ($category_parents as $row): ?>

                <option value="<?= $row->parent_id ?>"><?= $row->parent_name ?></option>

            <?php endforeach; ?>
        </select>
    </div>
    <?php foreach ($company as $row): ?>  
        <input type='hidden' value='<?= $row->company_id ?>' name="company_id"/>
    <?php endforeach; ?>
        <input class="button" type="submit" value="Add Category" />
    <?= form_close() ?>
</div>


<?php foreach($company_categories as $row):?>

<div id="cat_<?=$row->company_cat_id?>" class="product_cat_list">
<span style="float:left;"><?=$row->parent_name?></span>
      <span  style="width:18px; float:right;" class="ui-icon ui-icon-circle-close  spanlink" onclick="deleteCompanyCat('<?= $row->company_cat_id ?>')" ></span>
</div>

<?php endforeach; ?>
