<?php 
require_once('../inc/recaptcha-php-1.9/recaptchalib.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>OntoFox</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="../styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<div id="topbanner"><a href="/index.php"><img src="../Images/logo.gif" alt="Logo" width="280" height="50" border="0"></a></div>
<div id="topnav"><a href="../index.php" class="topnav">Home</a><a href="../introduction.php" class="topnav">Introduction</a><a href="../tutorial/index.php" class="topnav">Tutorial</a><a href="../faqs.php" class="topnav">FAQs</a><a href="../references.php" class="topnav">References</a><a href="../download.php" class="topnav">Download</a><a href="../links.php" class="topnav">Links</a><a href="../contactus.php" class="topnav">Contact</a><a href="../acknowledge.php" class="topnav">Acknowledge</a><a href="../news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
      <form action="feedback_submit.php" method="post" name="SubmitFeedbackForm" id="SubmitFeedbackForm">
        <h3 class="head3_darkred">Feedback</h3>
        <p>Submitting feedback to the OntoFox team allows us to enhance the system for the best possible user experience. Please take a few minutes to let us know what you think. You may be contacted via email from us. Thank you.</p>
		<table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td>Category: </td>
            <td><select name="c_category">
                <option value="Suggestion">Suggestion</option>
                <option value="Correction">Correction</option>
                <option value="Errors">Errors</option>
                <option value="Other">Other</option>
              </select></td>
          </tr>
          <tr>
            <td>E-mail:</td>
            <td><input name="c_email" maxlength="100" size="60" value="" type="text" /></td>
          </tr>
          <tr>
            <td>Subject:</td>
            <td><input name="c_subject" maxlength="200" size="90" value="" type="text" /></td>
          </tr>
          <tr>
            <td>Message Body:</td>
            <td><textarea name="c_body" cols="60" rows="4"></textarea></td>
          </tr>

          <tr>
            <td>Verify via reCAPTCHA:</td>
            <td><?php echo recaptcha_get_html(RECAPTCHA_PUBLICKEY);?></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="submit" type="submit" value="Submit" />
              <img src="../images/pixel.gif" width="40" height="1" />
            <input type="button" name="Button" value="Cancel" onclick="window.location.href='../index.php'"/></td>
          </tr>
        </table>
      </form>
      <!-- InstanceEndEditable -->
</div>
<div id="footer">
  <div id="footer_hl"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><div id="footer_left"><a href="http://www.hegroup.org" target="_blank">He Group</a><br>
University of Michigan Medical School<br>
Ann Arbor, MI 48109</div></td>
		<td width="300"><div id="footer_right"><a href="http://www.umich.edu" target="_blank"><img src="../Images/wordmark_m_web.jpg" alt="UM Logo" width="166" height="20" border="0"></a></div></td>
	</tr>
</table>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-4869243-8");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
<!-- InstanceEnd --></html>
