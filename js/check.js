// validation for user when filling the form 
function validateForm()
{
var x=document.forms["uploadform"]["username"].value;
if (x==null || x=="")
  {
  alert("Du glömde att ange ett förnamn");
  return false;
  }
  var x=document.forms["uploadform"]["surname"].value;
if (x==null || x=="")
  {
  alert("Du glömde att ange ett efternamn");
  return false;
  }
    var x=document.forms["uploadform"]["company"].value;
if (x==null || x=="")
  {
  alert("Du glömde att ange ett företag");
  return false;
  }
    var x=document.forms["uploadform"]["email"].value;
if (x==null || x=="")
  {
  alert("Du glömde att ange en e mail adress");
  return false;
  }
    var x=document.forms["uploadform"]["phone"].value;
if (x==null || x=="")
  {
  alert("Du glömde att ange ett telefon-nummer");
  return false;
  }
    var x=document.forms["uploadform"]["comment"].value;
if (x==null || x=="")
  {
  alert("Du glömde att ange ett meddelande");
  return false;
  }
    var x=document.forms["uploadform"]["file"].value;
if (x==null || x=="")
  {
  alert("Du valde ingen fil");
  return false;
  }
  var x=document.forms["uploadform"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Ange en riktig mail-adress");
  return false;
  }

}



