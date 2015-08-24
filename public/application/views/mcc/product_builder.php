
		</div>
		
		
			<div id="product-builder">
               <?php
                    $detect = new MobileDetect;
                    if($detect->isMobile()) {
                ?>
                <div class="unsupported">
                    <h2>Unsupported Browser</h2>
                    <p>For the most optimal user experience to customize your chocolate, please use one of the suggested web browsers below using a desktop computer rather than a mobile device and be sure you have the most updated version of Flash player as well.</p>
				<ul>
					<li>Chrome</li>
					<li>Mozilla Firefox</li>
					<li>Internet Explorer 9 or higher</li><br>
				</ul>
		      <p>Feel free to call us at 1-866-230-7730 if you want to place your order with one of our friendly Customer Service Representatives.</p>
                </div>
                <?php }else{ ?>
			
				<center>
				<div id="flash_render">
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" <?php if($product->video== 'foiledPreloader.swf') echo 'width="940" height="475"'; else echo 'width="940" height="850"'; ?> id="test4_3" align="middle">
						<param name="allowScriptAccess" value="sameDomain" />
						<param name="allowFullScreen" value="false" />
						<param name="movie" value="/chocolates/<?php echo $product->video; ?>?session_string=<?php echo session_id(); ?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />
						<embed src="/chocolates/<?php echo $product->video; ?>?session_string=<?php echo session_id(); ?>" quality="high" bgcolor="#ffffff" <?php if($product->video== 'foiledPreloader.swf') echo 'width="940" height="475"'; else echo 'width="940" height="850"'; ?> name="test4_3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
					</object>
				</div>
				
				<script type="text/javascript"> 
					// <![CDATA[
					var so = new SWFObject("/chocolates/<?php echo $product->video; ?>?session_string=<?php echo session_id(); ?>", "home5", <?php if($product->video== 'foiledPreloader.swf') echo '"940", "475"'; else echo '"940", "850"'; ?>, "8", "#E9E9E9");
					so.addParam("wmode", "transparent")
					so.write("flash_render");
					// ]]>
				</script>
				</center>
                <?php } ?>
			</div><!-- product-builder -->


<div id="root">

	<div id="content" class="no-header">


			<div class="spacer"></div>
