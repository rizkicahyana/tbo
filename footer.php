		</div>
        <!-- /.row -->        	
    
    <?php
    	if($_GET['mode']=='dashboard_member' || $_GET['mode']==''){
    ?>
    <div class="row">
    	<div class="col-md-4"></div>
    	<div class="col-md-4">
    		<?php
    			echo "<center>";
				echo $query->printNav();
				echo "</center>";
    		?>
    	</div>
    	<div class="col-md-4"></div>
    </div>
    <?php
    	}
    ?>

       	
	<!--footer.php-->
	<!-- Footer -->
	<hr/>
	<footer>
	    <div class="row">
	        <div class="col-lg-12">
	            <p align="center">Copyright &copy; Toko Buku Online 2015.<br/>
	            Developed by Rizki Cahyana. Powered by Bootstrap.</p>
	        </div>
	    </div>
	</footer>

</div>
<!-- /.container -->