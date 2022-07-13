<?php ob_start();
      include('db.php'); 
      
     if(!isset($_SESSION['email'])) {
        header("Location: index");  
    }
?>
<title>VDOfy - Chat</title>
<link rel="icon" href="https://vdofy.com/wp-content/uploads/2020/10/cropped-unnamed-32x32.png" sizes="32x32">

<style>
	.sidebar {
		z-index:9999;
	}
	body {
	    background: #0d1418;
	}
	.contact_stautus {
	    position:relative;
	    height: 67px;
        margin-top: 0 !important;
        margin-left: -5px;
	}
	.message:hover {
	    background-color: #283034;
    }
    
    .tooltip {
      position: relative;
      display: inline-block;
    }
    .tooltip .tooltiptext {
      display:block;
      visibility: hidden;
      width: atuo;
      background-color: lightgray;
      color: black;
      font-weight:600;
      text-align: center;
      border-radius: 6px;
      padding: 0px 15px;
      /* Position the tooltip */
      position: absolute;
      z-index: 1;
    }
    .tooltip:hover .tooltiptext {
      visibility: visible;
    }
    
    
    #overlay1, #overlay2, #overlay3, #overlay4, #overlay5, #overlay6 {
      position: fixed; /* Sit on top of the page content */
      display: none; /* Hidden by default */
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5); /* Black background with opacity */
      z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */
    }
    
</style>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css'>
<link rel="stylesheet" href="chat-assets/chat-style.css">


<!-- Essentials Inputs Starts ---->

<?php 
    $email = $_SESSION['email']; 
    $sqluser = "SELECT * FROM subadmin WHERE email = '$email'";
	$resultuser = $conn->query($sqluser);
	if ($resultuser->num_rows > 0) {   
	while($rowuser = $resultuser->fetch_assoc()) {
		$sub_id = $rowuser["id"];
		$sub_name = $rowuser["name"];
	} } else {
	    $sub_name = "CHAT";
	    $sub_id = 0;
	}

?>

<input type="hidden" id="chat_loader_whatsapp" />
<input type="hidden" id="sub_id" value="<?= $sub_id; ?>" />

<!-- Essentials Inputs Ends ---->
 

<div id="loader" style="background: #2b343c;width: 100%;height: 100%;position: absolute;z-index: 99;opacity: 1;background-image: url(chat-assets/whatsapp-bg.png);
    background-size: inherit;
    background-position: top;
    background-repeat: repeat;">
	<img src="chat-assets/chatloading.gif" style="position: absolute;width: 500px;top: 50%;left: 50%;transform: translate(-50%, -50%);" />
</div>


<div id="loader_for_chat_switch" style="background-attachment: initial;background-origin: initial;background-clip: initial;background-color: rgb(43, 52, 60);width: 80%;height: 82%;left: 20%;top: 8.5%;position: fixed;z-index: 99;opacity: 1;background-image: url(&quot;chat-assets/whatsapp-bg.png&quot;);background-size: inherit;background-position: center top;background-repeat: repeat;display: none;">
	<img src="chat-assets/chatloading.gif" style="position: absolute;width: 500px;top: 50%;left: 50%;transform: translate(-50%, -50%);">
</div>


<div id="loadcontacts">
    
  <aside class="bg-gray-200 overflow-y-auto border-r border-gray-800 relative block" style="background:#131c21;height:100%;width:20%;position:fixed;overflow:hidden;">
    <div class="aside-header sticky top-0 right-0 left-0 z-40 text-gray-400">
       <div class="flex items-center" style="padding:5px 10px;">
         <div class="flex-1">
           <img class="w-11 h-11 rounded-full" src="chat-assets/chatr_box.png" alt="" style="display: inline-block;object-fit: contain;width: 150px;" />
           <p class="archive_btn" style="display: inline-block;vertical-align: sub;cursor:pointer;">
               <i class="fa fa-archive" aria-hidden="true" style="font-size: 20px;color: #49bef7;"></i>
           </p>
         </div>
		 <div class="text-xl text-white" style="font-size: 16px;"><?= $sub_name; ?></div>
       </div>
    </div>
    
    <div class="normal_contacts">
    
        <div class="search_div" style="position: fixed;width: 19%;padding: 5px 0px 5px 15px;border-bottom: 1px solid gray;z-index: 9;background: #131c21;">
            <i class="fa fa-search" aria-hidden="true" style="color: #e6e0e4;position: absolute;margin-top: 2%;margin-left: 3%;font-size: 20px;"></i>
            <input id="chat_user_search_input" type="search" placeholder="Type Name or Number" style="width: 98%;background: #202c33;color: white;padding: 5px 10px 5px 45px;border-radius: 10px;">
        </div>
    
        <div class="aside-messages loaded_contacts" style="width: 100%;padding-bottom: 14%;padding-top: 14%;height: 100%;overflow-y: scroll;">
           <div id="loadcontacts_status" style="width: 100%;display: inline-block;"></div>
        </div>
        
        <div class="aside-messages searched_contacts" style="width: 100%; display:none;padding-top:14%;"></div>
        
    </div>
    
    
    <div class="archive_contacts" style="display:none;">
    
        <div class="search_div_archive" style="position: fixed;width: 19%;padding: 5px 0px 5px 15px;border-bottom: 1px solid gray;z-index: 9;background: #131c21;">
            <p style="color: white;width: 100%;padding: 10px;text-align: right;font-size: 20px;">
                <span class="archive_contacts_close" style="float: left;font-size: 26px;cursor:pointer;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></span>
                Archived Contacts
            </p>
            <i class="fa fa-search" aria-hidden="true" style="color: #e6e0e4;position: absolute;margin-top: 2%;margin-left: 3%;font-size: 20px;"></i>
            <input id="chat_user_search_input_archive" type="search" placeholder="Type Name or Number" style="width: 98%;background: #202c33;color: white;padding: 5px 10px 5px 45px;border-radius: 10px;">
        </div>
    
        <div class="aside-messages loaded_contacts_archive" style="width: 100%;padding-bottom: 14%;padding-top: 28%;height: 100%;overflow-y: scroll;">
           <div id="loadcontacts_status_archive" style="width: 100%;display: inline-block;"></div>
        </div>
        
        <div class="aside-messages searched_contacts_archive" style="width: 100%; display:none;padding-top:28%;"></div>
        
    </div>
    
    
    
  </aside>
    
</div>

<main id="messageBody" class="w-full relative overflow-y-auto"> 

<div class="main-header z-40 sticky top-0 right-0 left-0 text-gray-400" style="padding-top:0%;margin-left:20%;">
	<div class="flex items-center" style="padding:5px 10px;">
		<div class="flex-1">
			<div class="flex" style="height: 45px;">
				<div class="mr-4">
					<img class="w-11 h-11 rounded-full" src="chat-assets/user.png">
				</div>
				<div>
					<p class="text-md font-bold text-white" id="u_name_poster" style="padding: 10px 0px;cursor:pointer;">Choose a Contact</p>
				</div>
				<div style="position: absolute;right: 6%;top: 30%;cursor:pointer;">
				    <img id="addchat-btn" src="chat-assets/user_icon.png" alt="" style="cursor:pointer;width:30px;" />
				</div>
				<div class="current_chat_options" style="display:none;position: absolute;right: 3%;top: 30%;cursor:pointer;">
				    <i class="fa fa-bars" aria-hidden="true" style="font-size: 25px;color: white;cursor:pointer;"></i>
				</div>
				<div class="current_chat_options_div" style="position: absolute;
				            display:none;
                            right: 3%;
                            top: 100%;
                            background: #0d1820;
                            text-align: center;
                            cursor: pointer;
                            font-weight: 600;
                            border-radius: 5px;
                            color: #6ed0ff;
                            box-shadow: 0px 2px 0px 2px rgb(255 255 255 / 20%);">
				    <p class="archive_chat_btn" data-uname="" style="border-bottom: 1px solid #eaf3f6;padding: 10px 15px;"><i class="fa fa-archive" aria-hidden="true"></i> Archive Chat</p>
				    <p class="delete_chat_btn" data-uname="" style="padding: 10px 15px;"><i class="fa fa-trash" aria-hidden="true"></i> Delete Chat</p>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Chat Area Starts -->

    <div id="links" class="main-messages block px-4 py-3 hidder links" style="margin-left:20%;overflow: auto;height: 81%;overflow-x: hidden;background-color: #0d1418;
        background-image: url(chat-assets/whatsapp-bg.png);
        background-size: inherit;
        background-position: top;
        background-repeat: repeat; display:none;">
    </div>

    <div class="main-footer sticky bottom-0 right-0 left-0 text-gray-400 hidder links" style="display:block;margin-left:20%;display:none;" id="usertext<?= $u_id; ?>">
       <div class="flex items-center px-4 py-1">
		   
		 <div style="font-size: 30px;" id="file_upload_btn" style="cursor:pointer;">
			 <i class="fa fa-paperclip" aria-hidden="true" style="cursor:pointer;"></i>
		 </div>
		   
         <div class="flex-grow">
           <div class="px-4 py-2 w-full">
             <form method="post" data-id="<?= $u_id; ?>" action="chatsend" id="chatter<?= $u_id; ?>"></form>
               <div class="relative text-gray-600 focus-within:text-gray-200">
                 <textarea required form="chatter<?= $u_id; ?>" style="font-size: 16px;outline: -webkit-focus-ring-color auto 0.5px;background: transparent;color: white;" 
                            type="search" name="message" id="message<?= $u_id; ?>" class="message-input w-full py-3 text-sm text-white bg-gray-700 rounded-full pl-5 focus:outline-none focus:bg-white focus:text-gray-900" 
                            placeholder="Type a message" autocomplete="off" ></textarea>
				 <input type="hidden" form="chatter<?= $u_id; ?>" name="whatsapp" id="whatsapp<?= $u_id; ?>" value="<?= $whatsapp; ?>" />
               </div>
           </div>
         </div>
         <div class="flex-none text-right" style="margin-top:1.5%";>
           <button type="submit" id="send-btn" form="chatter<?= $u_id; ?>" >
               <i style="font-size: 35px;color: #5db35d;" class="fa fa-paper-plane" aria-hidden="true"></i>
           </button>
         </div>
       </div>
    </div>

<!-- Chat Area Ends -->


<!-- Choose a contact Starts -->

    <div class="main-messages block px-4 py-3 hidder links_choose_a_contact" style="margin-left:20%;overflow: auto;height: 100%;overflow-x: hidden;background-color: #0d1418;
        background-image: url(chat-assets/whatsapp-bg.png);
        background-size: inherit;
        background-position: top;
        background-repeat: repeat;">
    </div>
    <div class="links_choose_a_contact" style="position:absolute;top: 54%;left: 60%;transform: translate(-50%, -50%);">
    	<img style="width: 60%;margin: auto;" src="chat-assets/chatr_box.png">
    	<h3 style="color: white;font-size: 16px;text-align: center;padding-top: 3%;">Choose a contact to view chat</h3>
    </div>
    
<!-- Choose a contact Ends -->


</main>




<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).on('submit','#chatter',function(e){
    e.preventDefault();
    let chat_loader_whatsapp = $("#chat_loader_whatsapp").val();
    let message = $("#message").val(); 
    let sub_id = $("#sub_id").val();
    
    $("#links").append(`<div class="flex justify-end">
                            <div class="single-message rounded-tl-lg rounded-bl-lg text-gray-200 rounded-br-lg user mb-4 px-4 py-2" style="max-width: 60%;">
                    			<div class="tooltip" style="display: inline-block;font-size: 16.2px;line-height: 26px;color:#e9edef;">
                    			    `+message+`
                    			    <div class="tooltiptext"></div>
                    			</div>
                    			<div style="float: right;margin-top: 5%;padding-left: 30px;">
                    			    <div style="display:inline-block;font-size:0.9rem;color:#98beb7;"></div>
                    			    <div style="display:inline-block;vertical-align: sub;">
                    			        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 16px;fill: #dee6e8;">
                    			            <path d="M256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512zM232 256C232 264 236 271.5 242.7 275.1L338.7 339.1C349.7 347.3 364.6 344.3 371.1 333.3C379.3 322.3 376.3 307.4 365.3 300L280 243.2V120C280 106.7 269.3 96 255.1 96C242.7 96 231.1 106.7 231.1 120L232 256z"></path>
                    			        </svg>
                    			    </div>
                    			</div>
                    		</div>
                    		  <span>
                    			  <svg class="user-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 13" width="8" height="13">
                    				  <path opacity=".13" d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                    				  <path fill="currentColor"d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                    			  </svg>
                    		  </span>
                          </div>`);
                        
    
                        
                        
	$('#message').val('');
	$("#links").animate({ scrollTop: $("#links").prop("scrollHeight")}, 1000);
    
    $.post(
    	'chatsend.php',
      {
         sub_id: sub_id,
         message: message,
         whatsapp: chat_loader_whatsapp,
      },
     function(result){
         loadlink();
         setTimeout(function(){
            $('#links').scrollTop($('#links')[0].scrollHeight);
        }, 5000); // this will run once after 5 seconds
     }
  );
});
</script>
<script>
$("#chat_user_search_input").on('input',function(){
    $(".loaded_contacts").css("display","none");
    $(".searched_contacts").css("display","block");
    
    let chat_user_search_input = $("#chat_user_search_input").val();
    $.post(
    	'normal_search_contacts.php',
      {
         chat_user_search_input: chat_user_search_input
      },
     function(result){
         $(".searched_contacts").html(result);
     }
    );
});

$("#chat_user_search_input_archive").on('input',function(){
    $(".loaded_contacts_archive").css("display","none");
    $(".searched_contacts_archive").css("display","block");
    
    let chat_user_search_input_archive = $("#chat_user_search_input_archive").val();
    $.post(
    	'archive_search_contacts.php',
      {
         chat_user_search_input_archive: chat_user_search_input_archive
      },
     function(result){
         $(".searched_contacts_archive").html(result);
     }
    );
});


$('body').on("click",function() {
    $("#chat_user_search_input").val('');
    $("#chat_user_search_input_archive").val('');
    $(".loaded_contacts").css("display","block");
    $(".searched_contacts").css("display","none");
    $(".loaded_contacts_archive").css("display","block");
    $(".searched_contacts_archive").css("display","none");
});

</script>


<script>
function loadlink(){
    let chat_loader_whatsapp = $("#chat_loader_whatsapp").val();
    $('#links').load('chatloader.php?whatsapp='+chat_loader_whatsapp,function () {
         $(this).unwrap();
    });
}

// loadlink(); // This will run on page load

setInterval(function(){
    loadlink() 
    // $('#links').scrollTop($('#links')[0].scrollHeight);
}, 5000); // this will run after every 5 seconds
	
$('#loader').show().delay(5000).fadeOut('slow');
$('#links').scrollTop($('#links')[0].scrollHeight);


// On Chat_Switch ---------------------------------------------------------
$(document).on("click", ".chat_switch", function(){
    let uid = $(this).attr('data-uid');
    let uname = $(this).attr('data-uname');
    let uwhatsapp = $(this).attr('data-uwhatsapp');
    $("#loader_for_chat_switch").css("display","block");
    $("#chat_loader_whatsapp").val(uwhatsapp);
    $('#links').load('chatloader.php?whatsapp='+uwhatsapp,function () {
         $(".links_choose_a_contact").css("display","none");
         $(".links").css("display","block");
         $("#loader_for_chat_switch").css("display","none");
         $(this).unwrap();
         $("#links").animate({ scrollTop: $("#links").prop("scrollHeight")}, 1000);
    });
    $("#u_name_poster").html(uname);
    $("#u_name_poster").attr('data-uwhatsapp',uwhatsapp);
    $("#chat_user_search_input").val('');
    $(".loaded_contacts").css("display","block");
    $(".searched_contacts").css("display","none");
    $(".chat_switch").css("background", "#131c21");
    $('[data-uid="'+uid+'"]').css("background", "#283034");
    $(".message_status_"+uid).remove();
    $(".current_chat_options").css("display","block");
    $(".archive_chat_btn").attr('data-uname',uname);
    $(".delete_chat_btn").attr('data-uname',uname);
});

</script>


<div id="overlay1"></div>
<div id="overlay2"></div>
<div id="overlay3"></div>
<div id="overlay4"></div>
<div id="overlay5"></div>
<div id="overlay6"></div>

<div id="addchat" style="position: absolute;top: 45%;left: 50%;transform: translate(-50%, -50%);background: white;width: 400px;height: auto;border-radius: 10px;display:none;z-index: 9;">
	<form action="addchat" method="post">
    	<h3 style="font-size: 16px;font-weight: 600;text-align: center;text-transform: uppercase;padding: 15px;">Create a Chat</h3>
    	<input required type="text" name="name" placeholder="User First Name" style="outline-width: 0;border: 1px solid;border-top: none;border-right: none;border-left: none;width: 80%;margin-left: 9%;margin-top: 6%;" />
    	<input required type="number" name="number" placeholder="Mobile Number"  style="outline-width: 0;border: 1px solid;border-top: none;border-right: none;border-left: none;width: 80%;margin-left: 9%;margin-top: 6%;" />
    	<input type="hidden" name="sub_id" value="<?= $sub_id; ?> />"
    	<input type="text" placeholder="Message"  style="outline-width: 0;border: 1px solid;border-top: none;border-right: none;border-left: none;width: 80%;margin-left: 9%;margin-top: 6%;" />
    	<textarea required type="text" name="message" placeholder="Message"  style="outline-width: 0;border: 1px solid;border-top: none;border-right: none;border-left: none;width: 80%;margin-left: 9%;margin-top: 6%;" ></textarea>
		<a id="addchatclose-btn" class="btn-warning btn" style="cursor:pointer;margin-top: 8%;width: 40%;margin-left: 9%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:lightgray;">Cancel</a>
		<button type="submit" class="btn-success btn" style="cursor:pointer;margin-top: 8%;width: 40%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:green;color:white;">Create</button>
	</form>
</div>

<div id="file_upload" style="position: fixed;top: 45%;left: 50%;transform: translate(-50%, -50%);background: white;width: 400px;height: auto;border-radius: 10px;display:none;z-index: 9;">
	<form action="https://vdofyfilex.com/backend_functions/uploads_from_chat_module.php" method="post" enctype='multipart/form-data'>
    	<h3 style="font-size: 16px;font-weight: 600;text-align: center;text-transform: uppercase;padding: 15px;">Upload file</h3>
    	<input required type="file" name="file" id="file" placeholder="Choose a file" style="outline-width: 0;border: 1px solid;border-top: none;border-right: none;border-left: none;width: 80%;margin-left: 9%;margin-top: 6%;" />
		<a id="file_upload_close_btn" class="btn-warning btn" style="cursor:pointer;margin-top: 8%;width: 40%;margin-left: 9%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:lightgray;">Cancel</a>
		<button type="button" id="file_upload_submit_btn" class="btn-success btn" style="cursor:pointer;margin-top: 8%;width: 40%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:green;color:white;">Upload</button>
	</form>
</div>


<div class="archive_chat_div" style="position: fixed;top: 45%;left: 50%;transform: translate(-50%, -50%);background: white;width: 400px;height: auto;border-radius: 10px;display:none;z-index: 9;">
	<form action="archive_chat" method="post" >
    	<h3 style="font-size: 16px;font-weight: 600;text-align: center;text-transform: uppercase;padding: 15px;">Are you sure, you want to Archive <br/>"<span class="uname_for_chat_option"></span>" Chat?</h3>
		<a class="btn-warning btn archive_chat_cancel" style="cursor:pointer;margin-top: 8%;width: 40%;margin-left: 9%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:lightgray;">Cancel</a>
		<button type="button" class="btn-success btn archive_chat_submit" style="cursor:pointer;margin-top: 8%;width: 40%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:green;color:white;">Yes</button>
	</form>
</div>

<div class="delete_chat_div" style="position: fixed;top: 45%;left: 50%;transform: translate(-50%, -50%);background: white;width: 400px;height: auto;border-radius: 10px;display:none;z-index: 9;">
	<form action="delete_chat" method="post" >
    	<h3 style="font-size: 16px;font-weight: 600;text-align: center;text-transform: uppercase;padding: 15px;">Are you sure, you want to Delete <br/>"<span class="uname_for_chat_option"></span>" Chat?</h3>
		<a class="btn-warning btn delete_chat_cancel" style="cursor:pointer;margin-top: 8%;width: 40%;margin-left: 9%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:lightgray;">Cancel</a>
		<button type="button" class="btn-success btn delete_chat_submit" style="cursor:pointer;margin-top: 8%;width: 40%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:green;color:white;">Yes</button>
	</form>
</div>


<div class="user_details" style="z-index:9;display:none;top: 45%; left: 50%; transform: translate(-50%, -50%); background: #fcffff; border: 1px solid black; position: absolute; width: 50%; min-height: 50%; border-radius: 7px;padding: 2% 5%;">
</div>
	
<script src="https://use.fontawesome.com/28ef931647.js"></script>
<script>
$("#addchat-btn").on("click",function(){
	$("#addchat").css("display","block");
	$("#overlay1").css("display","block");
});	
	
$("#addchatclose-btn").on("click",function(){
	$("#addchat").css("display","none");
	$("#overlay1").css("display","none");
});	

$("#u_name_poster").on("click",function() { 
    let uwhatsapp = $(this).attr('data-uwhatsapp');
    $.post(
    	'https://vdofy.com/external_sites/fetch_user_details_for_chat.php',
      {
         uwhatsapp: uwhatsapp
      },
     function(result){
         $(".user_details").css("display","block");
         $("#overlay2").css("display","block");
         $(".user_details").html(result);
      }
    );
});

$(document).on('click','#overlay2,#close_user_details',function() {
	$(".user_details").css("display","none");
	$("#overlay2").css("display","none");
});

</script>

<script type="text/javascript">

$(document).on('click','#file_upload_btn',function() {
	$("#file_upload").css("display","block");
	$("#overlay4").css("display","block");
});

$(document).on('click','#file_upload_close_btn, #overlay4',function() {
	$("#file_upload").css("display","none");
	$("#overlay4").css("display","none");
});

$(document).ready(function() {
    $("#file_upload_submit_btn").click(function() {
        $("#file_upload").css("display","none");
	    $("#overlay4").css("display","none");
        
        $("#links").append(`<div class="flex justify-end file_upload_loading_message">
                            <div class="single-message rounded-tl-lg rounded-bl-lg text-gray-200 rounded-br-lg user mb-4 px-4 py-2" style="max-width: 60%;">
                    			<div class="tooltip" style="display: inline-block;font-size: 16.2px;line-height: 26px;color:#e9edef;">
                    			    File Uploading
                    			    <div class="tooltiptext"></div>
                    			</div>
                    			<div style="float: right;margin-top: 5%;padding-left: 30px;">
                    			    <div style="display:inline-block;font-size:0.9rem;color:#98beb7;"></div>
                    			    <div style="display:inline-block;vertical-align: sub;">
                    			        <img src="chat-assets/file_loading.gif" alt="" style="width:40px;height:40px;" />
                    			    </div>
                    			</div>
                    		</div>
                    		  <span>
                    			  <svg class="user-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 13" width="8" height="13">
                    				  <path opacity=".13" d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                    				  <path fill="currentColor"d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                    			  </svg>
                    		  </span>
                          </div>`);
                          
        $('#links').scrollTop($('#links')[0].scrollHeight);
        
        var fd = new FormData();
        var files = $('#file')[0].files;
        var chat_loader_whatsapp = $("#chat_loader_whatsapp").val();
        var sub_id = $("#sub_id").val();
        
        fd.append('file',files[0]);
        fd.append('chat_loader_whatsapp',chat_loader_whatsapp);
        fd.append('sub_id',sub_id);

        $.ajax({
            url:'https://vdofyfilex.com/backend_functions/uploads_from_chat_module.php',
            type:'post',
            data:fd,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success:function(response){
                if(response == 'sent'){
                    // console.log(response);
                    $(".file_upload_loading_message").css("display","none");
                }else{ }
            }
        });
            
            
    });
});
</script>

<script>
function loadcontacts(){
    let chat_loader_whatsapp = $("#chat_loader_whatsapp").val();
    $('#loadcontacts_status').load('normal_contacts_loader.php?chat_loader_whatsapp='+chat_loader_whatsapp,function () {
        //  $(this).unwrap();
    });
}

loadcontacts(); // This will run on page load
setInterval(function(){
    loadcontacts() // this will run after every 15 seconds
}, 10000);
</script>



<script>
$(".archive_btn").on("click",function() {
    let chat_loader_whatsapp = $("#chat_loader_whatsapp").val();
    
    $(".normal_contacts").css("display","none");
    $(".archive_contacts").css("display","block");
    
    // Load Contacts of Archived
    $('#loadcontacts_status_archive').load('archive_contacts_loader.php?chat_loader_whatsapp='+chat_loader_whatsapp,function () {
    });
});

$(".archive_contacts_close").on("click",function() {
    $(".normal_contacts").css("display","block");
    $(".archive_contacts").css("display","none");
});
</script>


<script>
$(".current_chat_options").on('click', function() {
    $(".current_chat_options_div").toggle();
});

$(".archive_chat_btn").on('click', function() {
   let uname_for_chat_option = $(this).attr("data-uname");
   $(".archive_chat_div").css("display","block");
   $("#overlay5").css("display","block");
   $(".uname_for_chat_option").html(uname_for_chat_option);
   $(".current_chat_options_div").toggle();
});
$(document).on('click','.archive_chat_submit',function() {
    let chat_loader_whatsapp = $("#chat_loader_whatsapp").val();
    $(".archive_chat_div").html(`<h3 style="font-size: 16px;font-weight: 600;text-align: center;text-transform: uppercase;padding: 15px;">Archiving Chat<br>Please wait.</h3>
                                     <img src="chat-assets/chatloading.gif" style="width: 150px;margin:auto;" />
                                    `);
    $.post(
    	'archive_chat.php',
      {
         chat_loader_whatsapp: chat_loader_whatsapp
      },
     function(result){
        setTimeout(function(){
         	$(".archive_chat_div").css("display","none");
            $("#overlay5").css("display","none");
            $(".archive_chat_div").html(`<form action="archive_chat" method="post" >
                                        	<h3 style="font-size: 16px;font-weight: 600;text-align: center;text-transform: uppercase;padding: 15px;">Are you sure, you want to Archive <br/>"<span class="uname_for_chat_option"></span>" Chat?</h3>
                                    		<a class="btn-warning btn archive_chat_cancel" style="cursor:pointer;margin-top: 8%;width: 40%;margin-left: 9%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:lightgray;">Cancel</a>
                                    		<button type="button" class="btn-success btn archive_chat_submit" style="cursor:pointer;margin-top: 8%;width: 40%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:green;color:white;">Yes</button>
                                    	</form>`);
        }, 10000);
      }
    );
});
$(document).on('click','.archive_chat_cancel',function() {
   $(".archive_chat_div").css("display","none");
   $("#overlay5").css("display","none");
});

$(".delete_chat_btn").on('click', function() {
   let uname_for_chat_option = $(this).attr("data-uname");
   $(".delete_chat_div").css("display","block");
   $("#overlay6").css("display","block");
   $(".uname_for_chat_option").html(uname_for_chat_option);
   $(".current_chat_options_div").toggle();
});
$(document).on('click','.delete_chat_submit',function() {
    let chat_loader_whatsapp = $("#chat_loader_whatsapp").val();
    $(".delete_chat_div").html(`<h3 style="font-size: 16px;font-weight: 600;text-align: center;text-transform: uppercase;padding: 15px;">Deleting Chat<br>Please wait.</h3>
                                     <img src="chat-assets/chatloading.gif" style="width: 150px;margin:auto;" />
                                    `);
    $.post(
    	'delete_chat.php',
      {
         chat_loader_whatsapp: chat_loader_whatsapp
      },
     function(result){
        setTimeout(function(){
         	$(".delete_chat_div").css("display","none");
            $("#overlay6").css("display","none");
            $("#u_name_poster").html("Choose a Contact");
            $(".delete_chat_div").html(`<form action="delete_chat" method="post" >
                                        	<h3 style="font-size: 16px;font-weight: 600;text-align: center;text-transform: uppercase;padding: 15px;">Are you sure, you want to Delete <br/>"<span class="uname_for_chat_option"></span>" Chat?</h3>
                                    		<a class="btn-warning btn delete_chat_cancel" style="cursor:pointer;margin-top: 8%;width: 40%;margin-left: 9%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:lightgray;">Cancel</a>
                                    		<button type="button" class="btn-success btn delete_chat_submit" style="cursor:pointer;margin-top: 8%;width: 40%;display: inline-block;font-weight:600;text-align: center;padding: 5px;border-radius: 7px;background:green;color:white;">Yes</button>
                                    	</form>`);
        }, 10000);
      }
    );
});
$(document).on('click','.delete_chat_cancel',function() { 
   $(".delete_chat_div").css("display","none");
   $("#overlay6").css("display","none");
});
</script>


<script src="https://use.fontawesome.com/6e1caccada.js"></script>