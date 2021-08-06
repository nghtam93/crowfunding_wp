<div class="modal modal-search fade" id="modalSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-close">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" class="search-field form-control" placeholder="Search ..." name="s" />
                <button class="search-submit" type="submit"><span class="icon-search"></span></button>
            </form>
        </div>
    </div>
    </div>
</div>