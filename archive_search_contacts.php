<?php include('db.php'); ?>
<?php 
    $chat_user_search_input = $_POST["chat_user_search_input"];
    
	$sqlusers_title = "SELECT * FROM chats WHERE (name LIKE '%$chat_user_search_input%' OR number LIKE '%$chat_user_search_input%') AND contact_stats = 'Archive'";
	$resultusers_title = $conn->query($sqlusers_title);
	if ($resultusers_title->num_rows > 0) {                               
	while($rowusers_title = $resultusers_title->fetch_assoc()) { 
		$u_fname_title = $rowusers_title["name"];
		$u_lname_title = '';
		$u_whatsapp_title = $rowusers_title["number"];
		$u_id_title = $rowusers_title["id"];
		$u_status = $rowusers_title["status"];
		$u_last_message = $rowusers_title["last_message"];
		$u_last_message_check = $rowusers_title["last_message_check"];

        echo '<div class="message text-gray-300 chat_switch" id="usertitle'.$u_id_title.'" data-uid="'.$u_id_title.'" data-uname="'.$u_fname_title.'" data-uwhatsapp="'.$u_whatsapp_title.'"
            	   style="border: 1px solid #6a6a6a;border-top: none;border-left: none;border-right: none;cursor:pointer;padding:5px 10px;">
                <div class="flex items-center relative">
                  <div class="w-1/6">
                    <i class="fa fa-user-circle-o fa-6" aria-hidden="true" style="color: #53bdeb;font-size:34px;"></i>
                  </div>
                  <div class="w-5/6">
                    <div class="text-xl text-white" style="font-size: 16px;" id="u_name_getted'.$u_id_title.'">'.$u_fname_title.' '.$u_lname_title.'</div>
                    <div class="text-sm truncate" style="padding-left: 5px;font-size: 12px;color: #e2f2fc;">'.$u_whatsapp_title.'</div>
                  </div>
                </div>
              </div>';
  
} } else { } ?>