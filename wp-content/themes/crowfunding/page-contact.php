<?php
/**
 * Template Name: Page (Contact)
 * Description: Page template full width.
 *
 */
?>
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
    <div class="">
        <div class="inquiry__box mx-auto">
        	<?php the_content();?>
        </div>
    </div>
</div>
<script>
	    ClassicEditor
		.create( document.querySelector( '#editor' ), {
			toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'bulletedList',
						'numberedList',
						'|',
						'undo',
						'redo'
					]
				},
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

        (function($){

        })(jQuery);

        
    </script>
<?php get_footer(); ?>