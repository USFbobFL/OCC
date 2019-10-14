<?php 
/*
http://localhost/imo/rgb.rgbgeek.org/bs4/occ/index.php

*/
$bs4_path = "../"; 
require($bs4_path."incl0_PHPinit_bs4.php");
$incl_nav = false;
$pgm_title = "OCC";
$pgm_version = "1.0";
$pgm_update = "9/12/2019";
$bs4_path = "../"; 
require_once($bs4_path."incl0_DayTimeInit.php");
require_once($bs4_path."incl0_PHPfcts.php");
require($bs4_path."incl0_BS4_functions.php");
require("inclHeadBS.php");

$checklist_icon = "fas fa-clipboard-check";
$greeter_icon = "fas fa-hands-helping";
$shoebox_icon = "fas fa-box";
$bible_icon = "fas fa-bible";
$key_icon = "fas fa-key";
$prayer_icon = "fas fa-praying-hands";
$cartonizing_icon = "fas fa-box-open";
$donor_activity_icon = "fas fa-user-check";
$tgj_icon = "fas fa-award";
$volunteers_icon = "fas fa-users";
$transportation_icon = "fas fa-truck";
$proc_center_icon = "fas fa-building";
$cube_icon = "fas fa-cube";
$phone_icon = "fas fa-mobile-alt";
$info_icon = "fas fa-info";
$tree_icon = "fas fa-tree";
$arrow_rt_icon = "fas fa-arrow-alt-circle-right";
$thumbs_up_icon = "fas fa-thumbs-up";
$calculator_icon = "fas fa-calculator";
$pencil_icon = "fas fa-pencil-alt";
$edit_icon = "fas fa-edit";
$lock_icon = "fas fa-lock";
$keyboard_icon = "fas fa-keyboard";
$friends_icon = "fas fa-user-friends";
$video_icon = "fas fa-video";

$key_note = "<p class='text-primary font-italic'>A shoebox drop-off site should strive to be <b>relational</b>, rather than <b>transactional</b>.</p>";

/* OCC SLIDEOUT */
$aCheckList = [
	 [0, 'volunteer training and scheduling']
	,[0, 'easily accessible (directional signage)']
	,[0, 'supplies (cartons, tape, markers, paperwork)']
	,[0, 'communicate with Network Coordinator']
];	
$check_list = getCheckListCode($aCheckList, 'cbglobal', '');
$cbody1 = "<p>The Collection Network is the front line of the ministry of Operation Christmas Child. 
Drop-offs are given a missional opportunity to demonstrate God's love, express appreciation, and communicate 
the impact of the ministry of OCC to shoebox donors. Our donors represent churches, businesses, 
schools, colleges, civic groups, organizations, families, and individuals who lovingly pack shoebox gifts. 
These shoebox gifts are tools the Lord is using to change the lives of children around the world.</p>";
$aCards = [
   ["Collection Site Purpose", $cbody1, true,  "fas fa-church"  ]
 , ["General Preparedness Checklist", $check_list, false, $checklist_icon]
];
$slide_out_content = getAccCodeFromArray("acc_slideout", $aCards);		

/* GREETER PAGE */
$Matt2239 = "<p>In Matthew 22:39, Jesus gave us the 2nd Greatest Commandment:
'<i class='text-danger'>To love your neighbor as yourself</i>' <p>
	  A missional Drop-off should be deliberate to share this love with all who visit. 
	  We may never know the impact this has on their lives. Remember, each shoebox donor and each 
	  shoebox gift is a Gospel Opportunity.</p>";
$greet_how = "<p>Every donor should be welcomed with a personal greeting, an invitation to learn more, 
an offered prayer, and a warm thank you. Remember that you and other volunteers are not only the faces of 
Operation Christmas Child but may also be the only Christian the donor interacts with.</p>";
$greeter_purpose = "The greeter is a critical and key role at a shoe-box drop-off location.  
You are representing both your church and the Operation Christmas Child ministry.".$key_note;
$greet_more = "So long as there are no new donors that need your attendion, you may stay with the 
        donor during their time at your drop-off location, including helping with the shoe-box count
        and also making the donor aware of the other missional activities that are available to them, 
        if they have the time and desire.";
$tabset_id = "tsetgreeter";
$aTabsetArray = [];
$aTabsetArray[] = ['', $key_icon, '', $greeter_purpose, true];
$aTabsetArray[] = ['', $bible_icon, '', $Matt2239 , false];
$aTabsetArray[] = ['', $greeter_icon, '', $greet_how , false];
$aTabsetArray[] = ['', $donor_activity_icon, '', $greet_more , false];
$tabsetcode_greeter = getTabsetCodeFromArray($tabset_id, $aTabsetArray, false);
$aCheckList = [
			 [0, 'prompt and friendly attention']
			,[0, 'offer help with shoe-box unloading']
			,[0, 'a warm thank-you for the donation']
			,[0, 'help them to the shoe-box station']
			,[0, 'explore other missional opportunities']
		];		
$process_list = getCheckListCode($aCheckList, 'cbgreeter', '');
$aCards = [
   ["Greeting Shoebox Donors", $tabsetcode_greeter, true,  $greeter_icon  ]
 , ["Greeter Checklist", $process_list, false, $checklist_icon]
];
$greeter_content = getAccCodeFromArray("acc_greeter", $aCards);	

/* Shoebox drop-off station with drop-off logs */

$sbt1 = "<p>The drop-off log station carefully <b>counts</b> the shoeboxes, politely asks donor for information 
        for the <b>log</b>, and offers to <b>pray</b> for the shoeboxes with donor.</p>";
$sbt2 = "<p>Although the log information is important, don't make it seem like a big deal to the donor.</p>".$key_note;
$sbt3 = "An accurate count of the shoeboxes is required to write on the drop-off log.  Stacking shoeboxes
           in groups of five makes it easier to count larger donations.  Please offer to make a prayer circle around 
		   a large donation.  Pray over all received shoebox gifts.";

$sbt3b = "At this point, the donor has had interaction with the greeter(s) and the shoe-box logging station.
          If the greeter is still involved with the donor (has not moved on to greet a new donor), they 
          (or one of the shoe-box station volunters) may deepen the relationship with the donor, asking them 
          if they have any special prayer needs, or if they'd like to know more about the ministry,
          including the Greatest Journey, or the Prayer Network.  Offer them refreshments during this 
          engagement time and just point out the various stations you have setup for your missional drop-off.";

$sbt4 = "<p>After a donation has been counted, logged, and prayed over, it should be moved to the cartonizing station.
            It is important that <span class='text-danger'>no shoeboxes go to cartonizing prior to being logged</span>.</p>";	   



$tabset_id = "tsetsbstation";
$aTabsetArray = [];
$aTabsetArray[] = ['', $key_icon, '', $sbt1, true];
$aTabsetArray[] = ['', $thumbs_up_icon, '', $sbt2 , false];
$aTabsetArray[] = ['', $shoebox_icon, '', $sbt3 , false];
$aTabsetArray[] = ['', $friends_icon, '', $sbt3b , false];
$aTabsetArray[] = ['', $arrow_rt_icon, '', $sbt4 , false];
$tabsetcode_sbstation = getTabsetCodeFromArray($tabset_id, $aTabsetArray, false);
$aCheckList = [
			 [0, 'accurate count of shoebox donation']
			,[0, 'accurate drop-off log form entry']
			,[0, 'offer to pray with donor over shoeboxes']
			,[0, 'explore other missional opportunities']
			,[0, 'move logged boxes to cartonizing station']
		];		
$process_list = getCheckListCode($aCheckList, 'cbsbdropoff', '');
$aCards = [
   ["Shoebox Log Station", $tabsetcode_sbstation, true,  $greeter_icon  ]
 , ["Shoebox Log Station Checklist", $process_list, false, $checklist_icon]
];
$sbstation_content = getAccCodeFromArray("acc_shoeboxsta", $aCards);	

/* donor activities page (other things donors can do after dropping-off shoeboxes] */
$about_tgj = getListItemCode('ul', 
	[ 'A discipleship program children are invited to attend after receiving a shoebox gift'
	, 'A 12-lesson course that includes Bible Stories and Scripture memorization'
	, 'Children learn how to follow Christ in their daily lives'
	, 'Children learn how to share about Jesus with friends and family'
	, 'After completing the program, the children attend a graduation celebrate and receive a certificate and New Testament in their language.'
	]);	 

$donactovrvw = "<p>A missional drop-off will be setup to make donors feel welcome, provide opportunities 
        for donors to learn more about the OCC ministry, as well as opportunties to connect with your church.</p>";

$prayer = "<p>A prayer station could be setup to contain Prayer Network Cards, a prayer wall or 
    trifold project board, and a photo bundle (Order on Samaritan’s Purse website)</p><p>There will always 
	  be some donors who simply want to drop off their box(es) and move on and that is okay; but we want 
	  to be deliberate about engaging those who want to learn more.</p>";
$vol_opps = "<p>Have OCC Volunteer Recruitment Kits available and be prepared to talk to donor, if they ask.</p>";
$info_station = "<p>Your information station could include the Samaritan's Purse gift catalog, pictures from the 
          website, and local church information.</p>";
$hosp_station = "<p>Your hospitality station could include a decorated Christmas tree with decor, and refreshments.</p>";		  
$tabset_id = "tsetdonoractivities";
$aTabsetArray = [];
$aTabsetArray[] = ['', $key_icon, '', "<span class='h4 text-primary'>Engaging the donors</span>".$donactovrvw, true];
$aTabsetArray[] = ['', $tgj_icon, '', "<span class='h4 text-primary'>The Greatest Journey</span>".$about_tgj , false];
$aTabsetArray[] = ['', $prayer_icon, '', "<span class='h4 text-primary'>Prayer Station</span>".$prayer , false];
$aTabsetArray[] = ['', $volunteers_icon, '', "<span class='h4 text-primary'>Volunteer Opportunities</span>".$vol_opps , false];
$aTabsetArray[] = ['', $info_icon, '', "<span class='h4 text-primary'>Information Station</span>".$info_station , false];
$aTabsetArray[] = ['', $tree_icon, '', "<span class='h4 text-primary'>Hospitality Station</span>".$hosp_station , false];
$tabsetcode_de = getTabsetCodeFromArray($tabset_id, $aTabsetArray, false);
$aCheckList = [
			 [0, 'the Greatest Journey station']
			,[0, 'information station']
			,[0, 'prayer station']
			,[0, 'volunteer opportunties station']
			,[0, 'hospitality station']
		];		
$process_list = getCheckListCode($aCheckList, 'cbdonorengagement', '');
$aCards = [
   ["Donor Activities", $tabsetcode_de, true,  $greeter_icon  ]
 , ["Donor Activities Checklist", $process_list, false, $checklist_icon]
];
$donoract_content = getAccCodeFromArray("acc_donoract", $aCards);

/* shoebox cartonizing page  */
$sbc1 = "<p>The goal of the shoebox cartonizing role is to get as many shoeboxes into a carton as possible without damaging the carton or any of the contained shoeboxes.</p>";
$sbc2 = "<p>A generally accepted practice is to place the shoeboxes vertically in the bottom layer, 
     then horizantally in the top layer.  Use rubber bands, if needed, to prevent vertically placed boxes 
	 from opening up.</p>";
$sbc3 = "When building the cartons, you'll ensure that you first tape the bottom of the carton with 
         two strips of tape.  When the carton is full and the count of shoeboxes is 100% certain, 
		 you may close the top of the box and place a single strip of tape.  The tape should completely 
		 cover the top and at least 3 inches on each side.  Write the counted number on side of box.";
$sbc4 = "Keep all packed cartons in a safe location until the time they are loaded into a transport vehicle.
         Ensure that no carton leaves your site until it has been properly accounted for.";		 
$tabset_id = "tsetcartonizing";
$aTabsetArray = [];
$aTabsetArray[] = ['', $key_icon, '', $sbc1, true];
$aTabsetArray[] = ['', $cube_icon, '', $sbc2 , false];
$aTabsetArray[] = ['', $shoebox_icon, '', $sbc3 , false];
$aTabsetArray[] = ['', $proc_center_icon, '', $sbc4 , false];
$tabsetcode_cartonizing = getTabsetCodeFromArray($tabset_id, $aTabsetArray, false);
$aCheckList = [
			 [0, 'two strips of tape on bottom']
			,[0, 'bottom vertical, top horizantal']
			,[0, 'carton not over packed']
			,[0, 'top edges of box are touching']
			,[0, 'one strip of tape on top']			
			,[0, 'write shoebox count on side of box']			
			,[0, 'safely store until ready for transport']			
		];		
$process_list = getCheckListCode($aCheckList, 'cbcartonizing', '');
$aCards = [
   ["Cartonizing Station", $tabsetcode_cartonizing, true,  $cartonizing_icon  ]
 , ["Cartonizing Station Checklist", $process_list, false, $checklist_icon]
];
$cartonizing_content = getAccCodeFromArray("acc_cartonizing", $aCards);




/* transportation page  */

$trc1 = "<p>Shoeboxes transported from drop-off site to central drop-off (CDO) site should be covered to be 
           protected from the elements.  Please adhere to weight restrictions of vehicle.  Please take 
		   precautions to prevent cartons sliding or falling during transport.</p>";
$trc2 = "<p>Be sure to communicate with the centrl drop-off leader when you are  planning to bring your cartons.
		   They will need to ensure they have adequate muscle to transfer the cartons from your 
		   vehicle to the semi-trailers.  </p>";
$trc3 = "<p>Cartons must be <i>serialized</i> as they are loaded onto the 
		   semi-trailers, so it is vital to have a designated person that performs this function.
		   ALL carton loaders MUST BE fully aware of the serialization requirement and should check 
		   each box for a serial number prior to stacking it on the semi-trailer at the CDO location.</p>";
$trc4 = "<p>Cartons that are stored in trailers or transport vehicles while the collection site is 
           not open/supervised, should be locked securely.  </p>";		   
$tabset_id = "tsettransportation";
$aTabsetArray = [];
$aTabsetArray[] = ['', $key_icon, '', $trc1, true];
$aTabsetArray[] = ['', $phone_icon, '', $trc2 , false];
$aTabsetArray[] = ['', $transportation_icon, '', $trc3 , false];
$aTabsetArray[] = ['', $lock_icon, '', $trc4 , false];
$tabsetcode_transportation = getTabsetCodeFromArray($tabset_id, $aTabsetArray, false);
$aCheckList = [
			 [0, 'lift cartons by bending knees, not back']
			,[0, 'cartons are stacked no more than 5 high']
			,[0, 'cartons are secured to prevent sliding']
			,[0, 'cartons loaded on semi trailers are serialized']
			,[0, 'transport vehicle is secured when unattended']
		
		];		
$process_list = getCheckListCode($aCheckList, 'cbtransportation', '');
$aCards = [
   ["Carton Transportation", $tabsetcode_transportation, true,  $transportation_icon  ]
 , ["Transportation Checklist", $process_list, false, $checklist_icon]
];
$transportation_content = getAccCodeFromArray("acc_transportation", $aCards);

/* paperwork page  */

$ppwrk1 = "<p>The accurate completion and submission of paperwork is just as important as all of the 
          other work that has been performed!  The <b>daily summary sheets</b> show the number of shoeboxes 
		  collected each day, and should accurately balance to the actual drop-off log counts by day.</p>";
$ppwrk2 = "<p>The carton <b>tally sheet</b> (CDO location only) contains a serialized entry for every carton 
             loaded on the semi-trailers.  There is a <b>BOL</b> for each trailer that shows the number of 
			 cartons, number of shoeboxes, and the estimated weight of the shoeboxes on the trailer.</p>";
$ppwrk3 = "<p>All paperwork should be photo-copied for site records prior submitting with your final 
           carton transport trip to CDO.  The CDO leader will ensure that all paperwork is received on 
		   the final collection day.  The CDO leader combines all of the paperwork into a submission packet 
		   that is sent to regional headquarters.  Copies of this paperwork should be be made prior to 
		   submission.</p>";
$ppwrk4 = "<p>After each semi-trailer leaves the CDO, the CDO leader should use the online reporting 
          site to register the trailer that is now enroute to the processing center.</p>";		   
$tabset_id = "tsetpaperwork";
$aTabsetArray = [];
$aTabsetArray[] = ['', $key_icon, '', $ppwrk1, true];
$aTabsetArray[] = ['', $edit_icon, '', $ppwrk2 , false];
$aTabsetArray[] = ['', $calculator_icon, '', $ppwrk3 , false];
$aTabsetArray[] = ['', $keyboard_icon, '', $ppwrk4 , false];
$tabsetcode_paperwork = getTabsetCodeFromArray($tabset_id, $aTabsetArray, false);
$aCheckList = [
			 [0, 'Accurate completion of paperwork']
			,[0, 'Make photo-copies of paperwork']
			,[0, 'Timely submission of paperwork']
			,[0, 'CDO verifies completeness']
			,[0, 'CDO creates BOL']
			,[0, 'CDO pink sheet in trailer prior sealing']
			,[0, 'CDO seal trailer and record on BOL']

		
		];		
$process_list = getCheckListCode($aCheckList, 'cbpaperwork', '');
$aCards = [
   ["Paperwork", $tabsetcode_paperwork, true,  $calculator_icon  ]
 , ["Paperwork Checklist", $process_list, false, $checklist_icon]
];
$paperwork_content = getAccCodeFromArray("acc_paperwork", $aCards);

$prep_day_video_url = "https://occ.polkministries.org/training/collection_network/OCC_drop-off_Prep_day_2019.mp4";
$sptv_ncw_stv_training_url = "http://sptv.org/national-collection-week-volunteer-training";
$prep_day = getButtonLinkCode('PrepDay', 'success', true, $prep_day_video_url, 'doprepday2019');

$prep_day_video_link = getLink("Drop-off Prep 2019", $prep_day_video_url, "doprepday2019");

$aLinkList = [
	["PrepDay", "primary", "For drop-off site leaders", $prep_day_video_url, "doprepday2019"]
   ,["Training", "success", "For short-term volunteers", $sptv_ncw_stv_training_url, "sptvstvtrnncw"] 
 ];
 $aLinkListTable = getLinkListTable($aLinkList);


$video_content = '<p>Here are some videos that may be useful.</p>'.$aLinkListTable;


/* NAVIGATTION array is very important */
$navitems = [
    ['nav1', 'Greeter',     'greet_page',   $greeter_icon,     true,  $greeter_content]
   ,['nav2', 'Shoebox Logging', 'shoebox_page',   $shoebox_icon,false, $sbstation_content]
   ,['nav3', 'Donor Activities', 'donor_activity_page',$donor_activity_icon, false, $donoract_content]
   ,['nav4', 'Cartonizing shoeboxes', 'cartonizing_page',   $cartonizing_icon, false, $cartonizing_content]
   ,['nav5', 'Transporting shoeboxes', 'transportation_page',   $transportation_icon, false, $transportation_content]
   ,['nav6', 'Paperwork', 'paperwork_page',   $calculator_icon, false, $paperwork_content]
   ,['nav7', 'Video', 'video_page',   $video_icon, false, $video_content]
];
?>
<body>
<nav class="navbar navbar-expand navbar fixed-top navbar-dark bg-dark">
    <div class="container-fluid">
		<span class="navbold ptr text-success" data-toggle="modal" data-target="#slideoutModal" title="open side panel"><?=$pgm_title?></span>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav">
				<?php
				foreach($navitems as $navitem) {
					$acls = ($navitem[4]) ? "hi-nav text-warning" : "";
				?>	
                <li class="nav-item">
                    <a class="nav-link page-nav ptr <?=$acls?>" id="<?=$navitem[0]?>" title ="<?=$navitem[1]?>" data-page-id="<?=$navitem[2]?>"><i class="<?=$navitem[3]?>"></i></a>
                </li>				
				<?php
				}
				?>			
            </ul>
			<div class="navbar-text text-primary ml-auto">
			   <span class="text-success small" id="head_time"></span>
			   <span class="fas fa-server text-secondary ajax_indicator d-none" title='AJAX status indicator'></span>
			   <span class="fas fa-power-off text-primary ptr logged-in-only d-none" id="btn_logout" title='Logout'></span>
		    </div>
        </div>
    </div>
</nav>
<?php 


$slide_out_modal = getModalDialogDivCode("slideoutModal", "<i class='fas fa-globe-americas'></i> ".$pgm_title." Collection Network", $slide_out_content, "", "", "", true, false, true);
?>
<section class="container-fluid" id="page_container">
	<?php
	foreach($navitems as $navitem) {
		$acls = ($navitem[4]) ? "" : " pg-hide";
	?>	
	<div id="<?=$navitem[2]?>" class="page_div<?=$acls?>">
       <?=$navitem[5]?>
	</div>
	<?php
	}
	?>	
	<script>
	local_storage_prefix = "<?=$pgm_title?>";
	</script>	
	<script src="bs4navswitcher.js"></script>
	<script src="save_localstorage.js"></script>
	<script src="spa.js"></script>		
	<script src="bs4toast.js"></script>	
<?php
echo $slide_out_modal;
require($bs4_path."incl8_HtmlFoot_bs4.php");
?>

