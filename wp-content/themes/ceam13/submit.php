<?php
		$firstname	= stripslashes(trim($_POST['firstname']));
		$lastname	= stripslashes(trim($_POST['lastname']));
		$emailFrom	= stripslashes(trim($_POST['emailFrom']));
		//$urlFrom	= stripslashes(trim($_POST['urlFrom']));
		$phoneFrom	= stripslashes(trim($_POST['phoneFrom']));
		
		$date		= date ('M j, Y ');
		
		if(function_exists('stripslashes')) {
				$comment = stripslashes(trim($_POST['comment']));
			} else {
				$comment = trim($_POST['comment']);
			}
				
		$emailTo = 'barry@camelotlifecoach.com';
		$subject = 'New Submission';
			
		$message = '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<title>'. $route .' web message</title>
					</head>
						
					<body bgcolor="#ff0" text="#333">
				<!-- Main Table -->
					<table border="0" cellspacing="0" cellpadding="0" bgcolor="#ff0" style="width: 100%; padding: 20px 0 20px 0;">
				<!-- Header --> 
					<tbody>
						<tr>
							<td>
								<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="ff0" style="width: 720px;">
								<tr>
								<td>
								<table border="0" cellspacing="0" cellpadding="0" align="center" valign="top" bgcolor="#ff0" width="660px" height="150px">
									<tbody>
										<tr>
											<td align="left" style="padding: 20px 0 15px 15px; margin: 0;">
												<span style="font-family: Museo Sans, Helvetica; font-size: 70px; font-weight: 700; text-transform: uppercase; line-height: 1; color: #333;">'. $route .'
												<br />
												<!--<span style="font-size: 60px; font-weight: 100;">Web message</span></span>-->			
											</td>
											<td align="right" style="padding: 40px 10px 10px 0;">
												<span style="font-family: Museo Slab, Helvetica; font-size: 20px; color: #333;">' . $date . '</span>
											</td>
										</tr>
									</tbody>	
								</table>
							</td>
						</tr>
						<tr>
							<td>
				<!-- End of Header -->
				<!-- Content -->
								<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ff0" width="660px" style="color: #333; padding-bottom: 2px;">
									<tbody>
										<tr>
											<td style="padding:0;" colspan="12">
												<hr style="border: 1px solid #333" />
											</td>
										</tr>
				<!-- Blog -->
										<tr>
				            				<td>
				            					<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ff0" width="660px" style="color: #333; padding-bottom: 1px;">
				              						<tbody>
				                						<tr>
															<td style="padding: 0; background:#333333; color:#ff0;" colspan="10">
																<span style="font-family: Museo Slab, Helvetica; font-size: 30px; padding-left:15px;">New web message</span>
															</td>
														</tr>
				                						
				                						<tr>
				                  							<td style="padding: 20px 0 0;" colspan="5"> 
				                  								<img src="img/portfolioborder.png" alt="Portfolio Border" width="660px" height="1px" style="display: block;" />
				                  							</td>
				                						</tr>
				                						<tr>
				                 							<td style="padding: 15px 0 0 15px;" valign="top" align="right">
				                  								<span style="font-family: Museo Slab, Helvetica; font-size: 20px; color: #333;">Name:</span>
				                  							</td>
				                  							<td style="padding: 15px 20px 0 20px;" valign="top" > 
				                  								<span style="font-family: Museo Slab, Helvetica; font-size: 20px;">' . $firstname . ' ' . $lastname . '</span>
				                  							</td>
				                						</tr>
				                						<tr>
				                  							<td style="padding: 20px 0 0;" colspan="5"> 
				                  								<hr style="border: 1px solid #333" />	
				                  							</td>
				                						</tr>
				                						<tr>
				                  							<td style="padding: 15px 0 0 15px;" valign="top" align="right">
				                  								<span style="font-family: Museo Slab, Helvetica; font-size: 20px; color: #333;">E-mail:</span>
				                  							</td>
				                 							<td style="padding: 15px 25px 0 20px; " valign="top"  align="left">
				                  								<span style="font-family: Museo Slab, Helvetica; font-size: 20px; color:#333;">' . $emailFrom . '</span>
				                  							</td>
				                						</tr>
				                						<tr>
				                  							<td style="padding: 20px 0 0;" colspan="5"> 
				                  								<hr style="border: 1px solid #333" />
				                  							</td>
				                						</tr>
				                						
				                						<tr>
				                  							<td style="padding: 15px 0 0 15px;" valign="top" align="right">
				                  								<span style="font-family: Museo Slab, Helvetica; font-size: 20px; color: #333;">Phone:</span>
				                  							</td>
				                 							<td style="padding: 15px 25px 0 20px; " valign="top" align="left">
				                  								<span style="font-family: Museo Slab, Helvetica; font-size: 20px; color:#333;">' . $phoneFrom . '</span>
				                  							</td>
				                						</tr>
				                						<tr>
				                  							<td style="padding: 20px 0 0;" colspan="5"> 
				                  								<hr style="border: 1px solid #333" />
				                  							</td>
				                						</tr>

				                						<tr>
				                  							<td style="padding: 15px 0 0 15px;" valign="top" align="right">
				                  								<span style="font-family: Museo Slab, Helvetica; font-size: 20px; color: #333;">Comment:</span>
				                  							</td>
				                 							<td style="padding: 15px 25px 0 20px;" valign="top" align="left">
				                  								<span style="font-family: Museo Slab, Helvetica; font-size: 20px;">' . nl2br($comment) . '</span>
				                  							</td>
				                						</tr>

				              						</tbody>
				            					</table>
				            				</td>
				          				</tr>
				        			</tbody>
				      			</table>
				      		</td>
				      	</tr>
				<!-- End of Content -->
				
				    </table>
				  </td>
				 </tr>
				</tbody>
				</table>
				<!-- End of Main Table -->
				</body>
			</html>';
 		
		$headers = "From: DDC Contact Form <barry@camelotlifecoach.com>\r\n";
		$headers .= "Reply-To: " . $emailFrom . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		//$headers .= "CC: susan@example.com\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		
		mail($emailTo, $subject, $message, $headers);
?>