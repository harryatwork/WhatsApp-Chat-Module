<?php include('db.php'); ?>

<?php
    date_default_timezone_set('Asia/Calcutta'); 
    $chat_loader_whatsapp = $_GET["chat_loader_whatsapp"];
    
    $sql_dist_uid_chat_msgs = "SELECT DISTINCT u_id, MAX(id) FROM chat_messages GROUP BY u_id ORDER BY MAX(id) DESC, u_id";
	$result_dist_uid_chat_msgs = $conn->query($sql_dist_uid_chat_msgs);
	if ($result_dist_uid_chat_msgs->num_rows > 0) {                               
	while($row_dist_uid_chat_msgs = $result_dist_uid_chat_msgs->fetch_assoc()) { 
		$dist_uid_chat_msgs = $row_dist_uid_chat_msgs["u_id"];
		
// 	$sql_uid_chat_msgs = "SELECT * FROM chat_messages WHERE u_id = '$dist_uid_chat_msgs' ORDER BY id DESC LIMIT 1";
// 	$result_uid_chat_msgs = $conn->query($sql_uid_chat_msgs);
// 	if ($result_uid_chat_msgs->num_rows > 0) {                               
// 	while($row_uid_chat_msgs = $result_uid_chat_msgs->fetch_assoc()) { 
// 		$uid_chat_msgs = $row_uid_chat_msgs["u_id"];
    
	$sqlusers_title = "SELECT * FROM chats WHERE id = '$dist_uid_chat_msgs' AND contact_stats = 'Archive'";
	$resultusers_title = $conn->query($sqlusers_title);
	if ($resultusers_title->num_rows > 0) {                               
	while($rowusers_title = $resultusers_title->fetch_assoc()) { 
		$u_fname_title = $rowusers_title["name"];
		$u_lname_title = '';
		$u_whatsapp_title = $rowusers_title["number"];
		$u_id_title = $rowusers_title["id"];
		$u_id = $rowusers_title["id"];
		$u_status = $rowusers_title["status"]; 
		$u_last_message = $rowusers_title["last_message"];
		$u_last_message_check = $rowusers_title["last_message_check"];
?>

  <div class="message text-gray-300 chat_switch" id="usertitle<?= $u_id_title; ?>" data-uid="<?= $u_id_title; ?>" data-uname="<?= $u_fname_title; ?>" data-uwhatsapp="<?= $u_whatsapp_title; ?>"
	   style="<?php if($chat_loader_whatsapp == $u_whatsapp_title) { ?> background-color:#283034; <?php } else { } ?> border: 1px solid #6a6a6a;border-top: none;border-left: none;border-right: none;cursor:pointer;padding:5px 10px;">
    <div class="flex items-center relative">
      <div class="w-1/6">
        <!--<img class="w-11 h-11 rounded-full" src="chat-assets/user.png" style="height:auto;">-->
        <i class="fa fa-user-circle-o fa-6" aria-hidden="true" style="color: #53bdeb;font-size:34px;"></i>
      </div>
    <?php
        $sql_chat_messages_1 = "SELECT * FROM chat_messages WHERE u_id = '$u_id' ORDER BY id DESC LIMIT 1";
		$result_chat_messages_1 = $conn->query($sql_chat_messages_1);
		if ($result_chat_messages_1->num_rows > 0) {                               
		while($row_chat_messages_1 = $result_chat_messages_1->fetch_assoc()) { 
			$chat_messages_message = $row_chat_messages_1["message"];
			$chat_messages_date = $row_chat_messages_1["date"];
			$chat_messages_time = date('H:i', $chat_messages_date); 
		} } else { } 
	?>
      <div class="w-5/6">
        <div class="text-xl text-white" style="font-size: 16px;" id="u_name_getted<?= $u_id_title; ?>"><?= $u_fname_title; ?> <?= $u_lname_title; ?> <p style="font-size:12px;float:right;"><?= $chat_messages_time; ?></p></div>
        <div class="text-sm truncate" style="padding-left: 5px;font-size: 12px;color: #e2f2fc;"><?= substr($chat_messages_message, 0, 30); ?></div>
      </div>
    <?php
        $sql_chat_messages = "SELECT * FROM chat_messages WHERE u_id = '$u_id' AND by_whom = 'user' ORDER BY id DESC LIMIT 1";
		$result_chat_messages = $conn->query($sql_chat_messages);
		if ($result_chat_messages->num_rows > 0) {                               
		while($row_chat_messages = $result_chat_messages->fetch_assoc()) { 
			$chat_messages_status = $row_chat_messages["status"];
	?>
        <?php if($chat_messages_status == 'NA') { ?>
          <div class="message_status_<?= $u_id; ?>" style="width: 12px;height: 12px;background: #5db35d;border-radius: 50%;border:1px solid white;"></div> 
        <?php } else { ?>
          <div>&nbsp;</div> 
        <?php } ?>
    <?php } } else { } ?>
    </div>
  </div>
  
<?php } } else { } ?>


<?php } } else { } ?>