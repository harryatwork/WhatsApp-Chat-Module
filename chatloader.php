<?php include("db.php"); ?>
<?php
	$u_whatsapp = $_GET["whatsapp"];
?>

<?php
    $sql_chats = "SELECT * FROM chats WHERE number = '$u_whatsapp'";
	$result_chats = $conn->query($sql_chats);
	if ($result_chats->num_rows > 0) {                               
	while($row_chats = $result_chats->fetch_assoc()) {
		$u_id = $row_chats["id"];

        date_default_timezone_set('Asia/Calcutta'); 

		$sql_chat_content = "SELECT * FROM chat_messages WHERE u_id = '$u_id'";
    	$result_chat_content = $conn->query($sql_chat_content);
    	if ($result_chat_content->num_rows > 0) {                               
    	while($row_chat_content = $result_chat_content->fetch_assoc()) {
    		$message_content = $row_chat_content["message"];
    		$by_whom = $row_chat_content["by_whom"];
    		$sub_id = $row_chat_content["sub_id"];
    		$status = $row_chat_content["status"];
			$time_stamp = $row_chat_content['date'];
			$type = $row_chat_content['type'];
			$time = date('H:i', $time_stamp); 
			$date = date('d/M', $time_stamp); 
			
			$sqluser_2 = "SELECT * FROM subadmin WHERE id = '$sub_id'";
        	$resultuser_2 = $conn->query($sqluser_2);
        	if ($resultuser_2->num_rows > 0) {   
        	while($rowuser_2 = $resultuser_2->fetch_assoc()) {
        		$sub_name_2 = $rowuser_2["name"];
        	} } else {
        	    $sub_name_2 = "CHAT";
        	}
        	
        	$url_format = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
			
			if($by_whom == 'user') {
	?>
		
	 <div class="flex">
        <span>
			<svg class="incoming-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 13" width="8" height="13">
				<path opacity=".13" d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
				<path fill="currentColor" d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
			</svg>
		</span>
        <div class="single-message rounded-tr-lg text-gray-200 rounded-bl-lg rounded-br-lg mb-4 px-4 py-2" style="max-width: 60%;">
			<div class="tooltip" style="display: inline-block;font-size: 16.2px;line-height: 26px;color:#e9edef;">
			<?php if(@getimagesize($message_content)) { ?>
                <img src="<?= $message_content; ?>" style="width:100%;height:500px;object-fit:contain;" />
            <?php } else { ?>
                <?= nl2br(preg_replace($url_format, '<a href="$0" style="color:#49bef7;" target="_blank" title="$0">$0</a>', $message_content)); ?> 
            <?php } ?>
                <div class="tooltiptext"><?= $date; ?></div>
			</div>
			<div style="float: right;margin-top: 5%;padding-left: 30px;">
			    <div style="display:inline-block;font-size:0.9rem;color:#98beb7;"><?= $time; ?></div>
			</div>
		</div>
      </div>
		
	<?php } else { ?>
	
    	<?php if($status == 'sent'){ 
            $ack_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width:18px;">
    			            <path style="fill:#98beb7;" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"/>
    			        </svg>'; 
         } elseif($status == 'delivered') { 
            $ack_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width:18px;">
                            <path style="fill:#98beb7;" d="M182.6 246.6C170.1 259.1 149.9 259.1 137.4 246.6L57.37 166.6C44.88 154.1 44.88 133.9 57.37 121.4C69.87 108.9 90.13 108.9 102.6 121.4L159.1 178.7L297.4 41.37C309.9 28.88 330.1 28.88 342.6 41.37C355.1 53.87 355.1 74.13 342.6 86.63L182.6 246.6zM182.6 470.6C170.1 483.1 149.9 483.1 137.4 470.6L9.372 342.6C-3.124 330.1-3.124 309.9 9.372 297.4C21.87 284.9 42.13 284.9 54.63 297.4L159.1 402.7L393.4 169.4C405.9 156.9 426.1 156.9 438.6 169.4C451.1 181.9 451.1 202.1 438.6 214.6L182.6 470.6z"/>
                         </svg>'; 
         } elseif($status == 'viewed') { 
            $ack_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width:18px;">
                            <path style="fill:#53bdeb;" d="M182.6 246.6C170.1 259.1 149.9 259.1 137.4 246.6L57.37 166.6C44.88 154.1 44.88 133.9 57.37 121.4C69.87 108.9 90.13 108.9 102.6 121.4L159.1 178.7L297.4 41.37C309.9 28.88 330.1 28.88 342.6 41.37C355.1 53.87 355.1 74.13 342.6 86.63L182.6 246.6zM182.6 470.6C170.1 483.1 149.9 483.1 137.4 470.6L9.372 342.6C-3.124 330.1-3.124 309.9 9.372 297.4C21.87 284.9 42.13 284.9 54.63 297.4L159.1 402.7L393.4 169.4C405.9 156.9 426.1 156.9 438.6 169.4C451.1 181.9 451.1 202.1 438.6 214.6L182.6 470.6z"/>
                         </svg>'; 
         } else { } ?>
        
	  <div class="flex justify-end">
        <div class="single-message rounded-tl-lg rounded-bl-lg text-gray-200 rounded-br-lg user mb-4 px-4 py-2" style="max-width: 60%;">
			<div class="tooltip" style="display: inline-block;font-size: 16.2px;line-height: 26px;color:#e9edef;">
			    <?php if($type == 'text') { ?>
			        <?= nl2br(preg_replace($url_format, '<a href="$0" style="color:#49bef7;" target="_blank" title="$0">$0</a>', $message_content)); ?>
			    <?php } elseif($type == 'file') { ?>
    			    <a href="<?= $message_content; ?>" target="_blank">File Uploaded <i class="fa fa-download" aria-hidden="true"></i></a>
    			<?php } else { } ?>
			    <div class="tooltiptext"><?= $sub_name_2; ?> - <?= $date; ?></div>
			</div>
			<div style="float: right;margin-top: 5%;padding-left: 30px;">
			    <div style="display:inline-block;font-size:0.9rem;color:#98beb7;"><?= $time; ?></div>
			    <div style="display:inline-block;vertical-align: sub;">
			        <?= $ack_icon; ?>
			    </div>
			</div>
		</div>
		  <span>
			  <svg class="user-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 13" width="8" height="13">
				  <path opacity=".13" d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
				  <path fill="currentColor"d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
			  </svg>
		  </span>
      </div>
				
	<?php 
		 }
			
	  } } else { }
	  
	} } else { }
	
	
/* Updating Active Chat user end messages as seen ------- */
	
	$sql = "UPDATE chat_messages SET status = 'viewed'
        	WHERE u_id = '$u_id' AND status != 'viewed'";
	if ($conn->query($sql) === TRUE) { } else {
		echo "ERROR" . $sql . "<br>" . $conn->error;
	}
	
	$sql2 = "UPDATE chats SET status = 1
		    WHERE id = '$u_id'";
    if ($conn->query($sql2) === TRUE) { } else {
	    echo "ERROR" . $sql2 . "<br>" . $conn->error;
    }
	

?>