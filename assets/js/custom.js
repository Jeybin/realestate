$( document ).ready(function() {
	$(".auctionstartdate").click(function(){
		alert();
	});

		$('.lastdate').datepicker({ dateFormat: "dd-M-yy" });
		$(".auctionstartdate").datepicker({
		        dateFormat: "dd-M-yy",
		        minDate:  0,
						maxDate:  30,
		        onSelect: function(date){
		            var date2 = $('.auctionstartdate').datepicker('getDate');
					       date2.setDate(date2.getDate()+30);
		 						$('.lastdate').datepicker('setDate', date2);
						}
	    });

			$('.auction__end').datepicker({ dateFormat: "dd-M-yy" });
			$(".auction__start").datepicker({
							dateFormat: "dd-M-yy",
							minDate:  0,
							maxDate:  30,
							onSelect: function(date){
									var date2 = $('.auction__start').datepicker('getDate');
									 date2.setDate(date2.getDate()+30);
									$('.auction__end').datepicker('setDate', date2);
							}
				});

$('.auction__start').click(function(){
	alert();
});


});


	$(document).on("click",".agentregtype",function(){
		var $type = $(this).val();
		if($type === 'builders'){
		$('.credaiProof').css({
		        'display': 'block',
		    });
			}else{
				$('.credaiProof').css({
				        'display': 'none',
				    });
			}
	});

	$(document).on("click",".editPropType",function(){
		var $id = $(this).data('id');
		var $type = $(this).data('ptype');
		$(".propertyid").val($id);
		$(".propertyname").val($type);
	});


		$(document).on("click",".delPropType",function(){
			var $id = $(this).data('id');
			$(".propertyid").val($id);
		});

		$(document).on("click",".addtoauction",function(){
			var $id = $(this).data('property');
			$("#propertyModalId").val($id);
		});


				$(document).on("click",".delAuction",function(){
					var $id = $(this).data('auctionid');
					$("#auctionDelId").val($id);
				});

				$(document).on("click",".delPropBtn",function(){
					var $id = $(this).data('propertyid');
					$("#delpropertyid").val($id);
				});


				$(document).on("click", ".editPropertyBtn", function () {
					var propertyid = $(this).data('propertyid');
					if(propertyid){
							$.ajax({
									type:'POST',
									url:'../ajaxData.php',
									data: {'type':'editProperty','id': propertyid},
									success:function(data){
										console.log(data);
										$('.propertyEditModal').html(data);
								}
							});
					}
				});

				$(document).on("click",".viewinmap",function(){
				    var $url = $(this).data('mapurl');
				      $('.mapmodal').attr('src',$url);
				});

				$(document).on("click", ".viewPropertyBtn", function () {
					var propertyid = $(this).data('propertyid');
					var title = $(this).data('proptitle');
					title = 'About '+title;
					$(".viewAboutPropertyHeading").text(title);

					if(propertyid){
							$.ajax({
									type:'POST',
									url:'../ajaxData.php',
									data: {'type':'viewProperty','id': propertyid},
									success:function(data){
										console.log(data);
										$('.propertyViewModal').html(data);
								}
							});
					}

				});


 $(document).on("click",".addfav",function(){
	 var propertyid = $(this).data('propid');
	 var agentid = $(this).data('agentid');
	 var logintype = $(this).data('logintype');
		$.ajax({
				type:'POST',
				url:'../ajaxData.php',
				data: {'type':'addFavourites','propertyid': propertyid,'agentid':agentid,'logintype':logintype},
				success:function(data){
					$('.favbtn').html(data);
			}
		});
	});


	$(document).on("click",".removefav",function(){
 	 var favid = $(this).data('favid');
	 var logintype = $(this).data('logintype');
	 var agentid = $(this).data('agentid');
	 var propid = $(this).data('propid');
 		$.ajax({
 				type:'POST',
 				url:'../ajaxData.php',
				data: {'type':'removeFavourites','favouriteid':favid,'propertyid': propid,'agentid':agentid,'logintype':logintype},
				success:function(data){
 					$('.favbtn').html(data);
 			}
 		});
 	});


		$(document).on("click",".expressinterest",function(){
	 	 var posteduser = $(this).data('posteduserid');
		 var logintype = $(this).data('logintype');
		 var userid = $(this).data('interesteduserid');
		 var propertyid = $(this).data('propid');
	 		$.ajax({
	 				type:'POST',
	 				url:'../ajaxData.php',
					data: {'type':'expressInterest','posteduser':posteduser,'logintype': logintype,'userid':userid,'propertyid':propertyid},
					success:function(data){
						console.log(data);
	 					$('.interestbtncontainer').html(data);
	 			}
	 		});
	 	});

$(document).on("click",".markassoldbtn",function(){
 var propertyid = $(this).data('propertyid');
 var btnclass = $(this).data('btnclass');
 var divclass = $(this).data('divclass');
 btnclass = '.'+btnclass;
 divclass = '.'+divclass;
	$.ajax({
			type:'POST',
			url:'../ajaxData.php',
			data: {'type':'markassold','propertyid':propertyid},
			success:function(data){
				$(btnclass).prop('disabled', true);
 				$(btnclass).prop('disabled', true);
				$(divclass).html(data);
		}
	});
});



$(document).on("click",".changestatusbtn",function(){
 var propertyid = $(this).data('propertyid');
 var value = $(this).data('statusvalue');

	$.ajax({
			type:'POST',
			url:'../ajaxData.php',
			data: {'type':'changestatus','propertyid':propertyid,'value':value},
			success:function(data){
				console.log(data);
				$('.changestatusdiv').html(data);
		}
	});
});



		$(document).on("click",".submitBidBtn",function(){
				var auctionid = $(this).data('auctionid');
				var price = $(this).data('propprice');
				$(".auctionIdModalField").val(auctionid);
				$(".newbidamountfield").val(price);
		});


				$(document).on("click",".updateBidBtn",function(){
						var bidprice = $(this).data('bidprice');
						var bidid = $(this).data('bidid');
						$(".raiseBidIdField").val(bidid);
						$(".raiseBidAmountField").val(bidprice);
				});


$(document).on("click",".deletePropertyBtn",function(){
		var propertyid = $(this).data('propertyid');
		$(".propertyidfield").val(propertyid);
});


$(document).on("click",".markforauctionbtn",function(){
	var propertyid = $(this).data('propertyid');
	$(".addAuctionPropertyIdField").val(propertyid);
});
