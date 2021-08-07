<?php get_header();
$siteurl = get_option('siteurl');
?>
<div class="dn__breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container-fluid">
        <span><a href="<?= $siteurl; ?>" class="home"><span>TOP</span></a></span> ＞  
        <span><?php the_title();?></span>
    </div>
</div>
<div class="wrap__page">   
    <div class="container">
     
        <div class="archive__content wow animate__animated animate__fadeInUp">
        	<?php the_content();?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
