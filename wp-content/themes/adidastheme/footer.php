</section>
<footer class="footer full-width">
    <div class="footer-widgets full-width">
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar("footer_sidebar"); ?>
            </div>
        </div>
    </div>
    <?php
    if (get_option('show_hide_footer_strip')) { ?>
        <div class="copyright pt-3 pb-3 full-width">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <?php
                        if (get_option('footer_copy_right')) { ?>
                            <p class="mb-0"><strong>Disclaimer: </strong><?php echo get_option('footer_copy_right'); ?></p>
                        <?php } else { ?>
                            <p class="mb-0 text-center">Copyright &copy; <?php echo date("Y"); ?> Adidas All Rights Reserved</p>
                        <?php }
                        ?>

                    </div>
                </div>
            </div>

        </div>
    <?php }
    ?>
</footer>
<?php wp_footer(); ?>
</div>
</body>

</html>