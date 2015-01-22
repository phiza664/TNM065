<?php
// contect database
include_once("db/db.php");
$link_id = db_connect();

if(is_null($link_id)){
	echo "Missing connection reference";
}
// startar sessionen
session_start();

//inqlude query.php where all php functions is stored. 
include("query.php");

// $output ligger i 
include "transformations/dbToXml.php";

//Secure that only logged in users can access the site.
wearify();

//save new card handeler
save_card();

//logou handeler
logout();

if(isset($_GET['format'])){

	if($_GET['format']=='json')
	{
		print $output;
		exit;
	};
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>CardViz</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Image">
	<meta name="author" content="Sebastian Rauhala, Philip Zanderholm">
	<link rel="icon" href="content/img/Plants-Tomato-icon.png">

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="transformations/design.css"/>
	<link href="css/tamplate.css" rel="stylesheet">
	
	<script src="transformations/jquery-1.9.0.js"></script>
	<script src="transformations/flickrTest.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CardViz</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#contact">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
    </div>
	</div>

	<div class="btn-group">
        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action 
        	<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
        <form id="cardform" action="" method="post" name="cardform">
			<tr>
			  <th>Title</th>
			  <td><input name="title" type="text" class="textfield" id="title"/></td>
			</tr>
			<tr>
			  <th>Content </th>
			  <td><input name="content" type="text" class="textfield" id="content" /></td>
			</tr>
			<tr>
			  <th>Image URL</th>
			  <td><input name="imageurl" type="text" class="textfield" id="imageurl" /></td>
			</tr>
			<tr>
			  <th>Signature</th>
			  <td><input name="signature" type="text" class="textfield" id="signature" /></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><input type="submit" name="submit2" value="post" /></td>
			</tr>
		</form>

        </ul>
	</div>

    <div class="container">

    	

	    <div class ="logout">
			<form id="logoutForm" action="" method="post" name="logoutform"> 
				<button id="logoutbutton" type="submit" name="submit" class="btn btn-warning">Logout</button>	
			</form>
		</div>

		<form id="cardform" action="main.php" method="post" name="cardform">
		<table>
		  <h2>Post your awsome card!</h2>
			<tr>
			  <th>Title</th>
			  <td><input name="title" type="text" class="textfield" id="title"/></td>
			</tr>
			<tr>
			  <th>Content </th>
			  <td><input name="content" type="text" class="textfield" id="content" /></td>
			</tr>
			<tr>
			  <th>Image URL</th>
			  <td><input name="imageurl" type="text" class="textfield" id="imageurl" /></td>
			</tr>
			<tr>
			  <th>Signature</th>
			  <td><input name="signature" type="text" class="textfield" id="signature" /></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><input type="submit" name="submit2" value="Post" /></td>
			</tr>
			<?php
			if(isset($errmsg_arr)){
				echo $errmsg_arr;
			}
			?> 
		</table>
		</form>

	<!-- 	<div id="post-card" class="card">
			<div class="large-image-container">
				
			</div>
			<h2 class="card-rubrik">qwe</h2>
			<div class="text-content">
				<p><span class="qoute qoute-first">ʻ</span>qwe<span class="qoute qoute-last">‚</span></p>
			</div>
			
		</div> -->
	<?php 
		print $output;

	 ?>
	</div>
 </body>

<script type="text/javascript">
	$( document.body ).on( 'click', '.dropdown-menu li', function( event ) {

	   var $target = $( event.currentTarget );
	 
	   $target.closest( '.btn-group' )
	      .find( '[data-bind="label"]' ).text( $target.text() )
	         .end()
	      .children( '.dropdown-toggle' ).dropdown( 'toggle' );
	 
		return false;
	 
	});

	$(".card").each(function() {
		$card = $(this);
		var imageText = $card.find(".large-image-container img").attr("src");
		var cardText = $card.find(".text-content-text").text();

		var $link = $('<a>',{
			text: 'edit card',
			title: 'edit card',
			href: '?action=edit&card-id='+$(this).attr("data-card-id")
		});

		var $btnEdit = $('<button>',{
			text: 'edit card',
			type: 'button',
			class: 'btn btn-default',
		});
		$btnEdit.click(function() {
			$form.collapse('toggle');
		});
		

		var $btnSave = $('<button>',{
			text: 'save changes',
			type: 'submit',
			class: 'btn btn-default',
		});
		
		
		var $image = $('<input>', {
			name: 'input-image',
			type: 'text',
			class: 'form-control',
			value: imageText
		});

		var $content = $('<textarea>', {
			name: 'input-content',
			class: 'form-control',
			rows: '3',
		});
		$content.val(cardText);


		
		var $form = $('<form>', {
			class: 'update-card', 
			'data-card-id': $card.attr("data-card-id"),
			'data-user-id': $card.attr("data-user-id")
		}).append([$image, $content, $btnSave]);

		$form.submit(function( event ) {
			// Stop form from submitting normally
			event.preventDefault();
			var $target = $( event.currentTarget );
			var data = $(event.target).serializeArray(); // convert form to array
			data.push({name: "data-card-id", value: $target.attr("data-card-id")});
			data.push({name: "data-user-id", value: $target.attr("data-user-id")});
			
			$.ajax({
		        type: "POST",
		        url: "?action=update&item=card",
		        data: $.param(data),
		        success: function(msg){
		            console.log("updated");
		            $form.collapse('hide');
		        },
		        error: function(){
		            console.log("failed");
		        }
		    });

		});
		
		$(this).after($form);
		$(this).after($btnEdit);
		$form.collapse({
  			toggle: true
		});
		$form.collapse('hide');

	});
</script>

 </html>
