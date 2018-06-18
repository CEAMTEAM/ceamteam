<?php get_header(); ?>

<div class="body" role="main">
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<!-- 3 different Map techniques
			
				<div class="borderLight">
					<div id="gmap3"></div>
				</div>
				
				<p><iframe src="http://batchgeo.com/map/14eb8f6528aa8e4ae77e3f1866321432" frameborder="0" width="960" height="500" style="border:1px solid #aaa;border-radius:10px;"></iframe></p><p><small>View <a href="http://batchgeo.com/map/14eb8f6528aa8e4ae77e3f1866321432">Our Home</a> in a full screen map</small></p>

				<iframe width="960" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=928+briarwood+ln,+st+louis,+mo+63130&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=54.093296,70.839844&amp;ie=UTF8&amp;hq=&amp;hnear=928+Briarwood+Ln,+St+Louis,+Missouri+63130&amp;z=14&amp;ll=38.665671,-90.339918&amp;output=embed"></iframe><br /><small><a href="http://www.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=928+briarwood+ln,+st+louis,+mo+63130&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=54.093296,70.839844&amp;ie=UTF8&amp;hq=&amp;hnear=928+Briarwood+Ln,+St+Louis,+Missouri+63130&amp;z=14&amp;ll=38.665671,-90.339918" style="color:#0000FF;text-align:left">View Larger Map</a></small>
				
				-->


		<h6><?php single_post_title(); ?></h6>
			<div class="line">
										
				<form action="<?php bloginfo('template_url'); ?>/submit.php" method="post" id="contactForm" class="unit size2of6">
				
	                <fieldset>
	               		<legend class="h3">Send us a message</legend>
	               			
						<ol>
		                    <li class="relative">
		                        <label for="firstname" class="inField">First Name</label>
		                        <input type="text" name="firstname" id="firstname" title="First Name" maxlength="25" class="inputStyle" />
		                    </li>
		                    
		                    <li class="relative">
		                        <label for="lastname" class="inField">Last Name</label>
		                        <input type="text" name="lastname" id="lastname" title="Last Name" maxlength="40" class="inputStyle" />
		                    </li>
		                    
		        			<li class="relative">
		            			<label for="emailFrom" class="inField">Email Address</label>
		                        <input type="email" name="emailFrom" id="emailFrom" title="Email address" maxlength="60" class="inputStyle" />
		                    </li>
		                    
		                    <!--
		                    <li class="relative">
		                        <label for="website" class="inField">Web Site</label>
		                        <input type="url" name="website" id="website" title="Web Site" maxlength="40" placeholder="http://" autocomplete="off" required/>
		                    </li>
		                   
		                    <li class="relative">
		                        <label for="telephone" class="inField">Telephone (optional)</label>
		                        <input type="tel" name="telephone" id="telephone" title="Telephone" maxlength="20" placeholder="Telephone" autocomplete="off"/>
		                    </li>
		                     -->
		                    
		                    <li class="relative">
		                        <label for="comment" class="inField">Comment</label>
		                        <textarea name="comment" id="comment" title="Comment" cols="30" rows="8" autocomplete="off" class="inputStyle"></textarea>
	                    	</li>
	                    	
	                    	<li id="jerks">
		                        <input type="text" name="jerkNet" id="jerkNet" title="jerkNet" maxlength="20" autocomplete="off"/>
		                    </li>
		                     
	                    </ol>
	                    
	                  </fieldset>
	                  
	                  <fieldset id="routing">  
	                  	<p>Choose a mailbox</p>
	                	<ul id="mailbox">
						   
						   <li>
							    <input id="academics" class="radio" name="emailRoute" type="radio" value="Academics" autocomplete="off" />
							    <label for="academics">Academics</label>
						  	</li>
						  	 
		                   <li>
							    <input id="admissions" class="radio" name="emailRoute" type="radio" value="Admissions" autocomplete="off" />
							    <label for="admissions">Admissions</label>
						  	</li>
						  	
		                    <li>
							    <input id="giving" class="radio" name="emailRoute" type="radio" value="Giving" autocomplete="off" />
							    <label for="giving">Giving</label>
						  	</li>
		                   
		                    <li>
							    <input id="residential" class="radio" name="emailRoute" type="radio" value="Residential" autocomplete="off" />
							    <label for="residential">Residential</label>
						  	</li>
						<!--  	
		                    <li>
							    <input id="tuition" class="radio" name="emailRoute" type="radio" value="Tuition" autocomplete="off" />
							    <label for="tuition">Tuition</label>
						    </li>
						 -->   
						    <li>
							    <input id="other" class="radio" name="emailRoute" type="radio" value="Other" autocomplete="off" />
							    <label for="other">Other</label>
						    </li>
					    </ul>
	
	                    <!-- <h2><?php // single_post_title(); ?> Subscribe to your newsletter, or just leave us a message.</h2> -->
	                    
	                    <h1 id="response"></h1>
	                    
	                    <div class="getcode pad2to1">
	                        <input type="submit" id="submit" name="submit" value="Submit">
	                    </div>
	
	                </fieldset>
	            </form>
	            
	            <aside class="lastUnit size2of6">
					<dl>
						<dt class="pad1to1sm">Address</dt>
						<dd>1528 18th Street NW</dd>
						<dd>Washington, DC 20036</dd>
						<dd><button id="toggle">View Map</button></dd>
						<dt class="pad1to1sm">Phone &amp; Fax</dt>
						<dd>202-466-7345 (Office)</dd>
						<dd>202-466-7346 (Fax)</dd>
						<dt class="pad1to1sm">Facebook</dt>
						<dd><a href="http://www.facebook.com/pages/The-School-for-Ethics-and-Global-Leadership/124691740885200#!/pages/The-School-for-Ethics-and-Global-Leadership/124691740885200?v=wall">Friend SEGL</a></dd>
						<dt class="pad1to1sm">Twitter</dt>
						<dd><a href="http://twitter.com/segl">Follow SEGL</a></dd>
					</dl>
				</aside>
				
			</div>
		</div>
			
		<?php endwhile; else: ?>
	
			<p>Sorry, no posts matched your criteria.</p>
	
		<?php endif; ?>

	</div>

<?php get_footer(); ?>