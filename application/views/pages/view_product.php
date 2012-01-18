<div class="clearfix" id="content" style="margin-top:0px;margin-left:0px;" >






    <div class="clearfix" >    </div>
    <div class="grid_16">
        <div style="padding:10px;">
            <h1><?= $product_name ?></h1>
            Product Code: <?= $product_ref ?>
        </div>
    </div>
    <div class="grid_8">
        <!--login to be added here-->
        &nbsp;
    </div>

    <div class="clearfix" >    </div>
    <hr/>
    <div class="grid_16">

        <?php foreach ($defaultimage as $row): ?>
            <a href='<?= base_url() ?>images/products/<?= $row->product_id ?>/<?= $row->filename ?>' class = 'cloud-zoom' id='zoom1'
               rel="adjustX: 0, adjustY:0, position: 'inside', ">
                <img src="<?= base_url() ?>images/products/<?= $row->product_id ?>/medium/<?= $row->filename ?>" alt='' />
            </a>
        <?php endforeach; ?>




        <br/>
        <!-- "previous page" action -->
        <a class="prev browse left"></a>

        <!-- root element for scrollable -->
        <div class="scrollable">   

            <!-- root element for the items -->
            <div class="items">

                <?php
                $x = 0;
                $y = 0;
                foreach ($images as $row):

                    if ($x == 0) {
                        echo "<div>";
                    }
                    if ($x == 0 && $y == 1) {
                        $y = 0;
                    }

                    $x = $x + 1;
                    ?>



                    <a href='<?= base_url() ?>images/products/<?= $row->product_id ?>/<?= $row->filename ?>' class='cloud-zoom-gallery' title='Thumbnail 1'
                       rel="useZoom: 'zoom1', smallImage: '<?= base_url() ?>images/products/<?= $row->product_id ?>/medium/<?= $row->filename ?>' ">
                        <img src="<?= base_url() ?>images/products/<?= $row->product_id ?>/thumbs/<?= $row->filename ?>" alt = "Thumbnail 1"/></a>




                    <?php
                    if ($x == 4) {
                        echo "</div>";
                        $y = 1;
                        $x = 0;
                    }


                endforeach;
                if ($y == 0) {
                    echo "</div>";
                }
                ?>

                <!-- end of root element for items -->
            </div>
        </div>

        <!-- "next page" action -->
        <a class="next browse right"></a>
        <br clear="all" />
        <div style="padding:10px;">


            <h2>Description</h2>
            <?= $product_desc ?>

            <h2>Specifications</h2>
             <div style="width:100%; border-bottom:solid 2px #000080; height:0px; padding:4px 0 2px; clear:both;">  </div>
            <?php foreach ($specs as $row): ?>
                <div style="width:100%; border-bottom:solid 2px #000080; height:23px; padding:4px 0 2px; clear:both;">  
                    <div style="width:200px; float:left;  ">
                        <strong><?= $row->spec_desc ?> </strong>
                    </div>
                    <div style="width:300px; float:left;">
                        <?= $row->spec_value ?>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <div class="grid_8" >
        <div id="keyFeatures" >
            <h2>Key Features</h2>
             <?php foreach ($features as $row): ?>
            <img src="<?=base_url()?>images/icons/features/<?=$row->feature_image?>"/>
            
           <?php endforeach; ?>
            
        </div>
    </div>

</div>


