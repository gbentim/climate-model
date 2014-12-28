var groups;

function hideRows(rowType, numRows, first)
{
	first = typeof first !== 'undefined' ?  first : 1;

	for (i=first; i <= numRows; i++) {
		var rowobj = document.getElementById(rowType + i);
    	rowobj.style.display='none';
    }
}

function showRows(rowType, numRows, first)
{
	first = typeof first !== 'undefined' ?  first : 1;
	
	for (i=first; i <= numRows; i++) {
		var rowobj = document.getElementById(rowType + i);
    	rowobj.style.display='';
    }
}

function setNumGroups()
{
	hideRows('groupRow', 16);
	var numG = document.getElementById("numGroups").value;
	showRows('groupRow', numG);
}

function setIncome(group)
{
	var incomeG = document.getElementById("groupAction" + group).value;
	document.getElementById("incomeGroup" + group).innerHTML=incomeG;
	// document.getElementById("incomeGroup" + group).appendChild(document.createTextNode(incomeG));
}