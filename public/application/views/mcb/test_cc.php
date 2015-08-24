<div id="content">
			<div id="pink-section-header">
				<h2 class="curly">Checkout</h2>
			</div><!-- header -->
			<div id="checkout" class="grey-border left">
				<div id="credit" class="left">
					<div id="card" class="grey-border">
						<h3>Credit Card Information</h3>
						<br />
            
							<form method="post" action="/test_cc/test/" name="checkoutform" id="checkoutform">
              <input type="hidden" name="place_order" id="place_order" value="TRUE" />
              <input type="hidden" name="orderid" id="orderid" value="20" />
              <input type="hidden" name="shippingtotal" id="shippingtotal" value="69.75" />
              <input type="hidden" name="ordertotal" id="ordertotal" value="393.75" />
              
              
							<div class="form-element">
								<label for="cname">Name on Card:</label>
								<input type="text" name="cname" value="" />
							</div>

							<div class="form-element">
								<label for="ctype">Card Type:</label>
								<input type="text" name="ctype" value="" />
							</div>

							<div class="form-element">
								<label for="cnumber">Card Number:</label>
								<input type="text" name="cnumber" value="" />
							</div>

							<div class="form-element">
								<label for="expiration">Expiration Date (MM/YY):</label>
								<input type="text" name="expiration" value="" />
							</div>

							<div class="form-element">
								<label for="verification">Card Verification Number:</label>
								<input type="text" name="verification" value="" size="10" />
							</div>

							<a style="margin-left: 10px;" class="red left" href="#">What's this?</a>
					</div><!-- card -->
					<div id="share" class="grey-border">
							Share my creation with other users on MyChocolateHearts.com <input type="checkbox" name="share" value="Yes" checked />
					</div><!-- share -->
					<a href="#"><img style="margin: 20px; margin-right: 90px;" class="right" src="/env/images/place_order.png" onClick="javascript:document.checkoutform.submit(); return false;" /></a>

				</div><!-- credit -->

        </form>

				

			</div><!-- checkout -->

			<br class="clear" />

			<div class="clear pink-bar"></div>

			<br class="clear" />
