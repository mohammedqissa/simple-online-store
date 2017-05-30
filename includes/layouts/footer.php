    <script	src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</body>

</html>

<?php 

if (isset($connection)) {
	  mysqli_close($connection);
	}
?>