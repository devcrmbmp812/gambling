						<div class="panel panel-default ask-panel" id="fixed-right">
					  		<div class="panel-heading ask-panel-heading"><b>SPORT RECOMMAND</b></div>
						  	<div class="panel-body ask-panel-body">
						  		<?php
								$result = $User->query("SELECT `id`, `siteName`, `joinCode`, `link`, `imageName`, `sportsName` FROM `tblWebCards` WHERE `isRecommanded` = 'Y' ORDER BY `updatedOn` desc");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
								?>
						    	<div class="sticky row">
						    		<table class="text-center" style="width:100%;">
						    			<tr>
						    				<td style="width:30%;">
						    					<div class="text-white font12">
				                                    <a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><span class="text-white text-capitalize" style="margin-left: 6px;"><?php echo $value['siteName']; ?></span></a>
				                                </div>
						    				</td>
						    				<td style="width:33%;">
						    					<div class="text-white">
				                                    <span class="font12 text-center">Join code</span><br><span class="font15 text-center"><b><?php echo $value['joinCode']; ?></b></span>
				                                </div>	
						    				</td>
						    				<td style="width:33%;">	
				                                <div class="click">
				                                    <a href="http://<?php echo $value['link']; ?>" class="btn btn-ask hvr-grow-shadow text-center font12" style="font-weight:500 !important;">PLAY NOW</a>
				                                </div>
						    				</td>
						    			</tr>
						    		</table>
	                            </div>
	                            <?php
									}
								}
								?>
						  	</div>
						</div>
						<div class="ask-ads">
							<img src="images/banarAnim.gif" alt="" class="img-responsive hidden-sm hidden-xs" />
						</div>
						<div class="ask-ads">
							<img src="images/banarAnim1.gif" alt="" class="img-responsive hidden-sm hidden-xs" />
						</div>