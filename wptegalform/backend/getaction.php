 <?php 
if ($_GET['action'] === 'create') {
    
    
           require_once('createform.php');
           
           
} elseif ($_GET['action'] === 'edit' && isset($_GET['id'])) {
          
            require_once('editform.php');
}
elseif ($_GET['action'] === 'duplicate' && isset($_GET['id'])) {
     
     require_once('duplicateform.php');
    
              
 
} elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
    
    
           require_once('deleteform.php');
           
           
} elseif ($_GET['action'] === 'share' && isset($_GET['id'])) {

            require_once('shareform.php');
    
    
} elseif ($_GET['action'] === 'failed') {
    
            require_once('failedform.php');
    
           
} else {
    
    
        	require_once('entriesform.php');
        	
        	
}
            ?>
                <?php if ($_GET['action'] != 'share') { ?>
           
                <?php } ?>