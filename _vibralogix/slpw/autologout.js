// Set the inactivity timeout in seconds (e.g. 300 for 5 minutes)
var inactivitytimeout = 300
// Set the logout page
var logoutpage="/slpw/sitelokpw.php?sitelokaction=logout"

// ***************************************
var timer = 0
inactivitytimeout=inactivitytimeout*1000
function set_interval()
{
  timer = setInterval("auto_logout()",inactivitytimeout)
}
function reset_interval()
{
  if (timer != 0)
  {
    clearInterval(timer)
    timer = 0
    timer = setInterval("auto_logout()",inactivitytimeout)
  }
}
function auto_logout()
{
  window.location=logoutpage
}