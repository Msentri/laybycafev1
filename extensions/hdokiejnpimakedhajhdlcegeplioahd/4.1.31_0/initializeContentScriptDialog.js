(function(){var b=document.createElement("iframe");b.setAttribute("class","backgroundFrame");b.src="backgroundFrame.html";b.addEventListener("load",function(){b.contentWindow.LPPlatform.getBackgroundInterface({mainRequestFramework:!1,interfaceDefinition:Interfaces.ContentScriptDialogInterface,callback:function(a){window.bg=a}});b.contentWindow.Topics.get(b.contentWindow.Topics.REQUEST_FRAMEWORK_INITIALIZED).subscribe(function(a,b){var c=parseInt(a.topFrameID);csTop=Interfaces.createInstance(Interfaces.ContentScriptInterface,
{direct:!1,context:"contentScriptDialog",requestFunction:function(a){b.sendRequest({type:"contentScriptRequest",data:a,frameID:c})}});csTop.LPFrame.initializeRequestFramework(LPTools.getURLParams().dialogID)})});document.body.appendChild(b);Topics.get(Topics.REPROMPT).subscribe(function(a){bg.LPPlatform.openPopoverDialog("reprompt",{successCallback:a})});Topics.get(Topics.CONFIRM).subscribe(function(a){dialogs.confirmation.open(a)});Topics.get(Topics.DROPDOWN_SHOWN).subscribe(function(a){a.getDialog().setFrameSize()});
Topics.get(Topics.DROPDOWN_HIDE).subscribe(function(a){a.getDialog().setFrameSize()})})();
