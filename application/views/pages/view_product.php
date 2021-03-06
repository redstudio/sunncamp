<div class="clearfix" id="content" style="padding:25px" >






    <div class="clearfix" >    </div>
    <div class="grid_16">
        <div style="padding:0px;">
            <h1><?= $product_name ?></h1>
            Product Code:: <?= $product_ref ?>
        </div>
    </div>
    <div class="right_column">
        <?= $this -> load -> view('cart/frontcart') ?>
    </div>

    <div class="clearfix" >    </div>
    <hr/>
    <div class="grid_16">
	    
	    

        <?php if($defaultimage != NULL) { foreach ($defaultimage as $row): ?>
	    
	                        
	    
	    
            <a href='https://s3-eu-west-1.amazonaws.com/<?=$bucket ?>/products/<?= $row -> product_id ?>/large/<?= $row -> filename ?>' class = 'cloud-zoom' id='zoom1'
               rel="adjustX: 0, adjustY:0, position: 'inside', ">
                <img src="https://s3-eu-west-1.amazonaws.com/<?=$bucket ?>/products/<?= $row -> product_id ?>/medium/<?= $row -> filename ?>" alt='' />
            </a>
        <?php endforeach; ?>




        <br/>
        <!-- "previous page" action -->
        <a class="prev browse left"></a>

        <!-- root element for scrollable -->
        <div class="scrollable">   

            <!-- root element for the items -->
            <div class="items">
            	<?php if($video != NULL) { ?>}
							<a class="youtube" rel="prettyPhoto" href="http://www.youtube.com/watch?v=<?=$video?>">
								<img src="<?=base_url()?>images/youtube_icon.png" alt = "Thumbnail 1"/>
								</a>
								<?php } ?>
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

        <?php
                
                //check if s3 file exists
                $remoteFile = base_url()."images/products/".$row -> product_id."/thumbs/".$row->filename;
                
                if(!getimagesize($remoteFile)){
                // echo "s3 ";
                    $fileThumb = "https://s3-eu-west-1.amazonaws.com/".$bucket."/products/".$row -> product_id."/thumbs/".$row->filename;
                    $fileMedium = "https://s3-eu-west-1.amazonaws.com/".$bucket."/products/".$row -> product_id."/medium/".$row->filename;
                    $fileLarge = "https://s3-eu-west-1.amazonaws.com/".$bucket."/products/".$row -> product_id."/large/".$row->filename;
                
		
		} else {
                  //  echo "local ";
			$fileThumb = base_url()."images/products/".$row -> product_id."/thumbs/".$row->filename;
                    $fileMedium = base_url()."images/products/".$row -> product_id."/medium/".$row->filename;
                    $fileLarge = base_url()."images/products/".$row -> product_id."/large/".$row->filename;
                
                }
               
    
                ?>

                    <a href="<?=$fileLarge?>" class='cloud-zoom-gallery' title='Thumbnail 1'
                       rel="useZoom: 'zoom1', smallImage: '<?=$fileMedium?>' ">
                        <img src="<?=$fileThumb?>" alt = "Thumbnail 1"/></a>




                    <?php
						if ($x == 4)
						{
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
        <?php  }
			else {
			echo "No Images";
			}
		?>
        <br clear="all" />
        <div style="padding:0px;">


            <div style="float:left;"?><h2>Description</h2></div>
            <div style="float:right;">
           <g:plusone size="medium"></g:plusone>
            <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true" data-font="arial"></div>
            </div>
            <div style="clear:both;"></div>
            <?= $product_desc ?>
            
             <?php if ($other_features != NULL) { ?>
              <div style="width:100%; border-bottom:solid 0px #000080; height:10px; padding:4px 0 2px; clear:both;">  </div>
               <!-- <h2>Features</h2>
               
                <ul><?php foreach ($other_features as $row): ?>
                
                     
                    <li>  <strong><?= $row -> other_feature_name ?> </strong></li>
                
                    

                <?php endforeach; ?>
                            </ul> -->
                
               
            <?php } ?>
            
            
            <?php if ($specs != NULL) { ?>
                  <div style="width:100%; border-bottom:solid 0px #000080; height:10px; padding:4px 0 2px; clear:both;">  </div>
                <h2>Specifications</h2>
               
                <?php foreach ($specs as $row): ?>
                    <div style="width:100%; border-bottom:solid 2px #000080;  padding:4px 0 2px; clear:both;">  
                        <div style="width:200px; float:left; padding-top:5px;  ">
                            <strong><?= $row -> spec_desc ?> </strong>
                        </div>
                        <div style="width:300px; float:left;  padding-top:5px;">
                            <?= $row -> spec_value ?>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php } ?>
            <?= $this -> load -> view('global/sunncamp/disclaimer') ?>
        </div>

    </div>
    
 <style>
  label {
    display: inline-block;
    width: 5em;
  }
  </style>

    <div class="right_column" >

        <?php if ($features != NULL) { ?>
            <div id="keyFeatures"  >
                <h2>Key Features</h2>
                <?php foreach ($features as $row): ?>
                	
                    <img  <?php if($row->feature_description == NULL) { } else { ?>class="tooltip" <?php }?> title="<?=$row->feature_description?>" style="margin:0px;  width:80%;" src="<?= base_url() ?>images/icons/features/<?= $row -> feature_image ?>"/>
					
                <?php endforeach; ?>
                <div style="clear:both;"></div>
            </div>

        <?php } ?>


        <?= $this -> load -> view('cart/product_stock') ?>

        <?= $this -> load -> view('sidebox/product_cats') ?>
    </div>

</div>


