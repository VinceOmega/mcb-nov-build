var name;
var fckEditors = [];

function showGrid(caption, colModel, param){
	if (typeof param == 'undefined')
		param = {};
	jQuery("#grid").jqGrid(
		{ 
			url:'/admin-console/'+name+'/view/?'+param, 
			datatype: "json", 
            colModel :colModel,
			rowNum:10, 
			rowList:[10,20,30], 
			pager: '#pager', 
			sortname: typeof param.sidx == 'undefined' ? 'id' : param.sidx, 
			viewrecords: true, 
			sortorder: typeof param.sord == 'undefined' ? "desc" : param.sord, 
			forceFit: true,
			caption:caption,
			height: 300
		}
	); 

    $(window).resize(function(e) {
        $("#grid").jqGrid("setGridWidth", 1000);
    }).resize();	
	//jQuery("#grid").jqGrid('navGrid','#pager',{edit:false,add:false,del:false}); 
	jQuery("#grid").jqGrid('filterToolbar',{ searchOnEnter : false });	
	
}

function submitForm(){

	for (var id in fckEditors) {
		var oEditor = FCKeditorAPI.GetInstance( fckEditors[id] );
		$("form#"+name+" #"+ fckEditors[id]).val( oEditor.GetXHTML( true ) );
	}

	$.post(name + "/save", $("form#"+name).serialize(), function(data, textStatus, XMLHttpRequest) {
		if (data !== 'OK') {
            alert( data );
		} else {
			toggleForm();
			$("#grid").trigger("reloadGrid");
		}
	});	
}

function editItem(){
	if ((id = jQuery('#grid').getGridParam('selrow'))==null){
		alert('Choose an item to edit');
		return;
	}

	$.post(name + "/edit/?id=" + id, function (data) {
		toggleForm();
		for (var id in data) {
			if ( jQuery.inArray( id, fckEditors ) !== -1){
				var oEditor = FCKeditorAPI.GetInstance(id);
				oEditor.SetData(data[id]);
			}else{
				$("form#"+name+" #"+id).val(data[id]);
			}
		}
	});
}

function toggleForm(){
	$('#gridContainer').toggle();
	$('form#'+name).toggle();
}

function addItem(){
	document.forms[name].reset();
	for (var id in fckEditors) {
		var oEditor = FCKeditorAPI.GetInstance( fckEditors[id] );
		oEditor.SetData('');
	}
	$("form#"+name+" #id").val('');
	toggleForm();
}

function deleteItem(){
	if (confirm('Are you sure?')){
		id = jQuery('#grid').getGridParam('selrow');
		$.get(name + "/delete/?id="+id, function(data) {
			$("#grid").trigger("reloadGrid");
		});	
	}
}

function getArray(url){
	var out = new Array();
	out[0] = 'All';
	$.ajax({ async:false, url: url, context: document.body, success: function(data){
		for (var i in data){
			out[ i ] = data[i];
		}
	}});
	return out;
}


function showhideBox(eleid) {
	
	ele = document.getElementById(eleid);

	if(ele.style.display == "none") {
		ele.style.display = "block";
		ele.style.visibility = "visible";
	} else {
		ele.style.display = "none";
		ele.style.visibility = "hidden";
	}

}