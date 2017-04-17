<?php
if(!defined('saul')) 
	die('Nope.');
?>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; <?php echo Config::$SITE_NAME; ?> 2017 / Login in AdminCP</p> 
                </div>
            </div>
            <!-- /.row -->
        </footer>
</center>
</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo Config::$_PAGE_URL; ?>/assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Config::$_PAGE_URL; ?>/assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php
ob_flush();
?>