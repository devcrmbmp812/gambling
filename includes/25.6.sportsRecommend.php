						<div class="panel panel-default ask-panel custom-show" id="fixed-right">
					  		<div class="panel-heading ask-panel-heading"><b style="margin-left: -10px;">배팅 사이트 추천</b></div>
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
				                                    <a href="sports-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><span class="text-white text-capitalize" style="margin-left: 6px;"><?php echo $value['siteName']; ?></span></a>
				                                </div>
						    				</td>
						    				<td style="width:33%;">
						    					<div class="text-white">
				                                    <span class="font12 text-center">가입코드</span><br><span class="font15 text-center"><b><?php echo $value['joinCode']; ?></b></span>
				                                </div>	
						    				</td>
						    				<td style="width:33%;">	
				                                <div class="click">
				                                    <a href="http://<?php echo $value['link']; ?>" class="btn btn-ask-black text-center font12" style="font-weight:500 !important;">PLAY</a>
				                                </div>
						    				</td>
						    			</tr>
						    		</table>
	                            </div>
	                            <?php
									}
								}
								?>
								<?php
								$result = $User->query("SELECT `id`, `siteName`, `joinCode`, `link`, `imageName`, `sportsName` FROM `tblSadariCards` WHERE `isRecommanded` = 'Y' ORDER BY `updatedOn` desc");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
								?>
						    	<div class="sticky row">
						    		<table class="text-center" style="width:100%;">
						    			<tr>
						    				<td style="width:30%;">
						    					<div class="text-white font12">
				                                    <a href="sadari-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><span class="text-white text-capitalize" style="margin-left: 6px;"><?php echo $value['siteName']; ?></span></a>
				                                </div>
						    				</td>
						    				<td style="width:33%;">
						    					<div class="text-white">
				                                    <span class="font12 text-center">가입코드</span><br><span class="font15 text-center"><b><?php echo $value['joinCode']; ?></b></span>
				                                </div>	
						    				</td>
						    				<td style="width:33%;">	
				                                <div class="click">
				                                    <a href="http://<?php echo $value['link']; ?>" class="btn btn-ask-black text-center font12" style="font-weight:500 !important;">PLAY</a>
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
							<div id="myCarouselads" class="carousel" data-ride="carousel" data-interval="5000">

							  <!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									<?php
									$result = $User->query("SELECT `adsImage`, `imageName`, `adsLink` FROM `tblAds` ORDER BY `sequence` ASC");
									$counter = 1;
									if(is_array($result) && count($result) > 0){
										foreach ($result as $key => $slider) {
													
									?>
									<div class="item<?php if($counter <= 1){echo " active"; } ?>">
										<a href="http://<?php echo $slider['adsLink']; ?>" target="_blank"><img src="<?php echo $slider['adsImage']; ?>" class="img-responsive center-block" alt="slider" /></a>
									</div>
									<?php
									$counter++;
										}
									}
									?>
								</div>

							  <!-- Left and right controls -->
								<a class="left carousel-control custom-control" href="#myCarouselads" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control custom-control" href="#myCarouselads" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
						<div class="ask-ads">
							<img src="images/banarAnim1.gif" alt="" class="img-responsive hidden-sm hidden-xs" />
						</div>
