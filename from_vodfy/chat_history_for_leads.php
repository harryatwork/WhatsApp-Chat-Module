<?php include("../db.php"); ?>
<?php $u_whatsapp = $_GET["number"];
      $sub_id_o = $_GET["sub_id"];
      $name = $_GET["name"];
?>
		
<div id="chat-history" class="chat-history-div" style="position: fixed; top: 142%; right: 0px; transform: translate(0%, -50%); height: 100%; z-index: 9999;">
    
    <div class="header" id="chat-history-open-btn" style="margin-bottom:0px;background: #bde3ef;cursor:pointer;width: 60px;border-radius: 10px;margin-left: 85%;text-align: center;">
            <a 
			   style="width: 100%;margin-left: 5%;display: inline-block;font-size: 40px;font-weight: 600;">
                <i class="fa fa-whatsapp" aria-hidden="true"></i>
            </a>
        </div>
    
    <div id="message" style="width: 500px; background: white; height: 100%; 
							 padding-top: 2%;background: #bde3ef;border-radius: 10px;">
		<div class="header header_2" style="margin-bottom:0px;">
            <a id="chat-history-close-btn" class="btn button btn-danger" 
			   style="width: 20%;margin-left: 5%;display: inline-block;font-size: 14px;font-weight: 600;">
                Close
                <div class="ripple-container"></div>
            </a>
            <h2 style="display: inline-block;float: right;padding: 16px;" class="page-title">Chat History
				<span class="grey"></span>
			</h2>
        </div>

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
		
		<div id="message-nano-wrapper" class="nano has-scrollbar" 
			 style="background: whitesmoke;height: 85%;width: 100%;overflow-y: scroll;overflow-x: hidden;">
		    <form method="post" action="chatsend" id="chatter"></form>
            <div class="nano-content" tabindex="0" style="right: -17px;">
				<textarea form="chatter" id="chat_textarea" style="height: 61px;width: 86%;background: rgb(181, 228, 255);border-radius: 7px;border:1px solid gray;
								 font-size: 16px;color: black;display: inline-block;padding: 8px;overflow: hidden;margin-left: 10px;"></textarea>
				<input form="chatter" type="hidden" id="mobile" value="<?= $u_whatsapp; ?>" />
				<input form="chatter" type="hidden" id="sub_id" value="<?= $sub_id_o; ?>" />
				<input form="chatter" type="hidden" id="name" value="<?= $name; ?>" />
				<button form="chatter" type="submit" id="chat_textarea_btn" style="display: inline-block;font-size: 40px;vertical-align: top;color: #346683;">
					<i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
		</div>
		
    </div>
</div>


<script>
$("#chat-history-open-btn").click(function() {
	$(".chat-history-div").css("top","42%");
	$(".chat-history-overlay").css("display","block");
	$("#message-nano-wrapper").animate({ scrollTop: $("#message-nano-wrapper").prop("scrollHeight")}, 1000);
});
	
$("#chat-history-close-btn").click(function() {
	$(".chat-history-div").css("top","142%");
	$(".chat-history-overlay").css("display","none");
});
</script>

<script>
$(document).on('submit','#chatter',function(e){
    e.preventDefault();
    let chat_loader_whatsapp = $("#mobile").val();
    let message = $("#chat_textarea").val(); 
    let sub_id = $("#sub_id").val();
    let name = $("#name").val();
    
    let message_new = message.replace(/\n/g,"<br>");
    
    $(".sent").append(`<div class="details" style="font-size: 15px; color: #50a8f4; padding-bottom: 10px;width:100%;text-align:right;">
                            <div class="tooltip" style="display: inline-block;max-width: 80%;width: auto;
																  background: #346683;font-size: 16px;opacity: 1;
													  color: white;padding: 4px 6px;border-radius: 7px;position: relative;">
								`+message_new+`
								<span class="tooltiptext"></span>
							</div>
						</div>`);
	$('#chat_textarea').val('');
	$("#message-nano-wrapper").animate({ scrollTop: $("#message-nano-wrapper").prop("scrollHeight")}, 1000);
    
    $.post(
    	'https://chat.vdofyfilex.com/chatsend.php',
      {
         sub_id: sub_id,
         message: message,
         whatsapp: chat_loader_whatsapp,
         name: name
      },
     function(result){
         
     }
  );
});
</script>