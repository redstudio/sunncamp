<!doctype html>  

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>

        <?= $this->load->view('template/sunncamp/header') ?>

    </head>

    <body>
        <div id="header_container">
            <div id="header">

                <div  class="container_24" style="height:100px;">
                    <div class="grid_17" style="margin-left:0;">
                        <img style="margin-top:75px;" src="<?= base_url() ?>images/template/sunncamp/tagline.png"/>
                    </div>

                    <div id="logo" class="grid_7">

                    </div>

                </div>
                <div style="clear:both"></div>

                <div id="menutop">

                    <div style="width:960px; margin:0 auto;">

                        <?= $this->load->view('global/sunncamp/menu') ?>
                    </div> 
                </div>



            </div>
        </div>   
        <div id="container">

            <?php if (isset($slideshow) && $slideshow != NULL) { ?>
                <div id="slideshow_container" class="container_24">
                    <?= $this->load->view($slideshow) ?>
                </div>
            <?php } ?>

            <div id="bodycontainer" class="container_24">

                <div class="clear"></div>

                <div id="textcontainer">
                    <?php
                    if (isset($sidebox) && $sidebox != NULL) {
                        $mainsize = "grid_16";
                    } else {
                        $mainsize = "container_24";
                    }
                    ?>

         





                    <div class="<?= $mainsize ?>" >
                        <div style="padding:0px;">
                        <?= $this->load->view('global/alert') ?>
                        <?= $this->load->view($main_content) ?>
                        </div>

                    </div>

                    <?php if (isset($sidebox) && $sidebox != NULL) { ?>
                        <div class="grid_8">

                            <?= $this->load->view($sidebox) ?>


                        </div>
                    <?php } ?>


                </div>
                <div class="clear"></div>
            </div>

            <div class="container_24" id="footer">
                 <div class="grid_6">
                    <?= $this->load->view('global/sunncamp/login') ?>
                </div>
                 <div class="grid_6">
                    &nbsp;
                </div>
                <div class="grid_6">
                    <?= $this->load->view('global/sunncamp/links') ?>
                </div>
                <div class="grid_6">
                    <?= $this->load->view('global/sunncamp/social_icons') ?>
                </div>
            </div>



        </div> 





        <!--! end of #container -->
        <?= $this->load->view('template/sunncamp/footer') ?>


    </body>
</html>