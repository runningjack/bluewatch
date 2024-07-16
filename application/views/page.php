
    <?php

  
    
    ?>




<!-- start: Container -->
<div class="container">

    <!-- start: Page header / Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="page-header">
         
        </div>
        <div class="breadcrumbs">
            You are here: <?php //echo $breadcrumbs;?>
        </div>
    </section>
    <!-- end: Page header / Breadcrumbs -->

    <div class="row">

        <!-- start: Page section -->
        <section id="page-sidebar" class="span12">


        <!-- Docs nav
        ================================================== -->
        <div class="row">
        <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
                <li><a href="#global"><i class="icon-chevron-right"></i> Tourist Board</a></li>
                <li><a href="#gridSystem"><i class="icon-chevron-right"></i>History of Kano</a></li>
                <li><a href="#fluidGridSystem"><i class="icon-chevron-right"></i>Recreation Centers</a></li>
                <li><a href="#layouts"><i class="icon-chevron-right"></i> Layouts</a></li>
                <li><a href="#responsive"><i class="icon-chevron-right"></i> Responsive design</a></li>
            </ul>
        </div>
        <div class="span9">


<section id="global">
    <?php //var_dump($nav_links);

        if(!empty($page_content)) {
              foreach($page_content as $content) {
                        $ctitle = $content->main_title;
                        $ccontent = $content->main_content;
            ?>
             <section id="global">
              <h3><?php echo $ctitle ?></h3>

            <p><?php echo $ccontent;?> </p>   
            
             </section>
              <?php } }?>
        
</section>
</div>
            </div>
        </section>
        </div>
    </div>
<!-- end: Container -->

<!-- start: Footer -->
<!-- end: Footer -->
</body>


</html>


