
//Build naviagation menu on top of every html page
function CreateMenu()
{  	
	document.writeln("<table border='0' width='100%' cellpadding='0' cellspacing='2'><tr><td>");	
	document.writeln("<div class='navigatemenu'>");
  	var url=["index.htm","datetimepicker.htm","crexport-download.htm","newscroller.htm","discussion.htm","contact.htm"];
  	var desc=["[Home]","[Javascript Date Time Picker]","[Crystal Reports Exporter]","[News Scroller]","[Discussion]","[Write to me]"];
 	
  	for (i=0;i<url.length;i++)
  	{
		document.writeln("<a href='"+url[i]+"'>"+desc[i]+"</a>");
  	}

  	document.writeln("</div></td>");
  	document.writeln("</tr></table>");
}

//Build rainforestnet header banner
function BuildHeader()
{
	document.writeln("<table cellSpacing=0 cellPadding=0 border=0>");
	document.writeln("<tr>");
	for (i=1;i<=7;i++)
	{
		document.writeln("<td><a href='index.htm'><IMG height=72 alt='rainforest of Pahang, Malayisa' src='images/rfnet"+i+".jpg' width=90 border=0></a></td>");
	}
	document.writeln("</tr>");
	document.writeln("</table>");
}

function BuildFooter()
{
	document.writeln("<span class='copyright'>Copyright &copy 2002-");
	today=new Date();
	document.write(today.getFullYear().toString()+" ");
	document.write("RainforestNET.com. All Rights Reserved. All trademarks are the property of their respective owners</span>"); 
}
