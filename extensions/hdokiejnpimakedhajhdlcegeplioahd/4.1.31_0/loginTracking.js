LPTabState=function(){var f={};LPPlatform.onTabClosed(function(a){delete f[a]});Topics.get(Topics.CLEAR_DATA).subscribe(function(){f={}});var m=function(a,b){b=[].concat(b);for(var c=0;c<a.length;++c){var d=b.indexOf(lpmdec_acct(a[c].password,!0,a[c],g_shares));if(-1<d)return b[d]}return null},j,r=[function(a,b){if(1===b.uniquePasswords.length){var c=b.uniquePasswords[0];2===b.passwordsByValue[c].count&&(2===a.fields.length?a.passwordChangeForm=!0:a.createAccountForm=!0);return c}},function(a,b){for(var c in b.passwordsByValue)if(1<
b.passwordsByValue[c].count)return 2===b.uniquePasswords.length?(a.passwordChangeForm=!0,a.originalPassword=b.uniquePasswords[0]===c?b.uniquePasswords[1]:b.uniquePasswords[0]):a.createAccountForm=!0,c},function(a,b,c){if(2===b.uniquePasswords.length&&(b=m(c.getSites(),b.uniquePasswords)))return a.passwordChangeForm=!0,a.originalPassword=b,a.uniquePasswords[0]===b?a.uniquePasswords[1]:a.uniquePasswords[0]},function(a){for(var b in a.passwordsByValue){var c=a.passwordsByValue[b].field,d=["pw","pass"];
if(k(c.attributes.name,d)||k(c.id,d))return b}}],s=[function(a,b){if(1===b.uniqueTextValues.length){var c=b.uniqueTextValues[0];2===b.textFieldsByValue[c].count&&(a.createAccountForm=!0);return c}},function(a,b){for(var c in b.textFieldsByValue)if(1<b.textFieldsByValue[c].count)return a.createAccountForm=!0,c},function(a){a=a.fields;for(var b=1;b<a.length;++b)if("password"===a[b].type){var c=a[b-1];if("password"!==c.type)return c.value}},function(a,b){for(var c in g_sites)if(-1<b.uniqueTextValues.indexOf(g_sites[c].unencryptedUsername))return g_sites[c].unencryptedUsername},
function(a,b){if(b.textFieldsByType.email&&1===b.textFieldsByType.email.count)return b.textFieldsByType.email.field.value},function(a,b){for(var c in b.textFieldsByValue){var d=b.textFieldsByValue[c].field;if(k(d.attributes.name,"user")||k(d.id,"user"))return c}}],n,l=function(a,b,c){var d=c[b];"undefined"===typeof d?c[b]={field:a,count:1}:++d.count};n=function(a){var b={},c={},d={};a.fields.forEach(function(a){"password"===a.type?l(a,a.value,b):(l(a,a.value,c),l(a,a.type,d))});return{passwordsByValue:b,
textFieldsByValue:c,textFieldsByType:d,uniqueTextValues:Object.keys(c),uniquePasswords:Object.keys(b)}};var k=function(a,b){if(a){b=[].concat(b);for(var c=0;c<b.length;++c)if(-1<a.indexOf(b[c]))return!0}return!1},p=function(a,b,c,d){for(var h=null,e=0;e<d.length&&!(h=d[e](a,b,c));++e);return h};j=function(a,b){var c=n(b),d=!1;b.username=p(b,c,a,s);b.password=b.generatedPassword?b.generatedPassword:p(b,c,a,r);var h;a:{if(b.username&&!b.createAccountForm)for(c=0;c<b.fields.length;++c){var e=b.fields[c];
if(e.value===b.username){h=e;break a}}h=null}this.submitted=function(){return!b.generatedPassword};this.succeeded=function(a){a&&(d=a);return d};this.getUsernameField=function(){return h};this.getUsername=function(){return b.username};this.getPassword=function(){return b.password};this.getFormData=function(){return b};this.getOriginalPassword=function(){return b.originalPassword};this.isChangePasswordForm=function(){return!0===b.passwordChangeForm};this.isCreateAccountForm=function(){return!0===b.createAccountForm};
this.isBasicAuthentication=function(){return!0===b.basicAuthentication};this.shouldSaveFields=function(){return!this.isChangePasswordForm()&&!this.isCreateAccountForm()}};var e=function(a){this.tabID=a.tabID;this.domain=lp_gettld_url(a.tabURL);this.sites=[];this.username=this.usernameField=this.acccountsVersion=null};e.prototype.getSites=function(){if(this.acccountsVersion!==g_local_accts_version){this.sites=[];var a=getsites(this.domain),b;for(b in a)this.sites.push(g_sites[b]);this.acccountsVersion=
g_local_accts_version}return this.sites};e.prototype.getFields=function(){var a=this.getUsernameField(),a=a?[a]:[];this.passwordForm&&(a=this.passwordForm.getFormData().fields);return a};e.prototype.getUsernameField=function(){if(!this.usernameField)for(var a in f){var b=f[a];if(b.usernameField&&compare_tlds(b.domain,this.domain)){this.usernameField=b.usernameField;break}}return this.usernameField};e.prototype.setUsernameField=function(a){a&&(this.usernameField=a)};e.prototype.setUsername=function(a){a&&
(this.username=a)};e.prototype.getUsername=function(){if(!this.username)for(var a in f){var b=f[a];if(b.username&&compare_tlds(b.domain,this.domain)){this.username=b.username;break}}return this.username};e.prototype.processPasswordSubmit=function(a){this.passwordForm=new j(this,a);this.setUsernameField(this.passwordForm.getUsernameField());this.setUsername(this.passwordForm.getUsername());a.generatedPassword&&(this.generatedPassword=a.generatedPassword)};e.prototype.processTextSubmit=function(a){a=
new j(this,a);this.setUsernameField(a.getUsernameField());this.setUsername(a.getUsername())};var q=function(a,b){if(-1<b.indexOf("@")){var c=b.split("@");return 2===c.length&&a===c[0]}return!1};e.prototype.getMatchingSites=function(){var a=this,b=a.getSites();if(a.getUsername())b=b.filter(function(b){b=b.unencryptedUsername;var c=a.getUsername();return b===c||q(b,c)||q(c,b)});else{var c=a.passwordForm&&a.passwordForm.getOriginalPassword();c&&(b=b.filter(function(a){return lpmdec_acct(a.password,!0,
a,g_shares)===c}));0===b.length&&(b=a.getSites())}return b};e.prototype.getSiteNotificationData=function(a){if(this.passwordForm){var b={formSubmitted:this.passwordForm.submitted(),formSucceeded:this.passwordForm.succeeded()};if(this.passwordForm.succeeded()){var c=this.passwordForm.getFormData(),d=this.getMatchingSites();if(m(d,this.passwordForm.getPassword()))return this.clear(),{};b.matchingSites=d.map(function(a){return a.aid});b.defaultData={url:this.passwordForm.shouldSaveFields()?c.url:hostof(c.url),
name:this.domain,unencryptedUsername:this.getUsername(),group:siteCats[this.domain],basic_auth:this.passwordForm.isBasicAuthentication()?"1":"0",realm:c.realm};b.dialogData={password:this.passwordForm.getPassword()};b.sameDomain=compare_tlds(lp_gettld_url(this.passwordForm.getFormData().url),lp_gettld_url(a.tabURL));b.generatedPassword=this.generatedPassword===this.passwordForm.getPassword();this.passwordForm.shouldSaveFields()&&0<this.getFields().length&&(b.dialogData.fields=this.getFields().map(function(a){return{name:a.attributes.name||
a.id,type:a.type,value:a.value,formname:a.formname}}))}else this.generatedPassword||this.clear();return b}return{}};e.prototype.getFormSubmissionTabState=function(){for(var a=this;a;){if(a.passwordForm)return a;a=a.previousTabState}return this};e.prototype.getSiteNotification=function(a,b){if(a.callback){var c=this.getFormSubmissionTabState(),d=!1;if(c.domain===this.domain&&c.passwordForm&&!c.passwordForm.isBasicAuthentication()){var e=LPTabs.get({tabID:this.tabID}),f=function(){c.passwordForm.succeeded(!d);
if(c.passwordForm.succeeded()&&!c.getUsername()&&0<c.getSites().length){var f=a.callback,g=c.getSites().map(function(a){return a.unencryptedUsername});e.forEachWindow({each:function(a,b){return a.LPContentScriptTools.findText({searches:g,exactMatch:!0,callback:function(a){c.setUsername(a);b()}})},done:function(){f(c.getSiteNotificationData(b))}})}else a.callback(c.getSiteNotificationData(b))};if(a.source){var g=e.getFrame(a.source.frameID);g&&g.LPSiteNotification.formExists(c.passwordForm.getFormData(),
function(a){d=a;f()})}else c.passwordForm.getFormData().top?e.getTop().LPSiteNotification.formExists(c.passwordForm.getFormData(),function(a){d=a;f()}):e.forEachFrame({each:function(a,b){return a.LPSiteNotification.formExists(c.passwordForm.getFormData(),function(a){d=d||a;b()})},done:f})}else a.callback(c.getSiteNotificationData(b))}};e.prototype.clear=function(){this.previousTabState&&(this.previousTabState.clear(),delete this.previousTabState);delete this.passwordForm;delete this.generatedPassword};
e.prototype.processBasicAuthentication=function(a){this.passwordForm=new j(this,{basicAuthentication:!0,url:a.url,realm:a.realm,username:a.username,password:a.password})};var g=function(a,b){if(a){var c;c=lp_gettld_url(a.tabURL);if(LPContentScriptFeatures.new_save_site)c=!hasNeverSave(a.tabURL,c)&&!lp_url_is_lastpass(a.tabURL)&&!lp_url_is_lastpassext(a.tabURL);else{var d=IntroTutorial.getState();c=d.enabled&&d.domain===c}if(c){c=f[a.tabID];if(!c||!compare_tlds(c.domain,lp_gettld_url(a.tabURL)))d=
f[a.tabID]=new e(a),d.previousTabState=c,c=d;b(c)}}else LPPlatform.getCurrentTab(function(a){g(a.tabDetails,b)})};return{getSiteNotification:function(a,b){g(b,function(c){c.getSiteNotification(a,b)})},clear:function(a){g(a,function(a){a.clear()})},processPasswordSubmit:function(a,b){g(b,function(c){c.processPasswordSubmit(a.formData,b);c.getSiteNotification({callback:a.callback,source:b},b)})},processTextSubmit:function(a,b){g(b,function(c){c.processTextSubmit(a,b)})},processBasicAuthentication:function(a,
b){g(b,function(b){b.processBasicAuthentication(a)})}}}();