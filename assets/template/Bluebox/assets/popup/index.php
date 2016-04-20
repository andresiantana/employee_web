<link rel="stylesheet" type="text/css" href="popup-window.css" />

<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="popup-window.js"></script>

<style type="text/css">
dl   { margin:  0px 0px  0px  0px; }
dt   { margin:  0px 0px  0px  0px; }
dd   { margin:  0px 0px  0px 25px; }
form { margin:  0px 0px  0px  0px; }
h1   { margin:  0px 0px 20px  0px; }
h2   { margin: 20px 0px 10px  0px; }
p    { margin:  0px 0px  5px  0px; }

body  { font: 100  13px   Arial, Sans-Serif; }
b     { font: 900 1.0em   Arial, Sans-Serif; }
h1    { font: 900 1.4em   Arial, Sans-Serif; }
h2    { font: 900 1.4em   Arial, Sans-Serif; }
small { font: 100 0.8em Verdana, Sans-Serif; }
</style>

<p>Click one of the buttons bellow to open popup window in different positions:</p>

<p>
<input type="button" onclick="popup_window_show('#sample', { pos : 'window-center',       width : '800px' });" value="Window center" />
</p>

</form>

<div   class="popup_window_css" id="sample">
<table class="popup_window_css">
<tr    class="popup_window_css">
<td    class="popup_window_css">
<div   class="popup_window_css_head">
<img src="images/close.gif" alt="" width="9" height="9" />Sample popup window</div>
<div   class="popup_window_css_body"><div style="border: 1px solid #808080; padding: 6px; background: #FFFFFF;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div></div>