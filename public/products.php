<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
include_once('../includes/layouts/header.php');

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="panel-group" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapseOne">Category</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <input type="checkbox"> Board Toys                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox"> Toy Animals 
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <input type="checkbox"> Construction toys‎
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <input type="checkbox"> Dolls
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox"> Puzzles
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox"> Educational Toys
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapseTwo">Price</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">                    
                        <div class="panel-body form-group" id="cijena">
                             <input type="text" class="form-control"> -
                             <input type="text" class="form-control">
                        </div>
                    </div>                                      
                </div> 
                           
            </div>
        </div>
        <div class="col-sm-9 col-md-9">
            <div class="well" id="products">
                <h2>Welcome to <?php echo isset($pageTitle) ? $pageTitle : "shop" ?>!</h2>
            </div>
            
                            <?php get_products(); ?>

        </div>
    </div>
</div>

<?php
include_once('../includes/layouts/footer.php');
?>