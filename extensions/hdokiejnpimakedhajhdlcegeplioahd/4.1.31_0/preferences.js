Preferences=function(){var f=function(d,c){var b=LPPlatform.getPreference(d);c=void 0===c?a[d]:c;if(void 0===b)return c;if(typeof b!==typeof a[d])switch(typeof a[d]){case "boolean":return"true"===b||1===parseInt(b);case "number":return b=-1===b.indexOf(".")?parseInt(b):parseFloat(b),isNaN(b)?c:b;case "object":return JSON.parse(b)}return b},g=function(a){switch(typeof a){case "object":return JSON.stringify(a);case "boolean":return a?1:0;default:return a.toString()}},h={logoffWhenCloseBrowser:!0,logoffWhenCloseBrowserVal:!0,
showvault:!0,hideContextMenus:!0,notificationsBottom:!0,usepopupfill:!0,openloginstart:!0,storeLostOTP:!0,enablenamedpipes:!0,enablenewlogin:!0,htmlindialog:!0,language:!0,Icon:!0,generateHkKeyCode:!0,generateHkMods:!0,recheckHkKeyCode:!0,recheckHkMods:!0,searchHkKeyCode:!0,searchHkMods:!0,nextHkKeyCode:!0,nextHkMods:!0,prevHkKeyCode:!0,prevHkMods:!0,homeHkKeyCode:!0,homeHkMods:!0,openpopoverHkKeyCode:!0,openpopoverHkMods:!0,rememberpassword:!0,dialogSizePrefs:!0},a={logoffWhenCloseBrowser:!1,logoffWhenCloseBrowserVal:0,
idleLogoffEnabled:!1,idleLogoffVal:"",openpref:"tabs",htmlindialog:!1,highlightFields:!0,automaticallyFill:!0,showvault:!1,showAcctsInGroups:!0,hideContextMenus:!1,defaultffid:"0",donotoverwritefilledfields:!1,showNotifications:!0,showGenerateNotifications:!1,showFormFillNotifications:!1,showSaveSiteNotifications:!1,notificationsBottom:!1,showNotificationsAfterClick:!1,showFillNotificationBar:!1,showSaveNotificationBar:!0,showChangeNotificationBar:!0,usepopupfill:!0,showmatchingbadge:!0,autoautoVal:25,
warninsecureforms:!1,infieldPopupEnabled:!0,dontfillautocompleteoff:!1,pollServerVal:15,clearClipboardSecsVal:60,recentUsedCount:10,searchNotes:!0,openloginstart:!1,storeLostOTP:!0,enablenamedpipes:!0,enablenewlogin:!1,clearfilledfieldsonlogoff:!1,toplevelmatchingsites:!1,language:"",Icon:1,generate_length:12,generate_upper:!0,generate_lower:!0,generate_digits:!0,generate_special:!1,generate_mindigits:1,generate_ambig:!1,generate_reqevery:!0,generate_pronounceable:!1,generate_advanced:!1,gridView:!0,
compactView:!1,"seenVault4.0":!1,leftMenuMaximize:!0,disableffpwasked:!1,rememberemail:!0,rememberpassword:!1,dialogSizePrefs:{},tempID:0,lastreprompttime:0,identity:"",alwayschooseprofilecc:!1};LPPlatform.adjustPreferenceDefaults(a);LPPlatform.isMac()?(a.generateHkKeyCode=0,a.generateHkMods="",a.recheckHkKeyCode=0,a.recheckHkMods="",a.searchHkKeyCode=0,a.searchHkMods="",a.nextHkKeyCode=33,a.nextHkMods="meta",a.prevHkKeyCode=34,a.prevHkMods="meta",a.homeHkKeyCode=0,a.homeHkMods="",a.openpopoverHkKeyCode=
220,a.openpopoverHkMods="meta"):(a.generateHkKeyCode=71,a.generateHkMods="alt",a.recheckHkKeyCode=73,a.recheckHkMods="alt",a.searchHkKeyCode=87,a.searchHkMods="alt",a.nextHkKeyCode=33,a.nextHkMods="alt",a.prevHkKeyCode=34,a.prevHkMods="alt",a.homeHkKeyCode=72,a.homeHkMods="control alt",a.openpopoverHkKeyCode=220,a.openpopoverHkMods="alt");return{getDefault:function(d){switch(typeof d){case "object":var c={},b;for(b in d)c[b]=a[b];return c;case "string":return a[d];default:return null}},get:function(a,
c){switch(typeof a){case "object":var b={},e;for(e in a)b[e]=f(e,c?c[e]:void 0);return b;case "string":return f(a,c);default:return null}},set:function(a,c){switch(typeof a){case "object":for(var b in a){var e=b,f=g(a[b]);LPPlatform.setUserPreference(e,f);h[e]&&LPPlatform.setGlobalPreference(e,f)}break;default:b=g(c),LPPlatform.setUserPreference(a,b),h[a]&&LPPlatform.setGlobalPreference(a,b)}LPPlatform.writePreferences()}}}();
