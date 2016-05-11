<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<meta name="apple-itunes-app" content="app-id=593452214">
        <link rel="apple-touch-icon" href="images/QuickCRM-Pro.png"/>
        <script type="text/javascript" src="lib/jquery-1.10.2.min.js"></script>
        <script src="https://www.google.com/jsapi"></script>
        <link rel="stylesheet" href="lib/jquerymobile/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" href="lib/jquerymobile/quickcrm.min.css" />
        <link rel="stylesheet" href="lib/jquerymobile/icon-pack-custom.css" />
        <link rel="stylesheet" href="lib/mobiscroll/css/mobiscroll.custom-2.17.1.min.css" />
        <link rel="stylesheet" href="css/quickcrm5.0.css" />
        <script src="lib/jquerymobile/jquery.mobile-1.4.5.min.js"></script>


        <script src="lib/mobiscroll/js/mobiscroll.custom-2.17.1.min.js"></script>

        <script src="lib/drawing/jquery.jqscribble.js"></script>
        <script src="lib/drawing/jqscribble.extrabrushes.js"></script>
        <script src="lib/drawing/Drawing_utils.js"></script>
        <script type="text/javascript" src="js/quickcrm-webutils-5.2.0.min.js"></script>
        <script type="text/javascript" src="lib/json2.min.js"></script>
		
		<script type="text/javascript" language="Javascript">
			var froot="./", QCRM={},app_version="",mobile_app=false, sugar_flavor='CE', ForceCE=false,loaded_scripts=false, activePage, proxy_url, QuickCRMAddress = '.', ServerAddress='../',myTimeZone,qusers, mobile_usr=new Array(),  init_module = '', init_record="";
				QAppName="QuickCRM",
				QTrial='',Quser_name='',Qpwd='',
				QCRM={
					MaxUsers:-1,
					OffLine:false,
					StoredVersion:false,
					UpdatedConfig:false,
					TimeDiff:false,
					JJWG:false,
					custom:{},
					calendar: {dates:{},init:false, currDate:new Date(),weekmode:false,curUser:''},
					QBasicAuth:false, 
					BasicAuthPassword:'',
					BasicAuthUsername:'',
					BasicAuthParam: '', 
					sugaroutfitters:false,
					ajaxHeader:function(xhr){
					}
				};
$( document ).bind( "mobileinit", function() {
	$.mobile.defaultPageTransition = 'none';
});
function cachedScript (url, options) {
	var cached=localStorage.getItem('js-'+url);
	if(cached!==null){
		try {
			eval.call(window,cached);
			if (isCustom) {
				QCRM.CustomInstall();
			}
		}
		catch(err){
			//console.log(err);
		}
		return;
	}

	var AjaxOptions = {
		dataType: 'text',
		async: false,
		type: 'GET', 
		cache: false,
		url: url
	};
	if(typeof options!='undefined'){$.each(options,function(key,value){AjaxOptions[key]=options[key];});}
	var res=jQuery.ajax(AjaxOptions);
	
	res.success(function(script){
			try {
				eval.call(window,script);
				try{
					localStorage.removeItem('js-'+url);
				}
				catch(err){}
				try{
					localStorage.setItem('js-'+url,script);
				}
				catch(err){}
			}
			catch(err){
			}
		});
};

jQuery.cachedScript = function(url, options) {
	options = $.extend(options || {}, {
	dataType: "script",
	async: false,
	type: 'get', 
	cache: true,
	url: url
});
return jQuery.ajax(options);
};
function InitApp(err) {
	if (err===0) {
		if (mobile_app){
			setCookie("username",Quser_name,365);
			setCookie("SugarP",$.md5(Qpwd),365);
			setCookie("RememberMe",1,365);
		}
		loaded_app=true;
		MobileInit();
	}
	else {
		var msg;
		if (err===1) msg='Please select mobile users in SugarCRM';
		else msg='An error occured. Please check your configuration';
		$('#LoginLoading').html(msg);
	}
}


function removeOldScripts(time){
	var k,t=localStorage.getItem("LastScript");
	if (t!==time){
		var js=/^(js|file|dis|acl|acls|ce)-/; // js scripts , user's disabled modules and acl
		for(k in localStorage){
			if(js.test(k)) delete localStorage[k];
		}
	}
	localStorage.setItem("LastScript",time);
}

function ClearCache(){
	var k;
	for(k in localStorage){
		if(k!=='First') delete localStorage[k];
	}
}




function LoadApp() {
	// Check for private browsing turned on
	try{
		localStorage.setItem('tmp','1');
		localStorage.removeItem('tmp');
	}
	catch(err){
		alert('Please check that private browsing is turned off before using QuickCRM Mobile');
		return;
	}
	localStorage.setItem("SDemo","0");
	var key=window.location.host+window.location.pathname+"Info",s=localStorage.getItem(key); // in case people use multiple instances
	if (s!==null & s > '6.3') {
		LoadScripts();
		return;
	}
	var loaded_config=false;
	$.ajax({
		url: ServerAddress+"service/v2/rest.php",
		dataType: 'json',
		async:false,
		data: {method:"get_server_info",input_type:'JSON',response_type:'JSON'},
		type: 'get', 
		cache: false,
		success: function(r) {
			loaded_config=true;
			if (r.version > '6.3') {
				LoadScripts();
				localStorage.setItem(key,r.version);
			}
			else LoadScriptsOld();
		}
	});
}

function LoadScripts() {
	var err=0;
	loaded_scripts=true;
//	var conf_script=ServerAddress+'/index.php?entryPoint=QuickCRMgetConfig'+(trial!==false?'&trial=yes':'');

	var conf_script=ServerAddress+'index.php?entryPoint=QuickCRMgetConfig';


	$.getScript(conf_script+"&param=sugar_config")
		.done(function(script, textStatus) {
			removeOldScripts(quickcrm_upd_time);

			var appL=getAppLanguage();
			cachedScript(QuickCRMAddress+"/js/app_"+appL+".js");


			if (!isPro(false)){
					return;
			}



			proxy_url=ServerAddress+(ServerAddress.substr(-1)==="/"?"":"/")+"custom/QuickCRM/"+(sugar_version >= '6.5'?'rest4_1':(sugar_version >= '6.2'?'rest':'rest2'))+".php";
			var q_language = getSugarLanguage(sugar_languages,default_language);
			cachedScript(conf_script+"&param=sugar_fields",{});
			cachedScript(conf_script+"&param=modules_"+q_language,{});
			cachedScript(conf_script+"&param="+q_language,{});

			var webL=getMobileLanguage();
			$.cachedScript(QuickCRMAddress+"/js/mobile_"+webL+".js?v="+quickcrm_upd_time);


			$.cachedScript("js/quickcrm-web-5.2.2.min.js").done(function(script, textStatus) {



				if (jjwg_installed) {
					QCRM.JJWG=true,
					JJWG.unit=jjwg_def_unit;
					if (typeof jjwg_modules!=='undefined') {
						// TODO Init list of modules
						JJWG.jjwg_updatemodules(jjwg_modules);
					}	
					JJWG.jjwg_load();
				}
				// load js plugins
				for(var i in js_plugins){
					cachedScript(conf_script+"&param=plugin&name="+js_plugins[i],{});
				}
				if (!mobile_app){
					// load html plugins
					for(i in html_plugins){
						if (html_plugins[i].substring(0,5)!=='Cases' && html_plugins[i].substring(0,8)!=='Projects')
							$.get(ServerAddress+"/mobile/plugins/"+html_plugins[i], function(data){
								$.mobile.pageContainer.append(data);
							});
					}
					// load custom html files
				<?php
					if (file_exists("../custom/QuickCRM/login.html")) {
						echo "$('#LoginCustom').load(ServerAddress+'/custom/QuickCRM/login.html');";
					}
					if (file_exists("../custom/QuickCRM/home.html")) {
						echo "$('#HomeCustom').load(ServerAddress+'/custom/QuickCRM/home.html');";
					}
				?>
				}

				if (mobile_edition!=='CE'){
					$('#ContactNSTEAMContainer').html('<a href="mailto:support@quickcrm.fr?subject=Support Request from Full Version"><div class="HomeIcon NSEmailIcon"></div><div id="ContactNSTEAMLinkLabel">Support</div></a>');
					//cachedScript(conf_script+"&param=users",{error:function(){err=1;}});
					cachedScript(conf_script+"&param=fields_std",{error:function(){err=2;}});
					cachedScript(conf_script+"&param=mobile_config",{});
					//if (qusers==undefined) err=1;
					<?php
						if (file_exists("../custom/QuickCRM/custom.js")) {
							echo "$.getScript(ServerAddress+'/custom/QuickCRM/custom.js');";
						}
					?>
					InitApp(err);
				}
				else {
						$.getScript(ServerAddress+"/custom/QuickCRM/custom.js").fail(function(jqxhr, settings, exception) {
							//console.log( 'NO CUSTOMIZATION '+textStatus );
						});
						InitApp(err);
				}
			});
		});
}

function LoadScriptsOld() {
	var err=0;
	loaded_scripts=true;
	$.getScript("config.js")
		.done(function(script, textStatus) {

			removeOldScripts(quickcrm_upd_time);

			proxy_url=(QuickCRMAddress+(QuickCRMAddress.substr(-1)==="/"?"":"/"))+(mobile_app?"REST":"../service/v"+(sugar_version >= '6.5'?'4_1':(sugar_version >= '6.2'?'4':'2')))+"/rest.php";
			//cachedScript(QuickCRMAddress+"/fielddefs/fields.js",{});
			var q_language = getSugarLanguage(sugar_languages,default_language);
			cachedScript(QuickCRMAddress+"/fielddefs/modules_"+q_language+".js",{});
			cachedScript(QuickCRMAddress+"/fielddefs/"+q_language+".js",{});

			var webL=getMobileLanguage();
			$.cachedScript(QuickCRMAddress+"/js/mobile_"+webL+".js?v="+quickcrm_upd_time);


			$.cachedScript("js/quickcrm-web-5.2.2.min.js").done(function(script, textStatus) {


				if (jjwg_installed) {
					QCRM.JJWG=true,
					JJWG.unit=jjwg_def_unit;
					if (typeof jjwg_modules!=='undefined') {
						// TODO Init list of modules
						JJWG.jjwg_updatemodules(jjwg_modules);
					}	
					JJWG.jjwg_load();
				}

				// load js plugins
				for(var i in js_plugins){
					cachedScript(ServerAddress+"/mobile/plugins/"+js_plugins[i],{});
				}
				if (!mobile_app){
					// load html plugins
					for(i in html_plugins){
						if (html_plugins[i].substring(0,5)!=='Cases' && html_plugins[i].substring(0,8)!=='Projects')
							$.get(ServerAddress+"/mobile/plugins/"+html_plugins[i], function(data){
								$.mobile.pageContainer.append(data);
							});
					}
					// load custom html files
				<?php
					if (file_exists("../custom/QuickCRM/login.html")) {
						echo "$('#LoginCustom').load(ServerAddress+'/custom/QuickCRM/login.html');";
					}
					if (file_exists("../custom/QuickCRM/home.html")) {
						echo "$('#HomeCustom').load(ServerAddress+'/custom/QuickCRM/home.html');";
					}
				?>
				}

				if (mobile_edition!=='CE'){
					$('#ContactNSTEAMContainer').html('<a href="mailto:support@quickcrm.fr?subject=Support Request from Full Version"><div class="HomeIcon NSEmailIcon"></div><div id="ContactNSTEAMLinkLabel">Support</div></a>');
					cachedScript(QuickCRMAddress+"/fielddefs/fields_std.js",{error:function(){err=2;}});
					cachedScript(ServerAddress+"/cache/mobile_js/QuickCRMusers.js",{error:function(){err=1;}});
					cachedScript(ServerAddress+"/custom/QuickCRM/mobile.config.js",{});
					if (qusers==undefined) err=1;
					<?php
						if (file_exists("../custom/QuickCRM/custom.js")) {
							echo "$.getScript(ServerAddress+'/custom/QuickCRM/custom.js');";
						}
					?>
					InitApp(err);
				}
				else {
						$.getScript(ServerAddress+"/custom/QuickCRM/custom.js").fail(function(jqxhr, settings, exception) {
							//console.log( 'NO CUSTOMIZATION '+textStatus );
						});
						InitApp(err);
				}
			});
		});
}

function InitLoginPage() {
	$("#LoginPageMessage").text(RES_LOGIN_MESSAGE);
	$("#LoginPageTitle").text("QuickCRM");
	var lab="QuickCRM "+mobile_version;
	$("#LoginFooter").html(lab);
	if(typeof QuickCRMBeforeLogin == 'function') {
		QuickCRMBeforeLogin();
	}
	if (!mobile_app) {
		var req = "<em>* </em>";
		$("#SettingsUsernameLabel").html(req+RES_USERNAME_LABEL);
		$("#SettingsPasswordLabel").html(req+RES_PASSWORD_LABEL);
		$('#OptAdvanced').text(RES_ADVANCED);
		$('#ClearCacheBtn').text(RES_CLEARCACHE);
	}
	var username = getCookie("username");
	if (username!==null && username!=="") {
		$('#SettingsUsername').val(username);
	}
}

</script>

		<?php
		if(isset($_REQUEST['module']) && isset($_REQUEST['record'])){
        echo <<<EOQ
<script type="text/javascript" language="Javascript">
	init_module = '{$_REQUEST['module']}'; init_record='{$_REQUEST['record']}';
</script>
EOQ;
		}
		?>
		<!-- Mobile language file and UI -->
        <link rel="stylesheet" href="css/quickcrm5.0.css" />
        <title>QuickCRM</title>
    </head>
    <body>
        <div id="LoginPage" data-role="page" data-theme="b" data-title="QuickCRM">
			<script type="text/javascript" language="Javascript">
				if (!loaded_scripts) LoadApp();
			</script>
            <div data-role="header">
                <h1 id="LoginPageTitle">QuickCRM</h1>
            </div>  
            <div role="main" class="ui-content">
				<div id="LoginCustom">
				</div>
				<div id="LoginLoading">
					<p>... Loading</p>
				</div>
				<div id="HomeWarning">
				</div>
				<div id="LoginForm" style="display: none;">
                <p id="LoginPageMessage"></p>
				<fieldset data-role="controlgroup" data-mini="true">
					<label id="SettingsUsernameLabel" for="SettingsUsername"></label>
					<input id="SettingsUsername" type="text" />
				</fieldset>
                
				<fieldset data-role="controlgroup" data-mini="true">
					<label id="SettingsPasswordLabel" for="SettingsPassword"></label>
					<input id="SettingsPassword" type="password" />
				</fieldset>
				<div id="AdvancedParam" data-role="collapsible" data-mini="true" data-collapsed="true" data-theme="c" >
					<h4 id="OptAdvanced"></h4>
					<div>
						<a id="ClearCacheBtn" href="javascript:ClearCache();" data-role="button" data-mini="true" data-theme="c"></a>
					</div>
				</div>
				</div>
            </div>
			<div data-role="popup" id="AlertLoginPage"></div>
            <div data-role="footer" data-position="fixed" style="height:38px" data-theme="b">
                <p style="font-size:14px" id="LoginFooter"></p>
            </div>
        </div>

        <div id="HomePage" data-role="page" data-theme="c" data-title="Home" class="ui-responsive-panel">
            <div data-role="panel" data-theme="a" id="HomePanel" data-display="reveal" data-dismissible="false">
				<table width="100%"><tr>
					<td><a href="#" onclick="OpenHelp()" data-icon="question"  data-role="button" data-iconpos="notext"  class="ui-nodisc-icon"></a></td>
					<td align="center"><a href="#LockPage" onclick="return !QCRM.forceLock || !Pref.AppLock" id="LockBtn" data-close-btn="none" data-icon="lock" data-role="button" data-iconpos="notext" class="ui-nodisc-icon"></a></td>
					<td align="right"><a id="LogOutButton" href="javascript:Disconnect();LogOutUser();" data-role="button" data-icon="power" data-iconpos="notext" data-shadow="false" data-iconshadow="false" class="ui-nodisc-icon"></a></td>
				</tr></table>
				<br>
				<div>
					<ul id="FavoritesPanelDiv" data-role="listview" data-filter="false" style="list-style: none;margin: 0;padding: 0;">
					</ul>
					<ul id="LastViewedPanelDiv" data-role="listview" data-filter="false" style="list-style: none;margin: 0;padding: 0;">
					</ul>
				</div>
			</div>
            <div data-role="header" data-theme="a" >
				<div style="width:100%" data-theme="a">
					<div style="float:left;width:20%">
						<a href="#HomePanel" data-role="button" data-icon="bars" data-iconpos="notext" data-iconshadow="false" class="ui-nodisc-icon"></a>
					</div>
					<div style="float:left;width:60%">
						<div id="searchform" class="inline-form">
							<div class="wrapper">
								<div class="content"><input class="searchtext" data-mini="true" id="PanelSearchText"  size="30" type="text" data-clear-btn="true" data-theme="d"/></div>
							</div>
							<div class="right" id="searchbtndiv" style="display:none"><input class="searchbtn" data-icon="search" class="ui-alt-icon ui-nodisc-icon" data-inline="true" name="commit" type="submit" onclick="GlobalSearch('PanelSearchText','PanelSearchDiv','',5,true);return false;" data-theme="d" data-iconpos="notext"/></div>
							<div class="footer"></div>
						</div>						
					</div>
					<div id="HGreen" style="float:left;width:10%;height:32px;display:none" class="GreenIcon">
					</div>
					<div id="HRed" style="float:left;width:10%;height:32px;display:none" class="RedIcon">
					</div>
					<div style="float:left;width:10%">
						<a id="NotifyHomeBtn" href="#HomeNotify" data-inline="true" data-role="button" data-history="false" data-rel="popup" data-theme="e" data-icon="flag" data-iconpos="notext" data-iconshadow="false" class="ui-btn-right ui-nodisc-icon" style="display:none"></a>
					</div>
					<div style="clear:both">
					</div>
				</div>
				<div id="HomeBar" data-role="navbar" data-mini="true" class="ui-body-c ui-body" style="padding:0px !important">
					<ul>
						<li ><a id="AllModulesLinkLabel" href="#AllModulesPopup" data-history="false" data-rel="popup" data-role="button" data-icon="grid"  data-iconpos="notext" data-iconshadow="false" class="ui-alt-icon ui-nodisc-icon"></a></li>
						<li id="CalendarContainer"><a id="CalendarLinkLabel" href="#CalendarListPage"  data-transition="none" data-role="button" data-icon="calendar" data-iconpos="notext" data-iconshadow="false" class="ui-alt-icon ui-nodisc-icon"></a></li>
						<li id="MapsContainer"><a id="MapsLinkLabel" href="#" onclick="javascript:JJWG.ShowMapSearch();" data-role="button" data-icon="location" data-iconpos="notext" data-iconshadow="false" class="ui-alt-icon ui-nodisc-icon ui-disabled"></a></li>
						<li><a id="AdminPageLinkLabel" href="#AllOptions"  class="ui-nodisc-icon" data-role="button" data-icon="wrench" data-iconpos="notext" data-iconshadow="false" ></a></li>
					</ul>
				</div>	
            </div>
            <div role="main" id="HomePageMain" data-theme="d" class="ui-content">
				<div >
					<ul id="PanelSearchDiv" style="margin-top:0" data-role="listview" data-inset="true" data-theme="c" data-filter="false" />
				</div>
				<div id="HomeTop" style="clear: both">
					<div id="HomeWarning">
					</div>
					<div id="HomeCustom">
					</div>
					<div id="Favorites" class="IconWrapper">
					</div>
					<div id="Creates" class="IconWrapper">
					</div>
					<ul class="IconWrapper" id="HomeMenu">
					</ul>
				</div>
				<div id="dashlets" class="ui-grid-a my-breakpoint">
					<div id="dashletsLEFT" class="ui-block-a" style="padding:5px;"></div>
					<div id="dashletsRIGHT" class="ui-block-b" style="padding:5px;"></div>
				</div>
                <div id="Editiondiv" class="IconContainer" >
					<p id="EditionStatus"></p>
                </div>
                <a id='lnkPwd' href="#EnterPwdPage" data-position-to="window" style='display:none;'></a>
            </div>
			<div data-role="popup" data-history="false" id="HomeNotify">
				<a href="#HomePage" data-direction="reverse" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-left"></a>
				<div>
                <ul id="NotifyListDiv" style="padding-top:10px" data-role="listview" data-mini="true" data-split-theme="c"  data-theme="c" data-inset="true" data-filter="false" />
				</div>
				<a id="NotifyClear" href="javascript:ClearLastModified();" class="QCRMLinks"  data-theme="c"></a>
			</div>
			<div id="AllModulesPopup" data-history="false" style="margin-top:20px" data-role="popup" >
					<ul id="AllModulesPopupDiv" data-role="listview" data-theme="c" data-split-theme="c" data-filter="false" />
			</div>
        </div>

        <div id="CalendarListPage" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
                <h1 id="CalendarListPageTitle"></h1>
				<a id="CalendarRefresh" href="javascript:QCRM.calendar.init=false;CalendarShow();" data-role="button" data-icon="refresh" data-iconpos="notext" class="ui-alt-icon ui-nodisc-icon ui-btn-right" ></a>
            </div>
            <div role="main" class="ui-content">
				<div id="ActivitiesListPageSubMenu">
					<ul id="AllActivitiesListDiv" data-role="listview" data-split-theme="c" data-filter="false" />
				</div>
				<div id="calendar" class="ui-grid-a my-breakpoint">
					<div id="calendarLEFT" class="ui-block-a">
						<div id="calendarMOBI" style="padding:5px;"></div>
					</div>
					<div id="calendarRIGHT" class="ui-block-b" style="padding-left:5px;padding-right:5px;">
						<div id="calendarbtns" >
							<div style="float:left;margin-left:10px;">
								<div id="CalModeS" data-role="controlgroup"  style="text-align: center" data-type="horizontal" >
									<input type="radio" name="CalMode" id="CalMode_day" data-mini="true" value="day" class="custom" data-theme="c" checked="checked" />
									<label for="CalMode_day">&nbsp;</label>
									<input type="radio" name="CalMode" id="CalMode_week" data-mini="true" value="week" class="custom" data-theme="c"/>
									<label for="CalMode_week">&nbsp;</label>
								</div>
							</div>
							<div  style="float:right;margin-right:10px;">
								<div id="CalDispS" data-role="controlgroup"  style="text-align: center" data-type="horizontal" >
									<input type="radio" name="CalDisp" id="CalDispL" data-mini="true" data-icon="bars" value="list" class="custom" data-theme="c" checked="checked" />
									<label for="CalDispL"><span class="ui-icon-bars ui-btn-icon-notext inlineIcon">&nbsp;</span></label>
									<input type="radio" name="CalDisp" id="CalDispM" data-mini="true" data-icon="location" value="map" class="custom" data-theme="c"/>
									<label for="CalDispM"><span class="ui-icon-location ui-btn-icon-notext inlineIcon">&nbsp;</span></label>
								</div>
							</div>
						</div>
						<div id="CalList" style="clear:both;">
							<ul id="calendarList" data-role="listview" data-inset="true" data-split-theme="c" data-filter="false"></ul>
						</div>
						<div id="CalMap" style="display:none;clear:both;">
							<div id="cal_markers_div">
								<input type="checkbox" class="custom" name="cal_markers_opt" id="cal_markers_opt" data-mini = "true" data-theme="a" checked="checked"/>
								<label for="cal_markers_opt"></label>
							</div>
							<div id="calendar_canvas" style="width: 100%; height: 500px;padding:5px;"></div>
						</div>
					</div>
				</div>
			</div>
            <div data-role="footer" data-position="fixed" data-theme="d">
				<div data-role="navbar">
					<ul>
						<li><a id="CalendarListPageHomeBtn" href="#HomePage" data-role="button" data-icon="home" data-direction="reverse" class="ui-alt-icon ui-nodisc-icon"></a></li>

						<li id="CalendarCallDiv" ><a id="CalendarCallBtn" href="#" onclick="CallFromCalendar();" data-role="button" data-icon="phone" class="ui-alt-icon ui-nodisc-icon"></a></li>
						<li id="CalendarMeetingDiv"><a id="CalendarMeetingBtn" href="#" onclick="MeetingFromCalendar();" data-role="button" data-icon="user" class="ui-alt-icon ui-nodisc-icon"></a></li>

						<li><a id="CalendarLastViewedBtn" href="#LastViewedListPage" data-role="button" data-icon="bars" class="ui-alt-icon ui-nodisc-icon"></a></li>
						<li><a id="CalendarAllModulesBtn" href="#AllModulesListPage" data-role="button" data-icon="grid" class="ui-alt-icon ui-nodisc-icon"></a></li>
					</ul>
				</div>
            </div>
        </div>

        <div id="LastViewedListPage" data-dialog="true" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
                <h1 id="LastViewedListPageTitle"></h1>
            </div>
            <div role="main" class="ui-content">
                <ul id="LastViewedListDiv" data-role="listview" data-split-theme="b" data-filter="false" />
            </div>
        </div>

        <div id="GSListPage" data-dialog="true" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
                <h1 id="GSPageTitle"></h1>
            </div>
            <div role="main" class="ui-content">
                <ul id="GSListDiv" data-role="listview" data-split-theme="c" data-filter="false" />
            </div>
            <div data-role="footer" data-position="fixed" data-theme="d">
				<div data-role="navbar">
					<ul>
						<li><a id="GSListPageHomeBtn" href="#HomePage" data-icon="home" data-direction="reverse"></a></li>
						<li><a id="GSCalendarBtn" href="#CalendarListPage" data-role="button" data-icon="calendar" data-direction="reverse"></a></li>
						<li><a id="GSLastViewedBtn" href="#LastViewedListPage" data-role="button" data-icon="page"></a></li>
						<li><a id="GSGSBtn" href="#GlobalSearch" data-transition="none" data-role="button" data-icon="search"></a></li>
						<li><a id="GSAllModulesBtn" href="#AllModulesListPage" data-role="button" data-icon="grid"></a></li>
					</ul>
				</div>
            </div>
        </div>

        <div id="AllModulesListPage" data-dialog="true" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
                <h1 id="AllModulesListPageTitle"></h1>
            </div>
            <div role="main" class="ui-content">
                <ul id="AllModulesListDiv" data-role="listview" data-split-theme="c" data-filter="false" />
            </div>
        </div>

        <div id="EditNotes" data-role="page" data-theme="b">
            <div data-role="header" data-theme="d">
                <h1 id="EditNotesTitle"></h1>
				<a id="EditNotesCancelTopBtn" href="#" data-role="button" data-rel="back" data-theme="c"></a>
				<a id="EditNotesConfirmTopBtn" href="javascript:SaveNote();" data-role="button"  data-inline="true" class="ui-btn-right" data-theme="b"></a>
            </div>
            <div role="main" class="ui-content">
				<div id="EditNotesBtn">
				</div>
				<div id="EditNotesAdditional">
					<input id="NotesPrevPage" type="hidden" value="">
					<input id="NotesFromModule" type="hidden" value="">
					<input id="NotesFromId" type="hidden" value="">
					<input id="NotesFromName" type="hidden" value="">
					<input id="NotesFromLnk" type="hidden" value="">
					<input id="NotesFromAccountId" type="hidden" value="">
				</div>
				<style> .thumb { height: 75px; border: 1px solid #000; margin: 10px 5px 0 0;}</style>
				<div id="CurrentNotesFile" class="ui-field-contain">
						<label for="EditNotes_filename"></label>
						<input type="text" name="EditNotes_filename" id="EditNotes_filename" readonly="readonly" data-theme="c" />
				</div>
				<div style="display: none;">
						<input type="number" name="EditNotesDelAttach" id="DelAttach"/>
				</div>
				<a id="DelAttachBtn" href="javascript:DelAttach();" data-role="button" data-mini="true" data-theme="c" data-inline="true" ></a>
				<div id="EditNotesFile" class="ui-field-contain">
							<label for="EditNotesAttach"></label>
							<input type="file" name="EditNotesAttach" id="EditNotesAttach" data-theme="c" />
				</div>
				<output id="EditNotesPict"></output>
                <br />
				<div style="margin:0 auto; margin-left:auto; margin-right:auto; align:center; text-align:center;">
					<a id="EditNotesCancelBottomBtn" href="#" data-role="button" data-rel="back" data-inline="true" data-theme="c"></a>
					<a id="EditNotesConfirmBottomBtn" href="javascript:SaveNote();" data-role="button" data-inline="true" ></a>
				</div>
            </div>
        </div>

        <div id="QLogout" data-role="page" data-theme="b">
            <div data-role="header" data-theme="b">
                <h1 id="QDialogTitle">QuickCRM</h1>
            </div>
            <div data-role="content">
                <h3 id="QDialogLabel"></h3>
				<div style="margin:0 auto; margin-left:auto; margin-right:auto; align:center; text-align:center;">
					<a id="CancelLogout"  href="#HomePage" data-role="button" data-mini="true" data-inline="true" data-theme="c"></a>
					<a id="ConfirmLogout" href="javascript:LogOutUser();" data-role="button" data-mini="true" data-inline="true" ></a>
				</div>
            </div>
        </div>

        <div id="AllOptions" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
				<a href="#HomePage" data-role="button" data-direction="reverse" data-icon="arrow-l" data-iconpos="notext" data-iconshadow="false" class="ui-alt-icon ui-nodisc-icon"></a>
                <h1 id="AllOptionsTitle"></h1>
            </div>
            <div role="main" class="ui-content">
					<ul data-role="listview" data-theme="c" data-filter="false"  id="AllOptionsDiv">
						<li><a id="OptionsGeneralLnk" href="#OptionsGeneral"></a></li>
						<li><a id="OptionsHomeLnk" href="#OptionsHome"></a></li>
						<li id="OptSSDiv" ><a id="OptionsSSLnk" href="#OptionsSavedSearch"></a></li>
						<li><a id="OptionsSortOrderLnk" href="#OptionsSortOrder"></a></li>
						<li id="OptFilterOldDiv" ><a id="OptionsFilterOldLnk" href="#OptionsFilterOld"></a></li>
						<li id="OptActDiv" ><a id="OptionsActLnk" href="#OptionsAct"></a></li>
						<li id="ContactNSTEAMContainer"></li>
						<li id="OptGetPro"><a id="OptGetProLnk" href="#" style="white-space:normal;" onclick="OpenQuickCRM()"></a></li>
					</ul>
					<div >
						<br><p id="AppVersion" style="font-size:smaller;"></p>
					</div>
            </div>
        </div>
		
        <div id="OptionsGeneral" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
				<a class="OptionsBackBtn"  href="#AllOptions" data-role="button" onclick="OptionsGeneralSave();" data-direction="reverse" ></a>
                <h1 id="OptionsGeneralTitle"></h1>
            </div>
            <div role="main" class="ui-content">
					<div class="ui-field-contain">
						<fieldset data-role="controlgroup" data-mini="true">
							<legend id="OptToolbarLbl"></legend>
							<input type="checkbox" name="OptIconsLabels" id="OptIconsLabels" class="custom" data-theme="c" />
							<label for="OptIconsLabels"></label>
						</fieldset>
					</div>
					<div class="ui-field-contain" data-mini="true">
						<label for="OptRowsPerPage"></label>
						<input type="range" name="OptRowsPerPage" id="OptRowsPerPage" value="20" step="5" min="5" max="500" data-theme="c" data-track-theme="b" />
					</div>

					<div id="RowsPerDashlet" class="ui-field-contain" data-mini="true">
						<label for="OptRowsPerDashlet"></label>
						<input type="range" name="OptRowsPerDashlet" id="OptRowsPerDashlet" value="5" step="5" min="5" max="20" data-theme="c" data-track-theme="b" />
					</div>

					<div id="RowsPerSubpanel" class="ui-field-contain" data-mini="true">
						<label for="OptRowsPerSubpanel"></label>
						<input type="range" name="OptRowsPerSubpanel" id="OptRowsPerSubpanel" value="5" step="5" min="5" max="20" data-theme="c" data-track-theme="b" />
					</div>

					<div class="ui-field-contain">
						<fieldset data-role="controlgroup" data-mini="true">
							<legend id="OptSearchLbl"></legend>
							<input type="checkbox" name="OptPartialSearch" id="OptPartialSearch" class="custom" data-theme="c" checked="checked"/>
							<label for="OptPartialSearch"></label>
						</fieldset>
					</div>
					<div class="ui-field-contain">
						<fieldset data-role="controlgroup" data-mini="true">
							<legend id="OptHideEmptySubPLbl"></legend>
							<input type="checkbox" name="OptHideEmptySubP" id="OptHideEmptySubP" class="custom" data-theme="c" />
							<label for="OptHideEmptySubP"></label>
						</fieldset>
					</div>
					<div class="ui-field-contain" id="OptAlertDiv">
						<fieldset data-role="controlgroup" data-mini="true">
							<legend id="OptAlertsLbl"></legend>
							<input type="checkbox" name="OptAlerts" id="OptAlerts" class="custom" data-theme="c" />
							<label for="OptAlerts"></label>
						</fieldset>
					</div>
            </div>
        </div>
	
        <div id="OptionsHome" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
				<a class="OptionsBackBtn" href="#AllOptions" data-role="button" onclick="OptionsHomeSave();" data-direction="reverse"></a>
                <h1 id="OptionsHomeTitle"></h1>
            </div>
            <div role="main" class="ui-content">
				<div id="TodayDiv" class="ui-field-contain">
						<fieldset data-role="controlgroup" data-mini="true">
							<input type="checkbox" name="OptToday" id="OptToday" data-theme="c" />
							<label for="OptToday"></label>
						</fieldset>
				</div>
				<div class="ui-field-contain">
					<fieldset id="OptHomeIcons" data-role="controlgroup"  data-mini="true"/>
				</div>
            </div>
            </div>
        </div>
	
        <div id="OptionsSortOrder" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
				<a class="OptionsBackBtn" href="#AllOptions" data-role="button" onclick="OptionsSortOrderSave();" data-direction="reverse"></a>
                <h1 id="OptionsSortOrderTitle"></h1>
            </div>
            <div role="main" class="ui-content">
					<ul id="ModulesListSort" data-role="listview" data-theme="c" data-filter="false" />
            </div>
        </div>
	
        <div id="OptionsFilterOld" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
				<a class="OptionsBackBtn" href="#AllOptions" data-role="button" onclick="OptionsFilterOldSave();" data-direction="reverse"></a>
                <h1 id="OptionsFilterOldTitle"></h1>
            </div>
            <div role="main" class="ui-content">
					<div id="FilterOldDiv">
					</div>
					<fieldset id="ModulesListOld" data-role="controlgroup"  data-mini="true"/>
            </div>
        </div>
	
        <div id="OptionsAct" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
				<a class="OptionsBackBtn" href="#AllOptions" data-role="button" onclick="OptionsActSave();" data-direction="reverse" ></a>
                <h1 id="OptionsActTitle"></h1>
            </div>
            <div role="main" class="ui-content">
				<div class="ui-field-contain">
					<fieldset data-role="controlgroup" data-mini="true">
						<legend id="OptLogCallsLbl"></legend>
						<input type="checkbox" name="OptLogCalls" id="OptLogCalls" class="custom" data-theme="c" />
						<label for="OptLogCalls"></label>
					</fieldset>
				</div>
                <div class="ui-field-contain">
					<fieldset data-role="controlgroup" data-mini="true">
						<legend id="OptActMyItemsLbl"></legend>
						<input type="checkbox" name="OptActMyItems" id="OptActMyItems" class="custom" data-theme="c" />
						<label for="OptActMyItems"></label>
					</fieldset>
				</div>
                <div class="ui-field-contain" data-mini="true">
						<label for="ActivitiesFrom"></label>
						<input type="range" name="ActivitiesFrom" id="ActivitiesFrom" value="30" step="5" min="0" max="365" data-theme="c" data-track-theme="b" />
				</div>
                <div class="ui-field-contain" data-mini="true">
						<label for="ActivitiesTo"></label>
						<input type="range" name="ActivitiesTo" id="ActivitiesTo" value="30" step="5" min="0" max="365" data-theme="c" data-track-theme="b" />
				</div>

                <div class="ui-field-contain">
					<fieldset data-role="controlgroup"  data-mini="true">
						<legend id="OptActStatusLbl"></legend>
						<input type="checkbox" name="ActStatusN" id="ActStatus_planned"  class="custom" data-theme="c" checked="checked" />
						<label for="ActStatus_planned"></label>
						<input type="checkbox" name="ActStatusN" id="ActStatus_held"  class="custom" data-theme="c" checked="checked"  />
						<label for="ActStatus_held"></label>
						<input type="checkbox" name="ActStatusN" id="ActStatus_not_held"  class="custom" data-theme="c"   />
						<label for="ActStatus_not_held"></label>
					</fieldset>
				</div>
            </div>
        </div>
	
		<div id="GlobalSearch" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
                <h1 id="GlobalSearchTitle"></h1>
            </div>
            <div role="main" class="ui-content">
					<input id="GSSearchText" type="text"></input>
					<a id="GSSubmit" href="javascript:GlobalSearch('GSSearchText','GSListDiv','GSListPage',40);" data-mini="true" data-role="button" data-theme="c"></a>  
			</div>
		</div>

		<div id="InlineEdit" data-role="page" data-theme="c">
            <div role="main" class="ui-content">
				<div>
					<input id="IEModule" type="hidden"></input>
					<input id="IERefresh" type="hidden"></input>
					<input id="IEId" type="hidden"></input>
					<input id="IEFields" type="hidden"></input>
					<div id="IENew" >
					</div>
				</div>
				<div class="CenterBtns" >
					<a id="IECancel" href="#" onclick="IECancel();" data-role="button" data-mini="true" data-inline="true"></a>
					<a id="IESave" href="#" onclick="IESetNewval();" data-mini="true" data-inline="true" data-role="button" data-theme="b">Save</a>
					<span id="IESaved" style="color:red;display:none;"></span>
				</div>
			</div>
		</div>

		<div id="CreateSelect" data-dialog="true" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
                <h1 id="CreateSelectModule"></h1>
            </div>
            <div role="main" class="ui-content">
				<div>
					<input id="CSFromModule" type="hidden"></input>
					<input id="CSFromId" type="hidden"></input>
					<input id="CSToModule" type="hidden"></input>
					<input id="CSLnk" type="hidden"></input>
					<input id="CSWhere" type="hidden"></input>
					<input id="CS_LinkedId" type="hidden"></input>
					<fieldset data-role="controlgroup">
						<input id="CS_SearchText" type="text" ></input>
					</fieldset>
				</div>
				<div>
					<ul id="CS_SearchTextL" data-role="listview" data-filter="false" />
				</div>
<!--
				<div class="ui-grid-a" style="padding-top:15px">
					<div class="ui-block-a"><a id="CSCancelBtn" href="javascript:void(0)" data-mini="true" data-rel="back" data-role="button" data-theme="c"></a></div>
					<div class="ui-block-b"><a id="CSSelect" href="#" onclick="SetSelect();" data-mini="true" data-inline="true" data-role="button"></a></div>
				</div>
-->
			</div>
			
            <div data-role="footer" data-theme="c">
					<h1><a id="CSSelect" href="#" onclick="SetSelect();" data-mini="true" data-inline="true" data-role="button"></a></h1>
			</div>

		</div>

		<div id="Rename" data-dialog="true" data-role="page" data-theme="c">
            <div data-role="header" data-theme="b">
                <h1 id="RenameTitle"></h1>
            </div>
            <div role="main" class="ui-content">
				<div>
					<input id="RenInitText" type="hidden"></input>
					<input id="RenInitModule" type="hidden"></input>
					<input id="RenInitId" type="hidden"></input>
					<fieldset data-role="controlgroup">
						<input id="RenNewText" type="text" ></input>
					</fieldset>
				</div>
			</div>
            <div data-role="footer" data-theme="b">
					<h1><a id="RenConfirm" href="#" data-rel="back" data-mini="true" data-inline="true" data-role="button"></a></h1>
			</div>
		</div>
		
		<div id="LockPage" data-dialog="true" data-role="page" data-theme="c">
            <div data-role="header" data-theme="d">
                <h1 id="LockPageTitle"></h1>
            </div>
            <div role="main" class="ui-content" data-theme="c">
				<div id="AppLocked" data-theme="d">
					<h3 id="AppUnlockTitle"></h3>
					<fieldset data-role="controlgroup" data-mini="true">
						<label id="RemoveLockLabel" for="RemoveLock"></label>
						<input id="RemoveLock" type="password" />
					</fieldset>
				</div>
				<div id="AppUnlocked" data-theme="d">
					<h3 id="AppDefLockTitle"></h3>
					<fieldset data-role="controlgroup" data-mini="true">
						<label id="DefPasswordLabel" for="DefPassword"></label>
						<input id="DefPassword" type="password" />
					</fieldset>
					<fieldset data-role="controlgroup" data-mini="true">
						<label id="DefPassword2Label" for="DefPassword2"></label>
						<input id="DefPassword2" type="password" />
					</fieldset>
				</div>
				<div >
					<em id="LockErr"></em>
				</div>
				<div class="ui-grid-a">
					<div class="ui-block-a"><a id="LockPageCancelBtn" onclick="return checkForceLock()" href="#" data-role="button" data-rel="back" data-theme="c"></a></div>
					<div class="ui-block-b"><a id="LockPageConfirmBtn" href="javascript:SaveLockPage();" data-role="button" ></a></div>
				</div>
			</div>
		</div>

		<div id="EnterPwdPage" data-dialog="true" data-role="page" data-theme="c">
            <div role="main" class="ui-content" data-theme="c">
				<div>
					<div class="ui-field-contain" data-mini="true" >
							<label id="EnterPasswordLabel" for="EnterPassword"></label>
							<input id="EnterPassword" type="password" />
					</div >
					<div >
						<em id="PwdErr"></em>
					</div>
					<a id="EnterPwdConfirmBtn" href="#HomePage" data-direction="reverse" onclick="PasswordEntered();" data-role="button" ></a>
				</div>
			</div>
		</div>

        <div id="JJWG" data-role="page" data-theme="b">
            <div data-role="header" data-theme="d">
				<a href="#" data-role="button" data-rel="back"  data-icon="arrow-l" data-iconpos="notext" data-iconshadow="false" class="ui-alt-icon ui-nodisc-icon"></a>
                <h1 id="JJWGTitle"></h1>
           </div>

            <div role="main" class="ui-content">
				<div id="mapsearchdiv">
					<table data-role="table" data-mode="reflow" class="ui-responsive table-stroke">
						<thead>
							<tr>
								<th data-priority="1" id="map_type_title"></th>
								<th data-priority="2" id="map_dist_title"></th>
								<th data-priority="3" id="map_from_title"></th>
							</tr>
						</thead>
						<tr>
							<td id="map_type"></td>
							<td id="map_dist"></td>
							<td id="map_from"></td>
						</tr>
					</table>
					<div class="ui-grid-a">
						<div class="ui-block-a">
							<div id="map_markers_div">
								<input type="checkbox" class="custom" name="map_markers_opt" id="map_markers_opt" data-mini = "true" data-theme="a" checked="checked"/>
								<label for="map_markers_opt"></label>
							</div>
						</div>
						<div class="ui-block-b" style="text-align:center;"><a id="mapSearchBtn" href="javascript:JJWG.SearchMap();" data-inline="true" data-mini="true" data-theme="c" data-role="button"></a></div>
					</div>							
				</div>
				<div id="map_canvas" style="width: 100%; height: 500px;"></div>
				<br clear="all" />
				<div id="map_legend"></div>
            </div>
        </div>

        <div id="DownloadPage" data-role="page" data-theme="b">
            <div data-role="header" data-theme="d">
				<a href="#" data-role="button" data-rel="back"  data-icon="arrow-l" data-iconpos="notext" data-iconshadow="false" class="ui-alt-icon ui-nodisc-icon"></a>
                <h1 id="DownloadPageTitle"></h1>
           </div>

            <div role="main" class="ui-content">
				<div id="DownloadDiv"></div>
            </div>
        </div>

		<div id="ConvertLead" data-role="page" data-theme="b">
			<div data-role="header" data-theme="d">
				<h1 id="ConvertLeadTitle"></h1>
				<a id="ConvertLeadCancelTopBtn" href="#" data-role="button" data-rel="back" data-theme="c"></a>
				<a id="ConvertLeadConfirmTopBtn" href="javascript:Beans.Leads.SaveConverted();" data-role="button"  data-inline="true" class="ui-btn-right" data-theme="b"></a>
			</div>
			<div role="main" class="ui-content">
				<div id="ConvertLeadBtn"></div>
				<input type="checkbox" name="ConvOptCreateContact" id="ConvOptCreateContact" class="custom" data-theme="c" checked="checked" onchange="Beans.Leads.ToggleContact();"/>
				<label for="ConvOptCreateContact"></label>
				<div id="ConvertContactSearch" style="display:none;">
					<div class="ui-field-contain" data-mini="true">
						<label for="CLLeads_contact_name"></label>
						<input id="CLLeads_contact_name" name="CLLeads_contact_name" type="text" data-clear-btn="true"/>
					</div>
					<div>
						<ul id="CLLeads_contact_nameL" data-role="listview" data-theme="d" data-filter="false" ></ul>
						<input id="CLLeads_contact_id" type="hidden" ></input>
						<br/><br/>
					</div>
				</div>
				<div id="ConvertContactCreate"></div>
				<input type="checkbox" name="ConvOptCreateAccount" id="ConvOptCreateAccount" data-theme="c" checked="checked" onchange="Beans.Leads.ToggleAccount();"/>
				<label for="ConvOptCreateAccount"></label>
				<div id="ConvertAccountSearch" style="display:none;">
					<div class="ui-field-contain" data-mini="true">
						<label for="CLLeads_account_name"></label>
						<input id="CLLeads_account_name" name="CLLeads_account_name" type="text" data-clear-btn="true"/>
					</div>
					<div>
						<ul id="CLLeads_account_nameL" data-role="listview" data-theme="d" data-filter="false" ></ul>
						<input id="CLLeads_account_id" type="hidden" />
					</div>
				</div>
				<div id="ConvertAccountCreate"></div>
				<br />
				<div class="CenterBtns">
					<a id="ConvertLeadCancelBottomBtn" href="#" data-role="button" data-rel="back" data-inline="true" data-theme="c"></a>
					<a id="ConvertLeadConfirmBottomBtn" href="javascript:Beans.Leads.SaveConverted();" data-role="button" data-inline="true" ></a>
				</div>
			</div>
		</div>
    </body>
</html>
