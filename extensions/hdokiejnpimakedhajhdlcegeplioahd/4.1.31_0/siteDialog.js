var SiteDialog=function(j){EditableFieldsDialog.call(this,j,{closeButtonEnabled:!0,maximizeButtonEnabled:!0,dynamicHeight:!0,type:Account});this.changePasswordButton=null};SiteDialog.prototype=Object.create(EditableFieldsDialog.prototype);SiteDialog.prototype.constructor=SiteDialog;
(function(){var j=function(a){var b=a.domain;""!==a.a&&(b=a.a+" ("+a.domain+")");return b};SiteDialog.prototype.initialize=function(a){EditableFieldsDialog.prototype.initialize.apply(this,arguments);this.changePasswordButton=$("#autoChangePassword");this.inputFields.password.getElement().LP_addPasswordMeter(this.inputFields.unencryptedUsername.getElement());this.inputFields.url=new BloodhoundDropdown(document.getElementById("siteDialogURL"),{identify:function(a){return a.domain},remote:{url:LPProxy.getBaseURL()+
"typeahead_addsite.php?q=%QUERY",wildcard:"%QUERY"}},{optionLabel:function(a){return j(a)},elementTemplate:{template:function(a){var b=""!==a.favicon?a.favicon:"R0lGODlhEAAQAIcAAAAAAExnf1BpgWR0iHZ6hHeBkX+GkYiOmpeaopucoaSlqqWmqrm9w7q+xL+/wry/xcXGyc3Oz9HS1NPU1tnZ2d/h4+Di5OLj5uPl5+Tk5OXm6O7u7+7v8O/w8e/w8vDw8fHx8vLy8/Pz8/Pz9PT09fX19fX29vb29vf39/f3+Pj4+Pj4+fn5+vr6+/v7/Pz8/P39/f7+/v///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAAAALAAAAAAQABAAAAiQAAEIHEiw4MAFCBEmQCjBIIAFMiLK8CBjA4QIBiFu2Fgh4oYJDgpq5Chxw4KCCiqSlKigIAKVGyowYNDgAYGCB2BWsHABgwYDBQvA/CCiBAoVBQoOUNlBhAkVLV4MKCigIgenK1zAiCGgYICKIEhAhRExgFcZHEKcYEG27NkOI1K0aCvDLMEAePPqteuwr8CAADs=",
h=LPTools.createElement("li","siteTypeaheadOption"),c=LPTools.createElement("div","itemIcon"),b=LPTools.createElement("img",{src:"data:image/gif;base64,"+b});h.appendChild(c);h.appendChild(LPTools.createElement("span","siteTypeaheadOptionText",j(a)));c.appendChild(b);return h},value:function(a){return a.url},hint:function(a){return j(a)}}});this.addFavButton().appendChild(this.editFormFieldsButton.get(0));var b=this;b.inputFields.url.onChange(function(a){a=LPProxy.getDomain(a.domain);var d=a.indexOf("."),
d=a.charAt(0).toUpperCase()+a.substring(1,0<d?d:a.length);b.inputFields.name.setValue(d);(d=bg.get("siteCats"))&&d[a]&&b.inputFields.group.setValue(d[a])});a.find("#siteDialogPasswordHistory").bind("click",function(){b.vaultItem.canViewPassword()?LPProxy.reprompt(function(){LPRequest.makeRequest(LPProxy.getPasswordHistory,{parameters:[b.vaultItem.getID(),b.vaultItem.getShareID()],success:function(a){k(a,b.vaultItem,Constants.HISTORY_TYPES.PASSWORD)},requestSuccessOptions:{closeDialog:!1}});bg.loglogin(b.vaultItem.getID())},
{types:AccountBaseWithFields.prototype.REPROMPT_TYPE_VIEW_PW}):Topics.get(Topics.ERROR).publish(Strings.translateString("This is a shared site. You are not permitted to view the password."))});a.find("#siteDialogUsernameHistory").bind("click",function(){LPRequest.makeRequest(LPProxy.getUsernameHistory,{parameters:[b.vaultItem.getID(),b.vaultItem.getShareID()],success:function(a){k(a,b.vaultItem,Constants.HISTORY_TYPES.USERNAME)},requestSuccessOptions:{closeDialog:!1}})});a.find("#siteDialogNoteHistory").bind("click",
function(){LPRequest.makeRequest(LPProxy.getNoteHistory,{parameters:[b.vaultItem.getID(),b.vaultItem.getShareID()],success:function(a){k(a,b.vaultItem,Constants.HISTORY_TYPES.NOTE)},requestSuccessOptions:{closeDialog:!1}})});b.changePasswordButton.bind("click",function(){var a=function(){LPProxy.autoChangePassword(b.vaultItem.getID());b.close(!0)};b.vaultItem.canViewPassword()?b.isModified()?dialogs.confirmation.open({title:Strings.translateString("Auto Change Password"),text:Strings.translateString("Changes you have made have not been saved. Are you sure you want to continue?"),
handler:a}):a():Topics.get(Topics.ERROR).publish(Strings.translateString("This is a shared site. You are not permitted to view the password."))})};var k=function(a,b,e){dialogs.fieldHistory.open({history:a,vaultItem:b,type:e})};SiteDialog.prototype.open=function(a){a=$.extend(a,{sourceFunction:LPProxy.getSiteModel});if(a.saveAllData){var b=a.saveAllData;delete a.saveAllData;a.defaultData={url:b.url,save_all:!0};l(b.formdata,a.defaultData)}else a.defaultData&&a.defaultData.formdata&&(l(a.defaultData.formdata,
a.defaultData),delete a.defaultData.formdata);if(a.defaultData&&a.defaultData.url){var b=LPProxy.getDomain(a.defaultData.url),e=bg.get("siteCats");void 0===a.defaultData.group&&e[b]&&(a.defaultData.group=e[b]);void 0===a.defaultData.name&&(a.defaultData.name=b)}if(a.saveOptions&&a.saveOptions.checkForReplacement){for(var b=LPProxy.getDomain(a.defaultData.url),e=[],d=LPProxy.getSiteModels(),h=0,c=d.length;h<c;++h){var g=d[h];LPProxy.getDomain(g.getURL())===b&&a.defaultData.unencryptedUsername===g.getUsername()&&
e.push(g)}if(0<e.length){dialogs.vaultItemSelect.open({title:Strings.translateString("Replace Site"),nextButtonText:Strings.translateString("Replace"),backButtonText:Strings.Vault.NO,text:Strings.translateString("Would you like to replace an existing entry you have for %1?",b),items:e,closeHandler:this.createHandler(EditableFieldsDialog.prototype.open,a),handler:this.createDynamicHandler(function(b){var c=a.defaultData;delete a.defaultData;EditableFieldsDialog.prototype.open.call(this,$.extend(a,
{vaultItem:b[0],postSetup:function(a){a.populateFields(c)}}))}),buildOptions:{multiSelect:!1}});return}}EditableFieldsDialog.prototype.open.call(this,a)};SiteDialog.prototype.setup=function(a,b){b.title=b.vaultItem?Strings.translateString("Edit Site"):Strings.translateString("Add Site");EditableFieldsDialog.prototype.setup.call(this,a,b);this.changePasswordButton.hide();this.vaultItem?(a.find(".history").show(),"1"===this.vaultItem._data.pwch&&this.changePasswordButton.show(),this.inputFields.url.disableDropdown()):
(a.find(".history").hide(),this.inputFields.url.enableDropdown())};SiteDialog.prototype.validate=function(a){var b=EditableFieldsDialog.prototype.validate.apply(this,arguments);""===a.name&&(this.addError("name","Name is required."),b=!1);return b};var l=function(a,b){b.fields=[];for(var e=a.split("\n"),d=0,h=e.length;d<h;++d){var c=e[d].split("\t"),g=decodeURIComponent(c[0]),j=decodeURIComponent(c[1]),f=decodeURIComponent(c[2]),c=decodeURIComponent(c[3]);if("action"===c)b.action=f;else if("method"===
c)b.method=f;else if(j)switch(c){case "email":case "text":case "url":case "tel":case "password":case "checkbox":case "radio":case "select":case "select-one":g={formname:g,name:j,type:c,value:f};if("checkbox"===c)g.value="-1"===f.substring(f.length-2),g.valueAttribute=f.substring(0,f.length-2);else if("radio"===c)if("-1"===f.substring(f.length-2))g.value=f.substring(0,f.length-2);else continue;b.fields.push(g)}}}})();