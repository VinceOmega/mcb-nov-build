
<!-- Lower Navigation -->
			<div id="lower-nav" name="footer" class="rounded-corners">
				<div id="links">
				<?php foreach ($links as $title => $url): ?>
				<?php $alter = ''; if($title == 'Home') $alter = 'MyChocolateHearts.com'; else $alter = $title; $alter = str_replace('Us', 'MyChocolateHearts.com', $alter);?>
					<a href="<?php echo $url; ?>" title="<?php echo $alter; ?>"><?php echo $title; ?></a>
				<?php endforeach ?>
				</div><!--links-->
			</div><!-- lower-nav -->
		</div><!-- content -->
		<div id="footer">
			<div id="polarcopy" style="text-align:center;"><a href="http://www.polardesign.com/" target="_blank">Web Design</a> by <a href="http://www.polardesign.com/" target="_blank">Polar Design</a> &#169; <?=date('Y')?></div><br>
			<div id="seals" style="float:right;width:300px;"><a href="http://www.instantssl.com">
<img src="/env/images/comodo_secure-52x63.gif" alt="Instant SSL Certificate Secure Site" width="52" height="63" style="border: 0px;"><br> <span style="font-weight:bold; font-size:7pt">Instant SSL Certificate Secured</span> </a><!-- (c) 2005, 2012. Authorize.Net is a registered trademark of CyberSource Corporation --> <div class="AuthorizeNetSeal" style="float:right;margin-top:-68px;font-weight:bold; "> <script type="text/javascript" language="javascript">var ANS_customer_id="a3944379-8465-4015-892a-fb6debe2d8b9";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> http://www.authorize.net/ [^] </div></div>
		</div><!-- footer -->
	</div><!-- root -->