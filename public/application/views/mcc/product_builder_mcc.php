</div>
<div id="product-builder">
               <?php
                    $detect = new MobileDetect;
                    if($detect->isMobile()) {
                ?>
                <div class="unsupported">
                    <h2>Unsupported Browser</h2>
                    <p>For the most optimal user experience to customize your chocolate, please use one of the suggested web browsers below using a desktop computer rather than a mobile device.</p>
                    <ul>
						<li>Chrome</li>
						<li>Mozilla Firefox</li>
						<li>Internet Explorer</li>
					</ul>
					<p>Feel free to call us at 1-866-230-7730 if you want to place your custom order with one of our friendly Customer Service Representatives.</p>
					<p>Or, if you need quick chocolate in bulk, please browse our bulk Grab and Go Chocolate Coins options with fast shipping by <a href="/products/category/grab_and_go">clicking here</a>.</p>
                </div>
                <?php }else{ ?>
<center>
	<div id="flashContent" style="display: none">
		<a href="http://www.adobe.com/go/getflashplayer">
			<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
		</a>
	</div>
	<!-- Include support librarys first -->
	<script src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
	<script>
		var attributes = {};
		attributes.id = "i1Content";
		attributes.name = "i1Content";
		var flashvars = {};
		flashvars.fontsPath = "/env/configurator/files/fonts.xml";
		flashvars.headerPath = "/env/configurator/files/<?=$xmlHeader.'?'.time()?>";
		flashvars.contentPath = "/env/configurator/files/<?=$xmlContent.'?'.time()?>";
		swfobject.embedSWF("/env/configurator/configurator.swf", "flashContent", "940", "1175", "11.4", '/env/configurator/expressInstall.swf', flashvars, null, attributes);
	</script>
</center>
<?php } ?>
</div><!-- product-builder -->
<div id="root">
	<div id="content" class="no-header">
		<div class="spacer"></div>