var focusInColor = "#fff";
var focusOutColor = "#f5f5f5";
var fieldContainColor = "#e8f0fe";

function focusInForElementObject(elementObject) 
{
	elementObject.currentTarget.myParam.style.background = focusInColor;
}

function focusOutForElementObject(elementObject) 
{
	if(elementObject.currentTarget.myParam.value.length == 0) 
	{
		elementObject.currentTarget.myParam.style.background = focusOutColor;
	}
	else
	{
		elementObject.currentTarget.myParam.style.background = fieldContainColor;
	}
}

function formEffectForElementName(elementName)
{
	var elements = document.getElementsByTagName(elementName);
	for(var i = 0; i < elements.length; i++)
	{
		elements[i].style.background = focusOutColor;
		elements[i].addEventListener("focusin", focusInForElementObject, false);
		elements[i].myParam = elements[i];
		elements[i].addEventListener("focusout", focusOutForElementObject, false);
		elements[i].myParam = elements[i];
	}
}

formEffectForElementName("input");
formEffectForElementName("textarea");
formEffectForElementName("select");

function deleteRow(did)
{
	$("#deleteModal #deleteLink").attr("href", $(location).attr("href") + "?did=" + did);
}

function PrintSmartCard(id) 
{
	var newWin = window.open();
	$.ajax({
		type: "GET",
		url: "/user/smart_card/print_smart_card.php?id="+id,
		success: function(data){
			newWin.document.write(data);
			newWin.document.close();
			newWin.focus();
			setTimeout(function(){
				newWin.print();
				newWin.close();
			}, 100);
		}
	});
}