// Functions for calendar

var dateNow=new Date()
var month=dateNow.getMonth()
var year=dateNow.getFullYear()
var datefield=""
var dateformat="DD/MM/YYYY"
var calendarmouse=false

function nextMonth()
{
  if (month==11)
  {
    month=0
	year=year+1
  }
  else
    month=month+1
  updateCalendar()	
}
function previousMonth()
{
  if (month==0)
  {
    month=11
	year=year-1
  }
  else
    month=month-1
  updateCalendar()	
}
function nextYear()
{
  year=year+1
  updateCalendar()	
}
function previousYear()
{
  year=year-1
  updateCalendar()	
}
function dateChosen(date)
{
  field=document.getElementsByName(datefield).item(0)
  var dd=date.toString()
  if (date<10)
    dd="0"+dd
  var monthadjust=month+1		
  var mm=monthadjust.toString()
  if (monthadjust<10)
    mm="0"+mm
  var yyyy=year.toString()
  var yy=yyyy.substring(2)
  var result=dateformat.toUpperCase()
  result=result.replace("DD",dd)
  result=result.replace("MM",mm)
  result=result.replace("YYYY",yyyy)
  result=result.replace("YY",yy)
  field.value=result
  field.focus()
  closeCalendar()
}
function openCalendar(dateFieldName,format)
{
  datefield=dateFieldName
  var  displayBelowThisObject = document.getElementsByName (dateFieldName).item(0)
  displayBelowThisObject.focus()  
  var x = displayBelowThisObject.offsetLeft
  var y = displayBelowThisObject.offsetTop + displayBelowThisObject.offsetHeight
  
  var parent = displayBelowThisObject
  while (parent.offsetParent) {
    parent = parent.offsetParent
    x += parent.offsetLeft
    y += parent.offsetTop
  } 
  var box = document.getElementById("calendardiv")
  box.style.left=x.toString()+"px"
  box.style.top=y.toString()+"px"
  if (box.style.visibility == 'visible')
  {
    box.style.visibility = 'hidden'
    return
  }
  else	  
    box.style.visibility = 'visible'    
  if (format!="")
    dateformat=format
  updateCalendar()
}
function closeCalendar()
{
  var box = document.getElementById("calendardiv") 
  if (!box)
    return
  box.style.visibility = 'hidden'
  datefield=""
}
function updateCalendar()
{
  var monthNames=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
  var myDate=new Date()
  myDate.setFullYear(year,month,1)
  var firstdayofmonth=myDate.getDay()
  myDate.setDate(myDate.getDate()-firstdayofmonth)
  var table = document.getElementById('calendar')
  var rows = table.rows
  var cells = rows[0].cells
  cells[2].innerHTML="<p class='monthselecttext'>"+monthNames[month]+" "+year.toString()+"</p>"
  for(var rowLoop=2; rowLoop<rows.length; rowLoop++)
  {
    cells = rows[rowLoop].cells
    for(var cellLoop=0; cellLoop<cells.length; cellLoop++)
	{
	   if (!((cellLoop==(cells.length-1)) && (rowLoop==(rows.length-1))))
	   {
	     if (myDate.getMonth()==month)	   
           cells[cellLoop].innerHTML="<p class='dayofmonthtext' onmouseover=\"this.className = 'dayofmonthtexthlt';\" onmouseout=\"this.className = 'dayofmonthtext';\" onClick=\"dateChosen("+myDate.getDate().toString()+")\">"+myDate.getDate().toString()+"</p>"
	     else
           cells[cellLoop].innerHTML="<p class='dayofmonthtext'>&nbsp;</p>"     	 
         myDate.setDate(myDate.getDate()+1)
	   }
    }
  }
}

// Functions for combo box

var combofield=""
var combolist=""
var combomouse=false

function comboBox(comboFieldName,listdata)
{	
  combofield=comboFieldName
  combolist=listdata
  var  displayBelowThisObject = document.getElementsByName (comboFieldName).item(0)
  var x = displayBelowThisObject.offsetLeft
  var y = displayBelowThisObject.offsetTop + displayBelowThisObject.offsetHeight 
  var parent = displayBelowThisObject
  while (parent.offsetParent) {
    parent = parent.offsetParent
    x += parent.offsetLeft
    y += parent.offsetTop 
  } 
  displayBelowThisObject.focus()  
  var box = document.getElementById(listdata)
  box.style.left=x.toString()+"px"
  box.style.top=y.toString()+"px"
  box.style.overflow = 'auto'  
  box.style.visibility = 'visible'
}
function comboBoxSelected(newvalue)
{
  field=document.getElementsByName(combofield).item(0)
  field.value=newvalue
  comboBoxClose()
}
function comboBoxClose()
{
  if (combolist!="")
	{
      var box = document.getElementById(combolist)
      box.style.overflow = 'hidden'
      box.style.visibility = 'hidden'
      combofield=""
      combolist=""
	}
}
function guiCloseIfOutside()
{
    if (!combomouse)
	  comboBoxClose()
    if (!calendarmouse)
	  closeCalendar()
}
