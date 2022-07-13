<?php include("../db.php"); ?>
<?php $u_whatsapp = $_GET["number"]; ?>
		
<div id="chat-history" class="chat-history-div" style="z-index: 9999;">
    <div id="message" style="width: 100%; background: white;background: #bde3ef;border-radius: 10px;">
        <div id="message-nano-wrapper" class="nano has-scrollbar" 
			 style="background: whitesmoke;padding: 3% 0% 3% 3%;height: 85%;width: 100%;overflow-y: scroll;overflow-x: hidden;">
            <div class="nano-content" tabindex="0" style="right: -17px;">
                <ul class="message-container" style="padding-inline-start: 0px !important;">
                    <li class="sent" style="list-style-type: none;">

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
                        			$time = date('H:i', $time_stamp); 
                        			
                        			$sqluser_2 = "SELECT * FROM subadmin WHERE id = '$sub_id'";
                                	$resultuser_2 = $conn->query($sqluser_2);
                                	if ($resultuser_2->num_rows > 0) {   
                                	while($rowuser_2 = $resultuser_2->fetch_assoc()) {
                                		$sub_name_2 = $rowuser_2["name"];
                                	} } else {
                                	    $sub_name_2 = "CHAT";
                                	}
                        			
                        			if($by_whom == 'user') {
                        	?>	
					
					        <div class="details" style="font-size: 15px; color: #50a8f4; padding-bottom: 10px;width:100%;text-align:left;">
                                <div class="tooltip" style="display: inline-block;max-width: 80%;width: auto;font-size: 16px;opacity: 1;
    													 background: #55a1cd;color: white;padding: 4px 6px;
    															 border-radius: 7px;position: relative;">
    								<?= nl2br($message_content); ?>
    								<span class="tooltiptext">User</span>
    							</div>
    						</div>
							
							<?php    } else { ?>
							
							<div class="details" style="font-size: 15px; color: #50a8f4; padding-bottom: 10px;width:100%;text-align:right;">
                                <div class="tooltip" style="display: inline-block;max-width: 80%;width: auto;
    																  background: #346683;font-size: 16px;opacity: 1;
    													  color: white;padding: 4px 6px;border-radius: 7px;position: relative;">
    								<?= nl2br($message_content); ?>
    								<span class="tooltiptext"><?= $sub_name_2; ?></span>
    							</div>
    						</div>
							
						    <?php    } 
						    
                            	    } } else { }
	  
	                            } } else { }
						    ?>
							
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
